<?php
/*  This file is part of Iain Hamiltons Isometric HTML5 App.

    Iain Hamiltons Isometric HTML5 App is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Iain Hamiltons Isometric HTML5 App is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Iain Hamiltons Isometric HTML5 App.  If not, see <http://www.gnu.org/licenses/>. */

header('Content-type: text/xml');

//multiexplode retrieved from php.net/explode from php@metehanarslan.com
function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function returnimages($dirname) {
  $files = array();  
  if (strpos($dirname, '..') === false) {
    $pattern = "(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)";
      foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(realpath("../../" . $dirname))) as $filepath) {
        if (eregi($pattern, $filepath)) {
          $file =  multiexplode(array('\\','/'), $filepath);
          array_push($files, "<file>" . $file[count($file)-1] . "</file>");
      }
    }
    natsort($files);
  }
  return $files;
}

echo '<files>';
  foreach (returnimages($_GET['folder']) as $file) {
    echo $file;
  }
echo '</files>';
?>
