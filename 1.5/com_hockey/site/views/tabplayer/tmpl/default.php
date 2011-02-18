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

$i = 1;
$show = null;
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready(function()
    {
        jQuery(" #tableplayers1, #tableplayers2, #tableplayers3, #tableplayers4").tablesorter({widgets:['zebra']});
    });
    //]]>
</script>
<div class="headtab" style="display:block">
    <div><?php echo $this->title; ?></div>
</div>
<?php
if (($this->id == 4) OR ($this->id == 3)) {
    $show .='<table  class="tableplayers" id="tableplayers' . $this->id . '" border="0" cellpadding="0" cellspacing="1">
            <thead>
            <tr><th>*</th><th>' . JText::_('HOC_STATS_POS') . '</th><th>' . JText::_('HOC_PLAYER') . '</th>
                <th>' . JText::_('HOC_STATS_MATCH') . '</th><th>' . JText::_('HOC_MIN_PLAYED') . '</th>
                <th>' . JText::_('HOC_GOALS_AGAINST') . '</th><th>' . JText::_('HOC_STATS_SAVE') . '</th>
                <th>' . JText::_('HOC_GAA') . '</th><th>' . JText::_('HOC_SAVE_PORCENTAGE') . '</th>
                <th>' . JText::_('HOC_STATS_SCORED') . '</th><th>' . JText::_('HOC_STATS_ASISTS') . '</th>
                <th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>
            </thead><tbody>';

    foreach ($this->lista as $row) {
        $uri = JRoute::_('index.php?option=com_hockey&view=player&id=' . $row->id);
        @$sv = ($row->total_save / ($row->total_goals + $row->total_save));
        @$gaa = ($row->total_goals * 60) / $row->time_match;
        $show .= '<tr><td>' . $i . '</td><td>' . HockeyHelperPosition::getPositionShort((int) $row->pozycja) . '</td>
            <td style="text-align:left; padding-left: 10px;"><a href="' . $uri . '">' . $row->imie . ' ' . $row->nazwisko . '</a></td>
            <td>' . $row->mecze . '</td><td>' . $row->time_match . '</td><td>' . $row->total_goals . '</td>
            <td>' . $row->total_save . '</td><td>' . round($gaa, 2) . '</td><td>' . round($sv, 2) . '</td>
            <td>' . $row->bramki . '</td><td>' . $row->asysty . '</td><td>' . $row->kary . '</td></tr>';
        $i++;
    }

    $show .='</tbody></table>';
    $show .= '<div class="leg_p">' . JText::_('HOC_STATS_INFO_G') . '<br />' . JText::_('HOC_STATS_INFO') . '</div>';
} else {

    $show .='<table  class="tableplayers" id="tableplayers' . $this->id . '" border="0" cellpadding="0" cellspacing="1">
                <thead>
                 <tr><th>*</th><th>' . JText::_('HOC_STATS_POS') . '</th>
                  <th>' . JText::_('HOC_PLAYER') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
                  <th>' . JText::_('HOC_STATS_POINTS') . '</th><th>' . JText::_('HOC_STATS_SCORED') . '</th>
                  <th>' . JText::_('HOC_STATS_ASISTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>
                </thead><tbody>';

    foreach ($this->lista as $row) {
        $uri = JRoute::_('index.php?option=com_hockey&view=player&id=' . $row->id);
        $show .= '<tr><td>' . $i . '</td><td>' . HockeyHelperPosition::getPositionShort((int) $row->pozycja) . '</td>
            <td style="text-align:left; padding-left: 10px;"><a href="' . $uri . '">' . $row->imie . ' ' . $row->nazwisko . '</a></td>
            <td>' . $row->mecze . '</td><td>' . $row->punkty . '</td><td>' . $row->bramki . '</td><td>' . $row->asysty . '</td>
            <td>' . $row->kary . '</td></tr>';
        $i++;
    }

    $show .='</tbody></table>';
    $show .= '<div class="leg_p">' . JText::_('HOC_STATS_INFO_P') . '<br />' . JText::_('HOC_STATS_INFO') . '</div>';
}
echo $show;
?>
