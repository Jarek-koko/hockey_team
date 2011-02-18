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
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
    //<![CDATA[
    jQuery.noConflict();
    jQuery(document).ready(function($)
    {
        var Url = '<?php echo JRoute::_('index.php?option=com_hockey&view=live&format=raw') ?>';
        (function request() {
            $.ajax({
                url: Url,
                dataType: 'html',
                cache: false,
                success: function (data) {
                    $("#live").html(data); // works and updates
                },
                error : function () {
                    $("#live").html('<p>Error page not found</p>');
                }
            });
            //calling the anonymous function after x milli seconds
            setTimeout(request, <?php  echo $this->time;?>); 
        })(); //self Executing anonymous function
    });
    //]]>
</script>
<div id="live"></div>
