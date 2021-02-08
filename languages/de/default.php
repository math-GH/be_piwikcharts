<?php

if (!defined('TL_ROOT'))
  die('You can not access this file directly!');

/**
 * @copyright  µaTh 2014 -2020
 * @author     µaTh
 * @package    be_piwikcharts
 * @license    GNU/LGPL 
 */

/*
 * Fehlermeldungen
 */
$GLOBALS['TL_LANG']['be_piwikcharts']['errormsg'][1] = "be_piwikcharts: Fehler#1: Verbindung zum Matomo-Server konnte nicht hergestellt werden. Bitte Verbindungseinstellungen prüfen.";


$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['headline'] = "Statistiken Besucher mit Matomo";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['visits'] = "Besuche";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last30minutes'] = "letzte 30 Minuten";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['live']['last24hours'] = "letzte 24 Stunden";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['period'] = "Zeitraum";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['period_lastXdays'] = "letzte %d Tage";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings'] = "Einstellungen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['settings_title'] = "Zu den Einstellungen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print'] = "Seite drucken";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['print_title'] = "Statistiken ausdrucken";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout'] = "OptOut";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['optout_title'] = "Einstellungen: Eigene Besuche nicht mehr erfassen";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login'] = "Login Matomo";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['login_title'] = "Login Matomo-Server";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update'] = "Update verfügbar";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['menu']['update_title'] = "Ein neues Update der Matomo-Software ist verfügbar";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['headline'] = "Dasboard";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['alt_text'] = "Diagramm";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last30days_headline'] = "Tägliche Besuche";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_last24months_headline'] = "Letzte 24 Monate";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitsPerServerTime_headline'] = "Besuchszeiten (Serverzeit)";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_visitTimeByDayOfWeek_headline'] = "Besuchertage";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userBrowser_headline'] = "Browser";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['graph']['visitors_userCountry_headline'] = "Besucher aus";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_headline'] = "Top-Suchwörter, die auf die Webseite geführten hatten";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_keyword'] = "Suchwort";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['keywords_header_count'] = "Aufrufe";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_headline'] = "Von diesen Webseiten kamen Ihre Besucher auf Ihre Webseite";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_website'] = "Von Webseite";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['fromWebsite_header_count'] = "Aufrufe";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_headline'] = "Die am häufigsten besuchten Seiten";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_page'] = "Seite";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['visitedPages_header_count'] = "Aufrufe";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_headline'] = "Die häufigsten Downloads";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_domain'] = "Domain";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_file'] = "Datei";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['downloads_header_count'] = "Downloads";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_headline'] = "Auflösung";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_header_width'] = "Breite";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_header_count'] = "Besuche";
$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['table']['resolution_pixel'] = "Pixel";

$GLOBALS['TL_LANG']['be_piwikcharts']['template']['sheet']['piwikinfo'] = "<p>Matomo ist eine Open-Source (GPL lizenzierte) Webanalyse-Software, die heruntergeladen werden kann. Matomo bietet Ihnen detaillierte Echtzeit-Berichte über die Besucher Ihrer Homepage, die genutzten Suchmaschinen und Suchbegriffe, die Sprache, Ihre beliebten Seiten… und vieles mehr.</p><p>Das Ziel von Matomo ist es, eine Open-Source Alternative zu Google Analytics zu bieten.</p><p>Weitere Informationen auf <a href='https://matomo.org' onclick='window.open(this.href); return false;'>https://matomo.org</a></p>";

