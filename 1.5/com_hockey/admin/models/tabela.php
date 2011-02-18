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

class HockeyModelTabela extends JModel {

   
    var $_mainframe;
    var $_option;
    var $_id;
    var $_sez;
    var $_data;

    function __construct() {
        parent::__construct();

        $session = &JFactory::getSession ();
        $this->_sez = (int) $session->get('sezon', 0);
        $this->_mainframe = &JFactory::getApplication();
        $this->_option = JRequest::getCmd('option');
    }

    function getData() {
        if (empty($this->_data)) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query);
        }
        return $this->_data;
    }

    function _buildQuery() {
          $query = "SELECT #__hockey_teams.name, #__hockey_tabela.* "
            ."FROM   #__hockey_tabela "
            ."INNER JOIN #__hockey_teams "
            ."ON (#__hockey_tabela.team_id = #__hockey_teams.id) "
            ."WHERE id_system=$this->_sez ORDER BY grupa ASC, punkty DESC, ordering ASC";
        return $query;
    }

    
    // not veryfied  for add and edit
    function getItem() {
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

        if ($row->id_system == '') {
            $row->id_system = $this->_sez;
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

    function order(){
        $cid = JRequest::getVar ( 'cid', array(0), 'post', 'array' );
        JArrayHelper::toInteger($cid, array(0));
        $order = JRequest::getVar ( 'order', array(0), 'post', 'array' );
        JArrayHelper::toInteger($order, array(0));
        $total = count ( $cid );

        if (empty ( $cid )) {
            $this->setError(JText::_('No items selected'));
            return false;
        }
        
        $row = & $this->getTable();
        // update ordering values
        for($i = 0; $i < $total; $i ++) {

            $row->load (( int ) $cid [$i]);

            if ($row->ordering != $order [$i]) {
                $row->ordering = $order [$i];

                if (! $row->store ()) {
                     $this->setError($this->_db->getErrorMsg());
                     return false;
                }
            }
        }
    }

    function ordergrup() {
        $cid = JRequest::getVar ( 'cid', array(0), 'post', 'array' );
        JArrayHelper::toInteger($cid, array(0));
        $order = JRequest::getVar ( 'order2', array(0), 'post', 'array' );
        JArrayHelper::toInteger($order, array(0));
        $total = count ( $cid );

        if (empty ( $cid )) {
            $this->setError(JText::_('No items selected'));
            return false;
        }

        $row = & $this->getTable();
        // update ordering values
        for($i = 0; $i < $total; $i ++) {

            $row->load (( int ) $cid [$i]);

            if ($row->grupa != $order [$i]) {
                $row->grupa = $order [$i];

                if (! $row->store ()) {
                     $this->setError($this->_db->getErrorMsg());
                     return false;
                }
            }
        }


    }
}
?>
