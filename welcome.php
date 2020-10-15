<?php
require_once('.\mongo2.php');
$client = new MongoDB\Client; 
$db=new mongo2;
$Alimente=$client->Alimente;
$DetaliiAlimente=$Alimente->DetaliiAlimente;

$DateUtilizatori=$client->DateUtilizatori;
$date=$DateUtilizatori->date;
$index=0;$y=0;$x=0;$prenume;
session_start();
if(isset ($_SESSION['email'])){
  $cautareUtilizator = $date->find();
  foreach( $cautareUtilizator as $item){
    if($item->email==$_SESSION['email'])
    {
     $prenume=$item->prenume;
     $greutate=$item->greutate;
     $inaltime=$item->inaltime;
     $activitate=$item->nivelActivitate;
     $varsta=$item->varsta;
     $sex=$item->sex;
    }
  }


  $cautare = $DetaliiAlimente->find();
  foreach($cautare as $item){
    {
      if(isset($_POST['add']))
  if($_POST['add']==$item->aliment)       
{
 $_SESSION['totalkcal']=$_SESSION['totalkcal']+$item->calorii*($_POST['cantitate']/100);

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
       "<form method='POST' action='dieta.php'><button type='submit' class='btn btn-info' name='$var' value='$var'>   Sterge </button> </form><br>"
       );
       array_push($_SESSION['cod-cantitate'],$item->cod,$cantitate);
       } 
      
     }
  }

?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title> Profilul tau </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="welcome.css">
<script src="submit.js"></script>


</head>
<div class="topnav">

<a href="welcome.php" class="active">Home</a>
<a href="vizualizare.php">Toate alimentele</a>

<a href="dieta.php">Calorii consumate </a> 
 <!-- if(!empty($_SESSION['totalkcal'])) echo (int)$_SESSION['totalkcal']."kcal";  else echo "0 kcal"; --> 
 <?php
  if($_SESSION['email']=="lucian.miholca@gmail.com")
   echo "<a href='adauga.php'> Adauga aliment </a>";?> 
<uli style="float:right"><a  href="logout.php">Log out</a></uli>

     <div class="search-container">
       <form action="vizualizare.php" method="POST">
             <input type="text" autocomplete="off" placeholder="Search.." name="search">
             <button type="submit"><i class="fa fa-search"></i></button>
        </form>
  </div>
</div>
<body>


<!-- aici vreau sa fac homepage, bine ai venit -->
<div class="bunvenit" id="sus">
  <div class="element-animation">
    <p> Bine ai venit, <?php echo $prenume ?>
    
    <a href="#mid" id="link"> <img src="img/down.png" id="imagine" > </a></p>
    
    <br>
</div>
</div>


</div>
<!-- aici vreau sa fac homepage, categorii de produse -->
<div class="categorii" id="mid">
  <div>
  <a href="#nuci" id="link">
   <img src="img/nuts.png";>
    <p > Seminte, nuci, alune </p>
    </a>
  </div >

  <div >
  <a href="#legume-fructe" id="link"> 
  <img src="img/vegetable.png";>
    <p> Legume, fructe </p>
    </a>
  </div>

  <div >
     <a href="#uleiuri" id="link"> 
     <img src="img/olive-oil.png";>
    <p> Uleiuri, unturi </p>
    </a>
  </div>
  <div>
  <a href="#leguminoase" id="link"> 
    <img src="img/beans.png";>
    <p> Leguminoase </p>
</a>
  </div>

  <div>
  <a href="#cereale" id="link"> 
    <img src="img/grain.png";>
    <p> Cereale </p>
</a>
  </div>

  <div>
  <a href="#supe" id="link"> 
    <img src="img/soup.png";>
    <p> Supe </p>
</a>
  </div>

  <div>
  <a href="#carne" id="link"> 
    <img src="img/protein.png";>
    <p> Carne </p>
</a>
  </div>

  <div>
  <a href="#lactate" id="link"> 
    <img src="img/milk_egg.png";>
    <p> Oua, Lactate </p>
</a>
  </div>
</div>

<div class="button-up">
<a href="#sus" id="link"> <img src="img/up.png" >   </a>
<a href="#nuci" id="link"> <img src="img/down.png" > </a>
</div>
<!-- sectiunea cu nuci -->
<div class="categorii-cat-8" id="nuci">

<div>
    <img class="img" src="img/alune-de-padure.jpg";><br>
  <p> Alune de padure </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton" value="alune" name="add" onclick="SubmitFormData();"> Adauga </button>
   <input type="text" id="cantitate" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results"> </p>
