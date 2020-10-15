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
<a href="dieta.php" class="active">Calorii consumate</a>
<?php 
$x=1;$z=0;
session_start();
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
require 'vendor/autoload.php';
require_once('.\mongo2.php');
$client = new MongoDB\Client; 
$db=new mongo2;
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;
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

  <p>     Proteine : 10-35%, adica <?php echo $minP."-".$maxP."g";?> </p>
  <p> Carbohidrati : 45-65%, adica <?php echo $minC."-".$maxC."g";?></p>
  <p> Grasimi      : 20-35%, adica <?php echo $minG."-".$maxG."g";?></p>
  <p> Fibre     : 20-35g</p>

  <a href="https://www.macronutrients.net/macronutrient-recommendations/"> Cititi mai multe despre macronutrienti aici </a> <br>
  <a href="http://www.sfatulmedicului.ro/Alimentatia-sanatoasa/necesarul-de-fibre-in-alimentatie_13519"> Mai multe despre importanta fibrelor in alimentatie</a>
  <br>
</div>
<?php
if(isset($_POST['sterge-tot'])){
$_SESSION['cart']=array();
$_SESSION['contor']=-1; 
$_SESSION['updatare']=0;
$_SESSION['cod-cantitate']=array();
for($i=0;$i<2000;$i++)
  if(isset($_COOKIE[$i]))
    setcookie($i,null,time() - 3600,"/");
}
// tentativa de updatare la fel ca mai sus cu for each

$cautare = $DetaliiAlimente->find();
for($caut=1;$caut<1000;$caut++)
 if(isset($_POST['Update']))
if($_POST['Update']==$caut){
  $x1=$_POST['qty'];

  $p=9*$_POST['Update']-7;
  $p2=2*$_POST['Update'];

  foreach($cautare as $item)
  {
 if($item->aliment== $_SESSION['cart'][$p-2])
 {
       $_SESSION['cart'][$p]="<form method='POST' action='dieta.php'>
      <button type='submit' class='btn btn-dark' name='Update' value='$caut'> Update </button> 
      <input type='text' name='qty'  value='$x1'> </form>"; 
      
      $_SESSION['cart'][$p+1]= $item->calorii*($x1/100);
      $_SESSION['cart'][$p+2]= $item->proteine*($x1/100);
      $_SESSION['cart'][$p+3]= $item->carbohidrati*($x1/100);
      $_SESSION['cart'][$p+4]= $item->grasimi*($x1/100);
      $_SESSION['cart'][$p+5]= $item->fibre*($x1/100);
   
$_SESSION['cod-cantitate'][$p2-1]=$x1;
}



  }
}


$el=count($_SESSION['cart']);
if($el==0){

  ?> 
  <div class="categorii-calorii">
    <div>
    <h1> Cosul cu alimente este gol</h1> <br>
   <img src="img/eat.png">
</div>
  </div>
  <?php

 }
 else{
 ?>
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
<?php
 }

$o=1;
for($i=8;$i<=500;$i=$i+9){
if(isset($_POST[$i])){
 
  for($j=$i;$j>=$i-8;$j--)
  {
    unset($_SESSION['cart'][$j]);
  }
  //$cod=$_SESSION['cod-cantitate'][$o];
  unset($_SESSION['cod-cantitate'][$o]);
  unset($_SESSION['cod-cantitate'][$o-1]);


  for($i=0;$i<2000;$i++)
  if(isset($_COOKIE[$i]))
    setcookie($i,null,time() - 3600,"/");
 
if(count($_SESSION['cart'])==0)
{?>
  <div class="categorii-calorii">
    <div>
    <h1> Cosul cu alimente este gol</h1> <br>
   <img src="img/eat.png">
</div>
  </div>
  <?php
}

}
$o=$o+2;
}


while (list ($key, $val) = each ($_SESSION['cart'])) 
  { 
    if($z==0)
      echo "<tr>";
      if($z%9==1)
      echo "<td> <img src='$val'> </td>";
  else
  echo "<td> $val </td>"; 
  $z++;
  if($z%9==0)
  echo "</tr>";

  $val1 = (float)$val;
  
   if($z%9==4)
   $totalKcal=$totalKcal+$val1;
   if($z%9==5)
   $totalP=$totalP+$val1;
   if($z%9==6)
   $totalC=$totalC+$val1;
   if($z%9==7)
   $totalG=$totalG+$val1;
   if($z%9==8)
   $totalF=$totalF+$val1;
  if($z==(count($_SESSION['cart'])))
  {
    
     ?>
    
  <tr class="table-footer">
  
    <td colspan='3'> <b> Total    </b> </td>
    <td><b> <?php echo $totalKcal ?>  kcal    </b> </td>
   <td><b> <?php echo $totalP ?> Proteine   </b>   </td>
    <td> <b><?php echo $totalC ?> Carbohidrati </b> </td>
    <td><b> <?php echo $totalG ?>  Grasimi   </b>   </td>
    <td> <b><?php echo $totalF  ?> Fibre   </b>    </td>
    <b><form action="dieta.php" method="POST"><td><button name="sterge-tot" class="btn btn-dark"> Sterge tot </button> </form> </td></b>
   </tr>
   
   <?php
}

  }
  
  ?>


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