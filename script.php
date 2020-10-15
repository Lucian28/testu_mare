<?php 
     
    if(isset($_POST['id']) && isset($_POST['msg'])) {   $_POST = array_map("strip_tags", $_POST);    
     
         $id = $_POST['id']; 
           $ms = $_POST['msg']; 
     
         $rehtml = 'confirmare mesaj '. $id. ' ('. $ms.')'; } else $rehtml = 'Date nevalide'; 
     
    echo $rehtml;        ?>