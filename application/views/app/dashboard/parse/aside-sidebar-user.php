<?php
$CI =& get_instance();
?>
<aside id="slide-out" class="side-nav white fixed">
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
        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">store</i> Empresa<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="<?= base_url("empresa/registrar") ?>">Registrar Empresa</a></li>
          </ul>
        </div>
      </li>
    </ul>
    <div class="footer">
      <p class="copyright">Steelcoders ©</p>
      <a href="#!">Privacy</a> &amp; <a href="#!">Terms</a>
    </div>
  </div>
</aside>