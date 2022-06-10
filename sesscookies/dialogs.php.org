<html>
  <head>
    <title>Inet-Chat</title>
  </head>
  <body>  
    <link rel="stylesheet" type="text/css" href="style.css">
    <center>
      <?php
        require "dlgobjs.php";

        function RegisterDialog()
        {
          $dlg_reg = new StdDialog('index.php','post','<b>Neu Registrieren</b>');
                    
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdMiniTitle('Benutzerinformationen'));
          $dlg_reg->AddControl(new StdInput('Benutzername:','text','','username'));  // -> Desc=Benutzername Type=text Value="" Name="username"
          $dlg_reg->AddControl(new StdInput('Passwort:','password','','password'));
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdButton('submit','Jetzt registrieren!'));
          $dlg_reg->AddControl(new StdHidden('window','regsvr.php'));
          $dlg_reg->AddControl(new StdHidden('action','register'));
          $dlg_reg->CreateForm();
        }
  
        function LoginDialog()
        {
          $dlg_reg = new StdDialog('index.php','post','Einloggen');
                    
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdInput('Benutzername:','text','','username'));  // -> Desc=Benutzername Type=text Value="" Name="username"
          $dlg_reg->AddControl(new StdInput('Passwort:','password','','password'));
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdButton('submit','Einloggen'));
          $dlg_reg->AddControl(new StdHidden('window','regsvr.php'));
          $dlg_reg->AddControl(new StdHidden('action','login'));
          $dlg_reg->CreateForm();
        }

        function DeleteDialog()
        {
          $dlg_reg = new StdDialog('index.php','post','Konto l&ouml;schen');
                    
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdInput('Benutzername:','text','','username'));  // -> Desc=Benutzername Type=text Value="" Name="username"
          $dlg_reg->AddControl(new StdInput('Passwort:','password','','password'));
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdInput('Geben sie hier in Grossbuchstaben OK ein:','text','','OK'));
          $dlg_reg->AddControl(new StdMiniTitle('<br>'));
          $dlg_reg->AddControl(new StdButton('submit','Löschen'));
          $dlg_reg->AddControl(new StdHidden('window','regsvr.php'));
          $dlg_reg->AddControl(new StdHidden('action','delete'));
          $dlg_reg->CreateForm();
        }

        switch ($_GET['dialog'])
        { 
          case 'register': RegisterDialog(); break;
          case 'login': LoginDialog(); break;
          case 'delete': DeleteDialog(); break;
        } 
      ?>
    </center>
  </body>
</html>