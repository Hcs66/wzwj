<div class="comment clearfix">
  <div class="user"><?php print $picture ?></div>
  <div class="message">
    <div class="info">
      <h6><?php print theme('username', array('account' => $content['comment_body']['#object'])) ?></h6>
      <span class="date">- <?php print format_date($content['comment_body']['#object']->created,'custom','M j Y'); ?></span> </div>
      <?php print render($content) ?>
      <?php //print render($content['links']); ?>
    </div>
  <div class="clear"></div>
</div>
<?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>