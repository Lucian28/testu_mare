<?php 
require_once('.\mongo2.php');
$client = new MongoDB\Client; 
$db=new mongo2;
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;
$cautare = $DetaliiAlimente->find();


// crearea cookie-urilor daca se apasa pe buton
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

// stergerea cookie-urilor daca a fost apasat pe butonul delete aliment
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
if(isset($_POST['delete']))
   if($_POST['delete']==$item->cod){
    echo " am ajuns dupa isset post delete==item cod";
      setcookie($item->cod,null,-1,"/");
   }
}


// afisarea chestiilor din cookie
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
  if(isset($_COOKIE[$item->cod])){
    echo 
     "<div>".$item->aliment."</div>",
     "<div calorii>".$_COOKIE[$item->cod]."</div>",
     "<div> proteine ".$item->proteine*($_COOKIE[$item->cod]/100)."</div>",
     "<br><br>"
     ;
  }
}

// crearea butoanelor
$cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
?>
<form action="vizualizarecookies.php" method="POST">
         <label> <?php echo $item->aliment ?>  </label>
         <input type="text" name="<?php echo $item->cod?>" value="100">
        <button name="add" value="<?php echo $item->cod?>"> Adauga </button><br>
        <button name="delete" value="<?php echo $item->cod?>"> Sterge </button><br>
 
  </form>
  <?php
}



  

?>




