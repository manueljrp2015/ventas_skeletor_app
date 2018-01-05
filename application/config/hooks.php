<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'] = array(
        'class'    => 'oauthHooks',
        'function' => 'authorizedLicense',
        'filename' => '97ab950e6e15a6c6493bd80ca2307c86.php',
        'filepath' => 'hooks',
        'params'   => array()
);
