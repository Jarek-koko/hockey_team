<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Calendar
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
$path = JURI::base(true) . '/images/hockey/teams/';
if ($show_tooltips == 1) {
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function($){
        $("td.qhome, td.qaway").hover(function(e){
            var str = parseInt($('span',this).first().text());
            if (str !== null) {
                $("body").append('<div id="qtooltip"><div><img src="<?php echo JURI::base(true); ?>/components/com_hockey/assets/loading.gif" /></div></div>');
                var Url = 'index.php?option=com_hockey&task=modcal&view=modcal&id='+ str;
                $.ajax({
                    url: Url,
                    dataType: 'html',
                    cache: false,
                    success: function (data) { $("#qtooltip").html(data); },
                    error : function () { $("#qtooltip").html('<p>Data not found</p>');}
                });
                $("#qtooltip")
                .css("top",(  $(this).offset().top - 140) + "px")
                .css("left",(  $(this).offset().left - 150) + "px")
                .fadeIn("fast")
            }
        },
        function(){
            $("#qtooltip").remove();
        });     
    });

    function submitForm(month,year){
        var f = document.formCal;
        if(f){
            f.elements['month'].value = month;
            f.elements['year'].value = year;
            f.submit();
        }
    }
    //]]>
</script>
<?php } ?>
<div class="calq">
    <form action="<?php echo $uri->toString(); ?>" method="post" name="formCal">
        <div class="qnav">
            <ul>
            <li class="prev"><?php echo $back;?></li>
            <li class="actual" ><span><b><?php echo JText::_($title)?></b></span></li>
            <li class="prev"><?php echo $next;?></li>
            </ul>
            <div style="clear:both;"></div>
        </div>
        <table cellspacing="2" cellpadding="0">
            <tr><th scope="col"><?php echo JText::_('HOC_MONDAY'); ?></th>
                <th scope="col"><?php echo JText::_('HOC_TUESDAY'); ?></th>
                <th scope="col"><?php echo JText::_('HOC_WEDNESDAY'); ?></th>
                <th scope="col"><?php echo JText::_('HOC_THURSDAY'); ?></th>
                <th scope="col"><?php echo JText::_('HOC_FRIDAY'); ?></th>
                <th scope="col"><?php echo JText::_('HOC_SATURDAY'); ?></th>
                <th scope="col"><?php echo JText::_('HOC_SANDAY'); ?></th>
            </tr>
            <tr>
                <?php
                $show = null;

                for ($counti = 0; $counti < $weekday; $counti++) {
                    $show .= '<td class="empty">&nbsp;</td>';
                }
                for ($day = 1, $days_in_month = gmdate('t', $first_of_month); $day <= $days_in_month; $day++, $weekday++) {

                    if ($weekday == 7) {
                        $weekday = 0;
                        $show .= "</tr>\n<tr>";
                    }
                    if (($day == $today) & ($today_month == $month) & ($today_year == $post_year)) {
                        $idtoday = 'id="today"';
                    } else {
                        $idtoday = '';
                    }
                    if (isset($days[$day][1])) {

                        $mdata = $days[$day][0];
                        $style = $days[$day][1];
                        $idmatch = $days[$day][2];

                        $show .= '<td ' . $style . ' ' . $idtoday . '>';
                        if ($mdata) {
                            $show .= '<span style="display:none">'.$idmatch.'</span><span class="qtooltip">' . $day . '</span>';
                        }
                        $show .= '</td>';
                    } else {
                        $show .= '<td ' . $idtoday . '>' . $day . '</td>';
                    }
                }
                for ($counti = $weekday; $counti < 7; $counti++) {
                    $show .= '<td class="empty">&nbsp;</td>';
                }
                echo $show;
                ?>
            </tr></table>
        <div class="qleg">
         <ul>
            <li><div class="qhome squ"></div><span class="qlabel"> - <?php echo JText::_('HOC_HOME'); ?></span></li>
            <li><div class="qaway squ"></div><span class="qlabel"> - <?php echo JText::_('HOC_AWAY'); ?></span></li>
        </ul>
        </div>
        <input type="hidden" name="month" value="" />
        <input type="hidden" name="year" value="" />
    </form>
</div>