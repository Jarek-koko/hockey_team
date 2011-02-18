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
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class HockeyHelperSelectSeason {
  
    /**
     *  return nr season 
     * @static int $sezon
     * @return int
     */

    function &selSez() {

       static $sezon; 
        if (!$sezon) {
            $session = &JFactory::getSession ();
            $sezon = (int) $session->get ( 'sezon', 0 );
        }
        return $sezon;
    }

    /**
     * name of the season
     * @return string
     */
    function getNameSez() {

        if ($sez = HockeyHelperSelectSeason::selSez()) {
            $db = &JFactory::getDBO ();
            $query = "SELECT nazwa FROM #__hockey_system  WHERE id=$sez LIMIT 1";
            $db->setQuery ( $query );
            $row = $db->loadAssoc();
            return $row['nazwa'];
        }else {
            return JText::_('HOC_SELECT_NO_SEZ');
        }
    }
}