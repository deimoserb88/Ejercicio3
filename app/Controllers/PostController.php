<?php

namespace Controllers;

use Models\posts;

class PostController {

    public $userId;
    public $title;
    public $body;

    public function __construct(){}

    /** Guardar nueva publicación
        * @array $datos
        * 
     */
    public function newPost($datos){
        $posts = new posts();
        $posts->valores = [$datos['uid'],$datos['title'],$datos['body']];
        $result = $posts->create();
        return;
        die();
    }

    /**Obtener publicaciones del usuario registrado 
     * @int uid id del usuario
     * 
    */
    public function getMyPosts($uid){
        $posts = new posts();
        $result = $posts->where([['userId',$uid]])->get();
        return $result;
    }

    public function getPosts($limit = ""){
        $posts = new posts();
        $result = $posts->select(['a.id','a.title','a.body','date_format(a.created_at,"%d/%m/%Y") as fecha','b.name'])
                            ->join('user b','a.userId=b.id')
                            ->orderBy([['created_at','DESC']])
                            ->limit($limit)
                            ->get();
        return $result;
    }

}