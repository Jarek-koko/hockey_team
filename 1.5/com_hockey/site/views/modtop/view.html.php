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

class HockeyViewModtop extends JView {

    function display($tpl = null) {

        $model = &$this->getModel('stats');
        $id = (int) JRequest::getVar('id', 0, 'get', 'INT');
        $sez = (int) JRequest::getVar('sez', 0, 'get', 'INT');
        $type = (int) JRequest::getVar('ide', 0, 'get', 'INT');
        $type = (($type == 0) ? $type : 1);

        $this->assignRef('sez', $sez);
        $this->assignRef('type', $type);
        $this->assignRef('id', $id);
        $this->assignRef('model', $model);
        parent::display($tpl);
    }
}
?>