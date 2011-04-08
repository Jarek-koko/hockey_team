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
jimport('joomla.application.component.view');

class HockeyViewPlayer extends JView {

    function display($tpl = null) {

        $idplayer = (int) JRequest::getVar('id', 0, 'get', 'int');
        $type = (int) JRequest::getVar('sez', 0, 'get', 'int');
        $position = (int) JRequest::getVar('par', 0, 'get', 'int');

        if ($idplayer == 0) {
            JError::raiseError(404, JText::_("Player not found"));
            return;
        }

        if (($type < 0) || ($type > 1)) {
            JError::raiseError(404, JText::_("Player not found"));
            return;
        }

        if (($position < 1) || ($position > 3)) {
            JError::raiseError(404, JText::_("Player not found"));
            return;
        }

        $mainframe = &JFactory::getApplication();
        $params = &$mainframe->getPageParameters();
        $model = &$this->getModel();
        $model->setSezon($params->get('iddsfp'));

        // set regular season or playoff
        if (($type == 0) && ($position != 1)) {
            $regular_stat = $model->getStatplayer(0);
            echo '<div id="info" style="display:block"><table class="tabplayer">
                   <tr><th colspan="6">' . JText::_('HOC_PLAYER_RS') . '</th></tr>
                   <tr><th>' . JText::_('HOC_SEASON') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
                       <th>' . JText::_('HOC_STATS_SCORED') . '</th><th>' . JText::_('HOC_STATS_ASISTS') . '</th>
                       <th>' . JText::_('HOC_STATS_POINTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>';

            foreach ($regular_stat as $row) {
                $points = $row->assist + $row->shoot;
                echo '<tr>
                            <td>' . $row->nazwa . '</td><td>' . $row->meczy . '</td><td>' . $row->shoot . '</td>
                            <td>' . $row->assist . '</td><td>' . $points . '</td><td>' . $row->kary . '</td></tr>';
            }
            echo '</table><p class="leg_p">' . JText::_('HOC_STATS_INFO_P') . '</p><div>';
        }

        if (($type == 1) && ($position != 1)) {
            $playoff_stat = $model->getStatplayer(1);
            echo '<table class="tabplayer">
                          <tr><th colspan="6">' . JText::_('HOC_PLAYER_PO') . '</th></tr>
                          <tr><th>' . JText::_('HOC_SEASON') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
                              <th>' . JText::_('HOC_STATS_SCORED') . '</th><th>' . JText::_('HOC_STATS_ASISTS') . '</th>
                              <th>' . JText::_('HOC_STATS_POINTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>';

            foreach ($playoff_stat as $row) {
                $points = $row->assist + $row->shoot;
                echo '<tr><td>' . $row->nazwa . '</td><td>' . $row->meczy . '</td>
                          <td>' . $row->shoot . '</td><td>' . $row->assist . '</td>
                          <td>' . $points . '</td><td>' . $row->kary . '</td></tr>';
            }
            echo '</table><p class="leg_p">' . JText::_('HOC_STATS_INFO_P') . '</p>';
        }



        if (($type == 0) && ($position == 1)) {
            $regular_stat = $model->getStatplayer(0);

            if ($regular_stat) {
                echo '<div>
                          <table class="tabplayer">
                          <tr><th colspan="10" style="text-align:left; padding:10px;">' . JText::_('HOC_PLAYER_RS') . '</th></tr>
                          <tr><th>' . JText::_('HOC_SEASON') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
                              <th>' . JText::_('HOC_MIN_PLAYED') . '</th><th>' . JText::_('HOC_GOALS_AGAINST') . '</th>
                              <th>' . JText::_('HOC_STATS_SAVE') . '</th><th>' . JText::_('HOC_GAA') . '</th>
                              <th>' . JText::_('HOC_SAVE_PORCENTAGE') . '</th><th>' . JText::_('HOC_STATS_SCORED') . '</th>
                              <th>' . JText::_('HOC_STATS_ASISTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>';

                foreach ($regular_stat as $row) {
                    @$sv = ($row->total_save / ($row->total_goals + $row->total_save));
                    @$gaa = ($row->total_goals * 60) / $row->time_match;
                    echo '<tr>
                          <td>' . $row->nazwa . '</td><td>' . $row->meczy . '</td><td>' . $row->time_match . '</td>
                          <td>' . $row->total_goals . '</td><td>' . $row->total_save . '</td><td>' . round($gaa, 2) . '</td>
                          <td>' . round($sv, 2) . '</td><td>' . $row->shoot . '</td><td>' . $row->assist . '</td>
                          <td>' . $row->kary . '</td></tr>';
                }
                    echo '</table><p class="leg_p">' . JText::_('HOC_STATS_INFO_G') . '</p></div>';
            }
        }

        if (($type == 1) && ($position == 1)) {
            $playoff_stat = $model->getStatplayer(1);
            if ($playoff_stat) {
                echo '<div>
                   <table class="tabplayer">
                   <tr><th colspan="10" style="text-align:left; padding:10px;">' . JText::_('HOC_PLAYER_PO') . '</th></tr>
                   <tr><th>' . JText::_('HOC_SEASON') . '</th><th>' . JText::_('HOC_STATS_MATCH') . '</th>
                       <th>' . JText::_('HOC_MIN_PLAYED') . '</th><th>' . JText::_('HOC_GOALS_AGAINST') . '</th>
                       <th>' . JText::_('HOC_STATS_SAVE') . '</th><th>' . JText::_('HOC_GAA') . '</th>
                       <th>' . JText::_('HOC_SAVE_PORCENTAGE') . '</th><th>' . JText::_('HOC_STATS_SCORED') . '</th>
                       <th>' . JText::_('HOC_STATS_ASISTS') . '</th><th>' . JText::_('HOC_STATS_PENALTY') . '</th></tr>';

                foreach ($playoff_stat as $row) {
                    @$sv = ($row->total_save / ($row->total_goals + $row->total_save));
                    @$gaa = ($row->total_goals * 60) / $row->time_match;
                    echo '<tr><td>' . $row->nazwa . '</td><td>' . $row->meczy . '</td>
                             <td>' . $row->time_match . '</td><td>' . $row->total_goals . '</td>
                             <td>' . $row->total_save . '</td><td>' . round($gaa, 2) . '</td>
                             <td>' . round($sv, 2) . '</td><td>' . $row->shoot . '</td>
                             <td>' . $row->assist . '</td><td>' . $row->kary . '</td></tr>';
                }
                echo '</table><p class="leg_p">' . JText::_('HOC_STATS_INFO_G') . '</p></div>';
            }
        }
    }
}
?>

