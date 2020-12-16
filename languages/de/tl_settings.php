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


$GLOBALS['TL_LANG']['tl_settings']['piwikcharts_legend'] = 'Matomo: Statistiken Besucher (be_piwikcharts)';

$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL'] = array("URL", "URL zu der Matomo-Installation: (http(s)://sub.domain.tld/subfolder/)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_URL'] = 'Bitte geben Sie ein gültiges URL-Format ein und kodieren Sie Sonderzeichen! (http(s)://sub.domain.tld/subfolder/)';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['URL']['rgxp_httpCode'] = 'Matomo-Installation konnte nicht gefunden werden. Server meldet HTTP-Code ';
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['siteID'] = array("SiteID", "Webseiten-ID: idSite-Variable aus der Matomo-Installation. Bei Matomo-Installationen, die nur eine Webseite erfassen ist 1 der Standard. Den Wert der idSite-Variabe findet man in der URL, wenn man sich das Dashboards auf dem Matomo-Server anschaut.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode'] = array("AuthCode", "AuthCode für die Verbindung mit Matomo um die Statistiken im Backendmodul anzeigen zu können.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['authCode']['rgxp'] = "Mit diesem AuthCode ist keine Verbindung mit der Matomo-Installation möglich.";
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['period'] = array("Zeitraum", "Zeitaum in Tagen, der statistisch ausgewertet werden soll. (optional, default: 30 Tage)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['username'] = array("Benutzername", "Benutzername für den Auto-Login in Matomo (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['password'] = array("Passwort", "Passwort für den Auto-Login mit Matomo (optional)");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageAdmin'] = array("BE-Startseite: Statistiken anzeigen (nur für Admins)", "Nur für Admin-User: Zeigt eine Auswahl von Statistiken auf der ersten Seite nach dem Login an. Zusätzlich wird geprüft ob ein Update von Matomo bereit steht.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePage'] = array("BE-Startseite: Statistiken im Backend anzeigen (für alle User)", "Für alle User (inkl. Admins): Zeigt eine Auswahl von Statistiken auf der ersten Seite nach dem Login an.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageUpdate'] = array("BE-Startseite: Über Matomo-Update informieren (für Nicht-Admins)", "Zeigt für Nicht-Admins eine Information an, wenn ein Update von Matomo bereit steht. Admins werden immer informiert.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['welcomePageOptout'] = array("Optout-Link (für Nicht-Admins)", "Zeigt für Nicht-Admins neben der Überschrift ein Icon an, über dessen Link die Erfassung von Matomo deaktiviert werden kann.");
$GLOBALS['TL_LANG']['tl_settings']['be_piwikcharts']['redirect'] = array("Redirects auf der Matomo-Domain", "wenn man z.B. von nicht-www auf www umschreibt etc.. Aktivierung kann zur PHP-Warnung führen: CURLOPT_FOLLOWLOCATION cannot be activated");


?>