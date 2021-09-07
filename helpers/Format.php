<?php
/**
* Format Class
*/
class Format{
 public function formatDate($date){
     //used to convert an English textual date-time description to a UNIX timestamp
  return date('F j, Y, g:i a', strtotime($date));
 }

 public function textShorten($text, $limit = 400){
  $text = $text. " ";
  //The substr() function returns a part of a string
  $text = substr($text, 0, $limit);
  // finds the position of the last occurrence of a string inside another string
  $text = substr($text, 0, strrpos($text, ' '));
  $text = $text.".....";
  return $text;
 }

 public function validation($data){
     // inbuilt function which removes whitespaces and also the predefined characters from both sides of a string that is left and right
  $data = trim($data);
  //stripcslashes($data)
  //remove backslashes and clean up data retrieved from a database or from an HTML form. 
  //It returns a string with backslashes stripped off. 
  //This function stripcslashes() is important while we need to remove the backslashes.
  $data = stripcslashes($data);
  //htmlspecialchars() function accepts an input string ($string) and returns the new string with the special characters converted into HTML entities
  $data = htmlspecialchars($data);
  return $data;
 }

 public function title(){
     //an array containing information such as headers, paths, and script locations
  $path = $_SERVER['SCRIPT_FILENAME'];
  $title = basename($path, '.php');
  //$title = str_replace('_', ' ', $title);
  if ($title == 'index') {
   $title = 'home';
  }elseif ($title == 'contact') {
   $title = 'contact';
  }
  //function converts the first character of a string to uppercase
  return $title = ucfirst($title);
 }
}
?>