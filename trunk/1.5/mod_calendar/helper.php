<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team -Calendar
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
class modCalendarHelper {

    function getmatchdays($post_month, $post_year, &$params) {

        $sez = intval($params->get('sez', 0));
        $db = & JFactory::getDBO ();
        $query = "SELECT  m.data AS dates,( m.druzyna1 = s.myteam) AS home, DAYOFMONTH(m.data) AS matchday,m.id AS idmatch "
                . "FROM #__hockey_match m "
                . "INNER JOIN #__hockey_system s ON (s.id  = m.id_system) "
                . "WHERE (s.id=" . $db->Quote($sez) . ") "
                . "AND (MONTH(m.data)=" . $db->Quote($post_month) . ") "
                . "AND (YEAR(m.data)=" . $db->Quote($post_year) . ") "
                . "AND (m.published=1) AND ((m.druzyna1=s.myteam) OR (m.druzyna2=s.myteam)) "
                . "ORDER BY m.data";

        $db->setQuery($query);
        $events = $db->loadObjectList();
        $days = array();

        foreach ($events as $event) {
            if ($event->home == 1) {
                $bg = ' class="qhome" ';
            } else {
                $bg = ' class="qaway" ';
            }
            $data = $event->dates;
            $idmatch = $event->idmatch;
            $days [$event->matchday] = array($data, $bg, $idmatch);
        }
        return $days;
    }
}
?> 