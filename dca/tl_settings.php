<?php

if (!defined('TL_ROOT'))
  die('You cannot access this file directly!');

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
 * @copyright  µaTh 2014 
 * @author     µaTh (+ Caro (ct9))
 * @package    be_piwikcharts
 * @license    GNU/LGPL
 * @filesource
 */
/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{piwikcharts_legend:hide},piwikchartsURL,piwikchartsSiteID,piwikchartsAuthCode,piwikchartsUsername,piwikchartsPassword,piwikchartsWelcomePageAdmin,piwikchartsWelcomePage,piwikchartsWelcomePageUpdate,piwikchartsWelcomePageOptout,piwikchartsRedirect;';

$GLOBALS['TL_DCA']['tl_settings']['fields']['piwikchartsURL'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'],
    'inputType' => 'text',
    'exclude' => true,
    'eval' => array('mandatory' => false, 'rgxp' => 'absoluteUrl', 'tl_class' => 'w50', 'trailingSlash' => true)
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
    'eval' => array('mandatory' => false, 'rgxp' => 'alnum', 'tl_class' => 'long clr')
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
    'eval' => array('mandatory' => false, 'hideInput' => true, 'encrypt' => true)
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