<?php
  function OpenDB()
  {
    $con = ($GLOBALS["___mysqli_ston"] = mysqli_connect('localhost',  'typewriter',  '134n@sSz'));
    if (!$con)
    {
      return false;
    }
    else
    {
      if (mysqli_select_db($GLOBALS["___mysqli_ston"], mcadmin_typewriter))
      {
        return true; 
      } 
      else
      {
        return false;
      }
    }
  }
   
  function CloseDB()
  {
    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
  }

?>