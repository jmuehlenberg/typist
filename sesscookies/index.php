<?php 
  session_start();
  require "db.php";
  echo "<html>\n\r<head>\n\r<title>Tastaturschreibkurs Online</title>\n\r";
?>
<META NAME="Author" CONTENT="Patrick Emmisberger und Jens Muehlenberg">
<META NAME="Publisher" CONTENT="muehlenberg.ch">
<META NAME="Copyright" CONTENT="yuniq.me bis 2011 : muehlenberg.ch ab 2016">
<META NAME="Revisit" CONTENT="After 2 days">
<META NAME="Keywords" CONTENT="Schreiben, 10, Finger, System, üben, lernen">
<META NAME="page-topic" CONTENT="Bildung">
<META NAME="page-topic" CONTENT="Private Homepage">
<META NAME="audience" CONTENT=" Alle ">
<META NAME="Robots" CONTENT="INDEX,FOLLOW">
<META NAME="Language" CONTENT="Deutsch">
</head>

<?php
  echo "<body>\n\r";
  echo "  <link rel='stylesheet' type='text/css' href='mystyle.css'>\n\r";
  echo "  <div><h1 align=left>Tastaturschreibkurs Online</h1></div>\n\r";
  echo "  <div style='float:left;background-color:#FFF;height: 900px; border: 0px solid black;border-right:0px solid white;margin:0px;padding-bottom:0px'>";
  echo "  <div id='leftnavi'>\n\r";
  include "navi.html";
  echo "  </div></div>\n\r";
  /* if ($_GET[login_menu]=='yes')
  {
    echo "  <div id='leftnavi'>\n\r";
    include "navi_login.html";
    echo "  </div>\n\r";
 } */
  echo "  <div id='content'>";

  if (!$_POST)
  {$_POST = $_GET; }
  if ($_POST['window']=="")
  {
    /* if ($username != "")
    {
      echo "<h1 align=center>Willkommen $username</h1><p>"; 
    }
    else
    {
      echo "<center><p><div style='text-align:center;border:1px dotted black;padding:2px;width:300px;height:100px;' align=center><h2 align=center>Sie sind nicht eingeloggt!</h2><h3 align=center><a href='index.php?window=dialogs.php&dialog=login'>Jetzt einloggen!</a></h3></div></center><p>"; 
    } */ 

    include "home.html";
  }
  else
    include $_POST['window'];
  echo "    </div>\n\r    <br clear='all'>\n\r"; 
  /* echo "<div style='float:left;font-size:10px'>Created by <a href='http://yuniq.me'>yuniq.me</a></div>"; */
  echo "    </body>\n\r</html>";
?>