<?php
  session_start();
  if ($init != "succ")
  {
    $_SESSION["init"];
    $_SESSION["username"];
    $_SESSION["password"];
    $_SESSION["index"];
    $init="succ";
  }
  echo "<html><head><title>Typist - Der Tastaturschreibkurs im Internet</title></head>\n\r";
  echo "<body>\n\r";
  echo "  <link rel='stylesheet' type='text/css' href='mystyle.css'>\r\n";
  echo "  <table height=100% width=100% style='border-collapse:collapse;'>\r\n";
  echo "    <tr><td colspan=2 align=center style='border:solid 2px black;' height=10%><h1>Typist - Der Tastaturschreibkurs im Internet</h1></td></tr>\r\n";
  echo "    <tr><td width=20% style='border:solid 2px black;'>\r\n";
  if ($username=='')
    include "navi_unlogged.html";
  else
    include "navi_login.html";
  echo "    </td><td style='border:solid 2px black;'><div  style='height:100%;overflow:scroll;'>";

  if (!$_POST)
  {$_POST = $_GET; }
  if ($_POST['window']=="")
    include "home.html";
  else
    include $_POST['window'];
  echo "    </div></td></tr></table></body></html>";
  
?>