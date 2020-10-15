<?php
session_start();
$z=0;

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
     if(isset($_COOKIE[$i]))
      setcookie($_COOKIE[$i],null,-1,"/");
 }
?>
<form action="www.php" method="POST">
<button name="sterge-cookies"> Sterge toate cookie-urile </button>
</form>