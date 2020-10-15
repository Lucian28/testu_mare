<?php
require_once('.\MongodbDatabase.php');
$db=new MongodbDatabase;
$client = new MongoDB\Client; 
$DateUtilizatori=$client->DateUtilizatori;
$date=$DateUtilizatori->date;
$newURL="login.php";
if(isset ($_POST['Inregistrare']))
 if( isset ( $_POST['nume'])) 
    if( ! empty($_POST['nume']))
    if($_POST['parola']!=$_POST['parola2'])
    echo  "<script> alert('Parolele nu corespund')</script>";
    else
      {
        header('Location: '.$newURL);
        $e=$_POST['email'];
        
           $email=$date->findOne(array("email" =>$_POST['email']));

          $xemail=$email->email;
         if($xemail!=$_POST['email'])
         {
      
    {
       $insertable = $db->insertNewItem([
    'nume' => $_POST['nume'],
    'prenume'  => $_POST['prenume'],
    'sex' =>  $_POST['sex'],
    'email' =>  $_POST['email'],
    'parola' =>  $_POST['parola'],
    'varsta' =>  $_POST['varsta'],
    'greutate' =>  $_POST['greutate'],
    'inaltime' =>  $_POST['inaltime'],
    'nivelActivitate' =>  $_POST['nivelActivitate']
          ]);
          if($insertable){
              ?>
<div class="container">
 <div class="panel">
    <h3> Ai fost inregistrat cu succes </h3>
  </div>
 </div>
              <?php
          }
       }
    }
    else
    echo "<script> alert('Aceasta adresa de email este deja folosita de alt utilizator')</script>";
}



?>



<!DOCTYPE html>
<head>

<title> Welcome </title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="styles.css">
</head>

                            
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left"> 
                        <img src="img/protein.png" alt=""/>
                        <h3>Bine ai venit </h3>
                        <form action="login.php" method="POST">
                        <p>Ai deja cont ? Click pe login</p>
                        <input type="submit" name="Login" value="Login"/><br/>
                        </form>
                    </div>
                    <div class="col-md-9 register-right">
                    <form action="inregistrare.php" method="POST">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading"> Creeaza-ti contul acum ! </h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nume" pattern="[A-Za-z]{1,100}" placeholder="Nume *"name="nume" value="<?php if (isset($nume)) echo $nume;?>"  required  title="Introduceti doar litere !" onkeydown="return alphaOnly(event);" onblur="if (this.value == '') {this.value = 'Introduceti doar litere';}" onfocus="if (this.value == 'Introduceti doar litere') {this.value = '';}"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="prenume" pattern="[A-Za-z]{1,100}" placeholder="Prenume *" name="prenume" value="<?php if (isset($prenume)) echo $prenume;?>" required title="Introduceti doar litere !" onkeydown="return alphaOnly(event);" onblur="if (this.value == '') {this.value = 'Introduceti doar litere';}" onfocus="if (this.value == 'Introduceti doar litere') {this.value = '';}" />
                                        </div>
                                       
                                        <div class="form-group">
                                            <input type="password" id="parola"  class="form-control" pattern=".{6,50}" title="Introduceti minim 6 caractere" placeholder="Parola *" name="parola" value=""required  />
                                        </div>
                                      
                                        <div class="form-group">
                                            <input type="password" id="parola2" class="form-control"  pattern=".{6,50}"  title="Introduceti minim 6 caractere" name="parola2" placeholder="Confirma Parola *" value="" required  />
                                            <br> <span style="background-color:white" id='message2'></span>
                                            <br> <span style="background-color:white" id='message'></span>
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="sex" <?php if (isset($sex) && $sex=="male") echo "checked";?>value="male" checked>
                                                    <span> Male </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="sex" <?php if (isset($sex) && $sex=="female") echo "checked";?> value="female">
                                                    <span>Female </span> 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" placeholder="Email *" name="email" value="<?php if (isset($email)) echo $email;?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="email incorect" required  />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="varsta" id="varsta" class="form-control" placeholder="Varsta *" value="<?php if (isset($varsta))  echo $varsta;?>"  required onkeydown="return NumbersOnly(event);" onblur="if (this.value == '') {this.value = 'Introduceti doar cifre';}" onfocus="if (this.value == 'Introduceti doar cifre') {this.value = '';}"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="inaltime"  id="inaltime" class="form-control" placeholder="Inaltime (cm) *" value="<?php if (isset($inaltime)) echo $inaltime;?>"  required onkeydown="return NumbersOnly(event);" onblur="if (this.value == '') {this.value = 'Introduceti doar cifre';}" onfocus="if (this.value == 'Introduceti doar cifre') {this.value = '';}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="greutate" id="greutate" class="form-control" placeholder="Greutate (kg) *" value="<?php if (isset($greutate)) echo $greutate;?>" required   onkeydown="return NumbersOnly(event);" onblur="if (this.value == '') {this.value = 'Introduceti doar cifre';}" onfocus="if (this.value == 'Introduceti doar cifre') {this.value = '';}" />
                                        </div>
                                        <div class="form-group">
                                      
                                            <select name="nivelActivitate" class="form-control">
                                                <option class="hidden" required   disabled>Alegeti nivelul dvs. de activitate</option>
                                                <option value="1">Desk job with little exercise</option>
                                                <option value="2">1-3 hrs/week of strenuous cardio</option>
                                                <option value="3">3-5 hrs/week of strenuous cardio</option>
                                                <option value="4">5-6 hrs/week of strenuous cardio</option>
                                                <option value="5">7-21 hrs/week of strenuous cardio</option>
                                            </select>
                                        </div>
                                        
                                        <input type="submit" class="btnRegister"  name="Inregistrare" value="Inregistrare"/>
                                    </div>
                                </div>
                            
            </form>


      

<script>
$('#parola2, #parola').on('keyup', function () {
     if($('#parola').val().length>=6) 
        $('#message2').html('').css('color', 'green'); 
      else 
        $('#message2').html('Parola trebuie sa aiba minim 6 caractere').css('color', 'red');
        if ($('#parola2').val().length==0 )
        $('#message').html('<br>').css('color', 'green');
        else{
    if ($('#parola2').val() == $('#parola').val()) {
        $('#message').html('<br>').css('color', 'green');
    } else 
        $('#message').html('Parolele nu se potrivesc').css('color', 'red');
        }
});
</script>


<script>
function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 || key == 9);
};
</script>


<script>
function NumbersOnly(event) {
  var key = event.keyCode;
  return ((key >= 48 && key <= 57 || key==8 || key == 9));
};
</script>