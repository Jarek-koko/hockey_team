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
jimport('joomla.application.component.model');

class HockeyModelUscor extends JModel {

    // int id season
    var $_sez = null;
    // object points system
    var $_points = null;
    // object match
    var $_match = null;
    // id_match
    var $_id = null;
    // team  1 table
    var $_team1 = null;
    // team  2 table
    var $_team2 = null;


    function __construct() {
        parent::__construct();
        $session = &JFactory::getSession ();
        $this->_id = (int) JRequest::getVar('id_match', 0, 'POST', 'int');
        $this->_sez = (int) $session->get('sezon', 0);
    }

    function _getPoints() {
        $query = "SELECT * FROM #__hockey_system  WHERE id='$this->_sez' LIMIT 1";
        $this->_db->setQuery($query);
        return $this->_db->loadObject();
    }

    function _getMatch() {
        $query = "SELECT * FROM #__hockey_match WHERE id='$this->_id' LIMIT 1";
        $this->_db->setQuery($query);
        return $this->_db->loadObject();
    }

    function _getTeamTabela($id_team) {
        $query = "SELECT * FROM #__hockey_tabela WHERE team_id ='" . $id_team . "' and id_system='$this->_sez' LIMIT 1";
        $this->_db->setQuery($query);
        return $this->_db->loadObject();
    }

    function updateTable() {

        $this->_points = $this->_getPoints();
        $this->_match = $this->_getMatch();

        if (!isset($this->_points) || empty($this->_points)) {
            $this->setError(JText::_('SEASON NOT EXIST'));
            return false;
        }

        if (!isset($this->_match) || empty($this->_match)) {
            $this->setError(JText::_('MATCH NOT EXIST'));
            return false;
        }

        if ($this->_match->uscore == 1) {
            $this->setError(JText::_('UPDATE IMPOSSIBLE'));
            return false;
        }


        $this->_team1 = $this->_getTeamTabela($this->_match->druzyna1);
        $this->_team2 = $this->_getTeamTabela($this->_match->druzyna2);

        if (!isset($this->_team1) || empty($this->_team1)) {
            $this->setError(JText::_('TEAM IS NOT IN THE TABLE'));
            return false;
        }

        if (!isset($this->_team2) || empty($this->_team2)) {
            $this->setError(JText::_('TEAM IS NOT IN THE TABLE'));
            return false;
        }

        $team1 = new stdClass();
        $team1->id = $this->_team1->id;
        $team2 = new stdClass();
        $team2->id = $this->_team2->id;
        $matchflag = new stdClass();


        //*******************
        // if team1 won
        //*******************
        if ($this->_match->wynik_1 > $this->_match->wynik_2) {

            if ($this->_match->m_karne == "T") {                                    // if won by Shootout
                $team1->punkty = $this->_team1->punkty + $this->_points->p_k_w;
                $team2->punkty = $this->_team2->punkty + $this->_points->p_k_p;
            } else {
                if ($this->_match->m_dogr == "T") {                                 // if won in overtimes
                    $team1->punkty = $this->_team1->punkty + $this->_points->p_d_w;
                    $team2->punkty = $this->_team2->punkty + $this->_points->p_d_p;
                } else {                                                            // if won in regular time
                    $team1->punkty = $this->_team1->punkty + $this->_points->p_w;
                    $team2->punkty = $this->_team2->punkty + $this->_points->p_p;
                }
            }
            $team1->wygrane = $this->_team1->wygrane + 1;                           // add one win
            $team2->przegrane = $this->_team2->przegrane + 1;                        // add one loss
        }

        //*******************
        // if  team2 won
        //*******************
        if ($this->_match->wynik_1 < $this->_match->wynik_2) {
            if ($this->_match->m_karne == "T") {                                    // if won by Shootout
                $team1->punkty = $this->_team1->punkty + $this->_points->p_k_p;
                $team2->punkty = $this->_team2->punkty + $this->_points->p_k_w;
            } else {
                if ($this->_match->m_dogr == "T") {                                 // if won in overtimes
                    $team1->punkty = $this->_team1->punkty + $this->_points->p_d_p;
                    $team2->punkty = $this->_team2->punkty + $this->_points->p_d_w;
                } else {                                                            // if won in regular time
                    $team1->punkty = $this->_team1->punkty + $this->_points->p_p;
                    $team2->punkty = $this->_team2->punkty + $this->_points->p_w;
                }
            }
            $team1->przegrane = $this->_team1->przegrane + 1;                        // add one loss
            $team2->wygrane = $this->_team2->wygrane + 1;                            // add one win
        }

        //*******************
        // if it was tie
        //*******************
        if ($this->_match->wynik_1 == $this->_match->wynik_2) {
            $team1->punkty = $this->_team1->punkty + $this->_points->p_r;
            $team2->punkty = $this->_team2->punkty + $this->_points->p_r;

            $team1->remisy = $this->_team1->remisy + 1;                             // add one loss
            $team2->remisy = $this->_team2->remisy + 1;
        }

        $team1->b_strzelone = $this->_team1->b_strzelone + $this->_match->wynik_1;
        $team1->b_stracone = $this->_team1->b_stracone + $this->_match->wynik_2;
        $team1->roznica = $team1->b_strzelone - $team1->b_stracone;
        $team1->kolejka = $this->_team1->kolejka + 1;

        $team2->b_strzelone = $this->_team2->b_strzelone + $this->_match->wynik_2;
        $team2->b_stracone = $this->_team2->b_stracone + $this->_match->wynik_1;
        $team2->roznica = $team2->b_strzelone - $team2->b_stracone;
        $team2->kolejka = $this->_team2->kolejka + 1;

        if (!$this->_db->updateObject('#__hockey_tabela', $team1, 'id', false)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$this->_db->updateObject('#__hockey_tabela', $team2, 'id', false)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        // set flag for block
        $matchflag->id = $this->_match->id;
        $matchflag->uscore = 1;

        if (!$this->_db->updateObject('#__hockey_match', $matchflag, 'id', false)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        return true;
    }
}
?>
