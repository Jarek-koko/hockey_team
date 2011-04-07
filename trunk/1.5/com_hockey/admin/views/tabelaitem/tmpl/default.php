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
JHTML::_('behavior.calendar');
?>
<script type="text/javascript">
    //<![CDATA[
    function submitbutton(pressbutton){
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
<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
    <fieldset class="adminform"><legend><?php echo JText::_('HOC_HOB_STATS_TEAMS'); ?></legend>
        <table class="admintable">
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_TEAMS'); ?></td>
                <td><b><?php echo $this->lists['team_name']; ?></b></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_POINTS'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="punkty" id="punkty" size="3" maxlength="3" value="<?php echo $this->items->punkty; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_STATS_MATCHDAYS'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="kolejka" id="kolejka" size="3" maxlength="3" value="<?php echo $this->items->kolejka; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_STATS_DRAWS'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="remisy" id="remisy" size="3" maxlength="3" value="<?php echo $this->items->remisy; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_STATS_WON'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="wygrane" id="wygrane" size="3" maxlength="3" value="<?php echo $this->items->wygrane; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_STATS_LOSS'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="przegrane" id="przegrane" size="3" maxlength="3" value="<?php echo $this->items->przegrane; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_GOALS_SCORED'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="b_strzelone" id="b_strzelone" size="3" maxlength="3" value="<?php echo $this->items->b_strzelone; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_GOALS_CONCEDED'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="b_stracone" id="b_stracone" size="3" maxlength="3" value="<?php echo $this->items->b_stracone; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_HOB_GOALS_DIFFERANCE'); ?></td>
                <td><input class="text_area required validate-numeric" type="text" name="roznica" id="roznica" size="3" maxlength="4" value="<?php echo $this->items->roznica; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_PAGE'); ?></td>
                <td><?php echo $this->lists['published']; ?></td>
            </tr>
        </table>
    </fieldset>
    <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
    <input type="hidden" name="id_system" value="<?php echo $this->items->id_system; ?>" />
    <input type="hidden" name="ordering" value="<?php echo $this->items->ordering; ?>" />
    <input type="hidden" name="grupa" value="<?php echo $this->items->grupa; ?>" />
    <input type="hidden" name="id" value="<?php echo $this->items->id; ?>" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="section" value="tabela" />
    <input type="hidden" name="task" value="" />
</form>
</div>