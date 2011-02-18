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
require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'season.php' );

class HockeyViewInfo extends JView {

    function display($tpl = null) {

        $model = &$this->getModel('info');
        $info = $model->getComponentInfo();

        $calendar = $model->CheckModule("mod_calendar");
        $matchdays = $model->CheckModule("mod_matchdays");
        $scoreboard = $model->CheckModule("mod_scoreboard");
        $standings = $model->CheckModule("mod_standings");
        $topplayer = $model->CheckModule("mod_topplayer");

        $this->assignRef('info', $info);
        $this->assignRef('calendar', $calendar);
        $this->assignRef('matchdays', $matchdays);
        $this->assignRef('scoreboard', $scoreboard);
        $this->assignRef('standings', $standings);
        $this->assignRef('topplayer', $topplayer);

        $this->_addToolbar();
        $this->_addTitle();

        parent::display($tpl);
    }

    function _addToolbar() {
        $info = HockeyHelperSelectSeason::getNameSez();
        JToolBarHelper::title(JText::_('HOCKEY') . ' : ' . $info, 'logo.png');
        JToolBarHelper::preferences('com_hockey', '500', '700', 'HOC_CONFIG');
    }

    function _addTitle() {
        $this->addTemplatePath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'views' . DS . 'head');
        $title = JText::_('INFO');
        $this->assignRef('title', $title);
        parent::display('head');
    }
}
?>
