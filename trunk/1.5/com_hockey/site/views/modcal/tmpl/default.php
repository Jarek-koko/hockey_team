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
$path = 'images/hockey/teams/';
?>
<div class="pop-title"><?php echo JHTML::_('date', $this->list['data'], JText::_('DATE_FORMAT_LC3')); ?></div>
<div class="pop-board">
<div>
    <span class="pop-l"><?php echo $this->list['home']; ?></span>
    <span class="pop-r"><?php echo $this->list['visitor'] ?></span>
    <div class="pop-clr"></div>
</div>
    <div class="pop-out">
        <div class="pop-in">
        <div class="pop-logo1">
            <?php
            if (JFile::exists($path . $this->list['logo1'])) {
                echo '<img class="lo" src="' . JURI::base(true) . '/' . $path . $this->list['logo1'] . '" alt="logo1" />';
            } else {
                echo '<img class="lo" src="' . JURI::base(true) . '/' . $path . 'non.gif" alt="logo1" />';
            } ?>
        </div>
        <div class="pop-scoor">
            <?php
              if($this->list['wynik_1'] != null ) {  echo  $this->list['wynik_1'] . ' : ' . $this->list['wynik_2'];  }
              else echo ' - vs - ';
            ?>
        </div>
        <div class="pop-logo2">
            <?php
            if (JFile::exists($path . $this->list['logo2'])) {
                echo '<img class="lo" src="' . JURI::base(true) . '/' . $path . $this->list['logo2'] . '" alt="logo2" />';
            } else {
                echo '<img class="lo" src="' . JURI::base(true) . '/' . $path . 'non.gif" alt="logo2" />';
            } ?>
        </div>
        <div class="pop-clr"></div>
       </div>
    </div>
</div>
