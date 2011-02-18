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
jimport('joomla.filesystem.file');

class HockeyViewModmatch extends JView {

    function display($tpl = null) {
        $id = (int) JRequest::getVar('id', 0, 'get', 'INT');
        $sez = (int) JRequest::getVar('sez', 0, 'get', 'INT');

        if (($id == 0) || ($sez == 0)) {
            JError::raiseError(404, JText::_("Data not found"));
            return;
        }

        $model = &$this->getModel('modmatch');
        $rows = $model->getList();
        if (empty($rows)){
            JError::raiseError(404, JText::_("Data not found"));
            return;
        }

        $this->assignRef('rows', $rows);
        parent::display($tpl);
    }
}