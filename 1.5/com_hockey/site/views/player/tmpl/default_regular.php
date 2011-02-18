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

if ($this->player->pozycja != 1) {
    if ($this->regular_stat) {
        echo '<table class="tabplayer">
           <tr><th colspan="6">' . JText::_('HOC_PLAYER_RS') . '</th></tr>
           <tr><th>' . JText::_('HOC_SEASON') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
               <th>' . JText::_('HOC_STATS_SCORED') . '</th><th>' . JText::_('HOC_STATS_ASISTS') . '</th>
               <th>' . JText::_('HOC_STATS_POINTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>';

        foreach ($this->regular_stat as $row) {
            $points = $row->assist + $row->shoot;
            echo '<tr><td>' . $row->nazwa . '</td><td>' . $row->meczy . '</td><td>' . $row->shoot . '</td>
                      <td>' . $row->assist . '</td><td>' . $points . '</td><td>' . $row->kary . '</td></tr>';
        }
        echo '</table><div class="leg_p">' . JText::_('HOC_STATS_INFO_P') . '</div>';
    }
}

if ($this->player->pozycja == 1) {
    if ($this->regular_stat) {
        echo '<table class="tabplayer">
                  <tr><th colspan="10">' . JText::_('HOC_PLAYER_RS') . '</th></tr>
                  <tr><th>' . JText::_('HOC_SEASON') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
                      <th>' . JText::_('HOC_MIN_PLAYED') . '</th><th>' . JText::_('HOC_GOALS_AGAINST') . '</th>
                      <th>' . JText::_('HOC_STATS_SAVE') . '</th><th>' . JText::_('HOC_GAA') . '</th>
                      <th>' . JText::_('HOC_SAVE_PORCENTAGE') . '</th><th>' . JText::_('HOC_STATS_SCORED') . '</th>
                      <th>' . JText::_('HOC_STATS_ASISTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>';

        foreach ($this->regular_stat as $row) {
            @$sv = ($row->total_save / ($row->total_goals + $row->total_save));
            @$gaa = ($row->total_goals * 60) / $row->time_match;
            echo '<tr><td>' . $row->nazwa . '</td><td>' . $row->meczy . '</td>
                <td>' . $row->time_match . '</td><td>' . $row->total_goals . '</td>
                <td>' . $row->total_save . '</td><td>' . round($gaa, 2) . '</td>
                <td>' . round($sv, 2) . '</td><td>' . $row->shoot . '</td>
                <td>' . $row->assist . '</td><td>' . $row->kary . '</td></tr>';
        }
        echo '</table><div class="leg_p">' . JText::_('HOC_STATS_INFO_G') . '</div>';
    }
}
?>
