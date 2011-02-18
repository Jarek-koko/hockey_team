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

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');


class HockeyModelMatches extends JModel {

    var $_sez = null;

    function __construct() {
        parent::__construct();
        $session = &JFactory::getSession ();
        $this->_sez = (int) $session->get('sezon', 0);
    }

    function store() {
        $row = & $this->getTable('match');
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

    function multistore() {
        $liczba = (int) JRequest::getVar('liczba', null, 'POST', 'INT');
        $db = & JFactory::getDBO ();

        if ($liczba != null) {
            for ($i = 0; $i < $liczba; $i++) {
                $druzyna1 = (int) JRequest::getVar('druzyna1' . $i, null, 'POST', 'INT');
                $druzyna2 = (int) JRequest::getVar('druzyna2' . $i, null, 'POST', 'INT');
                $data = JRequest::getVar('data' . $i, null, 'POST');
                $kolejka = (int) JRequest::getVar('kolejka_nr' . $i, null, 'POST', 'INT');

                if (($data == null) || ($kolejka == null)) {
                    $this->setError(JText::_('HOC_NOT_EVERY_SAVED'));
                    return false;
                }

                $obj = new stdClass();
                $obj->druzyna1 = $druzyna1;
                $obj->druzyna2 = $druzyna2;
                $obj->id_kolejka = $kolejka;
                $obj->data = $data;
                $obj->id_system = $this->_sez;
                $obj->published = 1;
                if (!$db->insertObject('#__hockey_match', $obj)) {
                    $this->setError($db->getErrorMsg());
                    return false;
                }
            }
            return true;
        }
        $this->setError(JText::_("Id not found"));
        return false;
    }

    function delete() {
        $cids = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cids, array(0));
       
        if (count($cids)) {
            $row = & $this->getTable('match');
            foreach ($cids as $cid) {
                if (!$row->delete($cid)) {
                    $this->setError($row->getError());
                    return false;
                }
            }
            return true;
        }
        $this->setError(JText::_("Id not found"));
        return false;
    }

    function getListMatchday($type) {
        //lista kolejek
        $query = "SELECT DISTINCT id_kolejka FROM #__hockey_match WHERE id_system ='$this->_sez' AND type_of_match='$type' ORDER BY id_kolejka";
        $this->_db->setQuery($query);
        return $this->_db->loadResultArray();
    }

    function getListMatches($nr_kol, $type) {
        $query = "SELECT tb1.name as druzyna1, tb2.name as druzyna2, tb0.id, "
                . "tb0.wynik_1, tb0.wynik_2, tb0.published ,tb0.data,tb0.druzyna1 AS idteam1, tb0.druzyna2 AS idteam2 "
                . "FROM #__hockey_match AS tb0 "
                . "LEFT JOIN #__hockey_teams AS tb1 ON (tb0.druzyna1 = tb1.id) "
                . "LEFT JOIN #__hockey_teams AS tb2 ON (tb0.druzyna2 = tb2.id) "
                . "WHERE (id_system='$this->_sez') AND (id_kolejka= '$nr_kol' ) AND (type_of_match='$type')";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getLastMatchday($type) {
        $query = "SELECT id_kolejka FROM #__hockey_match  WHERE (id_system=$this->_sez) AND (type_of_match='$type') ORDER BY id_kolejka DESC";
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }

}

?>
