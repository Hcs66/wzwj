<div id="<?php print $block_html_id; ?>" class="block block-right <?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>

  <?php if ($block->subject) { print '<h6>'.$block->subject.'</h6>'; } ?>

  <?php print render($title_suffix); ?>
<div class="con">
  <?php print $content; ?>
</div>

</div>

<?php //print '<pre>'. check_plain(print_r($block, 1)) .'</pre>'; ?>