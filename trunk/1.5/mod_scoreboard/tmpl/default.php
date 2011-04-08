<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team -Scoreboar
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');
if ($popup == 1){
$link = ($list['id_match']) ? JRoute::_('index.php?option=com_hockey&view=report&id=' . $list['id_match'] . '&tmpl=component') : false;
} else {
$link = ($list['id_match']) ? JRoute::_('index.php?option=com_hockey&view=report&id=' . $list['id_match']) : false;
}
?>
<div class="sb">
<?php if ($show_countdown ==1) { ?>
<div id="countdown<?php echo $module->id; ?>" class="countdown">
    <div class="cd_row">
        <div class="cd_section">
             <span class="cd_amount" id="day<?php echo $module->id; ?>">0</span>
            <br /><?php echo $tday; ?>
        </div>
        <div class="cd_section">
            <span class="cd_amount" id="hour<?php echo $module->id; ?>">0</span>
            <br /><?php echo $thour; ?>
        </div>
        <div class="cd_section">
            <span class="cd_amount" id="minutes<?php echo $module->id; ?>">0</span>
            <br /><?php echo $tminute; ?>
        </div>
        <div class="cd_section">
            <span class="cd_amount" id="seconds<?php echo $module->id; ?>">0</span>
            <br /><?php echo $tsecond; ?>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>
<script type="text/JavaScript">
    //<![CDATA[
  jQuery.noConflict();
    jQuery(document).ready(function() {update<?php echo $module->id; ?>();});
    function update<?php echo $module->id; ?>()
    {
         this.date1 = new Date();
         this.date2 = new Date (<?php echo $year.",".--$month.",".$day.",".$hour.",".$minute.",".$second; ?>);
         this.sec = (this.date2 - this.date1) / 1000;
         this.n = 24 * 3600;

        if (this.sec > 0) {
            this.day = Math.floor (this.sec / this.n);
            this.hour = Math.floor ((this.sec - (this.day * this.n)) / 3600);
            this.min = Math.floor ((this.sec - ((this.day * this.n + this.hour * 3600))) / 60);
            this.sec = Math.floor (this.sec - ((this.day * this.n + this.hour * 3600 + this.min * 60)));
            if (this.day < 10) {  this.day = "0"+ this.day; }
            if (this.hour < 10) { this.hour = "0"+ this.hour;}
            if (this.min < 10) {  this.min = "0"+ this.min; }
            if (this.sec < 10)  { this.sec = "0"+ this.sec; }

            jQuery('#day<?php echo $module->id; ?>').html("<b>"+this.day+"</b>");
            jQuery('#hour<?php echo $module->id; ?>').html("<b>"+this.hour+"</b>");
            jQuery('#minutes<?php echo $module->id; ?>').html("<b>"+this.min+"</b>");
            jQuery('#seconds<?php echo $module->id; ?>').html("<b>"+this.sec+"</b>");
        }
        else if (Math.abs(this.sec) < (3 * 3600)) {
            jQuery('#countdown<?php echo $module->id; ?>').html('<span><b class="mstart"><?php echo $mstart; ?></b><span>');
        }
        else {
            jQuery('#countdown<?php echo $module->id; ?>').css('display', 'none');
        }
        setTimeout('update<?php echo $module->id; ?>()', 1000);
    };

	
    //]]>
</script>
<?php } ?>
<div class="scoreboard">
     <span class="ds"><?php echo $info;?></span>
    <div class="scoreboard1">
        <div class="wl"><?php echo $list['team1']; ?></div><div class="wp"><?php echo $list['team2']; ?></div>
        <div class="ln">
            <div class="logo1">
                <?php
                if (JFile::exists($path2 . $list['logo1'])) {
                    echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . $list['logo1'] . '" alt="' . $list['team1'] . '" />';
                } else {
                    echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . 'nologo.png" alt="' . $list['team1'] . '" />';
                } ?>
            </div>
            <div class="scoor"><?php echo $number1, ($gnumber == 1) ? '<img src="' . JURI::base(true) . '/' . $path1 . 'sk.png" alt="" />' : ' : ', $number2; ?></div>
            <div class="logo2">
                <?php
                if (JFile::exists($path2 . $list['logo2'])) {
                    echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . $list['logo2'] . '" alt="' . $list['team2'] . '" />';
                } else {
                    echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . 'nologo.png" alt="' . $list['team2'] . '" />';
                } ?>
            </div>
            <div class="clr"></div>
            <div class="showter">
                <?php
                  if ($list['w1p1'] != null ) echo '('.$list['w1p1'].':'.$list['w2p1'].', '.$list['w1p2'].':'.$list['w2p2'].', '.$list['w1p3'].':'.$list['w2p3'].')';
                  if ($list['w1ot'] != null || $list['w2ot'] != null ) echo '<br />'.$sovertime.' - ('.$list['w1ot'].':'.$list['w2ot'].')';
                  if ($list['w1so'] != null || $list['w2so'] != null ) echo '<br />'.$shoutouts.' - ('.$list['w1so'].':'.$list['w2so'].')';
                ?>
            </div>
        </div>
    <div class="scoreboard2">
    <?php
    if ($link) {
        if ($popup == 1){
            JHTML::_('behavior.modal');
            echo '<a class="modal" href="' . $link . '" rel="{handler: \'iframe\', size: {x:' . $width . ', y:' . $height . '}}"><span class="link_rel">' . $title . '</span></a>';
        } else{
            echo '<a class="modal" href="' . $link . '"><span class="link_rel">' . $title . '</span></a>';
        }
    }
    ?>
    </div>
    </div>
</div>
</div>
