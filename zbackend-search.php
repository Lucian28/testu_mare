<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once('vendor/autoload.php');
session_start();
$client = new MongoDB\Client; 
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;

if(isset($_REQUEST["term"])){
    // Prepare a select statement
 
    $regex = new MongoDB\BSON\Regex (strtolower($_REQUEST["term"]));
    $filter =['aliment'=>$regex];
    $options = ['sort' => ['aliment' => 1]];
    $cautare=$DetaliiAlimente->find($filter, $options);
  
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
   <!-- aici am modificat -->
  <button type="submit" id="submit" class="btn btn-primary"  name="Adauga" value="<?php echo $item->aliment?>" >  Adauga </button> 
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
