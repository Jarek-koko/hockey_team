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

class HockeyModelReferees extends JModel {

    var $_total;
    var $_pagination;
    var $_mainframe;
    var $_option;
    var $_id;

    function __construct() {
        parent::__construct();
      
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
        $query = ' SELECT * FROM #__hockey_referee '
                . $where
                . ' ORDER BY lname ';
        return $query;
    }

    function _buildContentWhere() {
        $search = $this->_mainframe->getUserStateFromRequest($this->_option . 'search', 'search', '', 'string');
        $search = JString::strtolower($search);
        $where = array();

        if ($search) {
            $where[] = 'LOWER(lname) LIKE ' . $this->_db->Quote($search . '%');
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

    // not veryfied  for add and edit
    function getReferee() {
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
        
        $row->review_date = date('Y-m-d H:i:s');
        
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
}
?>
