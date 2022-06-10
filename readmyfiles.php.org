<?php
  $newfilename=(string)time();

  move_uploaded_file($_FILES[printdatas][tmp_name], "$newfilename");
  $file = fopen("$newfilename", "r");
  if ($file)
  {
    echo "<h2>Datei erfolgreich hochgeladen!<h2>";
    while( !feof($file))
    { $inhalt .= fgets($file); }
    fclose($file);
    unlink("prints/$newfilename");
  }
  echo $inhalt;
?>
