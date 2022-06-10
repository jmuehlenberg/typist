<?php
  function EasyUnCrypt($s)
  {
    $key = (ord($s[0])-50);
    $s = substr($s,1);
    for($i=0; $i<strlen($s); $i++)
    { $s[$i] = chr(ord($s[$i])-$key-$i); }
    return $s;
  }

  echo "<center>";
  $newfilename=(string)time();

  move_uploaded_file($_FILES['printdatas']['tmp_name'], "prints/$newfilename");
  $file = fopen("prints/$newfilename", "r");
  if ($file)
  {
    echo "<h2>Datei erfolgreich hochgeladen!<h2>";
    while( !feof($file))
    { $inhalt .= fgets($file); }
    fclose($file);
    unlink("prints/$newfilename");
  }

  $file = fopen("prints/$newfilename.html", "w");
  if ($file)
  {
    echo "<h2>Datei erfolgreich umgewandelt<h2>";
    fputs($file, EasyUnCrypt($inhalt));
    fclose($file);
    echo "<a href='prints/$newfilename.html' target='__blank'>Jetzt drucken</a>";
  }
  echo "</center>";
?>