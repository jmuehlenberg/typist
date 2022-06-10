<?php
  $x = file('executeprf.html');
  $txt=implode('',$x);
  $txt = str_replace('<@filename@>', $_GET['src'], $txt);
  $txt = str_replace('<@totalmins@>', $_GET['mins'], $txt);
  echo stripslashes($txt);
?>