<?php if ($content['#node']->comment and !($content['#node']->comment == 1 and $content['#node']->comment_count)) { ?>
<div id="comment-wrapper">
  <h4><?php print t('!comment_count to "!title"', array('!comment_count' => format_plural($content['#node']->comment_count, '1 Response', '@count Responses'), '!title' => $content['#node']->title)); ?></h4>
  <!-- Begin Comments -->
  <div id="comments">
    <div id="singlecomments" class="commentlist">
      <?php print render($content['comments']); ?>
      <?php //print '<pre>'. check_plain(print_r($content['#node'], 1)) .'</pre>' ?>
    </div>
  </div>
  <div id="comment-form" class="comment-form">
    <h4><?php print t('Leave a Comment'); ?></h4>
    <?php print str_replace('resizable', '', render($content['comment_form'])); ?>
  </div>
</div>
<?php } ?>