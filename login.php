<?php
require_once('.\MongodbDatabase.php');
$db=new MongodbDatabase;
?>



<!DOCTYPE html> 
<head>
<title> Logare </title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link  rel="stylesheet" href="styles2.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<img src="img/protein.png" alt=""/>
<img src="img/vegetable.png" alt=""/>
<img src="img/nuts.png" alt=""/>
<img src="img/olive-oil.png" alt=""/>
<div class="back"> 
        <div class="container login-container">
            
             <div class="col-md-7 login-form-1">
                  <form action="welcome.php" method="POST" >
                    <h3>    Login   </h3>
                 
                        <div class="form-group">
                            <input type="text" id="email" class="form-control" placeholder="Your Email *" name="email" required  />
                        </div>
                        <div class="form-group">
                            <input type="password" id="parola" class="form-control" placeholder="Your Password *" name="parola" required  />
                        </div>
    
                       
                       <div class="form-group">
                         <input type="submit" class="btnSubmit" value="login" name="login">  </form> 
                         
                         </div>
                         <div>
                             <p style="color:white;" class="cont"> Daca nu ai cont, iti poti crea unul <a href="inregistrare.php"> aici </a> </p>
                        </div>
                       
                   
                </div>
                
        </div> 
</div>


</body>
  <html> 