</div>

  <div >
  <img src="img/migdale.jpg";>
    <p> Migdale </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton1" value="migdale" name="add" onclick="SubmitFormData1();"> Adauga </button>
   <input type="text" id="cantitate1" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results1"> </p>
  </div>

  <div >
    <img src="img/nuci.jpg";>
    <p> Nuci </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton2" value="nuci" name="add" onclick="SubmitFormData2();"> Adauga </button>
   <input type="text" id="cantitate2" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results2"> </p>
   </div>

  <div>
    <img src="img/caju.jpg";>
    <p> Caju </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton3" value="caju" name="add" onclick="SubmitFormData3();"> Adauga </button>
   <input type="text" id="cantitate3" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results3"> </p>
  </div>

  <div>
    <img src="img/nuci-braziliene.jpg";>
    <p> Nuci braziliene </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton4" value="nuci braziliene" name="add" onclick="SubmitFormData4();"> Adauga </button>
   <input type="text" id="cantitate4" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results4"> </p>
  </div>

  <div>
    <img src="img/seminte-chia.jpg";>
    <p> Seminte de chia </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton5" value="seminte de chia" name="add" onclick="SubmitFormData5();"> Adauga </button>
   <input type="text" id="cantitate5" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results5"> </p>
  </div>

  <div>
    <img src="img/seminte-de-in.jpg";>
    <p> Seminte de in </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton6" value="seminte de in" name="add" onclick="SubmitFormData6();"> Adauga </button>
   <input type="text" id="cantitate6" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results6"> </p>
   </div>

  <div>
    <img src="img/seminte-dovleac.jpg";>
    <p> Seminte de dovleac </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton7" value="seminte de dovleac" name="add" onclick="SubmitFormData7();"> Adauga </button>
   <input type="text" id="cantitate7" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results7"> </p>
    </div>

</div>

<div class="button-up">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#legume-fructe" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>
<!-- sectiunea cu legume / fructe -->

<!-- sectiunea cu nuci -->

<div class="categorii-cat-12" id="legume-fructe">
<div>
  <img src="img/mar.jpg";><br>
  <p> Mere </p>
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton8" value="mar" name="add" onclick="SubmitFormData8();"> Adauga </button>
   <input type="text" id="cantitate8" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results8"> </p>
    </div>


  <div >
  <img src="img/banana.jpg";>
    <p> Banane </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton9" value="banana" name="add" onclick="SubmitFormData9();"> Adauga </button>
   <input type="text" id="cantitate9" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results9"> </p>
    </div>

  <div >
     <img src="img/portocala.jpg";>
    <p> Portocale </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton10" value="portocale" name="add" onclick="SubmitFormData10();"> Adauga </button>
   <input type="text" id="cantitate10" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results10"> </p>
    </div>
  <div>
    <img src="img/kiwi.jpg";>
    <p> Kiwi </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton11" value="kiwi" name="add" onclick="SubmitFormData11();"> Adauga </button>
   <input type="text" id="cantitate11" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results11"> </p>
    </div>

  <div>
    <img src="img/rosii.jpg";>
    <p> Rosii </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton12" value="rosii" name="add" onclick="SubmitFormData12();"> Adauga </button>
   <input type="text" id="cantitate12" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results12"> </p>
    </div>

  <div>
    <img src="img/castraveti.jpg";>
    <p> Castraveti </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton13" value="castraveti" name="add" onclick="SubmitFormData13();"> Adauga </button>
   <input type="text" id="cantitate13" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results13"> </p>
    </div>

  <div>
    <img src="img/broccoli.jpg";>
    <p> Broccoli </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton14" value="broccoli" name="add" onclick="SubmitFormData14();"> Adauga </button>
   <input type="text" id="cantitate14" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results14"> </p>
    </div>

  <div>
    <img src="img/spanac.jpg";>
    <p> Spanac </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton15" value="spanac" name="add" onclick="SubmitFormData15();"> Adauga </button>
   <input type="text" id="cantitate15" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results15"> </p>
    </div>

  <div>
    <img src="img/morcov.jpg";>
    <p> Morcov </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton16" value="morcov" name="add" onclick="SubmitFormData16();"> Adauga </button>
   <input type="text" id="cantitate16" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results16"> </p>
    </div>

  <div>
    <img src="img/ceapa.jpg";>
    <p> Ceapa </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton17" value="ceapa" name="add" onclick="SubmitFormData17();"> Adauga </button>
   <input type="text" id="cantitate17" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results17"> </p>
    </div>

  <div>
    <img src="img/para.jpg";>
    <p> Para </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton18" value="para" name="add" onclick="SubmitFormData18();"> Adauga </button>
   <input type="text" id="cantitate18" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results18"> </p>
    </div>

  <div>
    <img src="img/pruna.jpg";>
    <p> Pruna </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton19" value="pruna" name="add" onclick="SubmitFormData19();"> Adauga </button>
   <input type="text" id="cantitate19" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results19"> </p>
    </div>
 
