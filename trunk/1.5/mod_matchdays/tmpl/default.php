<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Matchdays
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function($){
        var numMatchday = <?php echo $id; ?>;
        var numSeason = <?php echo $sez; ?>;
        var numSname = <?php echo $sname; ?>;
        var title  = "<?php echo $title; ?>";
        var stat = 0;

        getData(numMatchday,numSeason,numSname,stat);
        $("#dayNav li.actual span b").text( title + ' - ' + numMatchday);
        $("#dayNav li:first").click(function () { numMatchday--; stat = 1;getData(numMatchday,numSeason,numSname,stat); });
        $("#dayNav li:last").click(function () {  numMatchday++; stat = 2;getData(numMatchday,numSeason,numSname,stat); });
        function getData(id,se,st,stats) {
            var Url = 'index.php?option=com_hockey&task=modmatch&view=modmatch&id='+ id +'&sez='+ se +'&st='+ st ;
            $.ajax({
                url: Url,
                dataType: 'html',
                cache: false,
                beforeSend: function() {
                    $('#modmatch').fadeOut('slow');
                },
                success: function (data) { 
                    $("#modmatch").html(data).fadeIn('fast');
                    $("#dayNav li.actual span b").text( title + ' - ' + numMatchday);
                },
                error : function () {
                    if (stats == 1){ numMatchday ++; $("#modmatch").fadeIn('fast');}
                    if (stats == 2){ numMatchday --; $("#modmatch").fadeIn('fast');}
                    if (stats == 0){ $("#modmatch").html('<p>Data not found</p>').fadeIn('fast');}
                }
            });
        }
    });
    //]]>
</script>
<div class="matchdayNav">
    <ul id="dayNav">
        <li class="prev"><a href="#prev"><img src="<?php echo JURI::base(true) ?>/components/com_hockey/assets/prev.png" alt="prev" /></a></li>
        <li class="actual"><span><b><?php echo $title; ?></b></span></li>
        <li class="next"><a href="#next"><img src="<?php echo JURI::base(true) ?>/components/com_hockey/assets/next.png" alt="next" /></a></li>
    </ul>
    <div style="clear:both; display:none;"></div>
</div>
<div id="modmatch" class="mdaylist"></div>



