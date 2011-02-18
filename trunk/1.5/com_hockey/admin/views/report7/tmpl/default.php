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
$editor = & JFactory::getEditor();
?>
<div id="ht">
<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div style="width: 100%;">
        <div style="margin:30px auto; width: 900px;">
            <?php echo $editor->display('text', $this->row->text, '800', '400', '100', '20', array('pagebreak', 'readmore')); ?>
        </div>
    </div>
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
<input type="hidden" name="id_match" value="<?php echo $this->id_match; ?>" />
<input type="hidden" name="section" value="report7" />
<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="type" value="<?php echo $this->type; ?>" />
<input type="hidden" name="boxchecked" value="0" />
</form>
</div>