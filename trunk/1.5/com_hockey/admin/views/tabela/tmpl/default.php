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
JHTML::_('behavior.tooltip');
?>
<div id="ht">
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm">
    <table class="adminlist">
        <thead>
            <tr><th>&nbsp;</th>
                <th style="width: 20px;"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
                <th style="width: 130px;"><?php echo JText::_('HOC_HOB_TEAMS'); ?></th>
                <th style="width: 30px;"><?php echo JText::_('HOC_HOB_POINTS'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOC_HOB_STATS_MATCHDAYS'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOC_HOB_STATS_WON'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOC_HOB_STATS_DRAWS'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOC_HOB_STATS_LOSS'); ?></th>
                <th style="width: 30px;"><?php echo JText::_('HOC_HOB_GOALS_SCORED'); ?></th>
                <th style="width: 30px;"><?php echo JText::_('HOC_HOB_GOALS_CONCEDED'); ?></th>
                <th style="width: 30px;"><?php echo JText::_('HOC_HOB_GOALS_DIFFERANCE'); ?></th>
                <th style="width: 70px;"><?php echo JText::_('HOC_HOB_POSITION'); ?><?php echo JHTML::_('grid.order', $this->items); ?></th>
                <th style="width: 70px;"><?php echo JText::_('HOC_HOB_GROUP'); ?> <?php echo JHTML::_('grid.order', $this->items, 'filesave.png', 'savegruporder'); ?></th>
                <th style="width: 20px;" nowrap="nowrap"><?php echo JText::_('HOC_PAGE'); ?></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tfoot><tr><td colspan="15">&nbsp;</td></tr></tfoot>
        <tbody>
            <?php
              $k = 0; $i = 0;
                foreach ($this->items as $row) {
                    $checked = JHTML::_('grid.id', $i, $row->id);
                    $published = JHTML::_('grid.published', $row, $i);
                    $link = JRoute::_('index.php?option=' . $this->option . '&section=tabela&task=edit&cid[]=' . $row->id);
            ?>
                <tr class="<?php echo "row$k"; ?>" style="text-align:center;">
                    <td>&nbsp;</td>
                    <td><?php echo $checked; ?></td>
                    <td style="text-align:left;"><a href="<?php echo $link; ?>"> <?php echo $row->name; ?></a></td>
                    <td><?php echo $row->punkty; ?></td>
                    <td><?php echo $row->kolejka; ?></td>
                    <td><?php echo $row->wygrane; ?></td>
                    <td><?php echo $row->remisy; ?></td>
                    <td><?php echo $row->przegrane; ?></td>
                    <td><?php echo $row->b_strzelone; ?></td>
                    <td><?php echo $row->b_stracone; ?></td>
                    <td><?php echo $row->roznica; ?></td>
                    <td><input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" /></td>
                    <td><input type="text" name="order2[]" size="5" value="<?php echo $row->grupa; ?>" class="text_area" style="text-align: center" /></td>
                    <td align="center"><?php echo $published; ?></td>
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