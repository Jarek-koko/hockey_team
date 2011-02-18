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
require_once( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_hockey' . DS . 'helpers' . DS . 'position.php' );
$pate = JURI::base(true) . '/images/hockey/players/';
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function(){
        jQuery('ul.tabs').tabs('div.panes > div',{ effect: 'fade'});
        jQuery(".imgp").hide().fadeIn(3000);
    });
    //]]>
</script>     
<div id="players">
<?php
if (isset($this->player)) {
?>
    <div class="boxy">
        <div class="lew" style="width: 200px; text-align:center;">
            <img src="<?php echo $pate . $this->player->foto ?>" alt="<?php echo $this->player->nazwisko ?>" class="imgp" />
        </div>
        <div class="lew" style="width: 450px; text-align: left; margin:0 20px;">
            <p class="namep"><?php echo $this->player->imie . ' ' . $this->player->nazwisko ?></p>
            <p><?php echo JText::_('HOC_POSITION') . ' - ' . HockeyHelperPosition::getPositionString((int) $this->player->pozycja) ?></p>
            <p><?php echo JText::_('HOC_PLAYER_DATE') . ' - ' . JHTML::_('date', $this->player->data_u, JText::_('DATE_FORMAT_LC4')) ?></p>
            <p><?php echo JText::_('HOC_PLAYER_AGE') . ' - ' . $this->player->wiek ?></p>
            <p><?php echo JText::_('HOC_PLAYER_WEIGHT') . ' - ' . $this->player->waga ?> kg</p>
            <p><?php echo JText::_('HOC_PLAYER_HEIGHT') . ' - ' . $this->player->wzrost ?> cm </p>
            <p><?php echo JText::_('HOC_PLAYER_OLD_TEAM') . ' - ' . $this->player->klubold ?></p>
            <p><?php echo JText::_('HOC_PLAYER_NUMBER') . ' - ' . $this->player->nr ?></p>
        </div>
        <div class="clr"></div>
    </div>
    <ul class="tabs">
        <li><a href="#"><span><?php echo JText::_('HOC_PLAYER_NOTES') ?></span></a></li>
        <li><a href="#"><span><?php echo JText::_('HOC_PLAYER_REGULAR') ?></span></a></li>
        <li><a href="#"><span><?php echo JText::_('HOC_PLAYER_PLAYOFF') ?></span></a></li>
    </ul>
    <div class="panes">
        <div><?php echo $this->player->opis ?></div>
        <div><?php echo $this->loadTemplate('regular') ?></div>
        <div><?php echo $this->loadTemplate('playoff') ?></div>
    </div>    
<?php } else { ?>
    <p><b><?php echo JText::_('HOC_NO_DATA') ?></b></p>
<?php } ?>
</div>
