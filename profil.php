<?php
$email="a@gmail.com";
$parola="123456";
echo $_POST['email'];
session_start();

if(isset ($_SESSION['email'])){
    echo "<h1>Welcome".$_SESSION['email']."</h1>";

    echo "<a href='home.php'> Home </a><br>";

    echo "<br><a href='logout.php'><input type=button value=logout
          name=logout></a>";
}
else{
    if($_POST['email']==$email && $_POST['parola']==$parola){
        $_SESSION['email']==$email;

        echo "<script> location.href='profil.php'</script>";
    }
    else{
        echo "<script> alert('email sau parola incorecta !')</script>";

        echo "<script> location.href='login.php'</script>";
    }
}


?>


