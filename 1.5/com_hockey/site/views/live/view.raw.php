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

class HockeyViewLive extends JView {

    function display($tpl = null) {

        $mainframe = &JFactory::getApplication();
        $params = &$mainframe->getPageParameters();
        $id_match = (int) $params->get('id_match');
        $end = (int) $params->get('end');

        if ($id_match == 0) {
            return;
        }

        $model = &$this->getModel();
        $model->setId($id_match);
        $list = $model->getList();

        if (count($list)) {
            $zawodnicy = $model->getPlayers();
            $gole = $model->getGoals();
            $penalty = $model->getPenalty();

            $this->assignRef('end', $end);
            $this->assignRef('gole', $gole);
            $this->assignRef('penalty', $penalty);
            $this->assignRef('zawodnicy', $zawodnicy);
            $this->assignRef('list', $list);
            parent::display('raw');
        }
    }

}
?>


