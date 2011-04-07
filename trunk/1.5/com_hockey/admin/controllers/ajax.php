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
jimport('joomla.application.component.controller');

class HockeyControllerAjax extends JController {

    function __construct($config = array()) {
        parent::__construct($config);
        JRequest::setVar('tmpl', 'component');
    }

    function display() {
        $team = (int) JRequest::getVar('state', 0, 'get', 'int');

        if ($team == 0) {
            echo '<option value="no">' . JText::_('HOS_NO_PLAYERS') . '</option>';
        } else {
            $db = & JFactory::getDBO ();
            $query = "SELECT id , CONCAT_WS( ' ', nazwisko ,imie ) AS name "
                ."FROM #__hockey_players "
                ."WHERE klub=" . $db->Quote($team) . " AND published='1' ORDER BY nazwisko";

            $db->setQuery($query);
            $players = $db->loadAssocList();

            if (count($players)) {
                echo '<option value="no" >' . JText::_('HOS_MUST_SELECT_PLAYERS') . '</option>';
                foreach ($players as $player) {
                    echo '<option value="'. $player ['id'] .'">'.$player ['name'] . '</option>';
                }
            } else {
                echo '<option value="no">' . JText::_('HOS_NO_PLAYERS') . '</option>';
            }
        }
    }

    function getg() {
        $id_team = (int) JRequest::getVar('id_team', 0, 'get', 'int');
        if ($id_team == 0) {
            echo '<option value="no">' . JText::_('HOS_NO_PLAYERS') . '</option>';
        } else {
            $db = & JFactory::getDBO ();
            $query = "SELECT id , CONCAT_WS( ' ', nazwisko ,imie )AS name "
                    . "FROM #__hockey_players "
                    . "WHERE klub=" . $db->Quote($id_team) . " AND pozycja='1'  AND published ='1' ORDER BY  nazwisko ";

            $db->setQuery($query);
            $goalies = $db->loadAssocList();
            if (count($goalies)) {
                echo '<option value="no" >' . JText::_('HOS_MUST_SELECT_PLAYERS') . '</option>';
                foreach ($goalies as $goalie) {
                    echo '<option value="' . $goalie ['id'] . '">' . $goalie ['name'] . '</option>';
                }
            } else {
                echo '<option value="no">' . JText::_('HOS_NO_PLAYERS') . '</option>';
            }
        }
    }

    function iword() {
        $word = JRequest::getVar('value', '', 'post', 'string');

        if ($word != '') {
            $db = & JFactory::getDBO ();
            $escape = $db->getEscaped($word);
            $escape = $db->Quote($escape . '%', false);
            $query = "SELECT note, COUNT(*)  FROM #__hockey_match_penalty WHERE note LIKE " . $escape. " GROUP BY note ORDER BY COUNT(*) DESC";
            $db->setQuery($query);
            $data = $db->loadResultArray();

            $document = & JFactory::getDocument();
            $document->setMimeEncoding('application/json');
            echo json_encode($data);
        }
    }

}

?>