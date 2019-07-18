<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('login')){

    function login($dir)
    {
        redirect(HOST.'DnatoArbolado/main/setdir?direccion='.$dir.'/Dash&direccionsalida='.$dir.'/Login');
    }

}
if(!function_exists('logout')){

    function logout()
    {
        redirect(HOST.'DnatoArbolado/main/logout');
    }
    
}
if(!function_exists('editar')){

    function editar()
    {
        redirect(HOST.'DnatoArbolado/main/changeuser?control=sistema');
    }
    
}
if(!function_exists('admin_usuarios')){

    function admin_usuarios()
    {
        redirect(HOST.'DnatoArbolado/main/users');
    }
    
}
