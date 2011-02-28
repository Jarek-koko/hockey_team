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
    function changeDisplayImage() {
        if (document.adminForm.logo.value !='') {
            document.adminForm.imagelib.src='<?php echo JURI::root(true); ?>/images/hockey/teams/' + document.adminForm.logo.value;
        } else {
            document.adminForm.imagelib.src='<?php echo JURI::root(true); ?>/images/blank.png';
        }
    }

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
        <fieldset class="adminform"><legend><?php echo JText::_('HOC_STATS_TEAM_INFO'); ?></legend>
            <table class="admintable">
                <tr>
                    <td  class="key"><?php echo JText::_('HOC_NAME_TEAM'); ?> :</td>
                    <td><input class="text_area required" type="text" name="name" id="name" size="50" maxlength="50" value="<?php echo $this->items->name; ?>" /></td>
                    <td  class="key"><?php echo JText::_('HOC_LOGO'); ?></td>
                    <td><?php echo $this->lists ['photo']; ?></td>
                </tr>
                <tr>
                    <td  class="key"><?php echo JText::_('HOC_NAME_TEAM_SHORT'); ?> :</td>
                    <td><input class="text_area required" type="text" name="short" id="short" size="12" maxlength="12" value="<?php echo $this->items->short; ?>" /></td>
                    <td rowspan="4" colspan="2" align="center">
                        <?php
                        if (eregi("gif|jpg|png", $this->items->logo)) {
                            echo '<img src="'.JURI::root(true).'/images/hockey/teams/' . $this->items->logo . '" name="imagelib" />';
                        } else {
                            echo '<img src="'.JURI::root(true).'/images/blank.png" name="imagelib" />';
                        }
                        ?></td>
                </tr>
                <tr>
                    <td  class="key"><?php echo JText::_('description'); ?> :</td>
                    <td><textarea class="text_area" cols="20" rows="4" name="description" style="width: 500px"><?php echo $this->items->description; ?></textarea></td>
                </tr>
                <tr>
                    <td  class="key"><?php echo JText::_('HOC_EDIT_DATE'); ?> :</td>
                    <td><?php echo $this->items->review_date; ?></td>
                </tr>
                <tr>
                    <td  class="key"><?php echo JText::_('HOC_ACTIVE_TEAM'); ?> :</td>
                    <td><?php echo $this->lists ['published']; ?></td>
                </tr>
            </table>
        </fieldset>
        <input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
        <input type="hidden" name="id" value="<?php echo $this->items->id; ?>" />
        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
        <input type="hidden" name="section" value="teams" />
        <input type="hidden" name="task" value="" />
    </form>
</div>