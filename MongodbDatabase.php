<?php

require_once('vendor/autoload.php');

class MongodbDatabase{

    

    function __construct(){
    $this->db = (new MongoDB\Client)->DateUtilizatori->date;
    }

    public function insertNewItem($itemInfo=[])
    {
   if( empty ( $itemInfo ) ) {
       return false;
   }
   // daca avem date, le inseram
   $insertable = $this->db->insertOne([
       'nume' => $itemInfo['nume'],
    'prenume'  => $itemInfo['prenume'],
    'sex' =>  $itemInfo['sex'],
    'email' => $itemInfo['email'],
    'parola' =>  $itemInfo['parola'],
    'varsta' =>  $itemInfo['varsta'],
    'greutate' =>  $itemInfo['greutate'],
    'inaltime' =>  $itemInfo['inaltime'],
    'nivelActivitate' => $itemInfo['nivelActivitate']
   ]);   
// return this inserted documents mongodb id
return $insertable->getInsertedId();
}

public function fetchPlaylist(){ // aici am putea adauga parametrii pentru limitarea nr. de afisari.. etc
return $this->db->find();
}




}
