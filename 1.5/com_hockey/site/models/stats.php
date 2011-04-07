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
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.model' );

class HockeyModelStats extends JModel {

    function __construct() {
        parent::__construct ();
    }

    function getListPlayers($id ,$sez) {
        $query = "SELECT P.id,P.imie,P.nazwisko,P.foto,P.pozycja, "
            ."COALESCE(( SELECT COUNT(G.shooter) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.shooter = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) AS bramki, "
            ."COALESCE(( SELECT COUNT(G.assist1) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.assist1 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
            ."COALESCE(( SELECT COUNT(G.assist2) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.assist2 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS asysty, "
            ."COALESCE(( SELECT COUNT(G.id_player) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_players  G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS mecze, "
            ."COALESCE(( SELECT COUNT(G.shooter) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.shooter = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
            ."COALESCE((SELECT COUNT(G.assist1) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.assist1 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
            ."COALESCE(( SELECT COUNT(G.assist2) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.assist2 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS punkty, "
            ."COALESCE(( SELECT SUM(G.time_p) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_penalty G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE (M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS kary "
            ."FROM #__hockey_players AS P "
            ."WHERE (P.pozycja !=1 ) HAVING mecze <>'0' "
            ."ORDER BY punkty DESC , bramki DESC, mecze DESC";

        return  $this->_getList ( $query, 0, 0 );
    }

    function getListGolies($id,$sez) {

        $query = "SELECT P.id,P.imie,P.nazwisko,P.foto,P.pozycja, "
            ."COALESCE(( SELECT sum(G.goals) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goalie G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) AS total_goals, "
             ."COALESCE(( SELECT sum(G.save) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goalie G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) AS total_save, "
             ."COALESCE(( SELECT sum(G.time_p) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goalie G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) AS time_match, "
            ."COALESCE(( SELECT COUNT(G.shooter) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.shooter = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) AS bramki, "
            ."COALESCE(( SELECT COUNT(G.assist1) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.assist1 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
            ."COALESCE(( SELECT COUNT(G.assist2) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.assist2 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS asysty, "
            ."COALESCE(( SELECT COUNT(G.id_player) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_players  G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE ( M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS mecze, "
            ."COALESCE(( SELECT SUM(G.time_p) "
            ."FROM #__hockey_match M "
            ."INNER JOIN #__hockey_match_penalty G ON (G.id_match = M.id) "
            ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
            ."WHERE (M.type_of_match =".$this->_db->Quote($id)." AND G.id_player = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS kary "
            ."FROM #__hockey_players AS P "
            ."WHERE (P.pozycja=1 ) HAVING mecze <>'0' ";
        return  $this->_getList ( $query, 0, 0 );
    }

    function getTopPlayers($type,$sez,$nr) {

        switch ($nr) {
            case 3:
                $query = "SELECT P.id,concat_ws('. ',LEFT(P.imie,1),P.nazwisko) as nazwisko, "
                    ."COALESCE(( SELECT COUNT(G.assist1) "
                    ."FROM #__hockey_match M "
                    ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
                    ."WHERE ( M.type_of_match =".$this->_db->Quote($type)." AND G.assist1 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
                    ."COALESCE(( SELECT COUNT(G.assist2) "
                    ."FROM #__hockey_match M "
                    ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
                    ."WHERE ( M.type_of_match =".$this->_db->Quote($type)." AND G.assist2 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS asysty "
                    ."FROM #__hockey_players AS P "
                    ."WHERE ( P.published=1 ) AND (P.pozycja !=1 ) AND (P.klub=(SELECT S.myteam FROM #__hockey_system S WHERE S.id=".$this->_db->Quote($sez).")) "
                    ."ORDER BY asysty DESC LIMIT 10";
                break;
            case 2:
                $query = "SELECT P.id,concat_ws('. ',LEFT(P.imie,1),P.nazwisko) as nazwisko, "
                    ."COALESCE(( SELECT COUNT(G.shooter) "
                    ."FROM #__hockey_match M "
                    ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
                    ."WHERE ( M.type_of_match =".$this->_db->Quote($type)." AND G.shooter = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) AS bramki "
                    ."FROM #__hockey_players AS P "
                    ."WHERE ( P.published=1 ) AND (P.pozycja !=1 ) AND (P.klub=(SELECT S.myteam FROM #__hockey_system S WHERE S.id=".$this->_db->Quote($sez).")) "
                    ."ORDER BY bramki DESC LIMIT 10";
                break;
            default:
                $query = "SELECT P.id,concat_ws('. ',LEFT(P.imie,1),P.nazwisko) as nazwisko, "
                    ."COALESCE(( SELECT COUNT(G.shooter) "
                    ."FROM #__hockey_match M "
                    ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
                    ."WHERE ( M.type_of_match =".$this->_db->Quote($type)." AND G.shooter = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
                    ."COALESCE((SELECT COUNT(G.assist1) "
                    ."FROM #__hockey_match M "
                    ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
                    ."WHERE ( M.type_of_match =".$this->_db->Quote($type)." AND G.assist1 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0) + "
                    ."COALESCE(( SELECT COUNT(G.assist2) "
                    ."FROM #__hockey_match M "
                    ."INNER JOIN #__hockey_match_goals G ON (G.id_match = M.id) "
                    ."INNER JOIN #__hockey_system S ON (S.id =M.id_system AND  G.id_team = S.myteam ) "
                    ."WHERE ( M.type_of_match =".$this->_db->Quote($type)." AND G.assist2 = P.id AND M.id_system=".$this->_db->Quote($sez).")),0)  AS punkty "
                    ."FROM #__hockey_players AS P "
                    ."WHERE ( P.published=1 ) AND (P.pozycja !=1 ) AND (P.klub=(SELECT S.myteam FROM #__hockey_system S WHERE S.id=".$this->_db->Quote($sez).")) "
                    ."ORDER BY punkty DESC LIMIT 10";
                break;
        }
        return  $this->_getList ( $query, 0, 0 );
    }

    function getSezonList() {
        $query = 'SELECT id AS value, nazwa AS text FROM #__hockey_system ORDER BY id DESC;';
        $this->_db->setQuery ( $query );
        return $this->_db->loadObjectList ();
    }
}
?>