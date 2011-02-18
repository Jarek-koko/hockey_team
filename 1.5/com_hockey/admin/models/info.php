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
jimport('joomla.application.component.model');

class HockeyModelInfo extends JModel {

    function CheckModule($name) {
        
        $db = & JFactory::getDBO();
        $query = "SELECT * FROM #__modules WHERE module=".$db->Quote($name);
        $db->setQuery($query);
        $db->query();
        $num_rows = $db->getNumRows();

        if ($num_rows > 0) {
            $result = Array('ok' => true, 'mesg' => JText::_('INSTALLED'));
            return $result;
        } else {
            $result = Array('ok' => false, 'mesg' => JText::_('NOT INSTALLED'));
            return $result;
        }
    }

    function getComponentInfo() {
        $info = array();

        $parser = & JFactory::getXMLParser('Simple');
        $xml = JPATH_COMPONENT . DS . 'com_hockey.xml';

        $parser->loadFile($xml);
        $doc = & $parser->document;

        $element = & $doc->getElementByPath('author');
        $info['author'] = $element->data();

        $element = & $doc->getElementByPath('version');
        $info['version'] = $element->data();

        $element = & $doc->getElementByPath('copyright');
        $info['copyright'] = $element->data();

        $element = & $doc->getElementByPath('authorurl');
        $info['authorurl'] = $element->data();

        $element = & $doc->getElementByPath('creationdate');
        $info['creationdate'] = $element->data();

        $element = & $doc->getElementByPath('license');
        list($link, $gpl) = explode(' ', $element->data());
        $info['gpl'] = $gpl;
        $info['gpllink'] = $link;

        return $info;
    }
}

?>
