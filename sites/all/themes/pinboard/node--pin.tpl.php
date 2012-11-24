<?php global $user, $base_url; ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
<?php if (!$page and !(arg(0) == 'comment' and arg(1) == 'reply')){ ?>
<div class="pin_box">
  <div class="pin_box_in clearfix">
    <div class="actions">
      <a class="pin_act repin_link" href="<?php print url('repin/'.$node->nid); ?>"><strong><?php print t('Repin'); ?></strong></a>
      <?php print str_replace('rate','like',render($content['rate_like'])); ?>
      <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a class="pin_act comment_link" href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><strong><?php print t('Comment') ?></strong></a><?php } ?>
    </div>
                            
    <div class="pin_image"><?php if ($field_price = render($content['field_price'])) print '<strong class="price">'.$field_price.'</strong>'; ?><?php print render($content['field_image']); ?><?php if ($field_embed = render($content['field_embed'])) print '<a href="'.$node_url.'" class="video"></a>'.$field_embed; ?></div>
    <script type = "text/javascript" >
    <!-- 
	    //document.write('<p class="accent">You\'re using ' + BrowserDetect.browser + ' ' + BrowserDetect.version + ' on ' + BrowserDetect.OS + '!</p>'); 
    // --> 
    </script>                        
    <div class="description"><?php hide($content['comments']); hide($content['links']); hide($content['field_url']); print render($content); ?></div>
    <div class="stats">
      
      <?php $rateres = rate_get_results('node', $node->nid, 1); print '<span class="likesresult-'.$node->nid.'">'.format_plural($rateres['count'], '1 喜欢', '@count 喜欢').'</span>' ?>&nbsp;&nbsp;
      <?php if ($repins = pinboard_helper_repins_count($node)) { ?><?php print format_plural($repins, '1 repin', '@count repins') ?>&nbsp;&nbsp;<?php } ?>
      <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><?php print format_plural($node->comment_count, '1 comment', '@count comments') ?></a>&nbsp;&nbsp;<?php } ?>
    </div>
      
      <?php if (arg(2) != 'board') { ?>
      <div class="info_box">
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
            print t('!username via !ousername onto !category', array('!username' => $name, '!ousername' => l($nname, 'user/'.$nuid), '!category' => l($bname, 'user/'.$buid[0].'/board/'.$bid))); 
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
    <?php //print '<pre>'. check_plain(print_r($content  , 1)) .'</pre>'; ?>
  </div>
</div>
<?php } else { ?>
<div class="p_zoom_cont">
  <div class="p_zoom_in clearfix">
    <div class="author_box">
      <?php $destination = drupal_get_destination(); 
      print '<div class="flr">';
      		if ($user->uid and $node->uid != $user->uid)
            if (pinboard_helper_isfollow ($node)) 
              print '<a href="'.url('unfollow/'.$node->uid, array('query' => $destination)).'">'.t('Unfollow').'</a>';
            else
              print '<a href="'.url('follow/'.$node->uid, array('query' => $destination)).'">'.t('Follow').'</a>';
      ?>
      <a class="pin_act repin_link" href="<?php print url('repin/'.$node->nid); ?>"><strong><?php print t('喜欢'); ?></strong></a>
    <?php if ($node->uid == $user->uid) { ?><a class="pin_act repin_link" href="<?php print url('node/'.$node->nid.'/edit'); ?>"><strong><?php print t('Edit'); ?></strong></a><?php } ?>
    </div>
      <?php print $user_picture; ?>	    
	    <p class="author_name"><?php print $name; ?></p>
	    <?php $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
    	  if (count($bid)) $bid = $bid[0]; else $bid = 0;
    		$bname = db_select('pinboard_boards')->fields('pinboard_boards', array('name'))->condition('bid', $bid, '=')->execute()->fetchCol();
    		$buid = db_select('pinboard_boards')->fields('pinboard_boards', array('uid'))->condition('bid', $bid, '=')->execute()->fetchCol();
    		if (count($bname)) {
    		  $bname = $bname[0]; ?>
          <p class="stats"><?php print t('Pinned !data ago onto !board', array('!data' => format_interval(time() - $node->created), '!board' => l($bname, 'user/'.$buid[0].'/board/'.$bid))); ?></p>
        <?php } else { ?>
	    <p class="stats"><?php print t('Pinned !data ago', array('!data' => format_interval(time() - $node->created))); ?></p>
	    <?php } ?>
    </div>
	
	  <div class="pin_image_container"><div class="pin_image_bg">
	    <?php if ($field_price = render($content['field_price'])) print '<strong class="price">'.$field_price.'</strong>'; ?>
      <?php if ($url = strip_tags(render($content['field_url']))) { ?>  
	      <a class="pin_image_link" target="_blank" href="<?php print url($url); ?>"><?php print render($content['field_image']); ?></a>
      <?php } else { ?>  
        <?php print render($content['field_image']); ?>
      <?php } ?>  
      <?php print render($content['field_embed']); ?>
	  </div></div>
	  <?php if ($blocksad = block_get_blocks_by_region('sidebar_ad')) {?>
	  <div class="pin_ad_container">
	   <?php print render($blocksad); ?>
	  </div>
		<?} ?>
		
	  <div class="p_zoom_bottom"> <!--BOTTOM-->
	  <div class="description">
      <?php if ($url = strip_tags(render($content['field_url']))) { 
        print '<div class="pinsource">'.t('Source: !link',array('!link' => '<a target="_blank" href="'.url($url).'">'.pinboard_truncate_utf8($url, 80, FALSE, TRUE).'</a>')).'</div>';
      } ?>
        <?php hide($content['comments']); hide($content['links']); print render($content); ?>
        <?php drupal_add_js('misc/collapse.js'); print '<fieldset class="collapsible collapsed form-wrapper" id="pin-flags"><legend><span class="fieldset-legend"><img src="'.$base_url.'/'.drupal_get_path('theme','pinboard').'/img/flag.png" />'.t('Report Pin').'</span></legend><div class="fieldset-wrapper">'.t(variable_get('user_mail_register_pinboard_helper_flag_text', PINBOARD_HELPER_FLAG_PIN_TEXT)).render(drupal_get_form('pinboard_helper_flag_form')).'</div></fieldset>'; ?>
      </div>
      
      <div class="clearfix">
        <?php if (!empty($content['links']) and false): ?>
          <div class="links"><?php print render($content['links']); ?></div>
        <?php endif; ?>    
      </div>
      <?php if (!(arg(0) == 'comment' and arg(1) == 'reply')){ ?>
      <?php print render($content['comments']); ?>
	    <?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>
	    
        <?php
          $view_name = 'pinned_onto_the_board';
          $display_id = 'block';
          if ($view = views_get_view($view_name)) {
            if ($view->access($display_id)) {
              $output = $view->execute_display($display_id);
              $view->destroy();
              if ($output['content']) {
                print '<div class="pinned_box zoom_info">';
                $viewargs = explode(',', $view->args[0]);
                if (empty($viewargs[0])) $viewargs[0] = 0;
                $viewurl = url('taxonomy/term/'.$viewargs[0]);
                print '<p class="title">'.t('Pinned onto the category').'</p><h3><a target="_blank" href="'.$viewurl.'">'.$output['subject'].'</a></h3>';
	              print str_replace('!taxonomy_term', $viewurl, $output['content']);
	              print '</div>';
	            }
            }
            $view->destroy();
          }
        ?>
        <?php //print '<pre>'. check_plain(print_r($view, 1)) .'</pre>'; ?>
	    
	    
	    <?php if ($originally_pinned = pinboard_helper_originally_pinned($node)) { ?>
	      <div class="pinned_by_box zoom_info">
	      <?php print '<p class="title">'.t('Originally pinned by').'</p><h3><a target="_blank" href="'.url('user/'.$node->ph_uid).'">'.$node->ph_name.'</a></h3>'; ?>
	      <a target="_blank" href="<?php print url('user/'.$node->ph_uid); ?>"><ul class="b_thumbs">
	        <?php print $originally_pinned; ?>
	      </ul></a>
	      </div>
	    <?php } ?>
	    
	    
     <?php if ($pinned_onto = pinboard_helper_pinned_onto_board($node)) { ?>
	      <div class="pinned_via_box zoom_info">
	      <?php print '<p class="title">'.t('Pinned onto the board').'</p><h3><a target="_blank" href="'.url('user/'.$node->uid.'/board/'.$node->ph_bid).'">'.$node->ph_bname.'</a></h3>'; ?>
	      <a target="_blank" href="<?php print url('user/'.$node->uid.'/board/'.$node->ph_bid); ?>"><ul class="b_thumbs">
	        <?php print $pinned_onto; ?>
	      </ul></a>
	      </div>
	    <?php } ?>
	    

     <?php if ($repins_users = pinboard_helper_repins_users_out($node)) { ?>
	      <div class="repins_box zoom_info">
	      <?php $count = pinboard_helper_repins_users_count($node);
	      print '<h3>'.t('!count Repins', array('!count' => $count)).'</h3>'; ?>
	      <ul class="b_thumbs">
	        <?php print $repins_users; ?>
	      </ul>
	      <?php $ecount = $count - 12;
	      print ($ecount > 0 ? '<p class="more_activity">'.t('<strong>+!count</strong> more repins', array('!count' => $ecount)).'</p>' : '');
	      ?>
	      </div>
	    <?php } ?>
	    
     <?php if ($like_box = pinboard_helper_like_box_out($node)) { ?>
	      <div class="like_box zoom_info">
	      <?php $count = pinboard_helper_like_box_count($node);
	      print '<h3>'.t('!count Likes', array('!count' => $count)).'</h3>'; ?>
	      <ul class="b_thumbs">
	        <?php print $like_box; ?>
	      </ul>
	      <?php $ecount = $count - 12;
	      print ($ecount > 0 ? '<p class="more_activity">'.t('<strong>+!count</strong> more likes', array('!count' => $ecount)).'</p>' : '');
	      ?>
	      </div>
	    <?php } ?>
      <?php } ?>
      <?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>	    
	  </div>
  </div>
</div>
<?php } ?>
</div>