<?php
/**
 * @copyright  µaTh 2014 
 * @author     µaTh (+ Caro (ct9))
 * @package    be_piwikcharts
 */

$GLOBALS['TL_LANG']['MOD']['be_piwikcharts'] = array('Statistiken Besucher', 'Statistiken Besucher anzeigen');
$GLOBALS['TL_LANG']['MOD']['bepiwikcharts'] = array('Statistiken Besucher', 'Statistiken Besucher anzeigen');

$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsURL'] = array("URL","URL zu der Piwik-Installation");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsSiteID'] = array("SiteID","Webseiten-ID: idSite-Variable aus der Piwik-Installation. Bei Piwik-Installationen, die nur eine Webseite erfassen ist 1 der Standard. DenWert der idSite-Variabe findet man in der URL, wenn man sich das Dashboards auf dem Piwik-Server anschaut.");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsAuthCode'] = array("AuthCode","AuthCode für die Verbindung mit Piwik um die Statistiken im Backendmodul anzeigen zu können.");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsUsername'] = array("Benutzername","Benutzername für den Auto-Login in Piwik (optional)");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsPassword'] = array("Passwort","Passwort für den Auto-Login mit Piwik (optional)");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsWelcomePageAdmin'] = array("BE-Startseite: Statistiken anzeigen (nur für Admins)","Nur für Admin-User: Zeigt eine Auswahl von Statistiken auf der ersten Seite nach dem Login an. Zusätzlich wird geprüft ob ein Update von Piwik bereit steht.");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsWelcomePage'] = array("BE-Startseite: Statistiken im Backend anzeigen (für alle User)","Für alle User (inkl. Admins): Zeigt eine Auswahl von Statistiken auf der ersten Seite nach dem Login an.");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsWelcomePageUpdate'] = array("BE-Startseite: Über Piwik-Update informieren (für Nicht-Admins)","Zeigt für Nicht-Admins eine Information an, wenn ein Update von Piwik bereit steht. Admins werden immer informiert.");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsWelcomePageOptout'] = array("Optout-Link (für Nicht-Admins)","Zeigt für Nicht-Admins neben der Überschrift ein Icon an, über dessen Link die Erfassung von Piwik deaktiviert werden kann.");
$GLOBALS['TL_LANG']['piwikchartsURL']['piwikchartsRedirect'] = array("Redirects auf der Piwik-Domain", "wenn man z.B. von nicht-www auf www umschreibt etc.. Aktivierung kann zur PHP-Warnung führen: CURLOPT_FOLLOWLOCATION cannot be activated"); 


?>