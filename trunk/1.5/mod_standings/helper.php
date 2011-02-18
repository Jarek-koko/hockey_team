<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Standings
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class modStandingsHelper {

    function getList(&$params) {
        $db = & JFactory::getDBO ();
        $sez = intval ( $params->get ( 'sez', 0 ) );
        
        $sname = intval ( $params->get ( 'sname', 0 ) );
        $sname = ($sname) ? ' tm.short as name ':' tm.name ';

        if ($sez != 0) {
            $query = "SELECT $sname ,t.punkty,t.grupa "
                    ."FROM #__hockey_tabela t "
                    ."INNER JOIN #__hockey_teams tm ON (tm.id = t.team_id) "
                    ."WHERE t.id_system = ".$db->Quote($sez)." AND t.published = 1 "
                    ."ORDER BY t.grupa ASC, t.punkty DESC, t.ordering ASC";
        }  else {
            return NULL;
        }
        $db->setQuery ( $query );
        return $db->loadObjectList ();
    }
}
?>