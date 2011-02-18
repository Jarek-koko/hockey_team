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

class HockeyHelperType {

   function getT($type) {

          switch ($type) {
            case 2:
                $p= JText::_('SPARRING');
                break;
            case 1:
                $p = JText::_('PLAYOFF');
                break;
            case 0:
                $p = JText::_('MATCHES');
                break;
            default:
                $p = '';
                break;
        }
         return $p;
   }
}
?>