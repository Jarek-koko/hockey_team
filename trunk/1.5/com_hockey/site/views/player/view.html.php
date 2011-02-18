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
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.application.component.view' );

class HockeyViewPlayer extends JView {
    
    function display($tpl = null) {
        
        $document = & JFactory::getDocument ();
        $document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.js' );
        $document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.tools.min.js' );
        $idplayer = ( int ) JRequest::getVar ( 'id', 0, 'get', 'int' );

        if ($idplayer == 0) {
            JError::raiseError(404, JText::_("Player not found"));
            return;
        }

        $mainframe = &JFactory::getApplication();
        $params = &$mainframe->getPageParameters ();
        $model = &$this->getModel();
        $model->setSezon($params->get('iddsfp'));
        $player = $model->getPlayer();
        $regular_stat = $model->getStatplayer(0);
        $playoff_stat = $model->getStatplayer(1);
        $select_players = $model->getSelectPlayers();

        if (is_object($player))
        $document->setTitle($player->imie.' '.$player->nazwisko );

        $this->assignRef ('idplayer', $idplayer);
        $this->assignRef ( 'selpl',  $select_players);
        $this->assignRef ( 'playoff_stat',  $playoff_stat );
        $this->assignRef ( 'regular_stat',  $regular_stat );
        $this->assignRef ( 'player', $player );

        parent::display ( 'select' );
        parent::display ( $tpl );
    }
}
?>