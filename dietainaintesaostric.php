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
<a href="dieta.php" class="active">Calorii consumate</a>
<?php 
$x=1;$z=0;
session_start();
  if($_SESSION['email']=="lucian.miholca@gmail.com")
   echo "<a href='adauga.php'> Adauga aliment </a>";?> 
<uli style="float:right"><a  href="logout.php">Log out</a></uli>

     <div class="search-container">
       <form action="vizualizare.php" method="POST">
             <input type="text" placeholder="Search.." name="search">
             <button type="submit"><i class="fa fa-search"></i></button>
        </form>
  </div>
</div>



<?php 

require_once('.\mongo2.php');
$client = new MongoDB\Client; 
$db=new mongo2;
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;
$var=0;$totalC=0;$totalF=0;$totalG=0;$totalKcal=0;$totalP=0;
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
                            {
                              
   if(isset($_POST['Adauga']))                            
    if($_POST['Adauga']==$item->aliment){
      $_SESSION['contor']++;
      $var=$_SESSION['contor'];
      
   array_push($_SESSION['cart'],$item->aliment,
                                $item->image,
                              $_POST['cantitate'],
                              $item->calorii*($_POST['cantitate']/100),
                              $item->proteine*($_POST['cantitate']/100),
                              $item->carbohidrati*($_POST['cantitate']/100),
                               $item->grasimi*($_POST['cantitate']/100),
                               $item->fibre*($_POST['cantitate']/100),
                               "<form method='POST' action='dieta.php'><input type='submit' class='btn btn-info' name='$var' value='sterge'>  </form>");
                              
                                     }
                                    
                                    
                             }
                          }
                          

$el=count($_SESSION['cart']);
if($el==0){

  ?> 
  <div class="categorii-calorii">
    <div>
    <h1> Cosul cu alimente este gol</h1> <br>
   <img src="eat.png">
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


for($i=1;$i<=100;$i++)
if(isset($_POST[$i])){
 
  for($j=$i*9-1;$j>=$i*9-9;$j--)
  {
    unset($_SESSION['cart'][$j]);
  }
   
  

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
  if($key==(count($_SESSION['cart'])-1))
  {
    
    ?>
    
  <tr style="background-color:white">
   <td colspan='3'> Total     </td>
   <td> <?php echo $totalKcal ?>  kcal     </td>
   <td> <?php echo $totalP ?> Proteine      </td>
   <td> <?php echo $totalC ?> Carbohidrati  </td>
   <td> <?php echo $totalG ?>  Grasimi      </td>
   <td> <?php echo $totalF  ?> Fibre       </td>
   <td>                      </td>
  </tr>
  <?php
  }
}
  
  // echo "
  // <tr>
  //  <td colspan='3> Total     </td>
  //  <td> $totalKcal  kcal     </td>
  //  <td> $totalP Proteine     </td>
  //  <td> $totalC Carbohidrati </td>
  //  <td> $totalG Grasimi      </td>
  //  <td> $totalF Fibre        </td>
  //  <td>                      </td>
  // </tr>"
  // ;
  
  ?>