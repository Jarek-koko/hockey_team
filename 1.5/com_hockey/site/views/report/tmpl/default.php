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
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . 'non.gif" alt="logo1" />';
                    } ?>
                </div>
                <div class="scoor"><?php echo $this->number1, ($this->gnumber == 1) ? '<img src="' . JURI::base(true) . '/' . $path1 . 'sk.png" alt="" />' : ' : ', $this->number2; ?></div>
                <div class="logo2">
                    <?php
                    if (JFile::exists($path2 . $this->list['logo2'])) {
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . $this->list['logo2'] . '" alt="logo2" />';
                    } else {
                        echo '<img class="lo" src="' . JURI::base(true) . '/' . $path2 . 'non.gif" alt="logo2" />';
                    } ?>
                </div>
                <div class="clr"></div>
            </div>
            <div class="showter">
            <?php 
              if ($this->list['w1p1'] != null ) echo '('.$this->list['w1p1'].':'.$this->list['w2p1'].', '.$this->list['w1p2'].':'.$this->list['w2p2'].', '.$this->list['w1p3'].':'.$this->list['w2p3'].')';
              if ($this->list['w1ot'] != null || $this->list['w2ot'] != null ) echo '<br />'.JText::_('HOC_OVERTIME').' - ('.$this->list['w1ot'].':'.$this->list['w2ot'].')';
              if ($this->list['w1so'] != null || $this->list['w2so'] != null ) echo '<br />'.JText::_('HOC_SHOUTOUTS').' - ('.$this->list['w1so'].':'.$this->list['w2so'].')';
            ?></div>
        </div>
    </div>
</div>
 <div><?php echo $this->buttonback ?></div>
