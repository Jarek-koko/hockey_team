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
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function(){
        jQuery('ul.tabs-rec').tabs('div.panes-rec > div',{ effect: 'fade'});

    });
    //]]>
</script>     
<ul class="tabs-rec">
    <li><a href="#"><span><?php echo JText::_('HOC_GOAL') ?></span></a></li>
    <li><a href="#"><span><?php echo JText::_('HOC_PENALYTY') ?></span></a></li>
    <li><a href="#"><span><?php echo JText::_('HOC_RECAP') ?></span></a></li>
    <li><a href="#"><span><?php echo JText::_('HOC_REFEREES'); ?></span></a></li>
    <li><a href="#"><span><?php echo JText::_('HOC_PLAYER_STATS'); ?></span></a></li>
    <li><a href="#"><span><?php echo JText::_('HOC_GOALIE_STATS'); ?></span></a></li>
</ul>
<div class="panes-rec bb">
    <div>
        <?php if ($this->gole) : ?>
            <div class="headtab">
                <div> <?php echo JText::_('HOC_GOAL'); ?></div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><?php echo JText::_('HOC_SCORE'); ?></th>
                        <th><?php echo JText::_('HOC_TIME'); ?></th>
                        <th><?php echo JText::_('HOC_SHOOTER'); ?></th>
                        <th><?php echo JText::_('HOC_ASSIST1'); ?></th>
                        <th><?php echo JText::_('HOC_ASSIST2'); ?></th>
                        <th> INFO </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $tmp_pos = null;
                for ($i = 0, $n = count($this->gole); $i < $n; $i++) {
                    $row = &$this->gole [$i];
                    $kow = &$this->gole [$i + 1];
                    if ($tmp_pos != $row->period) {
                ?>
                        <tr><td colspan="6" class="ck"><?php echo ($row->period == 4) ? JText::_('HOC_OVERTIME') : JText::_('HOC_PERIOD') . '' . $row->period; ?></td></tr>

                <?php } ?>
                    <tr style="text-align: center;">
                        <td><?php echo $row->score1; ?> : <?php echo $row->score2; ?></td>
                        <td><?php echo $row->time; ?></td>
                        <td><?php echo $row->shooter; ?></td>
                        <td><?php echo $row->assist1; ?></td>
                        <td><?php echo $row->assist2; ?></td>
                        <td><?php echo $row->info; ?></td>
                    </tr>
                <?php
                    $tmp_pos = $row->period;
                }
                ?>
            </tbody></table>
        <p style="text-align: center; padding-bottom:20px;"><?php echo JText::_('HOC_INFO_TEXT'); ?></p>
        <?php endif; ?>
        </div>
        <div>
        <?php if ($this->penalty) : ?>
                    <div class="headtab">
                        <div><?php echo JText::_('HOC_PENALYTY'); ?></div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th><?php echo JText::_('HOC_TIME'); ?></th>
                                <th><?php echo JText::_('HOC_PLAYER'); ?></th>
                                <th><?php echo JText::_('HOC_PENALTY_NAME'); ?></th>
                                <th><?php echo JText::_('HOC_MIN'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                  for ($i = 0, $n = count($this->penalty); $i < $n; $i++) {
                        $row = &$this->penalty [$i];
                        $kow = &$this->penalty [$i + 1];
                        if ($tmp_pos != $row->period) {
                ?>
                            <tr><td colspan="4" class="ck"><?php echo ($row->period == 4) ? JText::_('HOC_OVERTIME') : JText::_('HOC_PERIOD') . '' . $row->period; ?></td></tr>

                <?php } ?>
                        <tr style="text-align: center;">
                            <td><?php echo $row->time; ?></td>
                            <td><?php echo $row->player; ?></td>
                            <td><?php echo $row->note; ?></td>
                            <td><?php echo $row->time_p; ?> min</td>
                        </tr>
                <?php
                        $tmp_pos = $row->period;
                    }
                ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
    <div>
        <div class="opis">
            <div class="par"><?php echo JText::_('HOC_RECAP'); ?></div>
            <div style="padding: 5px; text-align: left;"><?php echo $this->list ['text']; ?></div>
        </div>
    </div>
    <div>
        <div class="ref lew">
            <div class="par"><?php echo JText::_('HOC_REFEREES'); ?></div>
            <ul><li><?php echo ($this->list['referee1']) ? $this->list['referee1'] : "--"; ?></li>
                <li><?php echo ($this->list['referee4']) ? $this->list['referee4'] : "--"; ?></li>
            </ul>
        </div>
        <div class="ref prw">
            <div class="par"><?php echo JText::_('HOC_LINESMEN'); ?></div>
            <ul><li><?php echo ($this->list['referee2']) ? $this->list['referee2'] : "--"; ?></li>
                <li><?php echo ($this->list['referee3']) ? $this->list['referee3'] : "--"; ?></li>
            </ul>
        </div>
        <div class="clr"></div>
    </div>
    <div>
    <div class="lew" style="width: 49%;">
   <div class="headtab">
      <div><?php echo $this->list ['home']; ?></div>
   </div>
    <table>
        <thead>
            <tr><th>#</th><th><?php echo JText::_('HOC_POS'); ?></th><th><?php echo JText::_('HOC_PLAYER_R'); ?></th>
                <th><?php echo JText::_('HOC_POINTS'); ?></th><th><?php echo JText::_('HOC_GOAL_R'); ?></th><th><?php echo JText::_('HOC_ASSIST'); ?></th>
                <th><?php echo JText::_('HOC_PIM'); ?></th></tr>
        </thead>
        <tbody>
      <?php
            for ($i=0, $j=1, $players = count($this->zawodnicy); $i < $players; $i++) {
                if ($this->zawodnicy[$i]->id_team == $this->list ['druzyna1']) {
                    echo '<tr>';
                    echo '<td>'.$j++.'</td>';
                    echo '<td>'.HockeyHelperPosition::getPositionShort((int) $this->zawodnicy[$i]->pozycja).'</td>';
                    echo '<td style="text-align:left; padding-left:5px;">'. $this->zawodnicy[$i]->nazwisko .'</td>';
                    echo '<td>'.($this->zawodnicy[$i]->bramki + $this->zawodnicy[$i]->asysta). '</td>';
                    echo '<td>'.$this->zawodnicy[$i]->bramki.'</td>';
                    echo '<td>'.$this->zawodnicy[$i]->asysta.'</td>';
                    echo '<td>'.$this->zawodnicy[$i]->kary.'</td>';
                    echo '</tr>';
                }
            }
        ?>
       </tbody>
    </table>
    </div>
    <div class="prw" style="width: 49%;">
    <div class="headtab">
      <div><?php echo $this->list ['visitor']; ?></div>
    </div>
        <table>
        <thead>
             <tr><th>#</th><th><?php echo JText::_('HOC_POS'); ?></th><th><?php echo JText::_('HOC_PLAYER_R'); ?></th>
                <th><?php echo JText::_('HOC_POINTS'); ?></th><th><?php echo JText::_('HOC_GOAL_R'); ?></th><th><?php echo JText::_('HOC_ASSIST'); ?></th>
                <th><?php echo JText::_('HOC_PIM'); ?></th></tr>
        </thead>
        <tbody>
        <?php
        for ($i=0,$j=1, $players = count($this->zawodnicy); $i < $players; $i++) {
            if ($this->zawodnicy[$i]->id_team == $this->list ['druzyna2']) {
                 echo '<tr>';
                    echo '<td>'.$j++.'</td>';
                    echo '<td>'.HockeyHelperPosition::getPositionShort((int) $this->zawodnicy[$i]->pozycja).'</td>';
                    echo '<td style="text-align:left; padding-left:5px;">'. $this->zawodnicy[$i]->nazwisko .'</td>';
                    echo '<td>'.($this->zawodnicy[$i]->bramki + $this->zawodnicy[$i]->asysta). '</td>';
                    echo '<td>'.$this->zawodnicy[$i]->bramki.'</td>';
                    echo '<td>'.$this->zawodnicy[$i]->asysta.'</td>';
                    echo '<td>'.$this->zawodnicy[$i]->kary.'</td>';
                    echo '</tr>';
            }
        }
        ?>
        </tbody>
        </table>
    </div>
    <div class="clr"></div>
 </div>
 <div>
     
     
   <div class="headtab">
      <div><?php echo $this->list ['home']; ?></div>
   </div>
    <table>
        <thead>
             <tr><th>#</th><th><?php echo JText::_('HOC_GOALIES_R'); ?></th><th><?php echo JText::_('HOC_TOI'); ?></th>
                 <th><?php echo JText::_('HOC_SAVE'); ?></th><th><?php echo JText::_('HOC_GA'); ?></th><th><?php echo JText::_('HOC_SV'); ?></th>
                 <th><?php echo JText::_('HOC_GOAL_R'); ?></th><th><?php echo JText::_('HOC_ASSIST'); ?></th><th><?php echo JText::_('HOC_PIM'); ?></th></tr>
        </thead>
        <tbody>
      <?php
            for ($i=0, $j=1, $goalie = count($this->goalie); $i < $goalie; $i++) {
                if ($this->goalie[$i]->id_team == $this->list ['druzyna1']) {
                     echo '<tr>';
                    echo '<td>'.$j++.'</td>';
                    echo '<td style="text-align:left; padding-left:5px;">'. $this->goalie[$i]->nazwisko .'</td>';
                    echo '<td>'.$this->goalie[$i]->time_p. '</td>';
                    echo '<td>'.$this->goalie[$i]->save. '</td>';
                    echo '<td>'.$this->goalie[$i]->goals. '</td>';
                    echo '<td>'. round($this->goalie[$i]->save / ($this->goalie[$i]->goals + $this->goalie[$i]->save),2);
                    echo '<td>'.$this->goalie[$i]->bramki.'</td>';
                    echo '<td>'.$this->goalie[$i]->asysta.'</td>';
                    echo '<td>'.$this->goalie[$i]->kary.'</td>';
                    echo '</tr>';
                }
            }
        ?>
       </tbody>
    </table>

  
    <div class="headtab">
      <div><?php echo $this->list ['visitor']; ?></div>
    </div>
        <table>
        <thead>
            <tr><th>#</th><th><?php echo JText::_('HOC_GOALIES_R'); ?></th><th><?php echo JText::_('HOC_TOI'); ?></th>
                 <th><?php echo JText::_('HOC_SAVE'); ?></th><th><?php echo JText::_('HOC_GA'); ?></th><th><?php echo JText::_('HOC_SV'); ?></th>
                 <th><?php echo JText::_('HOC_GOAL_R'); ?></th><th><?php echo JText::_('HOC_ASSIST'); ?></th><th><?php echo JText::_('HOC_PIM'); ?></th></tr>
        </thead>
        <tbody>
        <?php
        for ($i=0, $j=1, $goalie = count($this->goalie); $i < $goalie; $i++) {
                if ($this->goalie[$i]->id_team == $this->list ['druzyna2']) {
                    echo '<tr>';
                    echo '<td>'.$j++.'</td>';
                    echo '<td style="text-align:left; padding-left:5px;">'. $this->goalie[$i]->nazwisko .'</td>';
                    echo '<td>'.$this->goalie[$i]->time_p. '</td>';
                    echo '<td>'.$this->goalie[$i]->save. '</td>';
                    echo '<td>'.$this->goalie[$i]->goals. '</td>';
                    echo '<td>'. round($this->goalie[$i]->save / ($this->goalie[$i]->goals + $this->goalie[$i]->save),2);
                    echo '<td>'.$this->goalie[$i]->bramki.'</td>';
                    echo '<td>'.$this->goalie[$i]->asysta.'</td>';
                    echo '<td>'.$this->goalie[$i]->kary.'</td>';
                    echo '</tr>';
                }
            }
        ?>
        </tbody>
        </table>
 </div>
</div>


