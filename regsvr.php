<?php


  function CheckUserDatas()
  {
    $sql = "select * from `mt_users` where UserName='$_POST[username]'";
    $res = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    if ($res)
    { $userdatas = mysqli_fetch_object($res);
      $username = $userdatas->UserName;
      $password = $userdatas->Password;
      $index = $userdatas->Index;
      if ($password==$_POST['password'])
      { return 1; }
    }
    else
    {
      return 0;  
    }
  }
 
  function register()
  {
    if (CheckUserDatas() == 0)
    {
      $sql = "INSERT INTO `mt_users` (UserName,Password) VALUES ('$_POST[username]','$_POST[password]');";
      $res = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      if ($res)
      {
        echo "<h3 align=center>Erfolgreich: Sie wurden erfolgreich registriert!</h3>";
        echo "<p><h3 align=center><a href='index.php?window=dialogs.php&dialog=login'>Jetzt einloggen!</a></h3>";
      }
      else
      {
        echo "<h3 color=red>Fehlgeschlagen! Fehler beim registrieren</h3>";
      }
    }
    else
    {
      echo "<h3 color=red>Fehlgeschlagen! Benutzer schon vorhanden</h3>";
    }
  }


  function Login()
  {
    if (CheckUserDatas()==1)
    {
      echo "<h3 align=center>Sie wurden erfolgreich eingeloggt!</h3>";
      echo "<h2 align=center>Willkommen $_POST[username]</h2>";
      echo "<p><h3 align=center><a href='index.php?registeruser=".crypt($_POST[username],$_POST[password])."&username=$_POST[username]'>Bitte hier klicken, sonst werden sie nicht richtig eingeloggt</a></h2>";
    }
    else
    {
      echo "<h3 align=center>Passwort falsch oder Benutzer nicht vorhanden!</h3>";
    }
  }  
  
  function DeleteAcc()
  {
    if (CheckUserDatas()==1)
    {
      $sql="DELETE FROM `mt_users` WHERE UserName='$_POST[username]'";

      $res=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      if ($res)
      {
        echo "<h3 align=center>Ihr MyType Account wurde gel&ouml;scht</h3>";
        echo "<h3 align=center>Schade...</h3>";
      }
      else
      {
        echo "<h3 align=center>Fehler beim l&ouml;schen!</h3>";
      }    
    }
    else
    {
      echo "<h3 align=center>Passwort falsch oder Benutzer nicht vorhanden!</h3>";
    }
  }  

  if (OpenDB())
  {

    
    switch ($_POST['action'])
    {
       case "register": Register(); break;
       case "login": Login();break;
       case "delete": DeleteAcc(); break;
       default: 
         echo "Befehl $_POST[action] unbekannnt!";
    } 
  }
  else
  {
    echo "Datenbankfehler!";
  }
  CloseDB();
?>