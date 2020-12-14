be_piwikcharts für Contao CMS
=============
Webseitenstatistiken aus einer Piwik-Installation im Backend unter System -> "Statistiken Besucher" anzeigen.

Webseitenstatistiken aus einer Piwik-Installation im Backend unter System -> "Statistiken Besucher" anzeigen.


Benötigt wird die URL zur Piwikinstallation, die SeitenID unter der in Piwik die Webseite getrackt wird und der Auth-Code. Diese Daten unter System -> Einstellungen im Abschnitt "Piwik-Statistiken" eintragen. Ohne Verbindungsdaten werden die Statistikdaten von demo.piwik.org angezeigt.

 

Folgende Statistiken werden im Standard-Template angezeigt:

  * Anzahl Besucher in den letzten 30 Minuten
  * Anzahl Besucher in den letzten 24 Stunden
  * Anzahl Besucher (täglich) [Linien-Diagramm]
  * Anzahl Besucher (monatlich) [Linien-Diagramm]
  * Besuchszeiten (Serverzeit) (stündlich, Daten der letzten 30 Tage) [Balkendiagramm]
  * Besucherwochentage (Daten der letzten 30 Tage) [Balkendiagramm]
  * Browser (Daten der letzten 30 Tage) [Balkendiagramm]
  * Herkunft der Besucher (Daten der letzten 30 Tage) [Balkendiagramm]
  * Suchwörter (Daten der letzten 30 Tage) [Tabelle]
  * Herkunft-Webseite der Besucher (Daten der letzten 30 Tage) [Tabelle]
  * Häufigsten Seiten (Daten der letzten 30 Tage) [Tabelle]
  * Downloads (Daten der letzten 30 Tage) [Tabelle]

 

Weiterhin kann über den Link "OptOut" ein Cookie gesetzt werden um eigene Besuche nicht in die Statistik  aufzunehmen.

Die angezeigten Statistiken können ausgedruckt werden.

 

Piwik (http://piwik.org) muss seperat auf einem Server installiert sein.

Links
=====
* Link zum Contao-Repository: https://contao.org/de/erweiterungsliste/view/be_piwikcharts.10050009.de.html
* Link zum Forum: https://community.contao.org/de/showthread.php?34266-be_piwikcharts-Besucherstatistiken-aus-Piwik-im-Backend-anzeigen/page3
* Link zum Wiki/Doku: https://github.com/mathContao/be_piwikcharts/wiki/Documentation-(German)
* Roadmap: https://github.com/mathContao/be_piwikcharts/wiki/Roadmap

Piwik/Matomo
============
Unterstützt Piwik/Matomo seit Version 1.0. Bis Matomo Versionen 3.13 kompatibel. In Version 4.0 gab es eine Änderung an der API (siehe Issues).

Credits
=======
  *  µaTh (Hauptentwickler)
  *  Caro (User: ct9)
