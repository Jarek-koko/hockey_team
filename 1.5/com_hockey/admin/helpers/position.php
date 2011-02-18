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

class HockeyHelperPosition {

    function getPositionSelect() {
        // tworzenie tablicy pozycji zawodnika
        $position = array(
            '0' => array('value' => '1', 'text' => JText::_('HOC_POSITION_GOALTENDER')),
            '1' => array('value' => '2', 'text' => JText::_('HOC_POSITION_DEFENCEMEN')),
            '2' => array('value' => '3', 'text' => JText::_('HOC_POSITION_FORWARD'))
        );
        return $position;
    }

    function getPositionString($pos) {

        switch ($pos) {
            case 1:
                $tmp = JText::_('HOC_POSITION_GOALTENDER');
                break;
            case 2:
                $tmp = JText::_('HOC_POSITION_DEFENCEMEN');
                break;
            case 3:
                $tmp = JText::_('HOC_POSITION_FORWARD');
                break;
            default:
                $tmp = '';
        }
        return $tmp;
    }

    function getPositionShort($pos) {

        switch ($pos) {
            case 1:
                $tmp = JText::_('HOC_P_GOALIES_S');
                break;
            case 2:
                $tmp = JText::_('HOC_P_DEFENCEMENS_S');
                break;
            case 3:
                $tmp = JText::_('HOC_P_FORWARDS_S');
                break;
            default:
                $tmp = '';
        }
        return $tmp;
    }

}

?>
