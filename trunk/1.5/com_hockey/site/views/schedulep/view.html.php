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

class HockeyViewSchedulep extends JView {

    function display($tpl = null) {
   
        $document = &JFactory::getDocument();
        $model = &$this->getModel();
        $mainframe = &JFactory::getApplication();
        $params = &$mainframe->getParams();

        $model->setSezon($params->get('iddsfp'));
        // list matches in matchday
        $rows = $model->getListPlayoff();

        $menus = &JSite::getMenu();
        $menu = $menus->getActive();

        $title =  JText::_('HOC_SCHEDULEP_TITLE');
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

        $lista = JHTML::_('select.genericlist', $sezony, 'sezon', 'class="inputbox" size="1"', 'value', 'text', $model->getSezon());
        $select_season = JHTML::_('Selectseason.getSelect', $lista, $menu->query['view'], JRoute::_('index.php?option=com_hockey&task=querypost'));

        $this->assignRef('rows', $rows);
        $this->assignRef('idsezon', $model->getSezon());
        $this->assignRef('params', $params);
        $this->assignRef('name_season', $name_season);
        $this->assignRef('select_season', $select_season);
        parent::display($tpl); 
    }
}
?>