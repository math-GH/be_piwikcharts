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
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{piwikcharts_legend:hide},piwikchartsURL,piwikchartsSiteID,piwikchartsAuthCode,piwikchartsPeriod,piwikchartsUsername,piwikchartsPassword,piwikchartsWelcomePageAdmin,piwikchartsWelcomePage,piwikchartsWelcomePageUpdate,piwikchartsWelcomePageOptout,piwikchartsRedirect;';

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsURL'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'rgxp' => 'checkPiwikUrl', 'tl_class' => 'w50', 'trailingSlash' => true)
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

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsUsername'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['username'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsPassword'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['password'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'hideInput' => true, 'encrypt' => true, 'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsWelcomePageAdmin'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageAdmin'],
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsWelcomePage'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePage'],
    'inputType' => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsWelcomePageUpdate'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageUpdate'],
    'inputType' => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsWelcomePageOptout'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageOptout'],
    'inputType' => 'checkbox',
);


$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsRedirect'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['redirect'],
    'inputType' => 'checkbox',
);
?>