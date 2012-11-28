<?php global $user, $base_url; ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
<?php if (!$page and !(arg(0) == 'comment' and arg(1) == 'reply')){ ?>
<div class="pin_box ">
  <div class="inbox">
    <div class="photo">
      <div class="action" >
        <a class="repin" href="<?php print url('repin/'.$node->nid); ?>">顶</a>
        <?php print str_replace('rate','like',render($content['rate_like'])); ?>
        <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a class="comment" href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><?php print t('Comment') ?></a><?php } ?>
      </div>
      <?php print render($content['field_image']); ?>
    </div>
    
    <div class="cont">
      <?php hide($content['comments']); hide($content['links']); hide($content['field_url']); print render($content); ?>    
      <div class="stat">
        <?php $rateres = rate_get_results('node', $node->nid, 1); print '<span class="likesresult-'.$node->nid.'">'.format_plural($rateres['count'], '1 喜欢', '@count 喜欢').'</span>' ?>&nbsp;&nbsp;
        <?php if ($repins = pinboard_helper_repins_count($node)) { ?><?php print format_plural($repins, '1 repin', '@count repins') ?>&nbsp;&nbsp;<?php } ?>
         <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><?php print format_plural($node->comment_count, '1 comment', '@count comments') ?></a>&nbsp;&nbsp;<?php } ?>
      </div>
    </div>
  </div>
  <?php if (arg(2) != 'board') { ?>
  <div class="user">
    <?php print $user_picture; ?>
    <?php $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
        if (count($bid)) $bid = $bid[0]; else $bid = 0;
        $bname = db_select('pinboard_boards')->fields('pinboard_boards', array('name'))->condition('bid', $bid, '=')->execute()->fetchCol();
        $buid = db_select('pinboard_boards')->fields('pinboard_boards', array('uid'))->condition('bid', $bid, '=')->execute()->fetchCol();
        if (count($bname)) {
          $bname = $bname[0];
          $did = db_select('pinboard_repins')->fields('pinboard_repins', array('did'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
          if (count($did)) $did = $did[0]; else $did = 0;
          $nuid = db_select('node')->fields('node', array('uid'))->condition('nid', $did, '=')->execute()->fetchCol();
          if (count($nuid)) $nuid = $nuid[0]; else $nuid = 0;
          if ($did == $node->nid or $nuid == $node->uid) {
            print t('!username 加入 !category', array('!username' => $name, '!category' => l($bname, 'user/'.$buid[0].'/board/'.$bid)));
          } else {
            $nname = db_select('users')->fields('users', array('name'))->condition('uid', $nuid, '=')->execute()->fetchCol();
            if (count($nname)) $nname = $nname[0]; else $nname = '';
            print t('!username 通过 !ousername 加入 !category', array('!username' => $name, '!ousername' => l($nname, 'user/'.$nuid), '!category' => l($bname, 'user/'.$buid[0].'/board/'.$bid))); 
    }?>
        <?php } else { ?>
          <p><?php print $name; ?></p>
        <?php } ?>
    </div>
        <?php } else {?>
          <?php if ($url = strip_tags(render($content['field_url']))) { 
            $result = parse_url($url);
            $url = $result['host'];
          ?>  
          <div class="info_box"><a target="_blank" href="<?php print url($result['scheme'].'://'.$url); ?>"><?php print $url; ?></a></div>
          <?php } ?>
        <?php } ?>
    <?php print pinboard_get_comments(0, $node); ?> 
</div>   
<?php } else { ?>
<div class="body-pin">
    <?php print $user_picture; ?>
    <?php print $name; ?>
    <div class="actions" >
      <a href="<?php print url('repin/'.$node->nid); ?>">
        <img width="20" height="20" src="<?php print '/'.$directory.'/img/button-repin.png' ?>">
      </a>
    </div>
    <div class="stat">
      <?php $rateres = rate_get_results('node', $node->nid, 1); print '<span class="likesresult-'.$node->nid.'">'.format_plural($rateres['count'], '1 喜欢', '@count 喜欢').'</span>' ?>&nbsp;&nbsp;
      <?php if ($repins = pinboard_helper_repins_count($node)) { ?><?php print format_plural($repins, '1 repin', '@count repins') ?>&nbsp;&nbsp;<?php } ?>
      <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><?php print format_plural($node->comment_count, '1 comment', '@count comments') ?></a>&nbsp;&nbsp;<?php } ?>
    </div>
    <?php $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
        if (count($bid)) $bid = $bid[0]; else $bid = 0;
        $bname = db_select('pinboard_boards')->fields('pinboard_boards', array('name'))->condition('bid', $bid, '=')->execute()->fetchCol();
        $buid = db_select('pinboard_boards')->fields('pinboard_boards', array('uid'))->condition('bid', $bid, '=')->execute()->fetchCol();
        if (count($bname)) {
          $bname = $bname[0]; ?>
          <div class="info"><?php print t('!data 前添加到 !board', array('!data' => format_interval(time() - $node->created), '!board' => l($bname, 'user/'.$buid[0].'/board/'.$bid))); ?></div>
        <?php } else { ?>
      <div class="info"><?php print t('!data 前', array('!data' => format_interval(time() - $node->created))); ?></div>
    <?php } ?>
    <div class="pin-image">
        <?php print render($content['field_image']); ?>
    </div>
    <div class="pin-des">
        <?php print render($content['body']); ?>
    </div>
    <div class="clr"></div>
     <?php if ($url = strip_tags(render($content['field_url']))) { 
        print '<div class="pinsource">'.t('来源: !link',array('!link' => '<a target="_blank" href="'.url($url).'">'.pinboard_truncate_utf8($url, 80, FALSE, TRUE).'</a>')).'</div>';
      } ?>
    <?php hide($content['comments']); hide($content['links']); print render($content); ?>
    <div class="clr"></div>
   
    <div class="clr"></div> 
    <?php print render($content['comments']); ?>      
    <?php
      $view_name = 'pinned_onto_the_board';
      $display_id = 'block';
      if ($view = views_get_view($view_name)) {
        if ($view->access($display_id)) {
          $output = $view->execute_display($display_id);
          $view->destroy();
          if ($output['content']) {
            print '<div class="pin-block-category">';
            $viewargs = explode(',', $view->args[0]);
            if (empty($viewargs[0])) $viewargs[0] = 0;
            $viewurl = url('taxonomy/term/'.$viewargs[0]);
            print '<h5>'.t('同分类信息').'</h5><h4><a target="_blank" href="'.$viewurl.'">'.$output['subject'].'</a></h4>';
            print str_replace('!taxonomy_term', $viewurl, $output['content']);
            print '</div>';
          }
        }
        $view->destroy();
      }
    ?>

    <div class="clr"/>

    <?php if ($originally_pinned = pinboard_helper_originally_pinned($node)) { ?>
        <div class="pin-block-originally">
        <?php print '<h4><a target="_blank" href="'.url('user/'.$node->ph_uid).'">'.$node->ph_name.'</a></h4><h5>'.t('发表的信息').'</h5>'; ?>
        <a target="_blank" href="<?php print url('user/'.$node->ph_uid); ?>">
          <?php print $originally_pinned; ?>
        </a>
        </div>
    <?php } ?>
      
      
    <?php if ($pinned_onto = pinboard_helper_pinned_onto_board($node)) { ?>
        <div class="pin-block-board">
        <?php print '<h5>'.t('同板块的信息').'</h5><h4><a target="_blank" href="'.url('user/'.$node->uid.'/board/'.$node->ph_bid).'">'.$node->ph_bname.'</a></h4>'; ?>
        <a target="_blank" href="<?php print url('user/'.$node->uid.'/board/'.$node->ph_bid); ?>">
          <?php print $pinned_onto; ?>
        </a>
        </div>
    <?php } ?>     
</div>
<?php } ?>
</div>