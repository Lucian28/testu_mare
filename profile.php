<?php
require_once('.\MongodbDatabase.php');
$db=new MongodbDatabase;
$client = new MongoDB\Client; 
$space="\n";
$videoPlaylists=$client->videoPlaylists;
$videos=$videoPlaylists->videos;
 $x=0;$y=1;$proteine=0;$grasimi=0;$carbohidrati=0;$fibre=0;
 
// pentru stergerea unui document din lista
 foreach( $db->fetchPlaylist() as $item){
   $argument="DeleteItem$y";
   $y++;
 if( isset ( $_POST[$argument])){
    $videos->deleteOne(
      ['_id' => $item->_id]
    );

 }
}
// pentru calcul total proteine . 
foreach( $db->fetchPlaylist() as $item){
 $proteine=    $proteine+$item->videoTitle;
 $grasimi=     $grasimi+$item->videoLink;
 $carbohidrati=$carbohidrati+$item->videoID;
 $fibre=       $fibre+$item->videoArtist;
}   
$calorii=$proteine*4+$grasimi*9+$carbohidrati*4;



?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title> Alimentele din baza de date </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

<form action="home.php" method="POST">
<div class="form-group">
           <input type="submit" class="btn btn-danger" value="           Intoarce-te acasa              ">
 </div>
</form>

<div class="col-sm-6">
  <h1> Playlists </h1>
  <ul class="list-group">
  <?php

   foreach( $db->fetchPlaylist() as $item){
   $x++;
  ?>

 <li class="list-group-item">

 <?php echo $item->videoTitle. "</p>\n"  ,$item->videoLink. "</p>\n",
            $item->videoID. "</p>\n",$item->videoArtist. "</p>\n" ?>

<form action="./profile.php?item=<?php echo $item->_id?>" method="POST">
            <div class="form-group">
                       <input type="submit" class="btn btn-danger" value="DeleteItem<?php echo $x?>" name="DeleteItem<?php echo $x?>">
             </div>
</form>

 </a>
 </li>

   <?php
        
   }


  ?>

   
   </ul>
 </div>
 
 
<ul class="list-group">
<li class="list-group-item">
<p> Total proteine :     <?php echo $proteine.         "</p>\n"?></p>
<p> Total carbohidrati : <?php echo $carbohidrati.     "</p>\n"?></p>
<p> Total grasimi :      <?php echo $grasimi.          "</p>\n"?></p>
<p> Total fibre :        <?php echo $fibre.            "</p>\n"?></p>
<p> Total calorii:       <?php echo $calorii.          "</p>\n"?></p>
<li>
 </ul>
</div>
</body>
</html>