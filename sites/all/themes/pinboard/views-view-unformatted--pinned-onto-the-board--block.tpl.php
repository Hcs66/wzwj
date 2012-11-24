<?php 
$n1 = '';
foreach ($rows as $id => $row) {
  $n1 .= '<li><a target="_blank" href="!taxonomy_term">'.$row.'</a></li>';
}
print ($n1 ? '<ul class="b_thumbs">'.$n1.'</ul>' : '');
?>