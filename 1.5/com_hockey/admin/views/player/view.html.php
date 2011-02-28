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

class HockeyViewPlayer extends JView {

    function display($tpl = null) {

        $document = & JFactory::getDocument ();
        $document->addScript(JURI::root(true)."/administrator/components/com_hockey/assets/validate.js");

        $option = JRequest::getCmd('option');
        $model = $this->getModel('players');
        $items = $model->getPlayer();

        $model2 = &$this->getModel('teams');
        $kluby = $model2->getAllTeamsSelect();
        $lists ['kluby'] = JHTML::_('select.genericList', $kluby, 'klub', 'class="inputbox validate-notzero"', 'value', 'text', $items->klub);

        // veryfication folder exist
        if (!JFolder::exists(JPATH_ROOT . DS . 'images' . DS . 'hockey' . DS . 'players')) {
            $msg = JText::_('HOC_FOLDER_PLAERS_NOT_EXIST');
            $link = 'index.php?option=' . $option . '&section=players';
            $type = 'error';
            $mainframe = &JFactory::getApplication();
            $mainframe->redirect($link, $msg, $type);
        } else {
            // if exist create select white photos players
            $directory = '/images/hockey/players';
            $javascript = 'onchange="changeDisplayImage();"';
            $lists ['foto'] = JHTML::_('list.images', 'foto', $items->foto, $javascript, $directory);
        }

        // get position players from static helpers
        $pozycja = HockeyHelperPosition::getPositionSelect();
        // create select position and yes or not
        $lists ['pozycja'] = JHTML::_('select.genericList', $pozycja, 'pozycja', 'class="inputbox"' . '', 'value', 'text', $items->pozycja);
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
