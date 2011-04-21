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
require_once( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_hockey' . DS . 'helpers' . DS . 'position.php' );

class HockeyViewPlayerflash extends JView {

    function display($tpl = null) {
        $mainframe = &JFactory::getApplication();
        $params =  &$mainframe->getParams();
        $model = &$this->getModel();
        $rows = $model->getListPlayers($params->get('iddsfp'));

        // modify the MIME type
        $document = & JFactory::getDocument ();
        $document->setMimeEncoding('text/xml');
        echo '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
        echo '<element>' . "\n";
        if (!empty($rows)) {
            foreach ($rows as $row) {
                echo "\t\t" . '<player>' . "\n";
                echo "\t\t\t" . '<name>' . $row->nazwisko . '</name>' . "\n";
                echo "\t\t\t" . '<firstname>' . $row->imie . '</firstname>' . "\n";
                echo "\t\t\t" . '<height>' . $row->wzrost . '</height>' . "\n";
                echo "\t\t\t" . '<weight>' . $row->waga . ' </weight>' . "\n";
                echo "\t\t\t" . '<date>' . JHTML::_('date', $row->data_u, JText::_('DATE_FORMAT_LC4')) . '</date>' . "\n";
                echo "\t\t\t" . '<position>' . HockeyHelperPosition::getPositionString((int) $row->pozycja) . '</position>' . "\n";
                echo "\t\t\t" . '<description><![CDATA[ ' . $row->opis . '   ]]> </description>' . "\n";
                echo "\t\t\t" . '<photo>' . $row->foto . '</photo>' . "\n";
                echo "\t\t\t" . '<number>' . $row->nr . '</number>' . "\n";
                echo "\t\t" . '</player>' . "\n";
            }
        }
        echo '</element>' . "\n";
    }
}

?>