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
<div id="formadd">
    <form action="index.php" method="post" name="adminForm">
        <fieldset style="padding:20px;">
            <legend><?php echo JText::_('HOC_HOA_REM_COF') ?></legend>
            <p><?php echo JText::_('HOC_HOA_REM_COF1') ?> : <b><?php echo count($this->items); ?></b></p>
            <p><b><?php echo JText::_('HOC_HOA_REM_COF2') ?> : </b></p>
            <?php
            echo "<ol>";
            foreach ($this->items as $item) {
                echo "<li>" . $item->nazwa . "</li>";
            }
            echo "</ol>";
            ?>
        </fieldset>
        <fieldset style="padding:20px;">
            <h1><?php echo JText::_('HOC_HOA_ATTENTION') ?></h1>
            <?php echo JText::_('HOC_HOA_REM_COF3') ?>
            <div style="margin: 80px;">
                <a href="#" onclick="javascript:void submitbutton('remove')" class="icon-32-delete"
                style="border: 1px dotted gray; width: 70px; padding: 10px;  padding-left: 40px;  background-repeat: no-repeat; text-align: left;">
                <?php echo JText::_('DELETE') ?></a>
            </div>
        </fieldset>
        <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="section" value="sezon" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php
            foreach ($this->items as $item) {
                echo '<input type="hidden" name="cid[]" value="' . $item->id . '" />';
            }
        ?>
    </form>
</div>
</div>