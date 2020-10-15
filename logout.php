<?php
session_start();
require 'vendor/autoload.php';
require_once('.\mongo2.php');
$client = new MongoDB\Client; 
$db=new mongo2;
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;

$z=0;


while (list ($key, $val) = each ($_SESSION['cod-cantitate'])) {
    if($z%2==0){
    if(!empty($_SESSION['cod-cantitate'][$z]))
     if(!empty($_SESSION['cod-cantitate'][$z+1]))
     {
      for($i=0;$i<count($_SESSION['cod-cantitate']);$i=$i+2)
          if($i!=$z)
           if($_SESSION['cod-cantitate'][$i]==$_SESSION['cod-cantitate'][$z]){
             $_SESSION['cod-cantitate'][$z+1]+=$_SESSION['cod-cantitate'][$i+1];
            unset($_SESSION['cod-cantitate'][$i]);
            unset($_SESSION['cod-cantitate'][$i+1]);
           }

     }
       setcookie($_SESSION['cod-cantitate'][$z], $_SESSION['cod-cantitate'][$z+1],time() + (86400 * 30), "/");
    }
    $z=$z+2;
  }






if(isset($_SESSION['email'])){
   session_destroy();
    echo "<script>location.href='login.php'</script>";
}
else{
    echo "<script>location.href='login.php'</script>";
}

?>