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
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'position.php');
?>
<script type="text/javascript">
    //<![CDATA[
    function searchPlayer(val){
        var f = document.adminForm;
        if(f){
            f.elements['search'].value = val;
            f.submit();
        }
    }
    //]]>
</script>
<div id="ht">
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm">
<div class="headABC">
<?php echo JText::_('Filter'); ?> :
<input type="text" name="search" id="search" value="<?php echo $this->lists ['search']; ?>" class="text_area" onchange="document.adminForm.submit();" />
<button onclick="this.form.submit();"><?php echo JText::_('HOC_GO'); ?></button>
<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_custom').value='';this.form.submit();"><?php echo JText::_('HOC_FLTER_RESET'); ?></button>
<?php
for ($i = 65; $i < 91; $i++) {
    echo '<a href="javascript:searchPlayer(\'' . chr($i) . '\')">' . chr($i) . '</a>';
}
 echo $this->lists['custom'];
?>
</div>
<table class="adminlist">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th style="width: 20px;"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
            <th style="width: 100px;"><?php echo JText::_('HOC_PLAYER_NAME'); ?></th>
            <th style="width: 100px;"><?php echo JText::_('HOC_PLAYER_FIRST_NAME'); ?></th>
            <th style="width: 70px;"><?php echo JText::_('HOC_PLAYER_POSITION'); ?></th>
            <th style="width: 90px;"><?php echo JText::_('HOC_PLAYER_BIRTHDAY'); ?></th>
            <th style="width: 40px;"><?php echo JText::_('HOC_PLAYER_WEIGHT'); ?></th>
            <th style="width: 40px;"><?php echo JText::_('HOC_PLAYER_HEIGHT'); ?></th>
            <th style="width: 20px;" nowrap="nowrap"><?php echo JText::_('HOC_ACTIVE_PLAYER'); ?></th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tfoot><tr><td colspan="10"><?php echo $this->pagination->getListFooter(); ?></td></tr></tfoot>
    <tbody>
            <?php
            $k = 0; $i = 0;
            foreach ($this->items as $row) {
                $checked = JHTML::_('grid.id', $i, $row->id);
                $published = JHTML::_('grid.published', $row, $i);
                $link = JRoute::_('index.php?option=' . $this->option . '&section=players&task=edit&cid[]=' . $row->id);
            ?>
                <tr class="<?php echo "row$k"; ?>" style="text-align:center;">
                    <td>&nbsp;</td>
                    <td><?php echo $checked; ?></td>
                    <td style="text-align: left;"><a href="<?php echo $link; ?>"> <?php echo $row->nazwisko; ?></a></td>
                    <td style="text-align: left;"><?php echo $row->imie; ?></td>
                    <td><?php echo HockeyHelperPosition::getPositionString((int) $row->pozycja); ?></td>
                    <td><?php echo JHTML::date($row->data_u, '%d-%m-%Y'); ?></td>
                    <td><?php echo $row->waga; ?></td>
                    <td><?php echo $row->wzrost; ?></td>
                    <td><?php echo $published; ?></td>
                    <td>&nbsp;</td>
                </tr>
            <?php
                $k = 1 - $k; $i++;
            }
            ?>
        </tbody>
</table>
<input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
</div>