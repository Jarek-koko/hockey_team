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

class HockeyModelReports extends JModel {

    var $_mainframe;
    var $_option;
    var $_sez;
    var $_id;

    function __construct() {
        parent::__construct();
        $session = &JFactory::getSession ();
        $this->_sez = (int) $session->get('sezon', 0);
        $this->_mainframe = &JFactory::getApplication();
        $this->_option = JRequest::getCmd('option');
    }

    function getInfoSP() {
        //get info if shootout and overtime exist in season
        $db = & JFactory::getDBO ();
        $query = "SELECT karne, dogr FROM #__hockey_system  WHERE id=" . $db->Quote($this->_sez);
        $db->setQuery($query);
        return $db->loadAssoc();
    }

    function storeReport1() {
        $this->_id = (int) JRequest::getVar('id_match', 0, 'POST', 'int');

        if (($this->_id != 0) and ($this->_sez != 0)) {

            $wynik_1 = (int) JRequest::getVar('wynik_1', 0, 'POST', 'int');
            $wynik_2 = (int) JRequest::getVar('wynik_2', 0, 'POST', 'int');
            $w1p1 = JRequest::getVar('w1p1', null, 'POST', 'string');
            $w2p1 = JRequest::getVar('w2p1', null, 'POST', 'string');
            $w1p2 = JRequest::getVar('w1p2', null, 'POST', 'string');
            $w2p2 = JRequest::getVar('w2p2', null, 'POST', 'string');
            $w1p3 = JRequest::getVar('w1p3', null, 'POST', 'string');
            $w2p3 = JRequest::getVar('w2p3', null, 'POST', 'string');
            $w1ot = JRequest::getVar('w1ot', null, 'POST', 'string');
            $w2ot = JRequest::getVar('w2ot', null, 'POST', 'string');
            $w1so = JRequest::getVar('w1so', null, 'POST', 'string');
            $w2so = JRequest::getVar('w2so', null, 'POST', 'string');
            $karne = JRequest::getVar('karne', 'F', 'POST', 'string');
            $dogrywka = JRequest::getVar('dogrywka', 'F', 'POST', 'string');

            $db = & JFactory::getDBO ();
            $obj = new stdClass();
            $obj->id = $this->_id;
            $obj->wynik_1 = $wynik_1;
            $obj->wynik_2 = $wynik_2;
            $obj->w1p1 = ($w1p1 !== "") ? (int) $w1p1 : NULL;
            $obj->w2p1 = ($w2p1 !== "") ? (int) $w2p1 : NULL;
            $obj->w1p2 = ($w1p2 !== "") ? (int) $w1p2 : NULL;
            $obj->w2p2 = ($w2p2 !== "") ? (int) $w2p2 : NULL;
            $obj->w1p3 = ($w1p3 !== "") ? (int) $w1p3 : NULL;
            $obj->w2p3 = ($w2p3 !== "") ? (int) $w2p3 : NULL;

            if ($dogrywka == "T") {
                $obj->m_dogr = "T";
                $obj->w1ot = ($w1ot !== "") ? (int) $w1ot : NULL;
                $obj->w2ot = ($w2ot !== "") ? (int) $w2ot : NULL;
            } else {
                $obj->m_dogr = "F";
                $obj->w1ot = NULL;
                $obj->w2ot = NULL;
            }

            if ($karne == "T") {
                $obj->m_karne = "T";
                $obj->w1so = ($w1so !== "") ? (int) $w1so : NULL;
                $obj->w2so = ($w2so !== "") ? (int) $w2so : NULL;
            } else {
                $obj->m_karne = "F";
                $obj->w1so = NULL;
                $obj->w2so = NULL;
            }

            if (!$db->updateObject('#__hockey_match', $obj, 'id', false)) {
                $this->setError($db->getErrorMsg());
                return false;
            }
            return true;
        }
        $this->setError(JText::_("Id not found"));
        return false;
    }

    function getGoalie($id_match) {
        $db = & JFactory::getDBO ();
        $query = "SELECT g.* , CONCAT_WS( ' ', p.imie, p.nazwisko ) AS player "
                . "FROM #__hockey_match_goalie g "
                . "LEFT JOIN #__hockey_players p ON (p.id = g.id_player) "
                . "WHERE g.id_match =" . $db->Quote($id_match);
        $db->setQuery($query);
        return $rows = $db->loadObjectList();
    }

