<?php
require_once('.\MongodbDatabase.php');

$db=new MongodbDatabase;
$space="\n";
$client = new MongoDB\Client; 
$videoPlaylists=$client->videoPlaylists;
$videos=$videoPlaylists->videos;
$regex = new MongoDB\BSON\Regex ($_POST['search']);
$x=0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title> Alimentele din baza de date </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>


<?php 
// check if we have data to insert information about videos to mongodb databasse


if( isset ( $_POST['videoTitle'])){
    if( ! empty($_POST['videoTitle'])) {
       $insertable = $db->insertNewItem([
    'videoTitle' => $_POST['videoTitle'],
    'videoLink'  => $_POST['videoLink'],
    'videoID' =>  $_POST['videoID'],
    'videoArtist' =>  $_POST['videoArtist']
    
    
          ]);
          if($insertable){
              ?>
<div class="container">
 <div class="panel">
    <h3> New video has inserted. </h3>
  </div>
 </div>
              <?php
          }
       }
    }
?>


 <div class="container">
  <div class="col-sn-6">
    <div class="panel panel-default">

    <div class="panel-heading">
    <br>  <b> Cauta aliment </b>
       </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<form class="example" action="home.php" method="POST">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>






  <div class="col-sm-6">
  <h1> Playlists </h1>
  <ul class="list-group">
  <?php
////////////////////////////////////////////////////////
if( isset ( $_POST['search'])){
   
   //$regex=$_POST['search'];
   $cautare = $videos->find(array('videoTitle' => $regex));
   foreach( $cautare as $item){
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
   }

////////////////////////////////////
  ?>

   
   </ul>
 </div>

  



</form>
<br>
      <div class="panel-heading">
       <b> Add a video </b>
       </div>
       <div class="panel-body">
        <form action="home.php" method="POST">

          <div class="form-group">
           <input type="text" name="videoTitle" id="" class="form-control" placeholder="Video Title">
           </div>
           <div class="form-group">
           <input type="text" name="videoLink" id="" class="form-control" placeholder="Video Link">
           </div>
           <div class="form-group">
           <input type="text" name="videoID" id="" class="form-control" placeholder="Video Id">
           </div>
           <div class="form-group">
           <input type="text" name="videoArtist" id="" class="form-control" placeholder="Video Artist">
           </div>
           <div class="form-group">
           <input type="submit" class="btn btn-danger" value="Add video">
           </div>
 </form>
 <form action="profile.php" method="POST">
 <div class="form-group">
           <input type="submit" class="btn btn-danger" value="Vizualizare">
           </div>
           </form>
 </div>
</div>
</div>
</div>
</body>
</html>