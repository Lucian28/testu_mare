<?php
require_once('vendor/autoload.php');
session_start();
$client = new MongoDB\Client; 
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;


    // Prepare a select statement
   
 
    $cautare = $DetaliiAlimente->find(
      [],
      [
     'sort'=> ['aliment' => 1]
      ]
   );
    ?>
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
   <form method="POST" action="vizualizare.php">
  <button type="submit" id="submit" class="btn btn-primary"  name="Adauga" value="<?php echo $item->aliment?>"  >  Adauga </button> 
  <br><br>
 

   <div class="input-group">
      <span class="input-group-addon">Gramaj</span>
      <input id="msg" type="text" class="form-control" name="cantitate" value="100">
    </div>

    </div>  
   </form>
         
              
               <?php 
   }


?>


</div>
