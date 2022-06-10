<html>
  <head>
    <title>Ausdruck von MyType</title>
    <style type="text/css">  
      *           {font-family:Arial;}
      *.typed     {font-family:monospace;} 
      hr          {width:100%; height:2px; color:black};
      span.nofail {color:white;};
      span.isfail {color:red; text-decoration:underline;}   
      #display    {background-color:#FEFEFE; border:single 2px black; width:100%}
    </style>
  </head>

  <body>
    <div align=center>
      <h1>MyType - Ausdruck von <?php echo $_POST[src] ?></h1>
      <br>
      <hr>
      Geschrieben von <?php echo ($_COOKIE[username]; ?>
		<!-- <?php echo ($_COOKIE[username]?$_COOKIE[username]:"Unbekannter Benutzer"); ?> -->
      Ausgedruckt <?php echo strftime("%d.%m.%Y %H.%M.%S",time()); ?>

      <div id="display">
        <?php
          echo $_POST[datas]
        ?>
      </div>  
    </div>
  </body>
</html>
     
  