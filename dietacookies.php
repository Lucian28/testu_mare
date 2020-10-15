<?php
require 'vendor/autoload.php';
require_once('.\mongo2.php');
session_start();
$client = new MongoDB\Client; 
$db=new mongo2;
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;
// ------------------------------add------------------------------------------------
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
  if(isset($_POST['add']))
  if($_POST['add']==$item->cod)
   {
     if(isset($_COOKIE[$item->cod])){
       $x=$_COOKIE[$item->cod];                       //daca avem deja un aliment de acest tip introdus
      setcookie($item->cod,$x+$_POST[$item->cod],time() + (86400 * 30), "/"); //adaugam cantitatea accea la cantitatea nou introdusa
     }
     else             // altfel creem cookie nou 
     setcookie($item->cod,$_POST[$item->cod],time() + (86400 * 30), "/");
   }
}
//----------------------------------------------------------------------------------------------------
//----------------------------delete-------------------------------------------------------------------
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
if(isset($_POST['delete']))
   if($_POST['delete']==$item->cod)
      setcookie($item->cod,null,-1,"/");
}
//----------------------------------------------------------------------------------------------------
// -----------------------------sterge tot-------------------------------------------------
if(isset($_POST['sterge-tot'])){
    $cautare = $DetaliiAlimente->find();
    foreach($cautare as $item){
        if(!empty($_COOKIE[$item->cod]))
         setcookie($item->cod,null,-1,"/");
    }
}
//----------------------------------------------------------------------------------------------------
//-----------------------------update------------------------------
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
if(isset($_POST['cantitate']))
   if($_POST['cantitate']==$item->cod)
      setcookie($item->cod,$_POST['update'],time() + (86400 * 30), "/");
}
//----------------------------------------------------------------------------------------------------
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title> Profilul tau </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="welcome.css">
</head>
<body>

