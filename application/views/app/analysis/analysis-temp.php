<script src="<?= PATH_PUBLIC_PLUGINS."/fusionchart/fusioncharts.js" ?>" type="text/javascript"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/fusionchart/fusioncharts.theme.zune.js" ?>" type="text/javascript"></script>
<link href="<?= PATH_PUBLIC_PLUGINS."/nvd3/nv.d3.min.css" ?>" rel="stylesheet"> 
<main class="mn-inner inner-active-sidebar">

<div class="row">
  <div class="col s12 m12 l8">
    <div class="col s12 m12 l4">
      <div class="card stats-card">
        <div class="card-content">
          <span class="card-title">Compras</span>
          <span class="stats-counter"><span class="counter"><?= date("W") ?></span><small>Semana Activa</small></span>

        </div>
        
      </div>
    </div>

    <div class="col s12 m12 l4">
      <div class="card stats-card">
        <div class="card-content">
          <div class="card-options">
            
          </div>
          <span class="card-title">Semana Anterior</span>
          <span class="stats-counter">$ <span class="counter c_week_b">0</span><small></small></span>
        </div>
        
      </div>
    </div>

    <div class="col s12 m12 l4">
      <div class="card stats-card">
        <div class="card-content">
          <div class="card-options">
            
          </div>
          <span class="card-title">Semana Actual</span>
          <span class="stats-counter">$ <span class="counter c_week_a">0</span><small></small></span>
        </div>
        
      </div>
    </div>
  
    
    <div class="col s12 m12 l4">
      <div class="card stats-card">
        <div class="card-content">
          <div class="card-options">
            
          </div>
          <span class="card-title">Compras este mes</span>
          <span class="stats-counter"><span class="counter items">0</span><small></small></span>
        </div>
        
      </div>
    </div>
    <div class="col s12 m12 l4">
      <div class="card stats-card">
        <div class="card-content">
          <span class="card-title">Productos este mes</span>
          <span class="stats-counter"><span class="counter prod">23230</span><small><?= lang('app_dashboard_text2') ?></small></span>
          
        </div>
        
      </div>
    </div>
    <div class="col s12 m12 l4">
      <div class="card stats-card">
        <div class="card-content">
          <div class="card-options">
            <!--<ul>
              <li class="red-text"><span class="badge cyan lighten-1">gross</span></li>
            </ul>-->
          </div>
          <span class="card-title">Total este mes</span>
          <span class="stats-counter">$ <span class="counter buy">0</span><small><?= lang('app_dashboard_text2') ?></small></span>
        </div>
      </div>
    </div>

    <div class="col s12 m12 l12">
      <div class="card visitors-card">
        <div class="card-content">
          <div class="card-options">
            <ul>
              
            </ul>
          </div>
          <span class="card-title">Ventas este año<span class="secondary-title">Desglose de ventas por mes</span></span>
          <div id="chart-container"></div>
        </div>
      </div>
    </div>

    <div class="col s12 m12 l12">
      <div class="card visitors-card">
        <div class="card-content">
          <div class="card-options">
            <ul>
              
            </ul>
          </div>
          <span class="card-title">Ventas este año<span class="secondary-title">Desglose de ventas por Semana</span></span>
          <div id="chart-container-2"></div>
        </div>
      </div>
    </div>
       <div class="col s12 m12 l12">
      <div class="card server-card">
        <div class="card-content">
          <div class="card-options">
            <ul>
              
            </ul>
          </div>
          <span class="card-title">comparativas</span>
          
          <div class="stats-info">
            <div id="line-compare"></div>
          </div>
          
        </div>
      </div>
    </div>


    <div class="col s12 m12 l12">
      <div class="card server-card">
        <div class="card-content">
          <div class="card-options">
            <ul>
              
            </ul>
          </div>
          <span class="card-title">Productos Vendidos Anual</span>
          
          <div class="stats-info">
            <div id="pieproduct"></div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="col s12 m12 l12">
      <div class="card server-card">
        <div class="card-content">
          <div class="card-options">
            <ul>
              
            </ul>
          </div>
          <span class="card-title">Productos Vendidos Este Mes</span>
          
          <div class="stats-info">
            <div id="pie_product"></div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <div class="col s12 m12 l4">
    
  <div class="col s12 m12 l12">
      <div class="card server-card">
        <div class="card-content">
          <div class="card-options">
            <ul>
              <li class="red-text"><span class="badge blue-grey lighten-3">optimal</span></li>
            </ul>
          </div>
          <span class="card-title">Resumen Anual <?= date("Y") ?></span>
          <div class="server-load row">
            <div class="server-stat col s4">
              <p id="c">0</p>
              <span>Compras</span>
            </div>
            <div class="server-stat col s4">
              <p id="p">0</p>
              <span>Productos</span>
            </div>
            <div class="server-stat col s4">
              <p id="t">0</p>
              <span>Total</span>
            </div>
          </div>
          <div class="stats-info">
            <ul id="sales">
              
            </ul>
          </div>
          <p>Compras Semanas Mes Actual</p>
          <div id="chart-week"></div>
          
        </div>
      </div>
    </div>
    <div class="col s12 m12 l12">
      <p>Compras este mes</p>
          <div id="flotchart2" ></div>
    </div>
    

  </div>
</div>
</div>
<!--<div class="inner-sidebar">
  <span class="inner-sidebar-title">Ranking de Clientes</span>
  <div class="message-list rank">
    
  </div>
</div>-->
</main>
<link href="<?= PATH_PUBLIC_PLUGINS."/datatables/css/jquery.dataTables.min.css" ?>" rel="stylesheet" type="text/css"/>
<script src="<?= PATH_PUBLIC_PLUGINS."/datatables/js/jquery.dataTables.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/flot/jquery.flot.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/flot/jquery.flot.time.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/flot/jquery.flot.symbol.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/flot/jquery.flot.resize.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/flot/jquery.flot.tooltip.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/d3/d3.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_PLUGINS."/nvd3/nv.d3.min.js" ?>"></script>
<script src="<?= PATH_PUBLIC_JS.'/app/app.analysis.temp.js' ?>"></script>