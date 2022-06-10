<?php


  class StdControl
  {
    var $html;
    
    function SetHtml($html)
    {

      $this->html = $html;
    } 
   
    function PrintData()
    {
  
      echo $this->html;
    }    
  }

  class StdButton extends StdControl
  {
    function StdButton($action, $value)
    {
      StdControl::SetHtml("<td colspan=2 align=center><input class=button type=\"$action\" value=\"$value\"></td>\n\r");    
    }
  }
 
  class StdHidden extends StdControl
  {
    function StdHidden($name, $value)
    {
      StdControl::SetHtml("<input type=hidden name=\"$name\" value=\"$value\">\n\r");    
    }
  }

  class StdInput extends StdControl
  {
    function StdInput($desc, $type, $value, $name)
    {
      StdControl::SetHtml("<td>$desc</td><td><input class=button type=\"$type\" name=\"$name\" value=\"$value\"></td>\n\r");    
    }
  }

  class StdMiniTitle extends StdControl
  {
    function StdMiniTitle($title)
    {
      StdControl::SetHtml("<td colspan=2 align=center><div class=title3>$title</div></td>\n\r");    
    }
  }

  class StdInfoText extends StdControl
  {
    function StdInfoText($desc,$value)
    {
      StdControl::SetHtml("<td>$desc</td><td>$value</td>\n\r");    
    }
  }

  class StdDialog
  {
    var $action_dest;
    var $action_method;
    var $dlg_title;
    var $items;
   
    function StdDialog($Dest, $Method, $Title)
    { 
      $this->action_dest = $Dest;
      $this->action_method = $Method;
      $this->dlg_title = $Title;
      $this->head_ctrl = 255;
    }
  
    function AddControl($Ctrl)
    {
      $this->items[] = $Ctrl;
    }

    function CreateForm()
    {
      echo "<div class=title2>$this->dlg_title</div>\n\r" ;
      echo "<form action=\"$this->action_dest\" method=\"$this->action_method\">";
      echo "<table border=0>\n\r" ;
      foreach($this->items as $each)
      {
        echo "<tr>";
        $each->PrintData();
        echo "</tr>";
      }
      echo "</form></table>";
    }
  }

?>