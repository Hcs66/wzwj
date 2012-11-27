<?php print render($page['header']); 
global $base_url;
if (arg(1)) $arg1 = arg(1); else $arg1 = 0;
if (!isset($page['content']['system_main']['nodes'][$arg1]['#node']->type)) $page['content']['system_main']['nodes'][$arg1]['#node']->type = '';
?>
<div id="page-wrapper" class="pin_page"><div id="page">

  <div id="header"><div class="section clearfix">
    <div id="logo_bar">
      <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" /></a>
    </div>
    <div id="top_menu_bar">
      <?php echo render($page['sidebar_top_left']); ?>
    </div> <!-- /#top_menu_bar-menu -->
    <div id="search_form_bar">
      <?php echo render($page['sidebar_top_right']); ?>
    </div> <!-- /#search_form_bar -->  
    <div class="right_bottons">
      <ul class="menu">
      <?php if ($user->uid) { ?> 
      <li class="first leaf"><a href="<?php echo url('user/'.$user->uid); ?>"><?php echo t('My account'); ?></a></li>
      <li class="last leaf"><a href="<?php echo url('user/logout'); ?>"><?php echo t('Log out'); ?></a></li>
      <?php } else { ?>
      <li class="first leaf"><a href="<?php echo url('user'); ?>"><?php echo t('Log in'); ?></a></li>
      <li class="last leaf"><a href="<?php echo url('user/register'); ?>"><?php echo t('Register'); ?></a></li>
      <?php } ?>
      </ul>
    </div>
  </div></div> <!-- /.section, /#header -->

  <div id="top_menu_subj_bar"><div class="section clearfix">
    <?php if ((arg(0) == 'taxonomy' and arg(1) == 'term')) { echo str_replace('>'.t('Category').'<','>'.t('Category').': '.$title.'<',render($page['sidebar_top_menu'])); } else {echo render($page['sidebar_top_menu']);} ?> 
  </div></div> <!-- /.section /#top_menu_subj_bar -->
  <?php if ($welcome = render($page['sidebar_welcome'])) { echo '<div id="sidebar_welcome">'.$welcome.'</div>'; } ?>
  <?php if (
    (arg(0) == 'node' and !arg(1)) or
    (arg(0) == 'taxonomy' and arg(1) == 'term') or
    (arg(0) == 'popular') or
    (arg(0) == 'video') or
    (arg(0) == 'gifts') or
    (arg(0) == 'youfollow')
  ) { ?>
  <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix">
    <div id="content" class="column container1"><div class="section">
      <?php if (isset($messages)) { print $messages; } ?>
      <?php if($tabs and false) { print render($tabs); } ?>
      <div class="region region-content">
        <div id="block-system-main" class="block block-system">
          <div class="content"><div class="">
            <?php print render($page['content']); ?>
          </div></div>
        </div>
      </div>
    </div></div> <!-- /.section, /#content -->
  </div></div> <!-- /#main, /#main-wrapper -->
  <?php } elseif (
    (arg(0) == 'user' and is_numeric(arg(1)) and (!arg(2) or arg(2) == 'board' or arg(2) == 'followers' or arg(2) == 'following'))
  ) { ?>
  <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix container">
    <?php if (isset($messages)) { print $messages; } ?>
    <?php if($tabs) { print render($tabs); } ?>
    <?php print render($page['content']); ?>
  </div></div> <!-- /#main, /#main-wrapper -->
  <?php } elseif ($page['content']['system_main']['nodes'][$arg1]['#node']->type == 'pin') { ?>
  <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix container">	
    <div id="content" class="twelve columns"><div class="section">
      <?php if (isset($messages)) { print $messages; } ?>
      <?php if($tabs) { print render($tabs); } ?>
      <div class="region region-content">
        <?php print render($page['content']); ?>
      </div>
    </div></div> <!-- /.section, /#content -->
    
    <div id="sidebar-second" class="four columns">
      <div class="section">
        <div class="region region-sidebar-second">
          <?php if (isset($page['sidebar_right'])) { echo render($page['sidebar_right']); } ?>
        </div>
	    </div>
    </div>  
  </div></div> <!-- /#main, /#main-wrapper -->
  <?php } else { ?>
  <div id="main-wrapper" class="clearfix"><div id="main" class="clearfix container">	
    <div id="content" class="twelve columns"><div class="section">
      <?php if (isset($messages)) { print $messages; } ?>
      <?php if($tabs) { print render($tabs); } ?>
      <div class="region region-content white-bg">
        <h3><?php print $title; ?></h3>
        <?php print render($page['content']); ?>
	<div class="clearfix"></div>
      </div>
    </div></div> <!-- /.section, /#content -->
    
    <div id="sidebar-second" class="four columns">
      <div class="section">
        <div class="region region-sidebar-second">
          <?php if (isset($page['sidebar_right'])) { echo render($page['sidebar_right']); } ?>
        </div>
	    </div>
    </div>  
  </div></div> <!-- /#main, /#main-wrapper -->
  <?php } ?>

  <div id="footer-wrapper" class="section "><div class="section container sixteen columns">
    <div class="clearfix" id="footer">
      <div class="region region-footer">
        <?php if (isset($page['footer_menu'])) { echo render($page['footer_menu']); } ?>
        <div class="copyright left"><?php if (isset($page['footer_copyright'])) { echo render($page['footer_copyright']); } ?></div>
        <div class="copyright right"><a href="http://www.themesnap.com/">Drupal theme by ThemeSnap.com</a></div>
      </div>
    </div> <!-- /#footer -->    
  </div></div>

</div></div> <!-- /#page, /#page-wrapper -->

<div class="scroll_top"><a class="button" href="#"><?php print t('Scroll to top'); ?></a></div>

<?php //print '<pre>'. check_plain(print_r($page['content'], 1)) .'</pre>'; ?>