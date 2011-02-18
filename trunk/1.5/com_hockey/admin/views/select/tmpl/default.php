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
    <form action="index.php" method="post" name="adminForm">
        <div class="selsez">
            <p><b><?php echo JText::_('HOC_SELECTSEASON'); ?></b></p>
            <select name="sez">
             <?php
               foreach($this->sezons as $sezon) {
                  echo '<option value="' . $sezon['id'] . '">' . $sezon['nazwa'] . '</option>';
                }
             ?>
            </select>
        </div>
        <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
        <input type="hidden" name="task" value="save" />
        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
        <input type="hidden" name="section" value="select" />
    </form>
</div>