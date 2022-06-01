<?php

namespace Controllers;

use Models\posts;
use Models\interactions;
use Controllers\auth\LoginController as LoginController;

class PostController {

    public $userId;
    public $title;
    public $body;

    public function __construct(){
        $ua = new LoginController();        
        $ua->sessionValidate();
        $this->userId = $ua->uid;
    }

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
    public function getMyPosts($uid=""){
        $posts = new posts();
        $result = $posts->where([['userId',$ua->uid]])->get();
        return $result;
    }

    public function getPosts($limit = "",$pid=""){
        $posts = new posts();
        $result = $posts->select(['a.id','a.title','a.body','date_format(a.created_at,"%d/%m/%Y") as fecha','b.name'])                            
                            ->join('user b','a.userId=b.id')                            
                            ->where( $pid != "" ? [['a.id',$pid]] : [] )
                            ->orderBy([['created_at','DESC']])
                            ->limit($limit)
                            ->get();
        if($limit == "1" || $pid != ""){
            $pid = $pid == "" ? json_decode($result)[0]->id : $pid; 
            $interac = new interactions();
            $ttint = $interac->count()->where([['postid',$pid],['status',1]])->get();   
            $ul = $interac->select(['status'])->where([['postid',$pid],['status',1],['userid',$this->userId]])->get();                     
            $result = json_encode(array_merge(json_decode($result),json_decode($ttint),json_decode($ul)));
        }
        return $result;
    }

    public function deletePost($pid){
        $post = new posts();
        $r = $post->where([['id',$pid]])->delete();
        return $r;
    }

}