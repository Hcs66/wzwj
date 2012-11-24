<div class="comment_box">
<?php print $picture ?>
<p><?php print theme('username', array('account' => $content['comment_body']['#object'])) ?><?php print render($content) ?></p>
</div>
<?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>