</div>
<div class="button-up">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#uleiuri" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>

<!-- sectiunea cu uleiuri si unturi -->

<div class="categorii-cat-8" id="uleiuri">

<div>
    <img class="img" src="img/ulei-de-floarea-soarelui.jpg";><br>
  <p> Ulei de floarea soarelui </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton20" value="ulei de floarea-soarelui" name="add" onclick="SubmitFormData20();"> Adauga </button>
   <input type="text" id="cantitate20" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results20"> </p>
</div>

  <div >
  <img src="img/ulei-de-masline.jpg";>
    <p> Ulei de masline </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton21" value="ulei de masline" name="add" onclick="SubmitFormData21();"> Adauga </button>
   <input type="text" id="cantitate21" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results21"> </p>
  </div>

  <div >
    <img src="img/ulei-de-rapita.jpg";>
    <p> Ulei de rapita </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton22" value="ulei de rapita" name="add" onclick="SubmitFormData22();"> Adauga </button>
   <input type="text" id="cantitate22" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results22"> </p>
   </div>

  <div>
    <img src="img/ulei-de-cocos.jpg";>
    <p> Ulei de cocos </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton23" value="ulei de cocos" name="add" onclick="SubmitFormData23();"> Adauga </button>
   <input type="text" id="cantitate23" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results23"> </p>
  </div>

  <div>
    <img src="img/unt-de-arahide.png";>
    <p> Unt de arahide </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton24" value="unt de arahide" name="add" onclick="SubmitFormData24();"> Adauga </button>
   <input type="text" id="cantitate24" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results24"> </p>
  </div>

  <div>
    <img src="img/unt-de-migdale.jpg";>
    <p> Unt de migdale </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton25" value="unt de migdale" name="add" onclick="SubmitFormData25();"> Adauga </button>
   <input type="text" id="cantitate25" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results25"> </p>
  </div>

  <div>
    <img src="img/unt65.jpg";>
    <p> Unt 65% grasime </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton26" value="unt 65% grasime" name="add" onclick="SubmitFormData26();"> Adauga </button>
   <input type="text" id="cantitate26" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results26"> </p>
   </div>

  <div>
    <img src="img/unt-de-cocos.jpg";>
    <p> Unt de cocos </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton27" value="unt de cocos" name="add" onclick="SubmitFormData27();"> Adauga </button>
   <input type="text" id="cantitate27" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results27"> </p>
    </div>

</div>

<div class="button-up">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#leguminoase" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>
<!-- Leguminoase -->

<div class="categorii-cat-8" id="leguminoase">

<div>
    <img class="img" src="img/fasole-cu-legume.jpg";><br>
  <p> Fasole cu legume </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton28" value="fasole cu legume" name="add" onclick="SubmitFormData28();"> Adauga </button>
   <input type="text" id="cantitate28" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results28"> </p>
</div>

  <div >
  <img src="img/fasole-frecata.jpg";>
    <p> Fasole frecata </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton29" value="fasole frecata" name="add" onclick="SubmitFormData29();"> Adauga </button>
   <input type="text" id="cantitate29" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results29"> </p>
  </div>

  <div >
    <img src="img/fasole-la-cuptor.jpg";>
    <p> Fasole la cuptor </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton30" value="fasole la cuptor" name="add" onclick="SubmitFormData30();"> Adauga </button>
   <input type="text" id="cantitate30" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results30"> </p>
   </div>

  <div>
    <img src="img/fasole-verde.jpg";>
    <p> Fasole verde </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton31" value="fasole verde" name="add" onclick="SubmitFormData31();"> Adauga </button>
   <input type="text" id="cantitate31" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results31"> </p>
  </div>

  <div>
    <img src="img/iahnie-de-fasole.jpg";>
    <p> Iahnie de fasole </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton32" value="iahnie de fasole" name="add" onclick="SubmitFormData32();"> Adauga </button>
   <input type="text" id="cantitate32" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results32"> </p>
  </div>

  <div>
    <img src="img/mancare-de-mazare.jpg";>
    <p> Mancare de mazare </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton33" value="mancare de mazare" name="add" onclick="SubmitFormData33();"> Adauga </button>
   <input type="text" id="cantitate33" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results33"> </p>
  </div>

  <div>
    <img src="img/mazare-fiarta.jpg";>
    <p> Mazare fiarta </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton34" value="mazare fiarta" name="add" onclick="SubmitFormData34();"> Adauga </button>
   <input type="text" id="cantitate34" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results34"> </p>
   </div>

  <div>
    <img src="img/naut-cu-legume.jpg";>
    <p> Naut cu legume </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton35" value="naut cu legume" name="add" onclick="SubmitFormData35();"> Adauga </button>
   <input type="text" id="cantitate35" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results35"> </p>
    </div>

