<html>
  <head>
    <title>?bungsvorschau:</title> 
    <link rel="stylesheet" type="text/css" href="../mystyle.css">
  </head>
  <body>
  <?php 
    echo "<script src='$_GET['src']' type='text/javascript'></script>";
  ?>
  <div align=center>
  <div class="showblock" align=center>
  <div align=justify>
  <script type="text/javascript">
    var i;
    i=1;
    while (sourcetext[i-1])
    {
      document.write((10>i?"0"+i:i));
      document.write(". "+sourcetext[i-1]+"<br>");
      i++;
    }

  </script> 
  </div>
  </div>
  <a href="javascript:window.close()">Zur&uuml;ck</a>
  </div>
  </body>
</html>