<?php

function hex2rgba($hex, $a='1') {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   return $r.','.$g.','.$b.','.$a;
}

function gameb_getButtonsOrdered($_buttons = array()){
   if(empty($_buttons)) return array();
   $buttons = array();

   foreach ($_buttons as $button) {
      $buttons[$button['position']][] = $button;
   }
   return $buttons;
}

function gamebAP_renderButtons($position = "", $buttons = array()){
   if(!isset($buttons[$position]) || empty($buttons[$position])) return false;
   $out = '<div class="'.$position.'">';
   foreach ($buttons[$position] as $button) {
      if($button['behavior'] != 'redirect'){
         $out .= '<div class="'.$button['class'].' button-container" id="'.$button['id'].'"><span class="gamebAP-button behave-'.$button['behavior'].'" style="background-color:'.$button['color'].'">'.$button['text'].'</span></div>';
      }else{
         $out .= '<div class="'.$button['class'].' button-container" id="'.$button['id'].'"><span class="gamebAP-button" style="background-color:'.$button['color'].'"><a href="'.$button['url'].'">'.$button['text'].'</a></span></div>';
      }
   }
   $out .= '</div>';
   echo $out;
   return true;

}

function gameb_getHorizontalMargins($width = '0', $position = '', $forced = true){
   $left = 0;
   $right = 0;

   if(!is_numeric($width)) return array(15, 15);
   $width = intval($width);
   
   if($width == 100) return array($left, $right);

   // Natural values. Middle position.
   $left = $right = (100 - $width)/2;
   
   switch ($position){
      case 'TopLeft':
      case 'MiddleLeft':
      case 'BottomLeft':
         // Float to the left
         $left = ($forced) ? 0 : 2;
         $right = ($forced) ? $right*2 : ($right*2)-2;
         break;
      case 'TopRight':
      case 'MiddleRight':
      case 'BottomRight':
         //Float it to the right
         $right = ($forced) ? 0 : 2;
         $left = ($forced) ? $left*2 : ($left*2)-2;
         break;
      default:
         break;
   }
   return array($left, $right);
}

function gameb_getVerticalMargins($height = '0', $position = '', $forced = true){
   $top = 0;
   $bottom = 0;

   if(!is_numeric($height)) return array(15, 15);
   $height = intval($height);
   
   if($height == 100) return array($top, $bottom);

   // Natural values. Middle position.
   $top = $bottom = (100 - $height)/2;
   
   switch ($position){
      case 'TopLeft':
      case 'TopMiddle':
      case 'TopRight':
         // Put it on top
         $top = ($forced) ? 0 : 2;
         $bottom = ($forced) ? $bottom*2 : ($bottom*2)-2;
         break;
      case 'BottomLeft':
      case 'BottomMiddle':
      case 'BottomRight':
         // Put it on the bottom
         $bottom = ($forced) ? 0 : 2;
         $top = ($forced) ? $top*2 : ($top*2)-2;
         break;
      default:
         break;
   }
   return array($top, $bottom);
}

?>