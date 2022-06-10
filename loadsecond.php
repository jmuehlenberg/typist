<?php
  $x = file('execute.html');
  $txt=implode('',$x);
  $txt = str_replace('<@filename@>', $_GET['src'], $txt);
  $txt = str_replace('<@LL@>', $_GET['lastLine'], $txt);
  $txt = str_replace('<@FL@>', $_GET['firstLine'], $txt);
  $txt = str_replace('<@LT@>', $_GET['lastLetter'], $txt);
  $txt = str_replace('<@TLC@>', $_GET['writeCount'], $txt);
  echo stripslashes($txt);
?>