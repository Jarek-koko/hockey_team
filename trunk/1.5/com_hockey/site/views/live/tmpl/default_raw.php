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
$path1 = 'images/hockey/numbers/';
$path2 = 'images/hockey/teams/';
?>
<div class="componentheading"><?php echo JHTML::_('date', $this->list['data'], JText::_('DATE_FORMAT_LC3')); ?></div>
<div id="scoreboard">
    <div class="board">
        <div class="wl"><?php echo $this->list['home']; ?></div><div class="wp"><?php echo $this->list['visitor'] ?></div>
        <div class="ln">
            <div class="ind">
                <div class="logo1">
                    <?php
                    if (JFile::exists($path2 . $this->list['logo1'])) {
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . $this->list['logo1'] . '" alt="logo1" />';
                    } else {
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . 'nologo.png" alt="logo1" />';
                    } ?>
                </div>
                <div class="scoor-live"><?php echo $this->list['wynik_1'].' : '.$this->list['wynik_2']; ?></div>
                <div class="logo2">
                    <?php
                    if (JFile::exists($path2 . $this->list['logo2'])) {
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . $this->list['logo2'] . '" alt="logo2" />';
                    } else {
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . 'nologo.png" alt="logo2" />';
                    } ?>
                </div>
                <div class="clr"></div>
                <?php if ($this->end == 1) echo '<p id="end">'. JText::_('HOC_END_OF_MATCH').'</p>'; ?>
            </div>
            <div class="showter">
            <?php
                  echo '('.$this->list['w1p1'].':'.$this->list['w2p1'].', '.$this->list['w1p2'].':'.$this->list['w2p2'].', '.$this->list['w1p3'].':'.$this->list['w2p3'].')';
                  if ($this->list['w1ot'] != null and $this->list['w2ot'] != null ) echo '<br />'.JText::_('HOC_OVERTIME').' - ('.$this->list['w1ot'].':'.$this->list['w2ot'].')';
                  if ($this->list['w1so'] != null and $this->list['w2so'] != null ) echo '<br />'.JText::_('HOC_SHOUTOUTS').' - ('.$this->list['w1so'].':'.$this->list['w2so'].')';
            ?></div>
        </div>
    </div>
</div>
<div class="bb">
    <div>
        <div class="opis">
            <div class="par"><?php echo JText::_('HOC_RECAP'); ?></div>
            <div style="padding: 5px; text-align: left;"><?php echo $this->list ['text']; ?></div>
        </div>
    </div>
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
    <div class="ple lew">
       <div class="par"><?php echo $this->list ['home']; ?></div>
   
       <ul>
      <?php
        $players = count($this->zawodnicy);
        for ($i = 0;$i <$players ; $i++ ) {
            if($this->zawodnicy[$i]->id_team == $this->list ['druzyna1']) {
                echo '<li><span>'.$this->zawodnicy[$i]->nazwisko .' '.$this->zawodnicy[$i]->imie.'</span></li>';
            }
        }
       ?>
      </ul>
   
    </div>
   <div class="ple prw">
     <div class="par"><?php echo $this->list ['visitor']; ?></div>
    
        <ul>
            <?php
            for ($i = 0 ;$i <$players ; $i++ ) {
                if($this->zawodnicy[$i]->id_team == $this->list ['druzyna2']) {
                    echo '<li><span>'.$this->zawodnicy[$i]->nazwisko .' '.$this->zawodnicy[$i]->imie.'</span></li>';
                }
            }
            ?>
        </ul>
    </div>
    <div class="clr"></div>
    </div>
</div>