</div>

<div class="button-up-2">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#cereale" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>
<!-- aici va fii footer-ul -->
<!-- Cereale -->

<div class="categorii-cat-8" id="cereale">
<div>
    <img class="img" src="img/fulgi-de-ovaz.jpg";><br>
  <p> Fulgi de ovaz </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton36" value="fulgi de ovaz" name="add" onclick="SubmitFormData36();"> Adauga </button>
   <input type="text" id="cantitate36" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results36"> </p>
</div>

  <div >
  <img src="img/fulgi-de-grau.jpg";>
    <p> Fulgi de grau </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton37" value="fulgi de grau" name="add" onclick="SubmitFormData37();"> Adauga </button>
   <input type="text" id="cantitate37" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results37"> </p>
  </div>

  <div >
    <img src="img/fulgi-de-secara.jpg";>
    <p> Fulgi de secara </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton38" value="fulgi de secara" name="add" onclick="SubmitFormData38();"> Adauga </button>
   <input type="text" id="cantitate38" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results38"> </p>
   </div>

  <div>
    <img src="img/fulgi-de-orz.jpg";>
    <p> Fulgi de orz </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton39" value="fulgi de orz" name="add" onclick="SubmitFormData39();"> Adauga </button>
   <input type="text" id="cantitate39" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results39"> </p>
  </div>

  <div>
    <img src="img/fulgi-de-porumb.jpg";>
    <p> Fulgi de porumb </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton40" value="fulgi de porumb" name="add" onclick="SubmitFormData40();"> Adauga </button>
   <input type="text" id="cantitate40" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results40"> </p>
  </div>

  <div>
    <img src="img/fulgi-de-amarath.jpg";>
    <p> Fulgi de amarath </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton41" value="fulgi de amarath" name="add" onclick="SubmitFormData41();"> Adauga </button>
   <input type="text" id="cantitate41" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results41"> </p>
  </div>

  <div>
    <img src="img/paine-neagra.jpg";>
    <p> Paine neagra </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton42" value="paine neagra" name="add" onclick="SubmitFormData42();"> Adauga </button>
   <input type="text" id="cantitate42" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results42"> </p>
   </div>

  <div>
    <img src="img/paine-de-secara.jpg";>
    <p> Paine de secara </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton43" value="paine de secara" name="add" onclick="SubmitFormData43();"> Adauga </button>
   <input type="text" id="cantitate43" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results43"> </p>
    </div>

</div>

<div class="button-up-2">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#supe" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>
<!-- -------------------------- -->

<!-- Supe -->

<div class="categorii-cat-8" id="supe">
<div>
    <img class="img" src="img/gulas.jpg";><br>
  <p> Gulas </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton44" value="gulas" name="add" onclick="SubmitFormData44();"> Adauga </button>
   <input type="text" id="cantitate44" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results44"> </p>
