<body class="signin-page">
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content valign-wrapper">
            <main class="mn-inner container">
                <div class="valign">
                      <div class="row">
                          <div class="col s12 m6 22 offset-16 offset-m3">
                              <div class="card white darken-1">
                                  <div class="card-content ">
                                      <span class="card-title"><?= lang("app_title_login") ?></span>
                                       <div class="row">
                                             <?php
                                                $attributes = array('class' => 'col s12', 'id' => 'fm-login');
                                                echo form_open(URL_WEB.'login/signUpLogin', $attributes);
                                              ?>
                                               <div class="input-field col s12">
                                                   <input id="user" name="user" type="text" class="validate">
                                                   <label for="user"><?= lang("app_title_input_login_user") ?></label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" name="password" type="password" class="validate">
                                                   <label for="password"><?= lang("app_title_input_login_Password") ?></label>
                                               </div>
                                               <div class="col s12 right-align m-t-sm">
                                                   
                                                   <input type="submit" class="waves-effect waves-light btn teal" value="<?= lang("app_title_login_in") ?>">
                                               </div>
                                               
                                               <div class="col s12 left-align m-t-sm">
                                                 <a href="javascript: void(0)" id="forgotPass">olvido su contraseña?</a>
                                               </div>


                                           </form>

                                           <br>
                                               <div id="loader" style="margin-top: 5px;"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="<?= PATH_PUBLIC_PLUGINS."/jquery/jquery-2.2.0.min.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_PLUGINS."/materialize/js/materialize.min.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_PLUGINS."/material-preloader/js/materialPreloader.min.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_PLUGINS."/jquery-blockui/jquery.blockui.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_PLUGINS."/jquery-validation/jquery.validate.min.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_PLUGINS."/sweetalert/sweetalert.min.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_PLUGINS."/backstretch/jquery.backstretch.min.js" ?>"></script>
        <script src="<?= PATH_PUBLIC_JS.'/alpha.min.js' ?>"></script>
        <script src="<?= PATH_PUBLIC_JS.'/app/app.login.js' ?>"></script>
        <script src="<?= PATH_PUBLIC_JS.'/app/app.lenguaje.js' ?>"></script>
        <script>
          $.backstretch([
              "https://www.youtube.com/watch?v=fSkkD215w_c",
              "https://www.youtube.com/watch?v=fSkkD215w_c",
              "pot-holder.jpg"
          ], {
              fade: 50,
              duration: 1000
          });
      </script>
    </body>
</html>
