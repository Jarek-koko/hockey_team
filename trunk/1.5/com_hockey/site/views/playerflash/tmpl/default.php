<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Hockey Team
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
?>
<div class="componentheading"><?php echo JText::_('HOC_PLAYERS_FLASH_TITLE'); ?></div>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function(){
	jQuery('#myFlash').flash({swf:'<?php echo JURI::base(true); ?>/components/com_hockey/views/playerflash/tmpl/players.swf', height:600, width:740});
    });
      //]]>
</script>
<div id="myFlash"></div>


			  
