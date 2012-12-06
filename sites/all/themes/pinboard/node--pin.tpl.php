<?php global $user, $base_url,$pager_page_array; ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?> >
<?php if (!$page and !(arg(0) == 'comment' and arg(1) == 'reply')){ ?>
<?php if($pager_page_array[0]==0 and arg(0) == 'node') { 
  if($node->node_index == 1) {?>
<div class="pin_box pin_top_box">
  <div class="inbox">
    <div class="pin_top"><h3>人气用户</h3></div>
    <?php print pinboard_helper_top_users(); ?>
  </div>
  <div class="inbox">
    <div class="pin_top"><h3>评论热榜</h3></div>
   <!-- UYAN HOT COMMENT BEGIN -->
    <div id="uyan_hotcmt_unit"></div>
    <!-- UYAN HOT COMMENT END -->
  </div>
  <div class="inbox pin_top_box_last">
    <div class="pin_top"><h3>热门专辑</h3></div>
    <?php print pinboard_helper_top_borads(); ?>
  </div>

</div>
<?php }} ?>

<div class="pin_box " index="<?php print $node->node_index; ?>">
  <div class="inbox"> 
    <div class="photo">
      <div class="action" >
        <!--<a class="repin" href="<?php print url('repin/'.$node->nid); ?>">顶</a>-->
        <?php print str_replace('rate','like',render($content['rate_like'])); ?>
        <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a class="comment" href="<?php print url("node/$node->nid", array('fragment' => 'uyan_frame')) ?>"><?php print t('Comment') ?></a><?php } ?>
      </div>
      <?php print render($content['field_image']); ?>
    </div>
    
    <div class="cont">
      <div class="stat">
        <?php $rateres = rate_get_results('node', $node->nid, 1); print '<span class="likesresult-'.$node->nid.'">'.format_plural($rateres['count'], '1 喜欢', '@count 喜欢').'</span>' ?>&nbsp;&nbsp;
        <a href="<?php print '/node/'.$node->nid.'#uyan_frame'; ?>" id="uyan_count_unit">0条评论</a></div>
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
            print t('!username 添加到 !category 专辑', array('!username' => $name, '!category' => l($bname, 'user/'.$buid[0].'/board/'.$bid)));
          } else {
            $nname = db_select('users')->fields('users', array('name'))->condition('uid', $nuid, '=')->execute()->fetchCol();
            if (count($nname)) $nname = $nname[0]; else $nname = '';
            print t('!username 通过 !ousername 添加到 !category 专辑', array('!username' => $name, '!ousername' => l($nname, 'user/'.$nuid), '!category' => l($bname, 'user/'.$buid[0].'/board/'.$bid))); 
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
</div>
<?php if(!($node->node_index % 10)) {
if($pager_page_array[0] % 2){ ?>
<div class="pin_box ">
  <div class="inbox">
<a href="http://fanbuxie.vancl.com/?source=wjwz168&sourcesuninfo=ad-0-1-93-0-2" target="_blank">
  <img src="http://union.vancl.com/adpics.aspx?source=wjwz168&sourcesuninfo=ad-0-1-93-0-2" width="200" height="200" border="0" /></a>
    </div>
  </div>
<?php } else { ?>
<div class="pin_box ">
  <div class="inbox">
<a href="http://www.vancl.com?source=wjwz168&sourcesuninfo=ad-0-1-15-0-1" target="_blank">
  <img src="http://union.vancl.com/adpics.aspx?source=wjwz168&sourcesuninfo=ad-0-1-15-0-1" width="200" height="200" border="0" /></a>
    </div>
  </div>
<?php } }?>
<?php } else { ?>
<div class="body-pin">
    <?php print $user_picture; ?>
    <?php print $name; ?>
    <div class="actions" >
      <!--<a href="<?php print url('repin/'.$node->nid); ?>">
        <img width="20" height="20" src="<?php print '/'.$directory.'/img/button-repin.png' ?>">
      </a>-->
      <?php if($user->uid and $node->uid != $user->uid){
        $destination = drupal_get_destination();
        $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
        if (count($bid)) $bid = $bid[0]; else $bid = 0;
        if(pinboard_helper_isfollow($node,$bid)){
      ?>
      <a href="<?php print url('unfollow/'.$node->uid, array('query' => $destination))?>">
          <img width="20" height="20" src="<?php print '/'.$directory.'/img/button-follow.png' ?>">
        取消关注</a>
      <?php } else { ?>
      <a href="<?php print url('follow/'.$node->uid, array('query' => $destination))?>">
      <img width="20" height="20" src="<?php print '/'.$directory.'/img/button-follow.png' ?>">
        关注</a>
      <?php } }?>
      <?php if ($node->uid == $user->uid) { ?><a href="<?php print url('node/'.$node->nid.'/edit'); ?>"><?php print t('Edit'); ?></a><?php } ?>
    </div>
    <div class="stat">
      <?php $rateres = rate_get_results('node', $node->nid, 1); print '<span class="likesresult-'.$node->nid.'">'.format_plural($rateres['count'], '1 喜欢', '@count 喜欢').'</span>' ?>&nbsp;&nbsp;
      <?php if ($repins = pinboard_helper_repins_count($node)) { ?><?php print format_plural($repins, '1 repin', '@count repins') ?>&nbsp;&nbsp;<?php } ?>
      <!-- UYAN COUNT BEGIN -->
<a href="<?php print $node->nid.'#uyan_frame'; ?>" id="uyan_count_unit">0条评论</a>
<!-- UYAN COUNT END -->
      <!--<?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><?php print format_plural($node->comment_count, '1 comment', '@count comments') ?></a>&nbsp;&nbsp;<?php } ?>-->
    </div>
    <?php $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
        if (count($bid)) $bid = $bid[0]; else $bid = 0;
        $bname = db_select('pinboard_boards')->fields('pinboard_boards', array('name'))->condition('bid', $bid, '=')->execute()->fetchCol();
        $buid = db_select('pinboard_boards')->fields('pinboard_boards', array('uid'))->condition('bid', $bid, '=')->execute()->fetchCol();
        if (count($bname)) {
          $bname = $bname[0]; ?>
          <div class="info"><?php print t('!data 前添加到 !board 专辑', array('!data' => format_interval(time() - $node->created), '!board' => l($bname, 'user/'.$buid[0].'/board/'.$bid))); ?></div>
        <?php } else { ?>
      <div class="info"><?php print t('!data 前', array('!data' => format_interval(time() - $node->created))); ?></div>
    <?php } ?>
    <div class="pin-category">
      <?php print render($content['field_category']); ?>
      <?php print render($content['field_tags']); ?>
    </div>
    <div class="pin-image">
      <h1><?php print render($content['field_title']); ?></h1>
        <?php print render($content['field_image']); ?>
    </div>
    <div class="pin-des">
        <?php print render($content['body']); ?>
    </div>
    <div class="clr"></div>
     <?php if ($url = strip_tags(render($content['field_url']))) { 
        print '<div class="pinsource">'.t('来源: !link',array('!link' => '<a target="_blank" href="'.url($url).'">'.pinboard_truncate_utf8($url, 80, FALSE, TRUE).'</a>')).'</div>';
      } ?>
    <?php hide($content['comments']); hide($content['field_url']); print render($content); ?> 
    <!-- UY BEGIN -->
    <div id="uyan_frame"></div>
    <script type="text/javascript" id="UYScript" src="http://v1.uyan.cc/js/iframe.js?UYUserId=1714437" async=""></script>
    <!-- UY END -->
    <div class="clr"></div>
   
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
        <?php print '<h5>'.t('同专辑的信息').'</h5><h4><a target="_blank" href="'.url('user/'.$node->uid.'/board/'.$node->ph_bid).'">'.$node->ph_bname.'</a></h4>'; ?>
        <a target="_blank" href="<?php print url('user/'.$node->uid.'/board/'.$node->ph_bid); ?>">
          <?php print $pinned_onto; ?>
        </a>
        </div>
    <?php } ?> 
        <div class="clr"></div>    
</div>
<?php } ?>
</div>