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

class HockeyViewPlayerflash extends JView {

    function display($tpl = null) {
        $document = & JFactory::getDocument ();
        $document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.js' );
        $document->addScript(JURI::base(true).'/components/com_hockey/assets/jquery.swfobject.1-1-1.min.js' );

        $mainframe = &JFactory::getApplication();
        $params = &$mainframe->getPageParameters ();

        $menus = &JSite::getMenu ();
        $menu = $menus->getActive ();

        $title =   JText::_( 'HOC_PLAYERS_FLASH_TITLE');
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));
        parent::display ( $tpl );
    }
}
?>