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
<div id="ht">
<form action="index.php" method="post" name="adminForm" id="adminForm">
    <table class="tabshort">
        <thead>
            <tr>
                <th><?php echo JText::_('HOS_SELECT_REFERER'); ?></th>
                <th><?php echo JText::_('HOS_SELECT_LINESMEN'); ?></th>
                <th><?php echo JText::_('HOS_SELECT_LINESMEN'); ?></th>
                <th><?php echo JText::_('HOS_SELECT_REFERER2'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $this->referee [0]; ?></td>
                <td><?php echo $this->referee [1]; ?></td>
                <td><?php echo $this->referee [2]; ?></td>
                <td><?php echo $this->referee [3]; ?></td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
    <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
    <input type="hidden" name="id_match" value="<?php echo $this->id_match; ?>" />
    <input type="hidden" name="section" value="report6" />
    <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="type" value="<?php echo $this->type; ?>" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
</div>