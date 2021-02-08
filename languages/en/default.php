<?php

if (!defined('TL_ROOT'))
  die('You can not access this file directly!');

/**
 * @copyright  µaTh 2014 - 2020
 * @author     µaTh
 * @package    be_piwikcharts
 * @license    GNU/LGPL 
 */

/*
 * Error messages
 */
$GLOBALS['TL_LANG']['be_piwikcharts']['errormsg'][1] = "be_piwikcharts: Error#1: Connection to Matomo-Server failed. Please check your connection settings.";


/*
 * Template text labels
 */

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['headline'] = "Visitor statistics with Matomo";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['visits'] = "visits";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last30minutes'] = "Previous 30 minutes";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last24hours'] = "Previous 24 hours";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['period'] = "Period";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['period_lastXdays'] = "previous %d days";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings'] = "Settings";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings_title'] = "Settings";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print'] = "Print page";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print_title'] = "Print this page";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout'] = "OptOut";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout_title'] = "Settings: Do not track own visits on website.";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login'] = "Login Matomo";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login_title'] = "Login Matomo-Server";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update'] = "Update available";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update_title'] = "New Matomo software update is available";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['headline'] = "Dashboard";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['alt_text'] = "Chart";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last30days_headline'] = "Daily visits";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last24months_headline'] = "Last 24 months";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitsPerServerTime_headline'] = "Visit time (server time)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitTimeByDayOfWeek_headline'] = "Visit days";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userBrowser_headline'] = "Browser";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userCountry_headline'] = "Visitors from";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_headline'] = "Top keywords, that leads to your website";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_keyword'] = "Keyword";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_count'] = "Visits";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_headline'] = "From this websites your visitors came from";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_website'] = "From website";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count'] = "Visits";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_headline'] = "Most visited pages";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_page'] = "Page";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_count'] = "Visits";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_headline'] = "Most downloaded content";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_domain'] = "Domain";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_file'] = "File";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_count'] = "Downloads";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_headline'] = "Resolution";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_header_width'] = "Width";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_header_count'] = "Visits";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_pixel'] = "Pixels";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['piwikinfo'] = "<p>Matomo is a free and open source web analytics application.</p><p>Matomo displays reports regarding the geographic location of visits, the source of visits (i.e. whether they came from a website, directly, or something else), the technical capabilities of visitors (browser, screen size, operating system, etc.), what the visitors did (pages they viewed, actions they took, how they left), the time of visits and more.</p><p>More informationen see <a href='https://matomo.org/' onclick='window.open(this.href); return false;'>https://matomo.org/</a></p>";


