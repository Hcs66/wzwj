<div class="comment_box">

<?php print $picture ?>

<p>
	<?php print theme('username', array('account' => $content['comment_body']['#object'])) ?>
	<span class="comment_date"><?php print format_date($content['comment_body']['#object']->created,'custom','Y-m-d H:i:s'); ?></span>
	<?php print render($content) ?>
</p>
</div>

<?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>