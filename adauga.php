<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title> Profilul tau </title>
<link rel="stylesheet" href="welcome.css">
</head>
<body>

<div class="topnav">
<a href="welcome.php" >Home</a>
<a href="vizualizare.php" >Toate alimentele</a>
<a href="dieta.php" >Calorii consumate</a>
<?php 
$x=1;$z=0;
session_start();
 if(!empty($_SESSION['email'])){
  if($_SESSION['email']=="lucian.miholca@gmail.com")
   echo "<a href='adauga.php' class='active'> Adauga aliment </a>";?> 
   
<uli style="float:right"><a  href="logout.php">Log out</a></uli>

     <div class="search-container">
       <form action="vizualizare.php" method="POST">
             <input type="text" autocomplete="off" placeholder="Search.." name="search">
             <button type="submit"><i class="fa fa-search"></i></button>
        </form>
  </div>
</div>



<?php
require_once('.\mongo2.php');
$db=new mongo2;
$client = new MongoDB\Client; 
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> Adauga alimente </title>

</head>
<body >
<?php 


while (list ($key, $val) = each ($_SESSION['cod-cantitate'])) {
  if($z%2==0)
  echo "cod: ".$val." cantitate";
  else
  echo $val;
  $z++;
  ?>
  
<br>
<?php
}
 if(isset($_POST['sterge-cookies'])){
  for($i=0;$i<2000;$i++)
  if(isset($_COOKIE[$i])){
    echo $i."<-acesta a fost i, // ".$_COOKIE[$i]."<- acesta a fost cookie [i]";
    setcookie($i,null,time() - 3600,"/");
    $_SESSION['cod-cantitate']=array();
  }
}
?>

<?php

// check if we have data to insert information about videos to mongodb databasse


if( isset ( $_POST['aliment'])){
  $v = strtolower( $_POST['aliment']);
       $ali=$DetaliiAlimente->findOne(array("aliment" =>$v));
      $xaliment=$ali->aliment;
      
        if($xaliment==$_POST['aliment'])
       echo "<h4> Acest aliment exista deja in baza de date </h4>";
        else
    {
       $insertable = $db->insertNewItem([
    'aliment' => strtolower($_POST['aliment']),
    'calorii'  =>strtolower( $_POST['calorii']),
    'proteine' => strtolower( $_POST['proteine']),
    'carbohidrati' => strtolower($_POST['carbohidrati']),
    'grasimi' => strtolower($_POST['grasimi']),
    'fibre' =>strtolower( $_POST['fibre']),
    'image' => strtolower($_POST['image']),
    'cod'=>$client->Alimente->DetaliiAlimente->count()
          ]);
          if($insertable){
              ?>
<div class="container">
 <div class="panel">
    <h3> Ai inserat un aliment nou </h3>
  </div>
 </div>
              <?php
          }
       }
    }
?>
<br>
      <div class="panel-heading">
      <p> <b> Adauga aliment nou </b> </p>
       </div>
       <div class="panel-body">
        <form action="adauga.php" method="POST">

          <div class="form-group">
           <input type="text" name="aliment" id="" autocomplete="off" class="form-control" placeholder="Aliment" pattern=".{1,60}" required>
           </div>
           <div class="form-group">
           <input type="text" name="calorii" id="" autocomplete="off" class="form-control" placeholder="Calorii" pattern="[-+]?[0-9]*[.,]?[0-9]+"  required>
           </div>
           <div class="form-group">
           <input type="text" name="proteine" id=""  autocomplete="off" class="form-control" placeholder="Proteine" pattern="[-+]?[0-9]*[.,]?[0-9]+"  required>
           </div>
           <div class="form-group">
           <input type="text" name="carbohidrati" id=""  autocomplete="off" class="form-control" placeholder="Carbohidrati" pattern="[-+]?[0-9]*[.,]?[0-9]+" required>
           </div>
           <div class="form-group">
           <input type="text" name="grasimi" id=""  autocomplete="off" class="form-control" placeholder="grasimi" required pattern="[-+]?[0-9]*[.,]?[0-9]+" >
           </div>
           <div class="form-group">
           <input type="text" name="fibre" id="" autocomplete="off"  class="form-control" placeholder="fibre" required pattern="[-+]?[0-9]*[.,]?[0-9]+" >
           </div>
           <div class="form-group">
           <input type="text" name="image" id="" autocomplete="off"  class="form-control" placeholder="numele imaginii si extensia"  >
           </div>
           <div class="form-group">
           <input type="submit" class="btn btn-danger" value="Adauga aliment">
           </div>
 </form>
 </div>
</div>
</div>
</div>
</body>
</html>

<?php
 }
 else
echo "<script> location.href='login.php'</script>";