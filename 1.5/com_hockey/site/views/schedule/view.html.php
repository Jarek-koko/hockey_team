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
JHTML::addIncludePath(JPATH_COMPONENT . DS . 'helpers');

class HockeyViewSchedule extends JView {

    function display($tpl = null) {
      
        $mainframe = &JFactory::getApplication();
        $document = & JFactory::getDocument();
        $model = &$this->getModel();
        $params =  &$mainframe->getParams();

        $model->setSezon($params->get('iddsfp'));

        $menus = &JSite::getMenu();
        $menu = $menus->getActive();

        $title =  JText::_('HOC_SCHEDULEALL_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

        $sezony = $model->getData();
        $nr = count($sezony);

        if ($nr < 1) {
            JError::raiseWarning(403, JText::_('HOC_NO_SEASON'));
            return;
        }
        for ($a = 0; $a < $nr; $a++) {
            if ($sezony[$a]->value == $model->getSezon()) {
                $name_season = $sezony[$a]->text;
            }
        }
        $rows = $model->getAllList();
        $lista = JHTML::_('select.genericlist', $sezony, 'sezon', 'class="inputbox size="1" ', 'value', 'text', $model->getSezon());

        $stom = array();
        $stom[] = JHTML::_('select.option', '0', JText::_('HOC_REGULAR_SEASON_SELECT'));
        $stom[] = JHTML::_('select.option', '1', JText::_('HOC_PLAYOFF_SELECT'));
        $stom[] = JHTML::_('select.option', '2', JText::_('HOC_PRESEASON_SELECT'));
        $tom = JHTML::_('select.genericlist', $stom, 'tom', 'class="inputbox" size="1" ', 'value', 'text', $model->getTom());

        $re = array();
        $re[] = JHTML::_('select.option', '0', JText::_('HOC_ALL_GAMES'));
        $re[] = JHTML::_('select.option', '1', JText::_('HOC_HOME_GAMES'));
        $re[] = JHTML::_('select.option', '2', JText::_('HOC_AWAY_GAMES'));
        $where = JHTML::_('select.genericlist', $re, 'where', 'class="inputbox" size="1" ', 'value', 'text', $model->getWhere());

        $this->assignRef('tom', $tom);
        $this->assignRef('where', $where);
        $this->assignRef('rows', $rows);
        $this->assignRef('idsezon', $model->getSezon());
        $this->assignRef('params', $params);
        $this->assignRef('name_season', $name_season);
        $this->assignRef('lista', $lista);
        $this->assignRef('action',JRoute::_('index.php?option=com_hockey&task=querypost3'));
        parent::display($tpl);  
    }
}
?>