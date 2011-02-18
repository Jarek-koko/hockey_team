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
jimport('joomla.application.component.view');

require_once (JPATH_COMPONENT . DS . 'helpers' . DS . 'position.php');

class HockeyViewTeam extends JView {

    function display($tpl = null) {
        $option = JRequest::getCmd('option');

        $model = $this->getModel('teams');
        $items = $model->getTeam();
        $lists = array();

        if (!JFolder::exists(JPATH_ROOT . DS . 'images' . DS . 'hockey' . DS . 'teams')) {
            $msg = JText::_('HOC_FOLDER_NOT_EXIST');
            $link = 'index.php?option=' . $option . '&section=teams';
            $type = 'error';
            $mainframe = &JFactory::getApplication();
            $mainframe->redirect($link, $msg, $type);
        } else {
            // select photo logo teams
            $directory = '/images/hockey/teams';
            $javascript = 'onchange="changeDisplayImage();"';
            $lists ['photo'] = JHTML::_('list.images', 'logo', $items->logo, $javascript, $directory);
        }
        $lists ['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $items->published);

        $this->assignRef('lists', $lists);
        $this->assignRef('items', $items);
        $this->assignRef('option', $option);
        $this->_addToolbar();
        parent::display($tpl);
    }

    function _addToolbar() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_('HOCKEY') . ' : ' . $info, 'logo.png');
        JToolBarHelper::save ();
        JToolBarHelper::apply ();
        JToolBarHelper::cancel ();
    }

}
?>
