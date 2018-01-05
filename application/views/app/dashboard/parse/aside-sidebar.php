<?php
$CI =& get_instance();
?>
<aside id="slide-out" class="side-nav white">
  <div class="side-nav-wrapper">
    <div class="sidebar-profile">
      <div class="sidebar-profile-image">
        <img src="<?= (!$CI->appUserModel->getAvatarThumb()) ? PATH_PUBLIC_IMG."/profile-image.png" : URL_WEB.$CI->appUserModel->getAvatarThumb() ?>" class="circle" alt="">
      </div>
      <div class="sidebar-profile-info">
        <a href="javascript:void(0);" class="account-settings-link">
          <p><?= (!$CI->appUserModel->getFullName()) ? lang('app_sidebar_msg_1') : $CI->appUserModel->getFullName() ?></p>
          <span><?= $this->session->userdata("nickname") ?><i class="material-icons right">arrow_drop_down</i></span>
        </a>
      </div>
    </div>
    <div class="sidebar-account-settings">
      <ul>
        <li class="no-padding">
          <a class="waves-effect waves-grey" href="<?= URL_WEB."user/myaccount"  ?>"><i class="material-icons">assignment_ind</i><?= lang('app_sidebar_option_myaccount') ?></a>
          <a class="waves-effect waves-grey" href="<?= URL_WEB."shutdown/session"  ?>"><i class="material-icons">exit_to_app</i><?= lang('app_sidebar_option_signout') ?></a>
        </li>
      </ul>
    </div>
    <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
      <li class="no-padding"><a class="waves-effect waves-grey" href="<?= base_url("dashboard/welcome") ?>"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>

      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">store</i>Tienda<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("store/welcome") ?>">Visitar Tienda</a></li>
          </ul>
        </div>
      </li>

      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">shopping_cart</i>Carrito<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("mi-carrito/") ?>">Mi Carrito</a></li>
          </ul>
        </div>
      </li>

      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">shopping_basket</i>Compras<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("mis-compras/purchases") ?>">Mis Compras</a></li>
          </ul>
        </div>
      </li>

      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">payment</i>Pagos<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("mis-pagos/pagos") ?>">Mis Pagos</a></li>
          </ul>
        </div>
      </li>


      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">settings_system_daydream</i>Administración<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("client/index-client-create") ?>">Crear Tienda</a></li>
            <li><a href="<?= base_url("products/index") ?>">Crear Productos</a></li>
            <li><a href="<?= base_url("prices/prices-managment") ?>">Precios</a></li>
            <li><a href="<?= base_url("prices/prices-managment") ?>">Pagos</a></li>
          </ul>
        </div>
      </li>


      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">settings</i>Configuraciones<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("settings/index") ?>">Tiendas</a></li>
          </ul>
        </div>
      </li>


      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">local_shipping</i>Bodega<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("cellar/cellar-order-management") ?>">Pedidos</a></li>
            <li><a href="<?= base_url("cellar/cellar-picking") ?>">Cosecha</a></li>
            <li><a href="<?= base_url("cellar/cellar-verify") ?>">Verificación</a></li>
          </ul>
        </div>
      </li>

      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">settings</i><?= lang('app_process_text1') ?><i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
          <?php
          if($this->session->userdata("account_id") == 4 || $this->session->userdata("account_id") == 2 || $this->session->userdata("account_id") == 1 || $this->session->userdata("account_id") == 3){
          ?>
            <li><a href="<?= base_url("process/orders") ?>">Hab. Ped/Tienda</a></li>
            <li><a href="<?= base_url("process/change-states-time") ?>">Hab. Ped/Horario</a></li>

          <?php
            }
            if($this->session->userdata("account_id") == 1 || $this->session->userdata("account_id") == 2 || $this->session->userdata("account_id") == 3){
          ?>
            <li><a href="<?= base_url("process/store") ?>">Gestión de Clientes</a></li>
            <li><a href="<?= base_url("process/relationships-user") ?>"><?= lang('app_process_text15') ?></a></li>
            <li><a href="<?= base_url("information/information-store") ?>">Información de Clientes</a></li>
            <li><a href="<?= base_url("process/analysis") ?>">Análisis</a></li>
            <?php
          }
          if($this->session->userdata("account_id") == 1 || $this->session->userdata("account_id") == 2 || $this->session->userdata("account_id") == 3 || $this->session->userdata("account_id") == 4){
            ?> 
            <li><a href="<?= base_url("prices/view-list-prices") ?>">Lista de Productos
            </a></li>
          <?php
            }
            if($this->session->userdata("account_id") == 1 || $this->session->userdata("account_id") == 2  || $this->session->userdata("account_id") == 4 || $this->session->userdata("account_id") == 12){
          ?>
          <li><a href="<?= base_url("user-admin/user-managment") ?>">Gestión de Usuarios
            </a></li>
          <?php
            }
            if($this->session->userdata("account_id") == 1 || $this->session->userdata("account_id") == 2  || $this->session->userdata("account_id") == 4 || $this->session->userdata("account_id") == 12){
          ?>
          <li><a href="<?= base_url("process/adjust-courier") ?>">Ajustar Despachos
            </a></li>
          <?php
            }
          ?>
          </ul>
        </div>
      </li>

      <li class="no-padding active">
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">add_shopping_cart</i>Pedidos<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("orderuser/orders-management") ?>">Gestión de Pedidos
            </a></li>
          </ul>
        </div>
        </li>
    </ul>
    <div class="footer">
      <p class="copyright">Tamy SPA</p>
    </div>
  </div>
</aside>