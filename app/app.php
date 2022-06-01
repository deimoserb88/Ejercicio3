<?php

namespace app;

require_once('autoloader.php');

use Controllers\auth\LoginController as LoginController;
use Controllers\PostController as PostController;
use Controllers\InteractionController as InteractionController;

$ua = new LoginController();        
$ua->sessionValidate();

if(!empty($_POST)){
    
    /*******************LOGIN */
    $login = in_array('_login',array_keys(filter_input_array(INPUT_POST)));
    if($login){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        $userLogin = new LoginController();
        print_r($userLogin->userAuth($datos));
    }

    /*********************GUARDAR NUEVA PUBLICACIÓN */
    $gp = in_array('_guardapub',array_keys(filter_input_array(INPUT_POST)));
    if($gp){
        $datos = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
        /**Llamar al controadro PostController.php */
        $npost = new PostController();
        $npost->newPost($datos);
        header('Location: /resources/views/myposts.php');

    }

}

if(!empty($_GET)){
    $logout = in_array('_logout',array_keys(filter_input_array(INPUT_GET)));    
    if($logout){        
        $lg = new LoginController();
        $lg->logout();
        header('Location: /resources/views/home.php');
    }

    /************************CARGAR MIS PUBLICACIONES */
    $mp = in_array('_mp',array_keys(filter_input_array(INPUT_GET)));
    if($mp){
        $uid = filter_input_array(INPUT_GET)["uid"];
        $posts = new PostController;
        print_r($posts->getMyPosts($uid));
    }

    /*************************CARGAR PUBLICACIONES PREVIAS */
    $pp = in_array('_pp',array_keys(filter_input_array(INPUT_GET)));
    if($pp){
        $posts = new PostController();
        print_r($posts->getPosts());
    }

    /*****************************CARGAR ÚLTIMA PUBLICACIÓN */
    $lp = in_array('_lp',array_keys(filter_input_array(INPUT_GET)));
    if($lp){
        $l = filter_input_array(INPUT_GET)["limit"];
        $post = new PostController();
        print_r($post->getPosts($l));
    }

    /*****************************CARGAR PUBLICACIÓN SELEC*/
    $op = in_array('_op',array_keys(filter_input_array(INPUT_GET)));
    if($op){
        $pid = filter_input_array(INPUT_GET)["pid"];
        //$uid = filter_input_array(INPUT_GET)["uid"];
        $post = new PostController();
        print_r($post->getPosts(1,$pid));
    }

    /*******************************ELIMINAR UNA PUBLICACIÓN */
    $dp = in_array('_dp',array_keys(filter_input_array(INPUT_GET)));
    if($dp){
        $pid = filter_input_array(INPUT_GET)["pid"];
        $post = new PostController();
        print_r(json_encode(['r' => $post->deletePost($pid)]));
    }

    /***************************ACTUALIZAR INTERACCIÓN*/
    $likepost = in_array('_likepost',array_keys(filter_input_array(INPUT_GET)));
    if($likepost){
        $ids = filter_input_array(INPUT_GET);
        $interaction = new InteractionController();
        print_r($interaction->updateInteraction($ids));

    }

}