<div class="topnav">
<a href="welcome.php" >Home</a>
<a href="vizualizare.php" >Toate alimentele</a>
<a href="dietacookies.php" class="active">Calorii consumate</a>
<?php 
$x=1;$z=0;
if(!empty($_SESSION['email'])){
   
  if($_SESSION['email']=="lucian.miholca@gmail.com")
   echo "<a href='adauga.php'> Adauga aliment </a>";?> 
<uli style="float:right"><a  href="logout.php">Log out</a></uli>

     <div class="search-container">
       <form action="vizualizare.php" method="POST">
             <input type="text" autocomplete="off" placeholder="Search.." name="search">
             <button type="submit"><i class="fa fa-search"></i></button>
        </form>
  </div>
</div>
<?php
$var=0;$totalC=0;$totalF=0;$totalG=0;$totalKcal=0;$totalP=0;
$cautare = $DetaliiAlimente->find();


  $email=$_SESSION['email'];
  $client = new MongoDB\Client;
  $DateUtilizatori=$client->DateUtilizatori;
  $date=$DateUtilizatori->date;
  $om=$date->findOne(['email' => $email]);
  if($om->sex=="Male")
$calRecomandate = (9.99*$om->greutate+6.25*$om->inaltime-4.92*$om->varsta+5);
else
  $calRecomandate = 9.99*$om->greutate+6.25*$om->inaltime-4.92*$om->varsta-161;

  if($om->nivelActivitate=="1")
  $calRecomandate =  $calRecomandate*1.2;
  if($om->nivelActivitate=="2")
  $calRecomandate =  $calRecomandate*1.375;
  if($om->nivelActivitate=="3")
  $calRecomandate =  $calRecomandate*1.55;
  if($om->nivelActivitate=="4")
  $calRecomandate =  $calRecomandate*1.725;
  if($om->nivelActivitate=="5")
  $calRecomandate =  $calRecomandate*1.9;
  $calRecomandate = (int)  $calRecomandate;

  $minP=$calRecomandate*0.1*0.25; $minP=(int) $minP;
  $maxP=$calRecomandate*0.35*0.25;$maxP=(int) $maxP;

  $minC=$calRecomandate*0.45*0.25;$minC=(int) $minC;
  $maxC=$calRecomandate*0.65*0.25;$maxC=(int) $maxC;

  $minG=$calRecomandate*0.2*0.11;$minG=(int) $minG;
  $maxG=$calRecomandate*0.35*0.11;$maxG=(int) $maxG;
?>
<div class="titlu">
  <h1> <?php echo $om->nume." ".$om->prenume ?> </h1>
</div>
<div class="continut" >
  <h2> Calorii zilnice recomandate pentru mentinere : <?php echo $calRecomandate ?> kcal </h2>
  <h2>  Distributia macronutrientilor  - Intervale acceptate pentru tine</h2>

  <p> Proteine : 10-35%, adica <?php echo $minP."-".$maxP."g";?> </p>
  <p> Carbohidrati : 45-65%, adica <?php echo $minC."-".$maxC."g";?></p>
  <p> Grasimi      : 20-35%, adica <?php echo $minG."-".$maxG."g";?></p>
  <p> Fibre     : 20-35g</p>

  <a href="https://www.macronutrients.net/macronutrient-recommendations/"> Cititi mai multe despre macronutrienti aici </a> <br>
  <a href="http://www.sfatulmedicului.ro/Alimentatia-sanatoasa/necesarul-de-fibre-in-alimentatie_13519"> Mai multe despre importanta fibrelor in alimentatie</a>
  <br>
</div>
 <br>
<table id="t01" >
 <tr>
   <th> Aliment      </th>
   <th>              </th>
   <th> Cantitate    </th>
   <th> Calorii      </th>
   <th> Proteine     </th>
   <th> Carbohidrati </th>
   <th> Grasimi      </th>
   <th> Fibre        </th>
   <th> Elimina       </th>
  </tr>
<?PHP
$cautare = $DetaliiAlimente->find();
$count = $DetaliiAlimente->count();
$ver=0;
foreach($cautare as $item){
    $ver++;
    if(isset($_COOKIE[$item->cod]))
     {
        $cantitate=$_COOKIE[$item->cod];
         //calcularea totalului din calorii, prot, gras --> pt footer tabel
         $totalKcal=$totalKcal+$item->calorii*($cantitate/100);
         $totalP=$totalP+$item->proteine*($cantitate/100);
         $totalC=$totalC+$item->carbohidrati*($cantitate/100);
         $totalG=$totalG+$item->grasimi*($cantitate/100);
         $totalF=$totalF+$item->fibre*($cantitate/100);

         
         echo 
         "<tr>",
         "<td>".$item->aliment."</td>",
         "<td><img src='".$item->image."'></td>",
         "<form  method='post' action='dietacookies.php'><td><button name='update' value='$item->cod' '>Update</button>
         <input type='text'  name='cantitate' value='$cantitate'></td></form>",
         "<td>".$item->calorii*($cantitate/100)."</td>",
         "<td>".$cantitate/100*$item->proteine."</td>",
         "<td>".$cantitate/100*$item->carbohidrati."</td>",
         "<td>".$cantitate/100*$item->grasimi."</td>",
         "<td>".$cantitate/100*$item->fibre."</td>",
         "<td><form method='POST' action='dietacookies.php'> <button name='delete' value='$item->cod'>Sterge</button></form></td>",
         "</tr>";


     }
     if($ver==$count)
     {
         ?>
     <tr style="background-color:white">
     <td colspan='3'> Total     </td>
     <td> <?php echo $totalKcal ?>  kcal     </td>
    <td> <?php echo $totalP ?> Proteine      </td>
     <td> <?php echo $totalC ?> Carbohidrati  </td>
     <td> <?php echo $totalG ?>  Grasimi      </td>
     <td> <?php echo $totalF  ?> Fibre       </td>
     <td><form action="dietacookies.php" method="POST"> <button name="sterge-tot"> Sterge tot </button>   </form>             </td>
    </tr>

    <?php
     }
}


?>




</script>

  <script>
$(document).ready(function(){
  $("h1").click(function(){
    $(".continut").toggle(2000);
  
  });
});
</script>
<?php 
}

else
echo "<script> location.href='login.php'</script>";