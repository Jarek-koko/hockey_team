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

class HockeyModelPlayer extends JModel {

    var $_idseason = null;
    var $_idplayer = null;
    var $_player = null;
    var $_goalie = false;

    function __construct() {
        parent::__construct ();
        $this->_idplayer = (int) JRequest::getVar('id', 0, 'get', 'int');
    }

    function setSezon($idsezon) {
        $idsezon = (int) $idsezon;
        if ($this->_idseason == null) {
            $this->_idseason = $idsezon;
        }
    }

    function getSelectPlayers() {
        $query = "SELECT id AS value, CONCAT_WS('. ',LEFT(imie,1),nazwisko) AS text "
                . "FROM #__hockey_players "
                . "WHERE published =1 AND klub=(SELECT myteam FROM #__hockey_system WHERE (id =".$this->_db->Quote($this->_idseason).")) "
                . "ORDER BY nazwisko";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    function getPlayer() {
        if (!$this->_player) {
            $query = "SELECT P.*,(YEAR(CURDATE()) - YEAR(P.data_u)) - (RIGHT(CURDATE(), 5) < RIGHT(P.data_u, 5)) AS wiek "
                    ."FROM #__hockey_players P "
                    ."WHERE (P.id = ". $this->_db->Quote($this->_idplayer ).") "
                    ."AND P.klub=(SELECT myteam FROM #__hockey_system WHERE (id=". $this->_db->Quote($this->_idseason).")) ";
            $this->_db->setQuery($query);
            $this->_player = $this->_db->loadObject();
        }
        if ($this->_player != null)
            if ($this->_player->pozycja == 1)
                $this->_goalie = true;

        return $this->_player;
    }

    function getStatplayer($i) {

        if ($this->_goalie) {
            $query = "SELECT S.nazwa, "
                    . "COALESCE((SELECT SUM(G.goals) "
                    . "FROM  #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goalie G  ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.id_player=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system ),0) AS total_goals, "
                    . "COALESCE((SELECT SUM(G.save) "
                    . "FROM  #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goalie G  ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.id_player=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system ),0) AS total_save, "
                    . "COALESCE((SELECT SUM(G.time_p) "
                    . "FROM  #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goalie G  ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.id_player=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system ),0) AS time_match, "
                    . "COALESCE((SELECT COUNT(G.shooter) "
                    . "FROM  #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.shooter=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system)  "
                    . "GROUP BY M.id_system),0) AS shoot, "
                    . "COALESCE((SELECT COUNT(G.assist1) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.assist1=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0)+ "
                    . "COALESCE((SELECT COUNT(G.assist2) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.assist2=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0) AS assist, "
                    . "COALESCE((SELECT COUNT(P.id_player) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_players P ON (P.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND P.id_player=" . $this->_db->Quote($this->_idplayer) . " AND P.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0) AS meczy, "
                    . "COALESCE((SELECT SUM(P.time_p) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_penalty P ON (P.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND P.id_player=" . $this->_db->Quote($this->_idplayer) . " AND P.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0) AS kary "
                    . "FROM #__hockey_system S HAVING (meczy <> 0)";
        } else {
            $query = "SELECT S.nazwa, "
                    . "COALESCE((SELECT COUNT(G.shooter) "
                    . "FROM  #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.shooter=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam AND S.id =M.id_system)  "
                    . "GROUP BY M.id_system),0) AS shoot, "
                    . "COALESCE((SELECT COUNT(G.assist1) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.assist1=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam  AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0)+ "
                    . "COALESCE((SELECT COUNT(G.assist2) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND G.assist2=" . $this->_db->Quote($this->_idplayer) . " AND G.id_team = S.myteam  AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0) AS assist, "
                    . "COALESCE((SELECT COUNT(P.id_player) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_players P ON (P.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND P.id_player=" . $this->_db->Quote($this->_idplayer) . " AND P.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0) AS meczy, "
                    . "COALESCE((SELECT SUM(P.time_p) "
                    . "FROM #__hockey_match M "
                    . "LEFT JOIN #__hockey_match_penalty P ON (P.id_match = M.id) "
                    . "WHERE (M.type_of_match =" . $this->_db->Quote($i) . " AND P.id_player=" . $this->_db->Quote($this->_idplayer) . " AND P.id_team = S.myteam AND S.id =M.id_system) "
                    . "GROUP BY M.id_system),0) AS kary "
                    . "FROM #__hockey_system S HAVING (meczy <> 0) ";
        }
        return $this->_getList($query, 0, 0);
    }
}
?>