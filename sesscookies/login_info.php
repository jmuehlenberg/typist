<?php
  if (isset($_COOKIE["username"])) {
    echo $_COOKIE["username"];
  } else {
    echo "No Cookie Named 'user' Is Set";
  }
?>