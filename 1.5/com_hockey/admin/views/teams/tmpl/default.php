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
    function searchTeams(val){
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
<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_('HOC_FLTER_RESET'); ?></button>
<?php
for ($i = 65; $i < 91; $i++) {
    echo '<a href="javascript:searchTeams(\'' . chr($i) . '\')">' . chr($i) . '</a>';
}
?>
</div>
<table class="adminlist">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th style="width: 20px;"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
            <th style="width: 150px;"><?php echo JText::_('HOC_NAME_TEAM'); ?></th>
            <th style="width: 100px;"><?php echo JText::_('HOC_NAME_TEAM_SHORT'); ?></th>
            <th style="width: 70px;"><?php echo JText::_('HOC_LOGO'); ?></th>
            <th style="width: 120px;" nowrap="nowrap"><?php echo JText::_('HOC_ACTIVE_TEAM'); ?></th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tfoot><tr><td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td></tr></tfoot>
    <tbody>
        <?php
                $k = 0; $i = 0;
                foreach ($this->items as $row) {
                    $checked = JHTML::_('grid.id', $i, $row->id);
                    $published = JHTML::_('grid.published', $row, $i);
                    $link = JRoute::_('index.php?option=' . $this->option . '&section=teams&task=edit&cid[]=' . $row->id);
        ?>
                    <tr class="<?php echo "row$k"; ?>">
                        <td>&nbsp;</td>
                        <td><?php echo $checked; ?></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->name; ?></a></td>
                        <td><?php echo $row->short; ?></td>
                        <td><?php echo $row->logo; ?></td>
                        <td style="text-align:center;"><?php echo $published; ?></td>
                        <td>&nbsp;</td>
                    </tr>
        <?php
            $k = 1 - $k;
            $i++;
          }
        ?>
   </tbody>
</table>
<input type="hidden" name="<?php echo JUtility::getToken() ?>" value="1" />
<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form></div>