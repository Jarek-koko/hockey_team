<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<div id="ht">
<div id="in" style="border: 1px solid rgb(204, 204, 204); margin:15px 100px; padding: 15px 50px; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" >
    <p><span><?php echo JText::_('AUTHOR'); ?>:</span> <?php echo $this->info['author']; ?></p>
    <p><span><?php echo JText::_('VERSION'); ?>:</span> <?php echo $this->info['version']; ?></p>
    <p><span><?php echo JText::_('HOC_CREATIONDATE'); ?>:</span> <?php echo $this->info['creationdate']; ?></p>
    <p><span><?php echo JText::_('COPYRIGHT'); ?>:</span> <?php echo $this->info['copyright']; ?></p>
    <p><span><?php echo JText::_('AUTHOR URL'); ?>:</span> <a href="<?php echo $this->info['authorurl']; ?>"><?php echo $this->info['authorurl']; ?></a></p>
    <p><span><?php echo JText::_('GPL'); ?>:</span> <a href="<?php echo $this->info['gpllink']; ?>"><?php echo $this->info['gpl']; ?></a></p>
</div>
<div id="my_team">&nbsp;</div>
<div id="clr">&nbsp;</div>
<div class="status-info" >
    <span><?php echo JText::_('HOC_STATUS'); ?></span>
    <!-- status calendar -->
    <div class="icon-stat">
        <?php echo JText::_('HOC_MODULE_STATUS_CALENDAR'); ?>
        <?php if ($this->calendar['ok']) {   ?>
            <span class="hockey-ok"><?php echo $this->calendar['mesg']; ?></span>
        <?php } else { ?>
            <span class="hockey-error"><?php echo $this->calendar['mesg']; ?></span>
        <?php } ?>
    </div>

    <!-- status matchdays -->
    <div class="icon-stat">
        <?php echo JText::_('HOC_MODULE_STATUS_MATCHDAYS'); ?>
        <?php if ($this->matchdays['ok']) { ?>
            <span class="hockey-ok"><?php echo $this->matchdays['mesg']; ?></span>
        <?php } else { ?>
            <span class="hockey-error"><?php echo $this->matchdays['mesg']; ?></span>
        <?php } ?>
    </div>

    <!-- status scoreboard -->
    <div class="icon-stat">
        <?php echo JText::_('HOC_MODULE_STATUS_STANDINGS'); ?>
        <?php if ($this->standings['ok']) { ?>
            <span class="hockey-ok"><?php echo $this->standings['mesg']; ?></span>
        <?php } else { ?>
            <span class="hockey-error"><?php echo $this->standings['mesg']; ?></span>
        <?php } ?>
    </div>

    <!-- status topplayer -->
    <div class="icon-stat">
        <?php echo JText::_('HOC_MODULE_STATUS_TOPPLAYER'); ?>
        <?php if ($this->topplayer['ok']) { ?>
            <span class="hockey-ok"><?php echo $this->topplayer['mesg']; ?></span>
        <?php } else { ?>
            <span class="hockey-error"><?php echo $this->topplayer['mesg']; ?></span>
        <?php } ?>
    </div>

     <!-- status scoreboard -->
    <div class="icon-stat">
        <?php echo JText::_('HOC_MODULE_STATUS_SCOREBOARD'); ?>
        <?php if ($this->scoreboard['ok']) { ?>
            <span class="hockey-ok"><?php echo $this->scoreboard['mesg']; ?></span>
        <?php } else { ?>
            <span class="hockey-error"><?php echo $this->scoreboard['mesg']; ?></span>
        <?php } ?>
    </div>
</div>
</div>