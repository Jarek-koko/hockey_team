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

$params = &JComponentHelper::getParams($this->option);
$options = array();
foreach ($this->listakol as $kolejka) {
    $options[] = JHTML::_('select.option', $kolejka, $params->get('round' . $kolejka));
}
?>
<div class="selsez">
    <p><b><?php echo JText::_('HOM_SELECT_PLAYOFF_ROUND'); ?></b></p>
    <?php echo JHTML::_('select.genericlist', $options, 'id_kolejka', 'onchange="selectMat();"', 'value', 'text', $this->nr_kol); ?>
</div>

