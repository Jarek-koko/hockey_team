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

class HockeyViewPlayers extends JView {

    function display($tpl = null) {
        $document = & JFactory::getDocument ();
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.js');
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.tablesorter.js');
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/tooltip.js');
       
        $mainframe = &JFactory::getApplication();
        $params = $mainframe->getPageParameters();
        $model = &$this->getModel();
        $players = $model->getListPlayers($params->get('iddsfp'));

        $menus = &JSite::getMenu ();
        $menu = $menus->getActive();

        $title =  JText::_('HOC_PLAYERS_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

        $position = array(
            '1' => JText::_('HOC_POSITION_GOALIES'),
            '2' => JText::_('HOC_POSITION_DEFENCEMENS'),
            '3' => JText::_('HOC_POSITION_FORWARDS')
        );

        $this->assignRef('players', $players);
        $this->assignRef('position', $position);
        parent::display($tpl);
    }
}
?>