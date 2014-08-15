<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!'); ?>
<?php 
  if ($this->errorMessage) { 
    echo $this->errorMessage; 
    }else{ 
?>
<div id="be_piwikcharts">
  <div class="serverinfo">
    <span class="settings">
      <?php if($this->isAdmin): ?>
        <a class="goToSettings" href="<?php echo $this->link_settings ?>" title="<?php echo $this->lang->menu['settings_title']; ?>">
          » <?php echo $this->lang->menu['settings']; ?>
        </a> | 
      <?php endif; ?>
      
      <a class="print" href="javascript:window.print()" title="<?php echo $this->lang->menu['print_title']; ?>">
          <?php echo $this->lang->menu['print']; ?>
      </a> | 
      <a class="optOut" href="<?php echo $this->link_optOut ?>" onclick="window.open(this.href); return false;" title="<?php echo $this->lang->menu['optout_title']; ?>">
          <?php echo $this->lang->menu['optout']; ?>
      </a> |
      <a class="extern" onclick="window.open(this.href); return false;" href="<?php echo (isset($this->link_server_login) ? ($this->link_server_login) : ($this->link_server)) ?>" title="<?php echo $this->lang->menu['login_title']; ?>">
        <?php echo $this->lang->menu['login']; ?>
      </a>
      <?php if($this->update && $this->showUpdate): ?>
      <a class="update" href="<?php echo $this->link_server ?>" onclick="window.open(this.href); return false;" title="<?php echo $this->lang->menu['update']; ?>: <?php echo $this->update ?>">
          | <?php echo $this->lang->menu['update']; ?>
        </a>
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
        <td><?php echo $this->lang->live['last30minutes']; ?>:</td>
        <td><?php echo $this->visitsLast30Minutes; ?></td>
      </tr>
      <tr>
        <td><?php echo $this->lang->live['last24hours']; ?>:</td>
        <td><?php echo $this->visitsLast24Hours; ?></td>
      </tr>
    </table>
  </div>
  <h2 class="sub_headline"><?php echo $this->lang->headline; ?></h2>


  <div style="padding:20px;">
    <table class="graphes">
      <tr>
        <th><?php echo $this->lang->graph['visitors_last30days_headline']; ?>:</th>
        <th><?php echo $this->lang->graph['visitors_last24months_headline']; ?>:</th>
      </tr>
      <tr>
        <td><?php echo $this->chart_evolutionVisitsSummaryDay; ?></td>
        <td><?php echo $this->chart_evolutionVisitsSummaryMonth; ?></td>
      </tr>
    </table>

    <hr />

    <table class="graphes">
      <tr>
        <th><?php echo $this->lang->graph['visitors_visitsPerServerTime_headline']; ?>:</th>
        <th><?php echo $this->lang->graph['visitors_visitTimeByDayOfWeek_headline']; ?>:</th>
      </tr>
      <tr>
        <td><?php echo $this->chart_verticalBarVisitsPerServerTime; ?></td>
        <td><?php echo $this->chart_verticalBarVisitTimeByDayOfWeek; ?></td>
      </tr>
    </table>

    <hr />

    <table class="graphes">
      <tr>
        <th><?php echo $this->lang->graph['visitors_userBrowser_headline']; ?>:</th>
        <th><?php echo $this->lang->graph['visitors_userCountry_headline']; ?>:</th>
      </tr>
      <tr>
        <td><?php echo $this->chart_horizontalBarUserBrowser; ?></td>
        <td><?php echo $this->chart_horizontalBarUserCountry; ?></td>
      </tr>
    </table>

    <hr />

    <h2><?php echo $this->lang->table['keywords_headline']; ?>:</h2>
    <?php echo $this->table_keywords; ?>

    <hr />

    <h2><?php echo $this->lang->table['fromWebsite_headline']; ?>:</h2>
    <?php echo $this->table_fromWebsite; ?>

    <hr />
    <h2><?php echo $this->lang->table['visitedPages_headline']; ?>:</h2>
    <?php echo $this->table_visitedPages; ?>

    <hr />

    <h2><?php echo $this->lang->table['downloads_headline']; ?>:</h2>
    <?php echo $this->table_downloads; ?>

    <hr />

    <div class="piwikinfo">
      <?php echo $this->lang->piwikinfo; ?>
    </div>

  </div>
</div>
<?php } ?>