</div>

  <div >
  <img src="img/supa-de-legume.jpg";>
    <p> Supa de legume </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton45" value="supa de legume" name="add" onclick="SubmitFormData45();"> Adauga </button>
   <input type="text" id="cantitate45" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results45"> </p>
  </div>

  <div >
    <img src="img/ciorba-radauteana.jpg";>
    <p> Ciorba radauteana</p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton46" value="ciorba radauteana" name="add" onclick="SubmitFormData46();"> Adauga </button>
   <input type="text" id="cantitate46" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results46"> </p>
   </div>

  <div>
    <img src="img/ciorba-de-burta.jpg";>
    <p> Ciorba de burta </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton47" value="ciorba de burta" name="add" onclick="SubmitFormData47();"> Adauga </button>
   <input type="text" id="cantitate47" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results47"> </p>
  </div>

  <div>
    <img src="img/supa-de-pui-cu-legume.jpg";>
    <p> Supa de pui cu legume </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton48" value="supa de pui cu legume" name="add" onclick="SubmitFormData48();"> Adauga </button>
   <input type="text" id="cantitate48" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results48"> </p>
  </div>

  <div>
    <img src="img/supa-de-fasole.jpg";>
    <p> Supa de fasole </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton49" value="supa de fasole" name="add" onclick="SubmitFormData49();"> Adauga </button>
   <input type="text" id="cantitate49" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results49"> </p>
  </div>

  <div>
    <img src="img/supa-de-orez.jpg";>
    <p> Supa de orez </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton50" value="supa de orez" name="add" onclick="SubmitFormData50();"> Adauga </button>
   <input type="text" id="cantitate50" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results50"> </p>
   </div>

  <div>
    <img src="img/ciorba-a-la-grec.jpg";>
    <p> Ciorba de pui a la grec </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton51" value="ciorba a la grec" name="add" onclick="SubmitFormData51();"> Adauga </button>
   <input type="text" id="cantitate51" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results51"> </p>
    </div>

</div>

<div class="button-up-2">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#carne" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>

<!-- Carne -->

<div class="categorii-cat-8" id="carne">
<div>
    <img class="img" src="img/somon.jpg";><br>
  <p> Somon </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton52" value="somon gatit" name="add" onclick="SubmitFormData52();"> Adauga </button>
   <input type="text" id="cantitate52" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results52"> </p>
</div>

  <div >
  <img src="img/coaste-de-porc.jpg";>
    <p> Coaste de porc</p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton53" value="coaste de porc" name="add" onclick="SubmitFormData53();"> Adauga </button>
   <input type="text" id="cantitate53" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results53"> </p>
  </div>

  <div >
    <img src="img/piept-de-pui.jpg";>
    <p> Piept de pui  </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton54" value="piept de pui" name="add" onclick="SubmitFormData54();"> Adauga </button>
   <input type="text" id="cantitate54" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results54"> </p>
   </div>

  <div>
    <img src="img/carne-de-miel.jpg";>
    <p> Carne de miel </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton55" value="carne de miel" name="add" onclick="SubmitFormData55();"> Adauga </button>
   <input type="text" id="cantitate55" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results55"> </p>
  </div>

  <div>
    <img src="img/slanina.jpg";>
    <p> Slanina </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton56" value="slanina" name="add" onclick="SubmitFormData56();"> Adauga </button>
   <input type="text" id="cantitate56" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results56"> </p>
  </div>

  <div>
    <img src="img/carne-de-vita.jpg";>
    <p> Carne de vita </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton57" value="carne de vita" name="add" onclick="SubmitFormData57();"> Adauga </button>
   <input type="text" id="cantitate57" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results57"> </p>
  </div>

  <div>
    <img src="img/ceafa-de-porc.jpg";>
    <p> Ceafa de porc </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton58" value="ceafa de porc" name="add" onclick="SubmitFormData58();"> Adauga </button>
   <input type="text" id="cantitate58" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results58"> </p>
   </div>

  <div>
    <img src="img/pastrav.jpg";>
    <p> Pastrav  </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton59" value="pastrav" name="add" onclick="SubmitFormData59();"> Adauga </button>
   <input type="text" id="cantitate59" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results59"> </p>
    </div>

</div>

<div class="button-up-2">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
<a href="#lactate" id="link"> <img src="img/down.png" id="imagine"> </a>
</div>


<!-- Lactate -->

<div class="categorii-cat-8" id="lactate">
<div>
    <img class="img" src="img/lapte.jpg";><br>
  <p> Lapte 1,5% </p> 
  <form method="post">
   <button type="button" class="btn btn-danger" id="buton60" value="lapte" name="add" onclick="SubmitFormData60();"> Adauga </button>
   <input type="text" id="cantitate60" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results60"> </p>
