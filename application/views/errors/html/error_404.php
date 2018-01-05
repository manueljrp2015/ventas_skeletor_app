<!DOCTYPE html>
<html lang="es">
    <head>

        <title><?= NAME_SITE ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <link type="text/css" rel="stylesheet" href="<?= PATH_PUBLIC_PLUGINS."/materialize/css/materialize.min.css" ?>"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?= PATH_PUBLIC_PLUGINS."/material-preloader/css/materialPreloader.min.css" ?>" rel="stylesheet">
        <link href="<?= PATH_PUBLIC_PLUGINS."/sweetalert/sweetalert.css" ?>" rel="stylesheet">

        <link href="<?= PATH_PUBLIC_CSS."/alpha.min.css" ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= PATH_PUBLIC_CSS."/custom.css" ?>" rel="stylesheet" type="text/css"/>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
		<body class="error-page page-404">

		</body>
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
         <div class="mn-content">
             <main class="mn-inner">
                 <div class="center">
                     <h1>
                         <span>404</span>
                     </h1>
		<h1></h1>


		<span class="text-white"><?php echo $heading; ?></span><br>
									 <a class="btn-floating btn-large waves-effect waves-light teal lighten-2 m-t-lg" href="<?= URL_WEB."dashboard/welcome" ?>">
											 <i class="large material-icons">home<?php echo $message; ?>i>
									 </a>
							 </div>
					 </main>
			 </div>
			 <script src="<?= PATH_PUBLIC_PLUGINS."/jquery/jquery-2.2.0.min.js" ?>"></script>
 			<script src="<?= PATH_PUBLIC_PLUGINS."/materialize/js/materialize.min.js" ?>"></script>
 			<script src="<?= PATH_PUBLIC_PLUGINS."/material-preloader/js/materialPreloader.min.js" ?>"></script>
 			<script src="<?= PATH_PUBLIC_PLUGINS."/jquery-blockui/jquery.blockui.js" ?>"></script>
 			<script src="<?= PATH_PUBLIC_JS.'/alpha.min.js' ?>"></script>
	 </body>
</html>
