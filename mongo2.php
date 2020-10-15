<?php

require_once('vendor/autoload.php');

class mongo2{

     

    function __construct(){
    $this->db = (new MongoDB\Client)->Alimente->DetaliiAlimente;
    }

    public function insertNewItem($itemInfo=[])
    {
   if( empty ( $itemInfo ) ) {
       return false;
   }
   // daca avem date, le inseram
   $insertable = $this->db->insertOne([
    'aliment' => $itemInfo['aliment'],
    'calorii' =>  $itemInfo['calorii'],
    'proteine'  => $itemInfo['proteine'],
    'carbohidrati' =>  $itemInfo['carbohidrati'],
    'grasimi' => $itemInfo['grasimi'],
    'fibre' =>  $itemInfo['fibre'],
    'image' => $itemInfo['image'],
    'cod'=>$itemInfo['cod']
   ]);   
// return this inserted documents mongodb id
return $insertable->getInsertedId();
}

public function fetchPlaylist(){ // aici am putea adauga parametrii pentru limitarea nr. de afisari.. etc
return $this->db->find();
}




}
