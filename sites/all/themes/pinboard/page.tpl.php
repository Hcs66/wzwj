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
                            <div class="block block-block" id="block-block-7">
                                <a class="soc1" href="/rss.xml"></a>
                            </div>
                        </div>
                    </div>
                    <div class="center l">
                        <ul class="menu">
                            <?php if(!$user -> uid) { ?>
                            <li class="first leaf">
                                <a href="/user">登录</a>
                            </li>
                            <li class="last leaf">
                                <a href="/user/register">注册</a>
                            </li>
                            <?php } else { ?>
                            <li class="first leaf">
                                <a href="/youfollow">我的关注</a>
                            </li>
                            <li class="first leaf">
                                <a href="/user">我的页面</a>
                            </li>
                            <li class="last leaf">
                                <a href="/user/logout">退出</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="right">
                        <div class="region region-sidebar-top-left">
                            <div class="block block-system block-menu" id="block-system-navigation">
                                <ul class="menu">
                                    <li class="first leaf">
                                        <a title="" href="/content/about">关于</a>
                                    </li>
                                    <li class="last leaf">
                                        <a title="" href="/contact">联系我们</a>
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
                        <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo">
                            <img alt="<?php print $site_name; ?>" src="<?php print $base_url.'/'.drupal_get_path('theme','pinboard').'/logo.png' ?>" height="30px"/>
                        </a>
                    </div>
                    <div class="center">
                        <?php if($user -> uid) { ?>
                        <a href="/node/add/pin">+ 我要分享</a>
                        <?php } ?>
                    </div>
                    <div class="right">
                        <?php if ((arg(0) == 'taxonomy' and arg(1) == 'term')) { echo str_replace('>'.t('Category').'<','>'.t('Category').': '.$title.'<',render($page['sidebar_top_menu'])); } else {echo render($page['sidebar_top_menu']);} ?>
                        <div class="search-b">
                            <div class="region region-sidebar-top-right">
                                <div class="block block-block" id="block-block-5">
                                    <form id="views-exposed-form-search-page" action="/search/node" method="get" accept-charset="UTF-8">
                                        <div class="container-inline">
                                            <input name="" title="请输入您想搜索的关键字" class="form-text required" id="edit-body-value" type="text" size="30" maxlength="128" value="">
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
  <div class="tab-block"><!--会员页面-->
    <?php if (isset($messages)) { print $messages; } ?>
    <?php if($tabs) { print render($tabs); } ?>
  </div>
  <?php print render($page['content']); ?>

  <?php } elseif ($page['content']['system_main']['nodes'][$arg1]['#node']->type == 'pin') {
  if (empty($_GET['ovr']) or $_GET['ovr']=='0') { ?>
    <div class="node_pin_page"><!--正常pin页面-->
        <?php if (isset($messages)) { print $messages; } ?>
        <div class="left blog pin-node ">
            <?php print render($page['content']); ?>
            <!-- UJian Button BEGIN -->
            <div class="ujian-hook"></div>
            <script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js?uid=1714437"></script>
            <!-- UJian Button END -->
        </div>
        <div class="right">
            <div class="inn">
                <?php if (isset($page['sidebar_right'])) { echo render($page['sidebar_right']); } ?>
            </div>
        </div>
    </div>
  <?php } else{ ?>
    <div class="ovr"><!--弹出层-->
        <div class="node_pin_page blog">
            <div class="pin-node">
                <?php print render($page['content']); ?>
            </div>
        </div>
    </div>
    <?php } } else { ?>
  <div class="node_pin_page"><!--普通信息页面-->
    <div class="left pin-node">
        <?php if (isset($messages)) { print $messages; } ?>
        <div class="blog">
                <h3 class="form-title"><?php print $title; ?></h3>
            <?php print render($page['content']); ?>
        </div>
    </div>
    <div class="right">
        <div class="inn">
                <?php if (isset($page['sidebar_right'])) { echo render($page['sidebar_right']); } ?>
        </div>
    </div>
  </div>
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
                    <a href="http://www.themesnap.com/"></a>
                </div>
            </div>
        </div><!-- /#footer -->
        <div class="scroll_top" style="display: block;">
          <a href="#"><?php print t('返回 '); ?>
            <img width="20" height="20" src="<?php print '/'.$directory.'/img/button-up.png' ?>"></a></div>
            <?php } ?>
        <?php //print '<pre>'. check_plain(print_r($page['content'], 1)) .'</pre>'; ?>
        <div class="footer">
      <div class="inn">
        <div class="left">
            <div class="region region-footer-copyright">
                <div class="block block-block" id="block-block-1">
                    <p>© 2012 梧讲梧知&nbsp;&nbsp;<script src="http://s4.cnzz.com/stat.php?id=4796677&web_id=4796677&show=pic1" language="JavaScript"></script></p>
</p>
                </div>  
            </div> 
        </div>
        <div class="right">
          <a href="http://www.themesnap.com/"></a>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=1714437"></script> <!-- 如果已经过加载此行JS，即可不用重复加载 -->