    function storeReport5() {
        $row = & $this->getTable('match_goalie');
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

    function deleteReport5() {
        $cids = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cids, array(0));

        if (count($cids)) {
            $row = & $this->getTable('match_goalie');

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

    function getPenalty($id_match) {
        $db = & JFactory::getDBO ();
        $query = "SELECT t1.*, CONCAT_WS( ' ', t2.imie, t2.nazwisko ) AS player "
                . "FROM #__hockey_match_penalty t1 "
                . "LEFT JOIN #__hockey_players t2 ON (t2.id = t1.id_player) "
                . "WHERE t1.id_match =" . $db->Quote($id_match) . " ORDER BY t1.period ASC, t1.time ASC";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    function storeReport4() {
        $row = & $this->getTable('match_penalty');
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        $row->id_team = (int) JRequest::getVar('state', 0, 'POST', 'int');

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

    function deleteReport4() {
        $cids = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cids, array(0));

        if (count($cids)) {
            $row = & $this->getTable('match_penalty');

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

    function getGool($id_match) {
        //pobieranie info goli
        $db = & JFactory::getDBO ();
        $query = "SELECT t1.id,t1.id_match,t1.time,t1.score1,t1.score2,t1.info,t1.id_team, t1.period , "
                . "CONCAT_WS( ' ', t2.imie, t2.nazwisko ) AS strzelec, "
                . "CONCAT_WS( ' ', t3.imie, t3.nazwisko ) AS asysta1, "
                . "CONCAT_WS( ' ', t4.imie, t4.nazwisko ) AS asysta2 "
                . "FROM #__hockey_match_goals t1 "
                . "LEFT JOIN #__hockey_players t2 ON (t2.id = t1.shooter) "
                . "LEFT JOIN #__hockey_players t3 ON (t3.id = t1.assist1) "
                . "LEFT JOIN #__hockey_players t4 ON (t4.id = t1.assist2) "
                . "WHERE t1.id_match =" . $db->Quote($id_match) . " ORDER BY t1.score1, t1.score2 ASC ";

        $db->setQuery($query);
        return $db->loadObjectList();
    }

    function storeReport3() {
        $row = & $this->getTable('match_goals');
        $data = JRequest::get('post');

        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        $row->id_team = (int) JRequest::getVar('state', 0, 'POST', 'int');

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

    function deleteReport3() {
        $cids = JRequest::getVar('cid', array(0), '', 'array');
        JArrayHelper::toInteger($cids, array(0));

        if (count($cids)) {
            $row = & $this->getTable('match_goals');

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

    function getReferees() {
        $db = & JFactory::getDBO ();
        $query = "SELECT id AS value, CONCAT_WS( ' ', lname, fname ) AS text  FROM #__hockey_referee WHERE published=1 ORDER BY text";
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    function getRapport($id_match) {
        $db = & JFactory::getDBO ();
        $query = "SELECT * FROM #__hockey_match_rapport WHERE id_match=" . $db->Quote($id_match);
        $db = & JFactory::getDBO ();
        $db->setQuery($query);
        $list = $db->loadObject();

        if (empty($list)) {
            $std = new stdClass();
            $std->id = null;
            $std->id_referee1 = null;
            $std->id_referee2 = null;
            $std->id_referee3 = null;
            $std->id_referee4 = null;
            $std->text = null;
            $list = $std;
        }
        return $list;
    }

    function storeReport6() {
        $id_match = (int) JRequest::getVar('id_match', 0, 'POST', 'int');

        if ($id_match != 0) {
            $id = (int) JRequest::getVar('id', 0, 'POST', 'int');
            $id_referee1 = (int) JRequest::getVar('id_referee1', 0, 'POST', 'int');
            $id_referee2 = (int) JRequest::getVar('id_referee2', 0, 'POST', 'int');
            $id_referee3 = (int) JRequest::getVar('id_referee3', 0, 'POST', 'int');
            $id_referee4 = (int) JRequest::getVar('id_referee4', 0, 'POST', 'int');

            $db = & JFactory::getDBO ();
            $obj = new stdClass();
            $obj->id = $id;
            $obj->id_match = $id_match;
            $obj->id_referee1 = ($id_referee1 != 0) ? $id_referee1 : null;
            $obj->id_referee2 = ($id_referee2 != 0) ? $id_referee2 : null;
            $obj->id_referee3 = ($id_referee3 != 0) ? $id_referee3 : null;
            $obj->id_referee4 = ($id_referee4 != 0) ? $id_referee4 : null;

            if ($id) {
                $ret = $db->updateObject('#__hockey_match_rapport', $obj, 'id', false);
            } else {
                $ret = $db->insertObject('#__hockey_match_rapport', $obj, 'id');
            }
            if (!$ret) {
                $this->setError($db->getErrorMsg());
                return false;
            } else {
                return true;
            }
        }
        $this->setError(JText::_("Id not found"));
        return false;
    }

    function storeReport7() {
        $id_match = (int) JRequest::getVar('id_match', 0, 'POST', 'int');

        if ($id_match != 0) {
            $id = (int) JRequest::getVar('id', 0, 'POST', 'int');
            $text = JRequest::getVar('text', 0, 'POST', 'string', JREQUEST_ALLOWHTML);

            $db = & JFactory::getDBO ();
            $obj = new stdClass();
            $obj->id = $id;
            $obj->text = $text;

            if ($id) {
                $ret = $db->updateObject('#__hockey_match_rapport', $obj, 'id', false);
            } else {
                $ret = $db->insertObject('#__hockey_match_rapport', $obj, 'id');
            }
            if (!$ret) {
                $this->setError($db->getErrorMsg());
                return false;
            } else {
                return true;
            }
        }
        $this->setError(JText::_("Id not found"));
        return false;
    }

    function getPlayers($id_match, $id_team1, $id_team2) {

        $id_match = (int) $id_match;
        $id_team1 = (int) $id_team1;
        $id_team2 = (int) $id_team2;

        $db = & JFactory::getDBO ();
        $query = "SELECT  tt.id, bb.id_player ,tt.nazwisko, tt.imie, tt.pozycja, tt.klub "
                . "FROM #__hockey_players AS tt "
                . "LEFT JOIN #__hockey_match_players AS bb "
                . "ON (tt.id = bb.id_player AND bb.id_match=$id_match AND (bb.id_team=$id_team1 OR bb.id_team=$id_team2 )) "
                . "WHERE tt.published=1 AND (tt.klub=$id_team1 OR tt.klub=$id_team2) "
                . "ORDER BY tt.klub , tt.nazwisko";
        $db->setQuery($query);
        return $db->loadAssocList();
    }

    function storeReport2() {
        $players1 = JRequest::getVar('players1', null, 'post', 'array');
        $players2 = JRequest::getVar('players2', null, 'post', 'array');

        $team1 = JRequest::getVar('team1', null, 'post', 'string');
        $team2 = JRequest::getVar('team2', null, 'post', 'string');
        $id_match = JRequest::getVar('id_match', null, 'post', 'int');

        if (count($players1)) {
            if (!$this->_savePlayers($id_match, $players1, $team1)) {
                return false;
            }
        }

        if (count($players2)) {
            if (!$this->_savePlayers($id_match, $players2, $team2)) {
                return false;
            }
        }
        return true;
    }

    function _savePlayers($id_match, $players, $team) {

        $id_match = (int) $id_match;
        $team = (int) $team;
        JArrayHelper::toInteger($players, array(0));
        $count = count($players);

        if ($count) {
            $db = & JFactory::getDBO ();

            // verif if exist
            $query = "SELECT id_player FROM #__hockey_match_players WHERE id_match=$id_match AND id_team=$team";
            $db->setQuery($query);
            $ver = $db->loadObjectList();

            if ($db->getErrorNum()) {
                $this->setError($db->getErrorMsg());
                return false;
            }
            // if yes ! then delete
            if ($ver != null) {
                $query = "DELETE FROM #__hockey_match_players WHERE id_match = $id_match AND id_team=$team";
                $db->setQuery($query);

                if (!$db->query()) {
                    $this->setError($db->getErrorMsg());
                    return false;
                }
            }
            // and add new players into the match
            $query = "INSERT INTO #__hockey_match_players (id_match ,id_player , id_team ) VALUES  ";

            for ($i = 0; $i < $count; $i++) {
                if ($i != 0)
                    $query .= " , ";
                $query .= "('$id_match','$players[$i]','$team')";
            }
            $db->setQuery($query);
            if (!$db->query()) {
                $this->setError($db->getErrorMsg());
                return false;
            }
            return true;
        }
    }
}
?>
