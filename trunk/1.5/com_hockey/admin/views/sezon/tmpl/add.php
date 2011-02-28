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
            <legend><?php echo JText::_('HOC_HOA_ATTENTION'); ?></legend>
            <ul>
                <li><?php echo JText::_('HOC_HOA_INFO1'); ?></li>
                <li><?php echo JText::_('HOC_HOA_INFO2'); ?></li>
                <li><?php echo JText::_('HOC_HOA_INFO3'); ?></li>
                <li><?php echo JText::_('HOC_HOA_INFO4'); ?></li>
            </ul>
        </fieldset>
        <fieldset>
            <legend><?php echo JText::_('HOC_HOA_NAME'); ?></legend>
            <div>
            <label for="nazwa"><?php echo JText::_('HOC_HOA_NAMESEASON'); ?> : </label>
            <input type="text" name="nazwa" size="50" maxlength="60"  class="required" /> <?php echo JText::_('HOC_HOA_EXEMPLE'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php echo JText::_('HOC_HOA_POINTS'); ?></legend>
            <div>
                <label for="rok"><?php echo JText::_('HOC_HOA_STATS_YEAR'); ?> : </label>
                <input type="text" name="rok" size="3" maxlength="4"  />
            </div>
            <div>
                <label for="p_w"><?php echo JText::_('HOC_HOA_STATS_WON'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_w', 'class="inputbox validate-notzero"', 'value', 'text'); ?>
            </div>
            <div>
                <label for="p_r"><?php echo JText::_('HOC_HOA_STATS_DRAWS'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_r', 'class="inputbox"', 'value', 'text'); ?>
            </div>
            <div>
                <label for="p_p"><?php echo JText::_('HOC_HOA_STATS_LOSS'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_p', 'class="inputbox"', 'value', 'text'); ?>
            </div>

            <div><label for="dogr"><?php echo JText::_('HOC_HOA_STATS_OVERTIME'); ?>  : </label>
                <?php echo JText::_('YES'); ?> <input type="radio" name="dogr" value="T" />
                <?php echo JText::_('NO'); ?> <input type="radio" name="dogr" value="F" checked="checked" />
            </div>
            <div>
                <label for="p_d_w"><?php echo JText::_('HOC_HOA_STATS_OVERTIME_WON'); ?>  : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_d_w', 'class="inputbox"', 'value', 'text'); ?>
            </div>

            <div>
                <label for="p_d_p"><?php echo JText::_('HOC_HOA_STATS_OVERTIME_LOSS'); ?> : </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_d_p', 'class="inputbox"', 'value', 'text'); ?>
            </div>

            <div><label for="karne"><?php echo JText::_('HOC_HOA_STATS_PENALTY'); ?> : </label>
                <?php echo JText::_('YES'); ?> <input type="radio" name="karne" value="T" />
                <?php echo JText::_('NO'); ?> <input type="radio" name="karne" value="F"  checked="checked" />
            </div>
            <div>
                <label for="p_k_w"><?php echo JText::_('HOC_HOA_STATS_PENALTY_WON'); ?>	: </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_k_w', 'class="inputbox"', 'value', 'text'); ?>
            </div>

            <div>
                <label for="p_k_p"><?php echo JText::_('HOC_HOA_STATS_PENALTY_LOSS'); ?>: </label>
                <?php echo JHTML::_('select.genericList', $this->pozycja, 'p_k_p', 'class="inputbox"', 'value', 'text'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php echo JText::_('HOC_HOA_TEAMS'); ?></legend>
            <?php
                $k = 0;
                foreach ($this->kluby as $klub) {
                    echo '<div><label for="klub[' . $k . ']">' . $klub['name'] . ' - </label><input type="checkbox" name="klub[' . $k . ']" value="' . $klub['id'] . '" /></div>';
                    $k++;
                }
            ?>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('HOC_HOA_MYTEAMS'); ?></legend>
                <div>
                    <label for="myteam"><?php echo JText::_('HOC_HOA_MYTEAMS'); ?></label>
                <?php echo $this->teams; ?>
            </div>
        </fieldset>
        <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
        <input type="hidden" name="section" value="sezon" />
        <input type="hidden" name="task" value="" />
    </form>
</div>
</div>
