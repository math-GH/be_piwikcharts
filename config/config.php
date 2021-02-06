<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * @copyright  µaTh 2011 - 2020
 * @author     µaTh 
 * @package    be_infopage 
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
$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('bepiwikcharts', 'myRegexp_checkMatomoUrl');
$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('bepiwikcharts', 'myRegexp_checkAuthCode');




array_insert($GLOBALS['BE_MOD']['system'], 98, array(
    'be_piwikcharts' => array(
        'callback' => 'bepiwikcharts'
    )
));
