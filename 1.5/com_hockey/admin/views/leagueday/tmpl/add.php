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
    <div style="padding: 10px; margin-left: auto; margin-right: auto; width:300px; border: 1px dotted #CCCCCC;">
        <form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" class="form-validate">
            <p><label for="kolejka_nr"><?php echo JText::_('HOA_NR_MATCHDAYS'); ?>  : </label>
                <?php echo $this->lists ['kolejka_nr']; ?>
            </p>
            <p><label for="liczba_s"><?php echo JText::_('HOA_TOTAL_MATCHES'); ?> : </label>
                <?php echo $this->lists ['liczba_s']; ?>
            </p>
            <p><label for="Data"><?php echo JText::_('HOA_MATCH_DAYDATE'); ?> : </label>
                <input class="text_area required" type="text" name="data" id="data" size="10" maxlength="10" value="" />
                <input type="reset" class="button" value="..." onclick="return showCalendar('data','%Y-%m-%d');" />
            </p>
            <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
            <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
            <input type="hidden" name="task" value="" />
        </form>
    </div>
</div>