</div>

  <div >
  <img src="img/telemea-de-vaca.jpg";>
    <p> Telemea de vaca </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton61" value="telemea de vaca" name="add" onclick="SubmitFormData61();"> Adauga </button>
   <input type="text" id="cantitate61" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results61"> </p>
  </div>

  <div >
    <img src="img/telemea-de-oaie.jpg";>
    <p> Telemea de oaie </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton62" value="telemea de oaie" name="add" onclick="SubmitFormData62();"> Adauga </button>
   <input type="text" id="cantitate62" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results62"> </p>
   </div>

  <div>
    <img src="img/telemea-de-capra.jpg";>
    <p> Telemea de capra </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton63" value="telemea de capra" name="add" onclick="SubmitFormData63();"> Adauga </button>
   <input type="text" id="cantitate63" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results63"> </p>
  </div>

  <div>
    <img src="img/cas-de-vaca.jpg";>
    <p> Cas de vaca </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton64" value="cas de vaca" name="add" onclick="SubmitFormData64();"> Adauga </button>
   <input type="text" id="cantitate64" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results64"> </p>
  </div>

  <div>
    <img src="img/ochiuri.jpg";>
    <p> Ochiuri </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton65" value="ochiuri" name="add" onclick="SubmitFormData65();"> Adauga </button>
   <input type="text" id="cantitate65" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results65"> </p>
  </div>

  <div>
    <img src="img/oua-fierte.jpg";>
    <p> Oua fierte </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton66" value="oua fierte" name="add" onclick="SubmitFormData66();"> Adauga </button>
   <input type="text" id="cantitate66" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results66"> </p>
   </div>

  <div>
    <img src="img/omleta.jpg";>
    <p> Omleta </p>
    <form method="post">
   <button type="button" class="btn btn-danger" id="buton67" value="omleta" name="add" onclick="SubmitFormData67();"> Adauga </button>
   <input type="text" id="cantitate67" name="cantitate" value="100">
   </form>
   <p style="color:green" id="results67"> </p>
    </div>

</div>

<div class="button-up-2">
<a href="#mid" id="link"> <img src="img/up.png" id="imagine"> </a>
</div>

<!-- gata cu alimentele -->




  <?php
} 
else{
  if(isset($_POST['parola'])){
   $e=$_POST['email'];
   $p=$_POST['parola'];
   $email=$date->findOne(array("email" =>$_POST['email']));
  $parola=$date->findOne(array("parola"=>$_POST['parola']));
  $xemail=$email->email;
  $xparola=$email->parola;
  
    if($e==$xemail && $p==$xparola){
        $_SESSION['email']=$xemail;
        $_SESSION['cart']=array();
        $_SESSION['cod-cantitate']=array();
        $_SESSION['contor']=-1; 
        $_SESSION['updatare']=0;
        
        $cautare=$DetaliiAlimente->find();
        $i=0;
        foreach($cautare as $item){
          if(isset($_COOKIE[$item->cod]))
            {
              $_SESSION['cod-cantitate'][$i]=$item->cod;$i++;
              $_SESSION['cod-cantitate'][$i]=$_COOKIE[$item->cod];$i++;
              $xcant= $_COOKIE[$item->cod];
              
              $_SESSION['contor']=$_SESSION['contor']+9;
              $var=$_SESSION['contor'];
              $_SESSION['updatare']=$_SESSION['updatare']+1;
              $aux=$_SESSION['updatare'];
              array_push($_SESSION['cart'],$item->aliment,
                $item->image,
                "<form method='POST' action='dieta.php'>
                <button type='submit' class='btn btn-dark' name='Update' value='$aux'> Update </button> 
                 <input type='text'  name='qty' value='$xcant'> </form>",
                   $item->calorii*($xcant/100),
                    $item->proteine*($xcant/100),
                     $item->carbohidrati*($xcant/100),
                    $item->grasimi*($xcant/100),
                     $item->fibre*($xcant/100),
                       "<form method='POST' action='dieta.php'><button type='submit' class='btn btn-info' name='$var' value='$var'>   Sterge </button> </form><br>"
     );
            }
        }
     



    
        

        echo "<script> location.href='welcome.php'</script>";}

    else{
        echo "<script> alert('email sau parola incorecta !')</script>";

        echo "<script> location.href='login.php'</script>";
        } 
    }
    else
    echo "<script> location.href='login.php'</script>";


  }
?>

<script>
$(document).on("click","#link",function(e){
  e.preventDefault();
        var id = $(this).attr("href"),
            topSpace = 30;
        $('html, body').animate({
          scrollTop: $(id).offset().top - topSpace
        }, 800);
    });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#btnSubmit').click(function() {
        var val = $("#btnSubmit").val();
       
        $.post("dieta.php", {
            val: val
            
        })
        .done(function(data) {
            $('#lblEstatus').append(data); // Appends status
            if (data == "Received") {
                $("#btnSubmit").attr('disabled', 'disabled'); // Disable doubleclickers.
            }
        })
        .fail(function(xhr, textStatus, errorThrown) { 
            $('#lblEstatus').append("Error. Try later."); 
        });
     });
   }); 
</script>