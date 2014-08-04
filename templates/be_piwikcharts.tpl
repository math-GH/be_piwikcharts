<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!'); ?>

<div id="be_piwikcharts">
  <div class="serverinfo">
    <span class="settings">
      <?php if($this->isAdmin): ?>
        <a class="goToSettings" href="<?php echo $this->link_settings ?>">» Zu den Einstellungen</a> | 
      <?php endif; ?>
      <a class="print" href="javascript:window.print()">Seite drucken</a> | 
      <a class="optOut" href="<?php echo $this->link_optOut ?>" onclick="window.open(this.href); return false;" title="Einstellungen: Eigene Besuche nicht mehr erfassen">OptOut</a> |
      <a class="extern" onclick="window.open(this.href); return false;" href="<?php echo (isset($this->link_server_login) ? ($this->link_server_login) : ($this->link_server)) ?>" title="Login Piwik-Server">Login Piwik</a>
      <?php if($this->update && $this->showUpdate): ?>
        <a class="update" href="<?php echo $this->link_server ?>" onclick="window.open(this.href); return false;" title="Ein Update der Piwik-Software auf Version <?php echo $this->update ?> ist verfügbar."> | Update verfügbar</a>
      <?php endif; ?>
    </span>
    <?php if($this->isAdmin): ?>
      <div class="piwikserver">
        Piwik-Server: <a class="extern" target="_blank" href="<?php echo $this->link_server ?>"><?php echo $this->link_server ?></a> (SiteID: <?php echo $this->piwik_IDsite ?>)
      </div>
    <?php endif; ?>
    
  </div>
  <div class="summary">
    <table>
    <tr>
      <td class="col0">Letzte 30 Minuten:</td>
      <td class="col1"><?php echo $this->visitsLast30Minutes; ?> Besucher</td>
    </tr>
    <tr>
      <td class="col0">Letzte 24 Stunden:</td>
      <td class="col1"><?php echo $this->visitsLast24Hours; ?> Besucher</td>
    </tr>
    </table>
  </div>
  <h2 class="sub_headline">Besucherstatistiken mit Piwik</h2>
  
    
  <div style="padding:20px;">
    <table class="graphes">
    <tr>
      <th>letzte 30 Tage:</th>
      <th>letzte 24 Monate:</th>
    </tr>
    <tr>
      <td><?php echo $this->chart_evolutionVisitsSummaryDay; ?></td>
      <td><?php echo $this->chart_evolutionVisitsSummaryMonth; ?></td>
    </tr>
    </table>
    
    <hr />
    
    <table class="graphes">
    <tr>
      <th>Besuchszeiten (Serverzeit):</th>
      <th>Besuchertage:</th>
    </tr>
    <tr>
      <td><?php echo $this->chart_verticalBarVisitsPerServerTime; ?></td>
      <td><?php echo $this->chart_verticalBarVisitTimeByDayOfWeek; ?></td>
    </tr>
    </table>
    
    <hr />
    
    <table class="graphes">
    <tr>
      <th>Browser:</th>
      <th>Besucher aus:</th>
    </tr>
    <tr>
      <td><?php echo $this->chart_horizontalBarUserBrowser; ?></td>
      <td><?php echo $this->chart_horizontalBarUserCountry; ?></td>
      </tr>
    </table>
    
    <hr />
    
    <h2>Top-Suchwörter, die auf die Webseite geführten hatten (Zeitraum: letzte 30 Tage):</h2>
    <?php echo $this->table_keywords; ?>
      
    <hr />
      
    <h2>Von diesen Webseiten kamen Ihre Besucher auf Ihre Webseite (Zeitraum: letzte 30 Tage):</h2>
    <?php echo $this->table_fromWebsite; ?>

    <hr />
    <h2>Die am häufigsten besuchten Seiten (Zeitraum: letzte 30 Tage):</h2>
    <?php echo $this->table_visitedPages; ?>
    
    <hr />
    
    <h2>Die häufigsten Downloads (Zeitraum: letzte 30 Tage):</h2>
    <?php echo $this->table_downloads; ?>
    
    <hr />
    
    <div class="piwikinfo">
      <p>Piwik ist eine Open-Source (GPL lizenzierte) Webanalyse-Software, die heruntergeladen werden kann. Piwik bietet Ihnen detaillierte Echtzeit-Berichte über die Besucher Ihrer Homepage, die genutzten Suchmaschinen und Suchbegriffe, die Sprache, Ihre beliebten Seiten… und vieles mehr.</p>
      <p>Das Ziel von Piwik ist es, eine Open-Source Alternative zu Google Analytics zu bieten. Piwik wird bereits auf mehr als 320.000 Webseiten eingesetzt.</p>
      <p>Weitere Informationen auf <a href="http://de.piwik.org/" onclick="window.open(this.href); return false;">www.piwik.org</a></p>
    </div>

  </div>
</div>