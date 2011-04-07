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

class JHTMLSelectseason {
    function getSelect($lista , $page, $action) {

        $html = '<div id="wybor">
                <form action="'.$action.'" method="post" name="searchForm" >
                <fieldset>
                <legend>'.JText::_('HOC_SELECT_SEASON').'</legend>
                <div id="selsez">'.$lista.'<input name="ok" value="'.JText::_('HOC_GO').'" class="colguzik" type="submit" /></div>
                </fieldset><input type="hidden" name="page" value="'.$page.'" />
                </form></div>';
        return $html;
    }
}
?>
