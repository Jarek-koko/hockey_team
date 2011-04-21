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
jimport('joomla.application.component.view');

class HockeyViewLive extends JView {

    function display($tpl = null) {

        $document = & JFactory::getDocument ();
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.js');

        $mainframe = &JFactory::getApplication();
        $params =  &$mainframe->getParams();

        $id_match = (int) $params->get('id_match');
        $message1 = $params->get('message1', 'no match');
        $time = (int) $params->get('time');
        $time = (1000 * $time);

        if ($id_match == 0) {
            echo '<div class="lmessage"><span>'.$message1.'</span></div>';
            return;
        }

        $this->assignRef('time', $time);
        parent::display($tpl);
    }
}
?>