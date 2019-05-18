<html>
  <style>.error {color:#FF0000;}</style>
  <link rel="stylesheet" href="navbar.css">
<body>


<?php include('navbar.php'); ?>
<div class="main2">
</div>
<?php
// definirea valorilor pentru erori ca fiind goale. Altfel la prima afisare a formularului ar da o eroare
$usrnameerr=$emailerr=$passworderr=$usernameerr="";
// definirea variabilelor pentru valorile din formular. Daca nu am stabili, la prima afisare a formularului ar da eroare
$birthDate=$roleId=$about=$usrname1=$passwordUser=$email1=$username1="";
//definirea valorii la eroarea principala. Daca intervine orice eroare la verificare formular, ii vom atribui o alta valoare
$eroare=0;
//se deschide fisierul de configurare, pentru a citi variabilele definite de noi
require_once ("config.php");
// functie pentru sanitizarea datelor primite din formular
function test_input($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
// verifica daca au fost trimise date din formular
if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
// verifica daca campul usrname a fost completat cu functia empty
    if (empty($_POST["usrname"]))
      {
// in cazul in care nu a fost completat defineste o eroare
        $usrnameerr="usrnamele este obligatoriu";
// in cazul in care a fost definit o eroare la verificarea formularului, se modifica si eroarea principala
        $eroare=1;
      }
    else
      {
// se modifica valoarea goala de la variabila $usrname cu valoarea primita din formular
        $usrname1=test_input($_POST["usrname"]);
// daca campul a fost completat, se verifica daca contine numai litere si spatii folosind functia de filtrare preg_match
        if (!preg_match("/^[a-zA-Z ]*$/",$usrname1))
          {
            $usrnameerr="Numai litere si spatii sunt acceptate";
            $eroare=1;
          }
      }
 
        if (empty($_POST["email"]))
          {
            $emailerr="Adresa de e-mail este obligatorie";
            $eroare=1;
          }
        else
          {
            $email1=test_input($_POST["email"]);
// pentru a verifica formatul unei adrese de email, se poate folosi functia de filtrare filter_var
            if (!filter_var($email1, FILTER_VALIDATE_EMAIL))
              {
                $emailerr="Format adresa e-mail invalid";
                $eroare=1;
              }
          }
        if (empty($_POST["username"]))
          {
            $usernameerr="Usernameul este obligatoriu";
            $eroare=1;
          }
        else
          {
            $username1=test_input($_POST["username"]);
// daca campul a fost completat, se verifica daca contine numai litere, usrnamere si spatii
            if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username1))
              {
                $usernameerr="Numai litere, cifre si spatii sunt acceptate";
                $eroare=1;
              }
          }
            
          if (empty($_POST["usrPassworda"]))
            {
              $passworderr="usrPassword este obligatorie";
              $eroare=1;
            }
          else
            {
              if (empty($_POST["usrPasswordb"]))
                {
                  $passworderr="usrPassword este obligatorie";
                  $eroare=1;
                }
                else
                  {
// se verefica daca cele doua parole sunt identice
                    if ($_POST["usrPassworda"]!=$_POST["usrPasswordb"])
                      {
                        $passworderr="usrPassword nu se potriveste";
                        $eroare=1;
                      }
                  }
            }

// daca nu a fost nici o eroare la verificarea formularului, se va verifica in baza de date daca user-ul si e-mailul exista deja

echo "<p>Numarul de erori este ".$eroare."</p>";
      if ($eroare==0)
       {
         require_once ("config.php");

         echo "<p> ROW 116 Ne-am conectat la baza de date!!</p>";

         $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");

         $query="SELECT * FROM $tbl_name_users WHERE username='$username1'";
         $result=mysqli_query($db,$query);
         $num=mysqli_num_rows($result);
         if($num==1)
         {
           $usernameerr="Username existent. Alegeti alt Username";
           $eroare=1;
         }
          $query="SELECT * FROM $tbl_name_users WHERE email='$email1'";
          $result=mysqli_query($db,$query);
          $num=mysqli_num_rows($result);
          if($num==1)
          {
            $emailerr="Adresa de e-mail existent. Alegeti alta adresa";
            $eroare=1;
          }
        }
// daca nu a fost nici o eroare la verificarea formularului se va salva poza si se vor introduce datele in baza de date
        if ($eroare==0)
         {
           require_once ("config.php");

// se conecteaza la baza de date
           $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
// se cauta in tabel id-ul maxim, la care se va adauga 1, pentru a crea id-ul nou
           $query="SELECT MAX(id) AS max FROM $tbl_name_users";
           $result=mysqli_query($db,$query);
           $result2=mysqli_fetch_array($result);
           $idnew=$result2['max']+1;
// se sanitizeaza usrPassword
           $usrPassword1=test_input($_POST["usrPassworda"]);
// se sanitizeaza about
           $about1=test_input($_POST["about"]);
// se sanitizeaza usrnamele Usernameului
            $usrname1=test_input($_POST["usrname"]);
               // se sanitizeaza data de nastere Usernameului
            $birthDate=test_input($_POST["birthDate"]);     
// se cripteaza usrPassword
           $usrPassword1=md5($usrPassword1);

// inserare in baza de date

            $query="INSERT INTO $tbl_name_users (id, name, birth_date, username, email, password, role_id, about) VALUES ('$idnew', '$usrname1', '$birthDate', '$username1', '$email1', '$usrPassword1', '5','$about1')";
            $result=mysqli_query($db,$query);
          
// se specifica pagina catre care se va redirectiona dupa inserare in baza de date
            header("Location: index.php");
          }
  }
?>
<h2>Inregistrare Username nou</h2>
<p><span class="error">* camp obligatoriu</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">
  <fieldset>
  <legend>Personal user informations</legend>
  <br>
    Name of the User: <br><input type="text" name="usrname" value="<?php echo $usrname1; ?>" lenght="80">
    <span class="error">* <?php echo $usrnameerr;?></span><br><br>
    E-mail: <br><input type="text" name="email" value="<?php echo $email1; ?>" lenght="80">
    <span class="error">* <?php echo $emailerr;?></span><br><br>
    Birth Date: <br><input type="date" name="birthDate" min="1900-01-01"value="<?php echo $birthDate; ?>" lenght=80">
    <br>    <br>
    About: <br><input type="text" name="about" value="<?php echo $about; ?>" lenght="240">
    <br>    
    
  </fieldset>
  <br>
 
  <br>
  <fieldset>
  <legend>Login Details</legend>
  <br>
    Username: <br><input type="text" name="username" value="<?php echo $username1; ?>" lenght="40">
    <span class="error">* <?php echo $usernameerr;?></span><br><br>
    Password: <br><input type="password" name="usrPassworda" lenght="40">
    <br><br>
    Repeat Password: <br><input type="password" name="usrPasswordb" lenght="40">
    <span class="error">* <?php echo $passworderr;?></span><br>
  </fieldset>
  <br>
    <input type="submit" name="submit" value="Submit">
</form>
<br><br>
<a href='index.php' target='_self'>Home Page</a>
&nbsp; | &nbsp;
<a href='login.php' target='_self'>Login</a>
</body></html>
