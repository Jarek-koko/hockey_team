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
<script type="text/javascript">
    //<![CDATA[
    function submitbutton(pressbutton) {
        var form = document.adminForm;

        if (pressbutton == 'cancel') {
            submitform( pressbutton );
            return;
        }

        if( document.formvalidator.isValid( form ) )
        {
          submitform( pressbutton );
          return;
        }
        else
        {
            alert('<?php echo JText::_('HOC_VALUES_NOT_ACCEPTABLE'); ?>');
            return false;
        }
    }
    //]]>
</script>
<div id="ht">
<div id="formadd">
    <form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
        <fieldset>
            <legend><?php echo JText::_('HOC_HOA_NAME'); ?></legend>
            <div>
                <label for="nazwa"><?php echo JText::_('HOC_HOA_NAMESEASON'); ?> :</label>
                <input type="text" name="nazwa" size="50" maxlength="60" class="required" value="<?php echo $this->row->nazwa; ?>" /> <?php echo JText::_('HOC_HOA_EXEMPLE'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php echo JText::_('HOC_HOA_POINTS'); ?></legend>
            <div>
                <label for="rok"><?php echo JText::_('HOC_HOA_STATS_YEAR'); ?> : </label>
                <input type="text" name="rok" size="3" maxlength="4" value="<?php echo $this->row->rok; ?>" />
            </div>

            <div>
                <label for="p_w"><?php echo JText::_('HOC_HOA_STATS_WON'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_w', 'class="inputbox validate-notzero"' . '', 'value', 'text', $this->row->p_w); ?>
            </div>

            <div>
                <label for="p_r"><?php echo JText::_('HOC_HOA_STATS_DRAWS'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_r', 'class="inputbox"' . '', 'value', 'text', $this->row->p_r); ?>
            </div>

            <div>
                <label for="p_p"><?php echo JText::_('HOC_HOA_STATS_LOSS'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_p', 'class="inputbox"' . '', 'value', 'text', $this->row->p_p); ?>
            </div>

            <div>
                <label for="dogr"><?php echo JText::_('HOC_HOA_STATS_OVERTIME'); ?> : </label>
                <?php echo JText::_('YES'); ?><input type="radio" name="dogr" value="T" <?php if ($this->row->dogr == "T") {  echo 'checked="checked"'; } ?> />
                <?php echo JText::_('NO'); ?><input type="radio" name="dogr" value="F" <?php if ($this->row->dogr == "F") {  echo 'checked="checked"';  } ?> />
            </div>

            <div>
                <label for="p_d_w"><?php echo JText::_('HOC_HOA_STATS_OVERTIME_WON'); ?>  : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_d_w', 'class="inputbox"' . '', 'value', 'text', $this->row->p_d_w); ?>
            </div>

            <div>
                <label for="p_d_p"><?php echo JText::_('HOC_HOA_STATS_OVERTIME_LOSS'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_d_p', 'class="inputbox"' . '', 'value', 'text', $this->row->p_d_p); ?>
            </div>

            <div>
                <label for="karne"><?php echo JText::_('HOC_HOA_STATS_PENALTY'); ?> : </label>
                <?php echo JText::_('YES'); ?><input type="radio" name="karne" value="T" <?php if ($this->row->karne == "T") { echo 'checked="checked"'; } ?> />
                <?php echo JText::_('NO'); ?><input type="radio" name="karne" value="F" <?php if ($this->row->karne == "F") { echo 'checked="checked"'; } ?> />
            </div>

            <div>
                <label for="p_k_w"><?php echo JText::_('HOC_HOA_STATS_PENALTY_WON'); ?>	: </label>
            <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_k_w', 'class="inputbox"' . '', 'value', 'text', $this->row->p_k_w); ?>
            </div>

            <div>
                <label for="p_k_p"><?php echo JText::_('HOC_HOA_STATS_PENALTY_LOSS'); ?>: </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_k_p', 'class="inputbox"' . '', 'value', 'text', $this->row->p_k_p); ?>
            </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('HOC_HOA_SEASON_ACTIVE'); ?></legend>
                <div>
                    <label><?php echo JText::_('HOC_HOA_SEASON_ACTIVE'); ?> :</label>
                   <?php echo JText::_('YES'); ?><input type="radio" name="published" value="1" <?php if ($this->row->published==1) { echo 'checked="checked"'; } ?> />
                   <?php echo JText::_('NO'); ?><input type="radio" name="published" value="0" <?php if ($this->row->published==0) { echo 'checked="checked"'; } ?> />
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('HOC_HOA_MYTEAMS'); ?></legend>
                <div>
                    <label for="myteam"><?php echo JText::_('HOC_HOA_MYTEAMS'); ?></label>
                    <?php echo $this->lists[0]; ?>
                </div>
            </fieldset>
            <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
            <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
            <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
            <input type="hidden" name="section" value="sezon" />
            <input type="hidden" name="task" value="" />
    </form>
</div>
</div>
