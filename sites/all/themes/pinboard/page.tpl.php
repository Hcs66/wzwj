<?php print render($page['header']); 
global $base_url;
if (arg(1)) $arg1 = arg(1); else $arg1 = 0;
if (!isset($page['content']['system_main']['nodes'][$arg1]['#node']->type)) $page['content']['system_main']['nodes'][$arg1]['#node']->type = '';
?>
     <?php if (empty($_GET['ovr']) or $_GET['ovr']=='0') 
     { ?>             
        <div class="header">
            <div class="top">
                <div class="inn">
                    <div class="left soc">
                        <div class="region region-sidebar-top-button">
                        </div>
                    </div>
                    <div class="center">
                        <ul class="menu">
                            <li class="first leaf">
                                <a href="/user">Log in</a>
                            </li>
                            <li class="last leaf">
                                <a href="/register">Register</a>
                            </li>
                        </ul>
                    </div>
                    <div class="right">
                        <div class="region region-sidebar-top-left">
                            <div class="block block-system block-menu" id="block-system-navigation">
                                <ul class="menu">
                                    <li class="first leaf">
                                        <a title="" href="/content/about">About</a>
                                    </li>
                                    <li class="leaf">
                                        <a title="" href="/addpinit">"Pin It" Button</a>
                                    </li>
                                    <li class="last leaf">
                                        <a title="" href="/contact">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav">
                <div class="inn">
                    <div class="left">
                        <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo"></a>
                    </div>
                    <div class="center">
                        <a href="/theme-demos/pinboard/user">+ Add</a>
                    </div>
                    <div class="right">
                        <?php if ((arg(0) == 'taxonomy' and arg(1) == 'term')) { echo str_replace('>'.t('Category').'<','>'.t('Category').': '.$title.'<',render($page['sidebar_top_menu'])); } else {echo render($page['sidebar_top_menu']);} ?>
                        <div class="or-b">
                            or
                        </div>
                        <div class="search-b">
                            <div class="region region-sidebar-top-right">
                                <div class="block block-block" id="block-block-5">
                                    <form id="views-exposed-form-search-page" action="/theme-demos/pinboard/search" method="get" accept-charset="UTF-8">
                                        <div class="container-inline">
                                            <input name="s" class="form-text required" id="edit-body-value" type="text" size="30" maxlength="128" value="">
                                            <div id="edit-actions">
                                                <input class="form-submit" id="edit-submit-search" type="submit" value="Apply">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
       <?php }?>
        <div id="main">
            <div class="top-content-block">
                <?php if ($welcome = render($page['sidebar_welcome'])) { echo '<div id="sidebar_welcome">'.$welcome.'</div>'; } ?>
            </div>
            <?php if (
                    (arg(0) == 'node' and !arg(1)) or
                    (arg(0) == 'taxonomy' and arg(1) == 'term') or
                    (arg(0) == 'popular') or
                    (arg(0) == 'video') or
                    (arg(0) == 'gifts') or
                    (arg(0) == 'youfollow')
                  ) { ?>
            <div class="pin_page">
                <?php if (isset($messages)) { print $messages; } ?><?php if($tabs and false) { print render($tabs); } ?>
                        <div class="content">
                            <div class="">
                                <?php print render($page['content']); ?>
                            </div>
                        </div>
            </div>
              <?php } elseif (
    (arg(0) == 'user' and is_numeric(arg(1)) and (!arg(2) or arg(2) == 'board' or arg(2) == 'followers' or arg(2) == 'following'))
  ) { ?>
  <div id="main-wrapper" class="clearfix-1"><div id="main" class="clearfix container">
    <?php if (isset($messages)) { print $messages; } ?>
    <?php if($tabs) { print render($tabs); } ?>
    <?php print render($page['content']); ?>
  </div></div> <!-- /#main, /#main-wrapper -->
  <?php } elseif ($page['content']['system_main']['nodes'][$arg1]['#node']->type == 'pin') { ?>
  <div class="ovr">
    <div class="node_pin_page">
        <div class="pin-node">
            <?php print render($page['content']); ?>
        </div>
    </div>
  </div>
  <?php } else { ?>
  <div id="main-wrapper" class="clearfix-3"><div id="main" class="clearfix container">  
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
        </div><!-- /main-->
     <?php if (empty($_GET['ovr']) or $_GET['ovr']=='0') 
     { ?>  
        <div id="footer">
            <div class="region region-footer">
                <?php if (isset($page['footer_menu'])) { echo render($page['footer_menu']); } ?>
                <div class="copyright left">
                    <?php if (isset($page['footer_copyright'])) { echo render($page['footer_copyright']); } ?>
                </div>
                <div class="copyright right">
                    <a href="http://www.themesnap.com/">Drupal theme by ThemeSnap.com</a>
                </div>
            </div>
        </div><!-- /#footer -->
        <div class="scroll_top" style="display: block;">
          <a href="#"><?php print t('返回 '); ?>
            <img width="20" height="20" src="http://www.themesnap.com/theme-demos/pinboard/sites/all/themes/pinboard2/img/button-up.png"></a></div>
            <?php } ?>
        <?php //print '<pre>'. check_plain(print_r($page['content'], 1)) .'</pre>'; ?>