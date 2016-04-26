<?php
class scIo{
  public static $nLength  = 133 ;  //fixed

  public static function PrintMe($vaPrintLine,$lEject=true,$cTextInit="\033\033\017\017",$cPortDefault=''){
    if(!empty($vaPrintLine)){
      if($cPortDefault == ''){
        $cPort = "/dev/lp0" ;
        if(self::IsWindowsOS()) $cPort = "LPT1" ;
      }else{
        $cPort = $cPortDefault ; 
      } 
      echo('<applet CODEBASE="../sapeltucore/sc_credits/print_io/" code="printio.class" height="0" width="0">') ;
      echo('<param name="PORT" Value = "' . $cPort . '">') ;
      $nRow = 0 ;
      foreach($vaPrintLine as $key=>$value){
        $v = $value ;  
        $v = $cTextInit . $v ;

        echo('<param name="cPrint' . $nRow . '" Value = "x' . $v . '">') ;
        $nRow ++ ;
      }
      echo('<param name="nJumlah" Value = "' . count($vaPrintLine) . '">') ;
      $cEject = "true" ;
      if(!$lEject) $cEject = "false" ;
      echo('<param name="Eject" Value = "' . $cEject . '">') ;
      echo('</applet>') ;
    }
  }

  public static function SetSpace($nRow){
    $cSpace = "" ; 
    for($o  = 0 ; $o < $nRow ; $o++){
      $cSpace .= " " ;
    }
    return $cSpace ; 
  }

  public static function Padl($cString,$nLen,$cAlign="left",$cSpace=" "){
    $sAlign = STR_PAD_RIGHT ; 
    switch (strtolower($cAlign)) {
      case 'right': 
        $sAlign = STR_PAD_LEFT ; 
        break;
      case 'center': 
        $sAlign = STR_PAD_BOTH ; 
        break;  
      default:
        $sAlign = STR_PAD_RIGHT  ; 
        break;
    }

    return substr(str_pad($cString, $nLen,$cSpace,$sAlign), 0, $nLen) ; 
  }

  public static function PrintEnter($nTop=0,&$vaPrint){
    for($o = 0 ; $o < $nTop ; $o++){
      $vaPrint[]  = " " ; 
    } 
  }

 
  public static function IsWindowsOS(){
    $lRetval = false ;
    $cAgent = $_SERVER['HTTP_USER_AGENT'] ;
    if(preg_match("/Windows/i",$cAgent)){
      $lRetval = true ;
    }
    return $lRetval ;
  }  
}

?>
