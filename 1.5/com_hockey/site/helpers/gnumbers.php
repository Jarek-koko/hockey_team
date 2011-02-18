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

class HockeyHelperGnumbers {

    function getNumber($number = null) {

        $path = JURI::base(true).'/images/hockey/numbers/';
        $gnumber = null;

        if ($number == null ) {
            $gnumber = '<img src="'.$path.'ss.png" alt="-" />';
            return $gnumber;
        }
      
        $number = (string) $number;
        $nr = 0;

        while (isset($number{$nr})) {
            $gnumber .= '<img src="'.$path.'0'.$number{$nr}.'.png" alt="'.$number{$nr}.'" />';
            $nr++;
        }
        return $gnumber;
    }
}
?>
