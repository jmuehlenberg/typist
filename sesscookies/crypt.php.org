<?php
  function EasyCrypt($s)
  {
    srand((double)microtime()*time());
    $key=rand(0,5);
    for($i=0; $i<strlen($s); $i++)
    { $s[$i] = chr(ord($s[$i])+$key+$i); }
    return chr(($key+50)).$s;
  }
  function EasyUnCrypt($s)
  {
    $key = (ord($s[0])-50);
    $s = substr($s,1);
    for($i=0; $i<strlen($s); $i++)
    { $s[$i] = chr(ord($s[$i])-$key-$i); }
    return $s;
  }

?>