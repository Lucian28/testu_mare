<?php
session_start();
require_once('vendor/autoload.php');

if(!empty($_SESSION['email'])){
$client = new MongoDB\Client; 
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;
$x=0; $gasit=0;

  $cautare = $DetaliiAlimente->find();
foreach($cautare as $item){
  {
    
   

if(isset($_POST['Adauga']))                            
if($_POST['Adauga']==$item->aliment){
$_SESSION['contor']=$_SESSION['contor']+9;
$var=$_SESSION['contor'];
$cantitate=$_POST['cantitate'];
$_SESSION['updatare']=$_SESSION['updatare']+1;
$aux=$_SESSION['updatare'];
array_push($_SESSION['cart'],$item->aliment,
      $item->image,
    "<form method='POST' action='dieta.php'>
    <button type='submit' class='btn btn-dark' name='Update' value='$aux'> Update </button> 
      <input type='text'  name='qty' value='$cantitate'> </form>",
    $item->calorii*($_POST['cantitate']/100),
    $item->proteine*($_POST['cantitate']/100),
    $item->carbohidrati*($_POST['cantitate']/100),
     $item->grasimi*($_POST['cantitate']/100),
     $item->fibre*($_POST['cantitate']/100),
     "<form method='POST' action='dieta.php'><button type='submit' class='btn btn-primary' name='$var' value='$var'>   Sterge </button> </form><br>"
    //  return number_format((float)$number, 2, '.', '');     
    //pentru afisare 2 zecimale    
     );
     array_push($_SESSION['cod-cantitate'],$item->cod,$cantitate);
//  header("Location:vizualizare.php"); 
           }
        
        
   }


}
?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title> Profilul tau </title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="welcome.css">
  <style>
 .topnav {
 position:fixed;
 top: 0;
width: 100%;

}
</style>
</head>
<body>


<div class="topnav">
<a href="welcome.php" >Home</a>
<a href="vizualizare.php" class="active">Toate alimentele</a>
<a href="dieta.php">Calorii consumate</a>

<?php if($_SESSION['email']=="lucian.miholca@gmail.com")
   echo "<a href='adauga.php'> Adauga aliment </a>"; ?>
<uli style="float:right"><a  href="logout.php">Log out</a></uli>
    <div class="search-container">
        <input type="text" autocomplete="off" placeholder="Cauta..." />
    </div>
</div><br><br>

<div class="result"></div>
<?php

$cautare = $DetaliiAlimente->find();
foreach( $cautare as $item){
if(isset($_POST['Sterge'.$item->aliment]))
  $DetaliiAlimente->deleteOne(['aliment'=>$item->aliment]);
}

if(isset($_POST['search']))
  {
    $regex = new MongoDB\BSON\Regex (strtolower($_POST['search']));
    $filter =['aliment'=>$regex];
    $options = ['sort' => ['aliment' => 1]];
    $cautare=$DetaliiAlimente->find($filter, $options);
    ?>
    
    <div class="grid-container">
    <?php
 
   foreach($cautare as $item){
     $gasit++;
    ?>
    <div>
 
    <img src=<?php echo $item->image?>  height="100" width="100"><br>
   <?php echo         "<h1 style='color:green';>"  . $item->aliment."</h1>\n",
                   "Calorii: ". $item->calorii."</p>\n",
                  "Proteine: ".$item->proteine. "</p>\n",
              "Carbohidrati: ".$item->carbohidrati. "</p>\n",
                   "Grasimi: ". $item->grasimi."</p>\n",
                     "Fibre: ". $item->fibre."</p> ";                  
              
                     
   if($_SESSION['email']=="lucian.miholca@gmail.com")
   {
  ?>
   <form method="POST" action="vizualizare.php">
  <input type="submit" id="submit" class="btn btn-danger" name="<?php echo "Sterge".$item->aliment?>" value="Sterge" > <br>
  </form>
   <?php } 
   ?>
   <form method="POST" id="prospects_form" action="vizualizare.php">
   <!-- aici am modificat -->
  <button type="submit" id="submit" class="btn btn-primary" name="Adauga" value="<?php echo $item->aliment?>" >  Adauga </button> 

  <br><br>
 

   <div class="input-group">
      <span class="input-group-addon">Gramaj</span>
      <input id="msg" type="text" class="form-control" name="cantitate" value="100">
    </div>

    </div>  
   </form>
         
              
               <?php 
   }
 
   
if($gasit==0)
 echo "<img src='img/not-found.jpg' style='width: 90vw; height : 90vh;'>";
 
  
}
else
   // afisarea tuturor elem. la incarcarea paginii
{
   $cautare = $DetaliiAlimente->find(
     [],
     [
    'sort'=> ['aliment' => 1]
     ]
  );
   
   ?>
   <div id="initial" class="initial">
   <div class="grid-container">
   <?php
  foreach($cautare as $item){
   ?>
   <div>

   <img src=<?php echo $item->image?>  height="100" width="100"><br>
  <?php echo         "<h1 style='color:green';>"  . $item->aliment."</h1>\n",
                  "Calorii: ". $item->calorii."</p>\n",
                 "Proteine: ".$item->proteine. "</p>\n",
             "Carbohidrati: ".$item->carbohidrati. "</p>\n",
                  "Grasimi: ". $item->grasimi."</p>\n",
                    "Fibre: ". $item->fibre."</p> ";                  
             
                    
  if($_SESSION['email']=="lucian.miholca@gmail.com")
  {
 ?>
  <form method="POST" action="vizualizare.php">
 <input type="submit" id="submit" class="btn btn-danger" name="<?php echo "Sterge".$item->aliment?>" value="Sterge" > <br>
 </form>
  <?php } 
  ?>
  <form method="POST"   action="vizualizare.php">
 <button type="submit" id="submit" class="btn btn-primary" name="Adauga" value="<?php echo $item->aliment?>" >  Adauga </button> 
 <br><br>


  <div class="input-group">
     <span class="input-group-addon">Gramaj</span>
     <input id="msg" type="text" class="form-control" name="cantitate" value="100">
   </div>

   </div>  
  </form>
        
             
              <?php 
  }
}

?>

</div>
</div>
<!-- pana aici ----- afisare toate elem --> 




<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-container input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(".result");
        if(inputVal.length){
            $.get("zbackend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
                var x = document.getElementById("initial");
          x.style.display = "none";
            });
        }else{
          var x = document.getElementById("initial");
        x.style.display = "block";
        resultDropdown.empty();
         
        } ;
    });
   
});
</script>

<?php
}
else
echo "<script> location.href='login.php'</script>";

