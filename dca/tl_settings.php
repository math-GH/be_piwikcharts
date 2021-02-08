<?php

if (!defined('TL_ROOT'))
  die('You cannot access this file directly!');

/**
 * @copyright  µaTh 2014 - 2020
 * @author     µaTh (+ Caro (ct9))
 * @package    be_piwikcharts
 * @license    GNU/LGPL
 * @filesource
 */
/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{piwikcharts_legend:hide},piwikchartsURL,piwikchartsSiteID,piwikchartsAuthCode,piwikchartsPeriod,piwikchartsResolutionWidth,piwikchartsRedirect;';

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsURL'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'rgxp' => 'checkMatomoUrl', 'tl_class' => 'w50', 'trailingSlash' => true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsSiteID'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['siteID'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'rgxp' => 'digit', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsAuthCode'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'rgxp' => 'checkAuthCode', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsPeriod'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['period'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'rgxp' => 'natural', 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsResolutionWidth'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['resolutionWidthArray'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'tl_class' => 'w50')
);


$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsRedirect'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['redirect'],
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'clr')
);
