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


$GLOBALS['TL_LANG']['tl_settings']['piwikcharts_legend'] = 'Piwik: Visitor stats (be_piwikcharts)';

$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'] = array("URL", "URL to Piwik installation: (http(s)://sub.domain.tld/subfolder/)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_URL'] = 'Valid URL-format required. Please decode special characters. (http(s)://sub.domain.tld/subfolder/)';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_httpCode'] = 'Piwik-installation not found. Server sends HTTP-Code ';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['siteID'] = array("SiteID", "Website-ID: idSite-variable from Piwik installation. Piwik installationen, that only track one website siteID is usualy 1. idSite value can found in URL of Piwik dashboard.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode'] = array("AuthCode", "AuthCode for authenticated connection to Piwik to show stats at the Contao backend.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode']['rgxp'] = "No Connection to Piwik installation possible with this AuthCode.";
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['username'] = array("Username", "Username for Auto-Login to Piwik (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['password'] = array("Password", "Password for Auto-Login to Piwik (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageAdmin'] = array("Backend welcome page: Stats shown (only for admins)", "Only for admin users: Shows any stats on first page after backend login. Additionally it checks for new available updates.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePage'] = array("Backend welcome page: Stats shown (for ALL users)", "Shows any stats on first page after backend login (for ALL users inkl. admin users). Additionally it checks for new available updates.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageUpdate'] = array("Backend welcome page: Check Piwik update is available (für non-admins)", "Shows for all non-admin useres a information, when a new piwik update ist available. Admin users will allways informed.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageOptout'] = array("Optout-Link (for non-admins)", "Shows for non-admin users next to headline an icon, within the user tracking by piwik can be disabled.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['redirect'] = array("Redirects of Piwik-domain", "helps by redirected domains f.e. redirection from non-www to www. Enabling could produce PHP-warning: CURLOPT_FOLLOWLOCATION cannot be activated");


?>