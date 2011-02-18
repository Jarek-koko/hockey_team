<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @component Hockey
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.calendar');
$document = & JFactory::getDocument ();
$document->addScript("../administrator/components/com_hockey/assets/validate.js");
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
<form action="index.php" method="post" name="adminForm" class="form-validate">
    <h1><?php echo JText::_(($this->kolejka_nr == null) ? 'HOA_ADD_SPARRING_MATCH' : 'HOA_EDIT_SPARRING_MATCH'); ?></h1>
    <table class="adminlist">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th style="width: 150px;"><?php echo JText::_('HOA_DATE_MATCHE'); ?></th>
                <th style="width: 250px;"><?php echo JText::_('HOA_HOME'); ?></th>
                <th style="width: 250px;"><?php echo JText::_('HOA_VISITORS'); ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center;">
                <td>&nbsp;</td>
                <td>
                    <input class="text_area required" type="text" name="data" id="data" size="10" maxlength="10" value="<?php echo $this->row->data; ?>" />
                    <input type="reset" class="button" value="..." onclick="return showCalendar('data','%Y-%m-%d');" />
                </td>
                <td><?php echo JHTML::_('select.genericList', $this->kl, 'druzyna1', 'class="inputbox"', 'value', 'text', $this->row->druzyna1); ?></td>
                <td><?php echo JHTML::_('select.genericlist', $this->kl, 'druzyna2', 'class="inputbox"', 'value', 'text', $this->row->druzyna2); ?></td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
        <tfoot><tr><td colspan="6">&nbsp;</td></tr></tfoot>
    </table>
    <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
    <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
    <input type="hidden" name="published" value="<?php echo $this->row->published ?>" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="section" value="sparring" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="id_kolejka" value="1" />
    <input type="hidden" name="id_system" value="<?php echo $this->sez; ?>" />
    <input type="hidden" name="type_of_match" value="2" />
</form>
</div>