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
<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
    <fieldset class="adminform">
        <legend><?php echo JText::_('HOC_STATS_REFERER'); ?></legend>
        <table class="admintable"  style="margin:30px auto 30px auto; width:400px;">
            <tr>
                <td  class="key"><?php echo JText::_('HOC_NAME_REFERER'); ?> :</td>
                <td><input class="text_area required" type="text" name="lname" id="lname" size="50" maxlength="50" value="<?php echo $this->items->lname; ?>" /></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_FIRST_NAME_REFERER'); ?> :</td>
                <td><input class="text_area required" type="text" name="fname" id="fname" size="50" maxlength="50" value="<?php echo $this->items->fname; ?>" /></td>
            </tr>

            <tr>
                <td class="key"><?php echo JText::_('HOC_EDIT_DATE'); ?> :</td>
                <td><?php echo $this->items->review_date; ?></td>
            </tr>
            <tr>
                <td class="key"><?php echo JText::_('HOC_ACTIVE_REFEREE'); ?> :</td>
                <td><?php echo $this->lists ['published']; ?></td>
            </tr>
        </table>
    </fieldset>
    <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
    <input type="hidden" name="id" value="<?php echo $this->items->id; ?>" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="section" value="referees" />
    <input type="hidden" name="task" value="" />
</form>
</div>