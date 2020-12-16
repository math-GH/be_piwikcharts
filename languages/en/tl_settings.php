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


$GLOBALS['TL_LANG']['tl_settings']['piwikcharts_legend'] = 'Matomo: Visitor stats (be_piwikcharts)';

$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'] = array("URL", "URL to Matomo installation: (http(s)://sub.domain.tld/subfolder/)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_URL'] = 'Valid URL-format required. Please decode special characters. (http(s)://sub.domain.tld/subfolder/)';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_httpCode'] = 'Matomo-installation not found. Server sends HTTP-Code ';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['siteID'] = array("SiteID", "Website-ID: idSite-variable from Matomo installation. Matomo installationen, that only track one website siteID is usualy 1. idSite value can found in URL of Matomo dashboard.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode'] = array("AuthCode", "AuthCode for authenticated connection to Matomo to show stats at the Contao backend.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode']['rgxp'] = "No Connection to Matomo installation possible with this AuthCode.";
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['period'] = array("Period", "Period in days, that the stats are shown. (optional, default: 30 days)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['username'] = array("Username", "Username for Auto-Login to Matomo (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['password'] = array("Password", "Password for Auto-Login to Matomo (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageAdmin'] = array("Backend welcome page: Stats shown (only for admins)", "Only for admin users: Shows any stats on first page after backend login. Additionally it checks for new available updates.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePage'] = array("Backend welcome page: Stats shown (for ALL users)", "Shows any stats on first page after backend login (for ALL users inkl. admin users). Additionally it checks for new available updates.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageUpdate'] = array("Backend welcome page: Check Matomo update is available (für non-admins)", "Shows for all non-admin useres a information, when a new Matomo update ist available. Admin users will allways informed.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageOptout'] = array("Optout-Link (for non-admins)", "Shows for non-admin users next to headline an icon, within the user tracking by Matomo can be disabled.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['redirect'] = array("Redirects of Matomo-domain", "helps by redirected domains f.e. redirection from non-www to www. Enabling could produce PHP-warning: CURLOPT_FOLLOWLOCATION cannot be activated");


?>