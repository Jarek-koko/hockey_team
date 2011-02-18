<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Standings
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<div>
<table class="tabb">
    <thead><tr><th><?php echo $title1; ?></th><th><?php echo $title2; ?></th><th><?php echo $title3; ?></th></tr></thead>
    <tbody>
    <?php $i=1; foreach ($rows as $row ) : ?>
    <tr class="<?php if($row->grupa == $group1) echo $class1; else echo $class2; ?>" >
        <td><?php echo $i; ?></td>
        <td><?php echo $row->name; ?></td>
        <td><?php echo $row->punkty; ?></td>
    </tr>
    <?php $i++; endforeach; ?>
    </tbody>
</table>
</div>