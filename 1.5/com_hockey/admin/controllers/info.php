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

defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.controller' );

class HockeyControllerInfo extends JController {


    function __construct($config = array()) {
        parent::__construct ( $config );
    }

    function display() {

        $view = JRequest::getVar('view');
	if (!$view) {
            JRequest::setVar('view', 'info');
        }
	parent::display();
    }

    /**
     * function show popup Config components
     *
     */
    function preview() {
        $editor = & JFactory::getEditor ();
        $document = & JFactory::getDocument ();
        $document->setLink ( JURI::root () );
        JHTML::_ ( 'behavior.caption' );
?>
        <script type="text/javascript">
            //<![CDATA[
            var form = window.top.document.adminForm
            var alltext = window.top.<?php echo $editor->getContent ( 'text' ); ?>; alltext=alltext.replace('<hr id=\"system-readmore\" />', '');
            //]]>
        </script>
        <table style="margin: 30px auto 30px auto; width: 90%; border: 0px">
        <tr><script>document.write("<td valign=\"top\" height=\"90%\" colspan=\"2\">" + alltext + "</td>");</script></tr>
        </table>
<?php
    }
}
?>