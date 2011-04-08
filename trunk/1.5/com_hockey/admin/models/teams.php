<?php

/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class HockeyModelTeams extends JModel {

    var $_sez = null;
    var $_total;
    var $_pagination;
    var $_mainframe;
    var $_option;
    var $_id;

    function __construct() {
        parent::__construct();
        $session = &JFactory::getSession ();
        $this->_sez = (int) $session->get('sezon', 0);

        $this->_mainframe = &JFactory::getApplication();
        $this->_option = JRequest::getCmd('option');

        // Get pagination request variables
        $limit = $this->_mainframe->getUserStateFromRequest('global.list.limit', 'limit', $this->_mainframe->getCfg('list_limit'), 'int');
        $limitstart = $this->_mainframe->getUserStateFromRequest($this->_option . 'limitstart', 'limitstart', 0, 'int');

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
        $where = $this->_buildContentWhere();
        $query = ' SELECT * FROM #__hockey_teams '
                . $where
                . ' ORDER BY name ';
        return $query;
    }

    function _buildContentWhere() {

        $search = $this->_mainframe->getUserStateFromRequest($this->_option . 'search', 'search', '', 'string');
        $search = JString::strtolower($search);
        $where = array();

        if ($search) {
            $where[] = 'LOWER(name) LIKE ' . $this->_db->Quote($search . '%');
        }

        $where = ( count($where) ? ' WHERE ' . implode(' AND ', $where) : '' );
        return $where;
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

    // not veryfied return for add and edit
    function getTeam() {
        $cid = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cid);
        $row = & $this->getTable();
        $row->load($cid[0]);
        return $row;
    }

    function store() {
        $row = & $this->getTable();
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        $row->description = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWHTML);
        $row->review_date = date('Y-m-d H:i:s');

        if ($row->logo == '') {
            $row->logo = 'nologo.png';
        }

        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        $this->_id = $row->id;
        return true;
    }

    function getId() {
        return $this->_id;
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
            return true;
        }
        $this->setError(JText::_("Id not found"));
        return false;
    }

    function getSeasonTeamsSelect($pauzuje = false, $idsez = NULL) {

        if (!$idsez)
            $idsez = $this->_sez;

        $query = "SELECT #__hockey_teams.id AS value ,#__hockey_teams.name AS text "
                . "FROM   #__hockey_tabela "
                . "INNER JOIN #__hockey_teams ON (#__hockey_teams.id = #__hockey_tabela.team_id) "
                . "WHERE #__hockey_tabela.id_system=" . $this->_db->Quote($idsez);

        $this->_db->setQuery($query);
        $teams = $this->_db->loadObjectList();
        $kl = array();

        if (empty($teams)) {
            $std = new stdClass();
            $std->value = 0;
            $std->text = JText::_('ERROR NO TEAMS');
            $teams[0] = $std;
        }
        if ($pauzuje) {
            $il = count($teams);
            if ($il % 2 != 0) {
                $kl [] = JHTML::_('select.option', 0, JText::_('HOC_NOT_MATCH'));
            }
        }
        return $kluby = array_merge($kl, $teams);
    }

    function getAllTeamsSelect() {
        $query = "SELECT id AS value, name AS text FROM #__hockey_teams WHERE published =1 ORDER BY name";
        $this->_db->setQuery($query);
        $teams = $this->_db->loadObjectList();

        if (empty($teams)) {
            $std = new stdClass();
            $std->value = 0;
            $std->text = (string) JText::_('ERROR NO TEAMS');
            $teams[0] = $std;
        }
        $kl[] = JHTML::_('select.option', '0', JText::_('HOC_SELECT_TEAM_FILTR'));
        $kluby = array_merge($kl, $teams);
        return $kluby;
    }

    function getAllTeamsArray() {
        $query = "SELECT id, name FROM #__hockey_teams WHERE published=1 ORDER BY name";
        $this->_db->setQuery($query);
        $teams = $this->_db->loadAssocList();

        if (empty($teams)) {
            $teams[] = array('id' => '0', 'name' => 'ERROR NO TEAMS');
        }
        return $teams;
    }

    function getMyTeam() {
        $query = "SELECT myteam FROM #__hockey_system  WHERE id=" . $this->_db->Quote($this->_sez) . " LIMIT 1";
        $this->_db->setQuery($query);
        $myteam = $this->_db->loadResult();

        if (empty($myteam)) {
            $myteam = (string) JText::_('ERROR NO TEAMS');
        }
        return $myteam;
    }

    function getNameTeam($id) {
        $query = "SELECT name FROM #__hockey_teams WHERE id=" . $this->_db->Quote($id);
        $this->_db->setQuery($query);
        $name = $this->_db->loadResult();

        if (empty($name)) {
            $name = (string) JText::_('ERROR NO TEAMS');
        }
        return $name;
    }

    function getNameTeames($id) {
        $query = "SELECT t1.name as druzyna1, t2.name as druzyna2, ta.druzyna1 as team1, ta.druzyna2 as team2 "
                . "FROM #__hockey_match AS ta "
                . "LEFT JOIN #__hockey_teams AS t1 ON  ( t1.id = ta.druzyna1) "
                . "LEFT JOIN #__hockey_teams AS t2 ON  ( t2.id = ta.druzyna2) "
                . "WHERE ta.id =" . $this->_db->Quote($id);
        $this->_db->setQuery($query);
        $teams = $this->_db->loadAssoc();
        
         if (empty($teams)) {
            $teams[] = array('druzyna1' => JText::_('ERROR NO TEAMS'), 'druzyna2' => JText::_('ERROR NO TEAMS'), 'team1' => JText::_('ERROR NO TEAMS'), 'team2' => JText::_('ERROR NO TEAMS'));
        }
        return $teams;
    }
}

?>
