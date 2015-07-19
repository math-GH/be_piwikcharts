<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  µaTh 2015
 * @author     µaTh 
 * @package    be_piwikcharts
 * @license    GNU/LGPL 
 * @filesource
 */


/**
 * -------------------------------------------------------------------------
 * BACK END MODULES
 * -------------------------------------------------------------------------
 *
 * Back end modules are stored in a global array called "BE_MOD". Each module 
 * has certain properties like an icon, an optional callback function and one 
 * or more tables. Each module belongs to a particular group.
 * 
 *   $GLOBALS['BE_MOD'] = array
 *   (
 *       'group_1' => array
 *       (
 *           'module_1' => array
 *           (
 *               'tables'       => array('table_1', 'table_2'),
 *               'key'          => array('Class', 'method'),
 *               'callback'     => 'ClassName',
 *               'icon'         => 'path/to/icon.gif',
 *               'stylesheet'   => 'path/to/stylesheet.css',
 *               'javascript'   => 'path/to/javascript.js'
 *           )
 *       )
 *   );
 * 
 * Use function array_insert() to modify an existing modules array.
 */


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getSystemMessages'][] = array('bepiwikcharts', 'dashboardWelcomePage');
$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('bepiwikcharts', 'myRegexp_checkPiwikUrl');
$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('bepiwikcharts', 'myRegexp_checkAuthCode');




array_insert($GLOBALS['BE_MOD']['system'], 98, array(
    'be_piwikcharts' => array(
        'callback' => 'bepiwikcharts',
        'stylesheet' => 'system/modules/be_piwikcharts/assets/bepiwikcharts.css',
        'icon' => 'system/modules/be_piwikcharts/assets/piwikicon.png'
    )
));

 
?>