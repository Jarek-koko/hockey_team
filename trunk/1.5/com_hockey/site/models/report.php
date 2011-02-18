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

class HockeyModelReport extends JModel {

    var $_id = null;

    function __construct() {
        parent::__construct ();
    }

    function setId($id) {
        $id = (int) $id;
        if ($this->_id == null) {
            $this->_id = $id;
        }
    }

    function getList() {
        $query = "SELECT t2.name AS home, t1.w1p1,t1.w2p1,t1.w1p2,t1.w2p2,t1.w1p3,t1.w2p3,t1.w1ot,t1.w2ot,t1.w1so,t1.w2so, t3.name AS visitor, t1.druzyna1, t1.druzyna2, t1.data,"
                . "t1.wynik_1, t1.wynik_2, t2.logo AS logo1, t3.logo AS logo2, "
                . "CONCAT_WS( ' ', r1.lname, r1.fname ) AS referee1, "
                . "CONCAT_WS( ' ', r2.lname, r2.fname ) AS referee2, "
                . "CONCAT_WS( ' ', r3.lname, r3.fname ) AS referee3, "
                . "CONCAT_WS( ' ', r4.lname, r4.fname ) AS referee4, t4.text "
                . "FROM #__hockey_match t1 "
                . "LEFT JOIN #__hockey_teams t2 ON ( t2.id = t1.druzyna1 ) "
                . "LEFT JOIN #__hockey_teams t3 ON ( t3.id = t1.druzyna2 ) "
                . "LEFT JOIN #__hockey_match_rapport t4 ON ( t4.id_match = t1.id ) "
                . "LEFT JOIN #__hockey_referee r1 ON (r1.id = t4.id_referee1) "
                . "LEFT JOIN #__hockey_referee r2 ON (r2.id = t4.id_referee2) "
                . "LEFT JOIN #__hockey_referee r3 ON (r3.id = t4.id_referee3) "
                . "LEFT JOIN #__hockey_referee r4 ON (r4.id = t4.id_referee4) "
                . "WHERE t1.id =" . $this->_db->Quote($this->_id);

        $this->_db->setQuery($query);
        return $this->_db->loadAssoc();
    }

    function getPenalty() {
        $query = "SELECT t1.*, CONCAT_WS( ' ', t2.imie, t2.nazwisko ) AS player "
                . "FROM #__hockey_match_penalty t1 "
                . "LEFT JOIN #__hockey_players t2 ON ( t2.id = t1.id_player ) "
                . "WHERE t1.id_match=" . $this->_db->Quote($this->_id)
                . " ORDER BY t1.period,t1.time";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getGoals() {
        $query = "SELECT t1.*, "
                . "CONCAT_WS( ' ', t2.imie, t2.nazwisko ) AS shooter, "
                . "CONCAT_WS( ' ', t3.imie, t3.nazwisko ) AS assist1, "
                . "CONCAT_WS( ' ', t4.imie, t4.nazwisko ) AS assist2 "
                . "FROM #__hockey_match_goals t1 "
                . "LEFT JOIN #__hockey_players t2 ON ( t2.id = t1.shooter ) "
                . "LEFT JOIN #__hockey_players t3 ON ( t3.id = t1.assist1 ) "
                . "LEFT JOIN #__hockey_players t4 ON ( t4.id = t1.assist2 ) "
                . "WHERE t1.id_match=" . $this->_db->Quote($this->_id)
                . " ORDER BY t1.period, t1.score1, t1.score2 ASC";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getPlayers() {

        $query = "SELECT M.id, CONCAT_WS('.', LEFT(P.imie,1),P.nazwisko) AS nazwisko , M.id_team, P.pozycja,P.nr, "
                . "COALESCE(( SELECT COUNT(G.shooter) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_goals G ON (G.id_match = M.id) "
                . "WHERE ( M.id=" . $this->_db->Quote($this->_id) . " AND G.shooter = P.id )),0) AS bramki, "
                . "COALESCE(( SELECT COUNT(G.assist1) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_goals G ON (G.id_match = M.id) "
                . "WHERE ( M.id=" . $this->_db->Quote($this->_id) . " AND G.assist1 = P.id )),0) + "
                . "COALESCE(( SELECT COUNT(G.assist2) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_goals G ON (G.id_match = M.id) "
                . "WHERE ( M.id=" . $this->_db->Quote($this->_id) . " AND G.assist2 = P.id )),0) AS asysta, "
                . "COALESCE(( SELECT SUM(G.time_p) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_penalty G ON (G.id_match = M.id) "
                . "WHERE (M.id =" . $this->_db->Quote($this->_id) . " AND G.id_player = P.id )),0)  AS kary "
                . "FROM new_hockey_match_players M "
                . "INNER JOIN new_hockey_players P ON (P.id = M.id_player) "
                . "WHERE M.id_match=" . $this->_db->Quote($this->_id) . " AND p.pozycja <> 1 "
                . "ORDER BY M.id_team, P.pozycja,P.nazwisko ";

        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getGoalie() {
        $query = "SELECT M.id,CONCAT_WS('.', LEFT(P.imie,1),P.nazwisko) AS nazwisko , M.id_team, P.pozycja, P.nr, M.time_p,M.goals, M.save, "
                . "COALESCE(( SELECT COUNT(G.shooter) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_goals G ON (G.id_match = M.id) "
                . "WHERE ( M.id=" . $this->_db->Quote($this->_id) . " AND G.shooter = P.id )),0) AS bramki, "
                . "COALESCE(( SELECT COUNT(G.assist1) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_goals G ON (G.id_match = M.id) "
                . "WHERE ( M.id=" . $this->_db->Quote($this->_id) . " AND G.assist1 = P.id )),0) + "
                . "COALESCE(( SELECT COUNT(G.assist2) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_goals G ON (G.id_match = M.id) "
                . "WHERE ( M.id=" . $this->_db->Quote($this->_id) . " AND G.assist2 = P.id )),0) AS asysta, "
                . "COALESCE(( SELECT SUM(G.time_p) "
                . "FROM new_hockey_match M "
                . "INNER JOIN new_hockey_match_penalty G ON (G.id_match = M.id) "
                . "WHERE (M.id =" . $this->_db->Quote($this->_id) . " AND G.id_player = P.id )),0)  AS kary "
                . "FROM new_hockey_match_goalie M "
                . "INNER JOIN new_hockey_players P ON (P.id = M.id_player) "
                . "WHERE M.id_match=" . $this->_db->Quote($this->_id) . " AND p.pozycja = 1 "
                . "ORDER BY M.id_team, P.pozycja,P.nazwisko";

        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

}

?>