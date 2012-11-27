<?php if ($content['#node']->comment and !($content['#node']->comment == 1 and $content['#node']->comment_count)) { ?>
<div class="comments">
  <h6>评论</h6>
  <div id="comment-wrapper">
  	<?php print render($content['comments']); ?>
  </div>
  <div id="comment-form" class="comment-form comment_box">
    <h4><?php print t('发表评论'); ?></h4>
    <?php print str_replace('resizable', '', render($content['comment_form'])); ?>
  </div>
</div>
<?php } ?>