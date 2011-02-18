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

class HockeyViewTabplayer extends JView {

    function display($tpl = null) {

        $model = & $this->getModel('stats');
        $id = (int) JRequest::getVar('id', 0, 'get', 'INT');
        $sez = (int) JRequest::getVar('sez', 0, 'get', 'INT');

        if ($sez == 0) {
            JError::raiseError(404, JText::_("Data not found"));
            return;
        }
    
        switch ($id) {
            case 4:
                $lista = $model->getListGolies(1, $sez);
                $title = JText::_('HOC_STAT_GOLIES_PLAYOFF');
                break;
            case 3:
                $lista = $model->getListGolies(0, $sez);
                $title = JText::_('HOC_STAT_GOLIES_SEASON_R');
                break;
            case 2:
                $lista = $model->getListPlayers(1, $sez);
                $title = JText::_('HOC_STAT_PLAYERS_PLAYOFF');
                break;
            default:
                $lista = $model->getListPlayers(0, $sez);
                $title = JText::_('HOC_STAT_PLAYERS_SEASON_R');
                break;
        }
        $this->assignRef('lista', $lista);
        $this->assignRef('title', $title);
        $this->assignRef('id', $id);
        parent::display($tpl);
    }
}
?>