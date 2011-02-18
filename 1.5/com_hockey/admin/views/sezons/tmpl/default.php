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
jimport('joomla.filter.output');
?>
<div id="ht">
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm">
    <table class="adminlist">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th style="width: 20px;">ID</th>
                <th style="width: 20px;"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
                <th style="width: 100px;"><?php echo JText::_('HOC_HOA_INFO'); ?></th>
                <th style="width: 200px;" class="title"><?php echo JText::_('HOC_HOA_NAMESEASONS'); ?></th>
                <th style="width: 200px;"><?php echo JText::_('HOC_HOA_MY_TEAM'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOC_HOA_YEAR'); ?></th>
                <th style="width: 50px;"><?php echo JText::_('HOC_HOA_ACTIVE'); ?></th>
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
                $link = JRoute::_( 'index.php?option=' . $this->option . '&section=sezon&task=edit&cid[]='. $row->id );

                $dogrywka = ($row->dogr == "T") ? JText::_('YES') : JText::_('NO');
                $karne = ($row->karne == "T") ? JText::_('YES') : JText::_('NO');

                //info icon
                $text = JText::_('HOC_HOA_WON') . ' - <b>' . $row->p_w . '</b> ' . JText::_('HOC_HOA_POINTS')
                        . '<br />' . JText::_('HOC_HOA_DRAWS') . ' - <b>' . $row->p_r . '</b> ' . JText::_('HOC_HOA_POINTS')
                        . '<br />' . JText::_('HOC_HOA_LOSS') . ' - <b>' . $row->p_p . '</b> ' . JText::_('HOC_HOA_POINTS')
                        . '<br />' . JText::_('HOC_HOA_OVERTIME') . ' - <b>' . $dogrywka . '</b>'
                        . '<br />' . JText::_('HOC_HOA_WON_OVERTIME') . ' - <b>' . $row->p_d_w . '</b> ' . JText::_('HOC_HOA_POINTS')
                        . '<br />' . JText::_('HOC_HOA_LOSS_OVERTIME') . ' - <b>' . $row->p_d_p . '</b> ' . JText::_('HOC_HOA_POINTS')
                        . '<br />' . JText::_('HOC_HOA_PENALTY') . ' - <b>' . $karne . '</b>'
                        . '<br />' . JText::_('HOC_HOA_WON_PENALTY') . ' - <b>' . $row->p_k_w . '</b> ' . JText::_('HOC_HOA_POINTS')
                        . '<br />' . JText::_('HOC_HOA_LOSS_PENALTY') . ' - <b>' . $row->p_k_p . '</b> ' . JText::_('HOC_HOA_POINTS');
            ?>

                <tr class="<?php echo "row$k"; ?>" style="text-align:center;">
                    <td>&nbsp;</td>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $checked; ?></td>
                    <td><?php echo JHTML::_('tooltip', $text, $row->nazwa); ?></td>
                    <td><a href="<?php echo $link; ?>"> <?php echo $row->nazwa; ?></a></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->rok; ?></td>
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
</form></div>


