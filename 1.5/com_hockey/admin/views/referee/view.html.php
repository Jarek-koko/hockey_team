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


class HockeyViewReferee extends JView {

    function display($tpl = null) {

        $document = & JFactory::getDocument ();
        $document->addScript(JURI::root(true)."/administrator/components/com_hockey/assets/validate.js");

        $option = JRequest::getCmd('option');
        $model = $this->getModel('referees');
        $items = $model->getReferee();

        $lists = array();
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
}?>
