<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team-Scoreboar
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

class modScoreboardHelper {

    function getList(&$params) {

    $db = & JFactory::getDBO ();
    $id = intval($params->get('id', 0));
    $id = ($id == 0) ? ' (SELECT id FROM #__hockey_match ORDER BY id DESC LIMIT 1) ' : $id;

    $query = "SELECT t2.name AS team1,t1.w1p1,t1.w2p1,t1.w1p2,t1.w2p2,t1.w1p3,t1.w2p3,t1.w1ot,t1.w2ot,t1.w1so,t1.w2so,t3.name AS team2, t1.wynik_1, t1.wynik_2, t2.logo AS logo1,t3.logo AS logo2, t4.id_match "
            . "FROM #__hockey_match t1 "
            . "LEFT JOIN #__hockey_teams t2 ON (t2.id = t1.druzyna1) "
            . "LEFT JOIN #__hockey_teams t3 ON (t3.id = t1.druzyna2) "
            . "LEFT JOIN #__hockey_match_rapport t4 ON (t4.id_match = t1.id) "
            . "WHERE t1.id =" . $db->Quote($id) . " LIMIT 1";

    $db->setQuery($query);
    return $db->loadAssoc();
    }

}
?>