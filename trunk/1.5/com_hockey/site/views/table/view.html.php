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

class HockeyViewTable extends JView {

    function display($tpl = null) {

        $document = & JFactory::getDocument();
        $mainframe = &JFactory::getApplication();
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.js');
        $document->addScript(JURI::base(true) . '/components/com_hockey/assets/jquery.tablesorter.js');

        $model = &$this->getModel();
        $params = &$mainframe->getParams();
        $model->setSezon($params->get('iddsfp'));

        //get list teams for table
        $list = $model->getData();

        $menus = &JSite::getMenu();
        $menu = $menus->getActive();

        $title = JText::_('HOC_TABLE_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

        // get season for select
        $sezony = $model->getSezonList();

        $lista = JHTML::_('select.genericlist', $sezony, 'sezon', 'class="inputbox" ', 'value', 'text', $model->getSezon());
        // helper selectseason
        $select_season = JHTML::_('Selectseason.getSelect', $lista, $menu->query['view'], JRoute::_('index.php?option=com_hockey&task=querypost'));
        $infosezon = $model->getInfoSezon();

        $this->assignRef('list', $list);
        $this->assignRef('params', $params);
        $this->assignRef('infosezon', $infosezon);
        $this->assignRef('select_season', $select_season);
        parent::display($tpl);
    }
}
?>