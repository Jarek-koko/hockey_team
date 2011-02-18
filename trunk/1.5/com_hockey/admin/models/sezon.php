<?php

/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey Team
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class HockeyModelSezon extends JModel {

    var $_data;
    var $_total;
    var $_pagination;

    function __construct() {
        parent::__construct();

        $mainframe = &JFactory::getApplication();
        $option = JRequest::getCmd('option');

        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = $mainframe->getUserStateFromRequest($option . 'limitstart', 'limitstart', 0, 'int');

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }

    function getData() {

        if (empty($this->_data)) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_data;
    }

    function _buildQuery() {
        $query = "SELECT system.*, teams.name "
                . "FROM #__hockey_system AS system LEFT JOIN #__hockey_teams AS teams ON (system.myteam = teams.id) "
                . "ORDER BY teams.id ";
        return $query;
    }

    function getTotal() {
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }

    function getPagination() {
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_pagination;
    }

    function store() {
        $nazwa = JRequest::getVar('nazwa', '', 'post');
        $kluby = JRequest::getVar('klub', array(0), 'post', 'array');

        //verification number teams min 2 teams
        if (count($kluby) < 2) {
            $this->setError(JText::_('HOC_HOA_MSG_MIN_TEAMS'));
            return false;
        }

        //veryfication if name that sezon existe !!
        $db = & JFactory::getDBO();
        $query = "SELECT id FROM #__hockey_system WHERE nazwa =" .$db->Quote($nazwa). " ";
        $db->setQuery($query);

        if ($db->getNumRows() > 0) {
            $this->setError(JText::_('HOC_HOA_MSG_ERR_SEASON'));
            return false;
        }

        $row = & $this->getTable();
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        $id = $db->insertid();

        //tables teams insert
        foreach ($kluby as $klub) {
            $klub = $db->Quote($klub);
            $query = "INSERT INTO #__hockey_tabela (team_id ,id_system) VALUES ( $klub,'$id')";
            $db->setQuery($query);
            if (!$db->query()) {
                $this->setError($row->getErrorMsg());
                return false;
            }
        }
        return true;
    }

    function update() {
        $row = & $this->getTable();
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        return true;
    }

    function delete() {
        $cids = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cids, array());

        if (count($cids)) {
            $row = & $this->getTable();

            foreach ($cids as $cid) {
                if (!$row->delete($cid)) {
                    $this->setError($row->getErrorMsg());
                    return false;
                }
            }

            $session = &JFactory::getSession ();
            $session->clear('sezon');
            return true;
        }

        $this->setError(JText::_("Id not found"));
        return false;
    }

    function getNameSezon() {
        $cids = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid, array(0));

        $db = & JFactory::getDBO ();
        if (count($cids)) {
            $cid = implode(',', $cids);
            $query = "SELECT id,nazwa FROM #__hockey_system WHERE id IN ( $cid )";
            $db->setQuery($query);

            if (!$db->query()) {
                $this->setError($row->getErrorMsg());
                return false;
            }
            $name =  $db->loadObjectList();

            if(empty($name)) {
                $this->setError('ERROR SEASON NAME');
                return false;
            }
            return $name;
            
        } else {
            $this->setError(JText::_("Id not found"));
            return false;
        }
    }

    function getSezon() {
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid);

        $row = & $this->getTable();
        if (!$row->load($cid[0])) {
            $this->setError(JText::_("SEASON ERROR ID"));
            return false;
        }
        return $row;
    }
}
?>
