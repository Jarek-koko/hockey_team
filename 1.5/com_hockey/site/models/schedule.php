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

class HockeyModelSchedule extends JModel {

    var $_list = null;
    var $_idsezon = null;
    var $_kolejka = null;
    var $_tom = null;
    var $_where = null;

    function __construct() {
        parent::__construct ();
        $this->_idsezon = (int) JRequest::getVar('sezon', 0, 'post', 'int');
        $this->_tom = (int) JRequest::getVar('tom', 0, 'post', 'int');
        $this->_where = (int) JRequest::getVar('where', 0, 'post', 'int');
    }

    function setSezon($idsezon) {
        $idsezon = (int) $idsezon;
        if ($this->_idsezon == 0) {
            $this->_idsezon = $idsezon;
        }
    }

    function getData() {
        $query = 'SELECT id AS value, nazwa AS text FROM #__hockey_system ORDER BY id DESC';
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getListMatchday($i) {
        $query = "SELECT DISTINCT id_kolejka FROM #__hockey_match WHERE id_system =" . $this->_db->Quote($this->_idsezon) 
               . " AND type_of_match=".$this->_db->Quote($i)." AND published='1' ORDER BY id_kolejka";
        $this->_db->setQuery($query);
        return $this->_db->loadResultArray();
    }

    // zwraca liste kolejek w sezonie ustawionym
    function getListMatches($nr_kol, $i) {
        if (!$this->_list) {
            $query = "SELECT M.id,M.data,T1.name AS druzyna1,T2.name AS druzyna2,M.wynik_1,M.wynik_2,M.m_dogr,M.m_karne, R.id as rid "
                    . "FROM #__hockey_match M  "
                    . "LEFT JOIN #__hockey_match_rapport R ON (R.id_match=M.id) "
                    . "LEFT JOIN #__hockey_teams T1 ON (M.druzyna1=T1.id) "
                    . "LEFT JOIN #__hockey_teams T2 ON (M.druzyna2=T2.id) "
                    . "WHERE M.published='1' AND M.type_of_match=" . $this->_db->Quote($i)
                    . " AND M.id_system=" . $this->_db->Quote($this->_idsezon) . " AND M.id_kolejka=" . $this->_db->Quote((int) $nr_kol)
                    . " ORDER BY M.data";
            $this->_list = $this->_getList($query, 0, 0);
        }
        return $this->_list;
    }

    function getListPlayoff() {

        if (!$this->_list) {
            $query = "SELECT M.id,M.data,T1.name AS druzyna1,T2.name AS druzyna2,M.wynik_1,M.wynik_2,M.m_dogr,M.m_karne ,M.id_kolejka, R.id as rid "
                    . "FROM #__hockey_match M  "
                    . "LEFT JOIN #__hockey_match_rapport R ON (R.id_match=M.id) "
                    . "LEFT JOIN #__hockey_teams T1 ON (M.druzyna1=T1.id) "
                    . "LEFT JOIN #__hockey_teams T2 ON (M.druzyna2=T2.id) "
                    . "WHERE M.published='1' AND M.type_of_match='1' AND M.id_system=" . $this->_db->Quote($this->_idsezon)
                    . " ORDER BY M.id_kolejka ,M.data";
            $this->_list = $this->_getList($query, 0, 0);
        }
        return $this->_list;
    }

    function getAllList() {

        if (!$this->_list) {

            $myteam = " (SELECT myteam FROM #__hockey_system  WHERE id=" . $this->_db->Quote($this->_idsezon) . " LIMIT 1) ";

            switch ($this->_where) {
                case 2:
                    $where = 'AND (M.druzyna2= ' . $myteam . ' ) ';
                    break;
                case 1:
                    $where = 'AND (M.druzyna1=' . $myteam . ' ) ';
                    break;
                default:
                    $where = ' AND (M.druzyna1=' . $myteam . ' OR M.druzyna2=' . $myteam . ' ) ';
                    break;
            }
            switch ($this->_tom) {
                case 2:
                    $tom = 'AND (M.type_of_match=2) ';
                    break;
                case 1:
                    $tom = 'AND (M.type_of_match=1) ';
                    break;
                default:
                    $tom = ' AND (M.type_of_match=0) ';
                    break;
            }
            $query = "SELECT M.id,M.data,T1.name AS druzyna1,T2.name AS druzyna2,M.wynik_1,M.wynik_2,M.m_dogr,M.m_karne ,M.id_kolejka ,M.type_of_match ,MONTH(M.data) as mm, R.id as rid "
                    . "FROM #__hockey_match M  "
                    . "LEFT JOIN #__hockey_match_rapport R ON (R.id_match=M.id) "
                    . "LEFT JOIN #__hockey_teams T1 ON (M.druzyna1=T1.id) "
                    . "LEFT JOIN #__hockey_teams T2 ON (M.druzyna2=T2.id) "
                    . "WHERE M.published='1' " . $where . " " . $tom . " AND M.id_system=" . $this->_db->Quote($this->_idsezon)
                    . " ORDER BY M.type_of_match, M.id_kolejka ,M.data";
            $this->_list = $this->_getList($query, 0, 0);
        }
        return $this->_list;
    }

}

?>