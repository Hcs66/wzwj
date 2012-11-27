<?php 

$n1 = '';

foreach ($rows as $id => $row) {

  $n1 .= '<div><a target="_blank" href="!taxonomy_term">'.$row.'</a></div>';

}

print ($n1 ? $n1 : '');

?>