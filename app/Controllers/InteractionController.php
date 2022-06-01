<?php

namespace Controllers;

use Models\interactions;

class InteractionController {

    public $userid;
    public $postid;
    public $status;

    public function updateInteraction(...$ids){
         
        $inter = new interactions();

        $st = json_decode($inter->select(['status'])
                    ->where([['userid',$ids[0]['uid']],['postid',$ids[0]['pid']]])
                    ->get());
        if(count($st) > 0){   
           // print_r($st);           
           $inter->valores = ['status' => ($st[0]->status ? 0 : 1 )];
           $inter->where([['userid',$ids[0]['uid']],['postid',$ids[0]['pid']]])->update();
        }else{
            //crear interacción con valor por defecto 1
            $inter->valores = [$ids[0]['uid'],$ids[0]['pid'],1];
            $inter->create();
            
        }
        return json_encode( $inter->where([['postid',$ids[0]['pid']],['status',1]])->count()->get() );
        

    }

}