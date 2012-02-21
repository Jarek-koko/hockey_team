<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @module Hockey Team - Top players
 * @copyright Copyright (C) Klich Jarosław
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

$sez = intval($params->get('sez', 0));
$title1 = ( $params->get('title1', 'P') );
$title2 = ( $params->get('title2', 'G') );
$title3 = ( $params->get('title3', 'A') );
$id = intval($params->get('type_of_match', 0));

$document = & JFactory::getDocument ();
$document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.js');
$document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.tools.min.js');
$link1 = JRoute::_('index.php?option=com_hockey&task=modtop&view=modtop&id=1&sez=' .$sez. '&ide=' .$id);
$link2 = JRoute::_('index.php?option=com_hockey&task=modtop&view=modtop&id=2&sez=' .$sez. '&ide=' .$id);
$link3 = JRoute::_('index.php?option=com_hockey&task=modtop&view=modtop&id=3&sez=' .$sez. '&ide=' .$id);
?>
<script type="text/javascript">
//<![CDATA[
jQuery.noConflict();
jQuery(document).ready(function()
{
    jQuery("ul.tabs-nav").tabs("div.tabs-panes > div", {effect: 'ajax', onBeforeClick: function(event, i) {
       var pane = this.getPanes("div.tabs-panes > div");
           pane.html('<img src="<?php echo  JURI::base(true) ?>/components/com_hockey/assets/loading.gif" />');
     }
    });
});
//]]>
</script>
<div id="topplayers">
<ul class="tabs-nav">
    <li><a href="<?php echo $link1; ?>"><span><?php echo $title1; ?> </span></a></li>
    <li><a href="<?php echo $link2; ?>"><span><?php echo $title2; ?> </span></a></li>
    <li><a href="<?php echo $link3; ?>"><span><?php echo $title3; ?> </span></a></li>
</ul>
<div class="tabs-panes">
<div style="display:block"></div>
</div>
</div>