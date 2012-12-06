<?php
// $Id$
global $base_url, $language;
//drupal_set_message('<pre>'. check_plain(print_r($language, 1)) .'</pre>');
/*drupal_add_css(path_to_theme().'/type/'.theme_get_setting('tm_value_4').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));*/
drupal_add_css(path_to_theme().'/color/'.theme_get_setting('tm_value_3').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
drupal_add_js('misc/form.js');
drupal_add_js('misc/collapse.js');
drupal_add_js('
jQuery(document).ready(function($) {
	  function getScrollTop() {
    var scrOfY = 0;
    if( typeof( window.pageYOffset ) == "number" ) {
      //Netscape compliant
      scrOfY = window.pageYOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
      //DOM compliant
      scrOfY = document.body.scrollTop;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
      //IE6 Strict
      scrOfY = document.documentElement.scrollTop;
    }
    return scrOfY;
  }
  
  function fixPaneRefresh(){
    if ($(".header").length) {
      var top  = getScrollTop();
      if (top > $(".top").height() && !(tablet || mobile)) {
        if (!$(".header").hasClass("top48")) {
          $(".header").addClass("top48");
          $(".main").css("margin-top", $(".top").height() + $(".nav").height() + 29 + "px");
          $(".header").css("position","fixed");
          $(".header").css("top","0");
          $(".top").css("display","none");
          
        }
      } else {
        if ($(".header").hasClass("top48")) {
          $(".header").removeClass("top48");
          $(".top").css("display","block");
          $(".header").css("position","static");
          $(".header").css("top","0");
          $(".main").css("margin-top","0px");
        }
      }
    }
  }  

	
	// Media types
	jQuery(window).resize(function() {
		windowWidth = jQuery(window).width();
		lteTablet = windowWidth < 980;
		lteMobile = windowWidth < 767;
		lteMini   = windowWidth < 479;
		gteDektop = windowWidth >= 980;
		gteTablet = windowWidth >= 767;
		gteMobile = windowWidth >= 479;
		tablet    = lteTablet && gteTablet;
		mobile    = lteMobile && gteMobile;
	}).trigger(\'resize\');


	

	  jQuery(\'.nav .menu li.expanded\').mouseover(function() {
		if (!jQuery(this).hasClass(\'active\') && !(tablet || mobile)) {
			jQuery(\'.nav .menu li.expanded\').removeClass(\'active\');
			jQuery(this).addClass(\'active\');
			jQuery(\'.nav .menu li.expanded\').find(\'ul.menu\').fadeOut();
			var activeTab = jQuery(this).find(\'ul.menu\');
			jQuery(activeTab).fadeIn();
		  return false;
		}
	});
	jQuery(\'.nav .menu li\').mouseleave(function() {
		if (jQuery(this).hasClass(\'active\') && !(tablet || mobile)) {
			jQuery(\'.nav .menu li.expanded\').removeClass(\'active\');
			jQuery(\'.nav .menu li.expanded\').find(\'ul.menu\').fadeOut();
		  return false;
		}
	});
  
	// Navigation main
	jQuery(\'.nav .menu li.expanded:has(ul)\').click(function(e) {
	if ((tablet || mobile) && e.pageX - jQuery(this).offset().left >= jQuery(this).width() - 45) {
			jQuery(\'> ul\', this).slideToggle(300);
			return false;
		}
	});

	
});

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

function checkBrowser() {  							
if (BrowserDetect.OS == \'Windows\' || 
    BrowserDetect.OS == \'Mac\' || 
    BrowserDetect.OS == \'iPhone/iPod\' ||
    (BrowserDetect.OS == \'Linux\' && BrowserDetect.browser != \'Mozilla\' && BrowserDetect.version != \'unknown\') ||
    (BrowserDetect.browser == \'Firefox\')
   ) {return true;} else {return false;}
}

function strpos( haystack, needle, offset){
	var i = haystack.indexOf( needle, offset );
	return i >= 0 ? i : false;
}

var oldurlpin = \'\';
function checkHash() {  							
  hash=window.location.pathname;
  //alert (hash);
  if (oldurlpin != hash) {
    (function ($) {
      jQuery(\'.overlay\').remove();
      jQuery("body").removeClass(\'no_scroll\');
      oldurlpin = \'\';
    })(jQuery);
  //alert (\'1\');
  } else {
    setTimeout("checkHash()",100);
  }
}

function frameFitting() {
    if (document.getElementById(\'pin_iframe\') && document.getElementById(\'pin_iframe\').contentWindow.document.body) {
      var h = 100;
      if (BrowserDetect.browser == \'Safari\' || BrowserDetect.browser == \'Chrome\') h = 0;
      document.getElementById(\'pin_iframe\').height = document.getElementById(\'pin_iframe\').contentWindow.document.body.scrollHeight+h+\'px\'; 
    }
    setTimeout("frameFitting()",500);
}

            
(function ($) {



if (checkBrowser()) {
//SCROLL TOP

jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop()) {
        jQuery(\'.scroll_top\').stop(true, true).fadeIn();
    } else {
        jQuery(\'.scroll_top\').stop(true, true).fadeOut();
    }
});
}

jQuery(document).ready(function(){
//PIN IMAGE CLICK

    function pin_image_click(a){
    
      hash=window.location.pathname;
      if (oldurlpin != hash) {
        var atr_link = jQuery(this).attr(\'href\');
        var html_to_prepend = \'<div class="overlay"><div class="pin_container"><div class="close_icon"></div><iframe id="pin_iframe" frameborder="0" scrolling="no" allowtransparency="true"></iframe></div></div>\';
        jQuery(\'body\').prepend(html_to_prepend);
        if (strpos(\'?\',atr_link) > 1) {atr_linkk = atr_link + \'&ovr=1\'} else {atr_linkk = atr_link + \'?ovr=1\'}
        var miframe = document.getElementById(\'pin_iframe\');
        miframe.src = atr_linkk; 
        
        jQuery(\'body\').addClass(\'no_scroll\'); //body no scrolling
        history.pushState(null,null,window.location.protocol + \'//\' + window.location.hostname + atr_link);
        oldurlpin=window.location.pathname;
        setTimeout(\'checkHash()\',500);
        setTimeout(\'frameFitting()\',1000);
      }
      
      return false;                  
    }


    var $container = jQuery(\'.pin_page:has(.pin_box)\');
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: \'.pin_box\',
        columnWidth: 0
        '.($language->direction ? ', isRTL: 1' : '').'
      });
    });   
    $container.infinitescroll({
      navSelector  : \'ul.pager\',    // selector for the paged navigation 
      nextSelector : \'ul.pager .pager-next a\',  // selector for the NEXT link (to page 2)
      itemSelector : \'.pin_box\',     // selector for all items you\'ll retrieve
      loading: {
          finishedMsg: \''.t('暂时没有更多信息了.').'\',
          img: \'http://5jiang5zhi.com/sites/all/themes/pinboard/img/load.gif\',
          msgText:\'正在努力加载内容\',
          finishedMsg:\'加载完成\'
        }
      }
      ,
      // trigger Masonry as a callback
      
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = jQuery( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they\'re ready
          window.a_second++;
          $newElems.addClass(\'second_\'+a_second);
          $newElems.animate({ opacity: 1 });
          $container.masonry( \'appended\', $newElems, true );

          
          jQuery(\'.like-widget:not(.like-processed)\').addClass(\'like-processed\').each(function () {
            var widget = jQuery(this);
            var ids = widget.attr(\'id\').match(/^like\-([a-z]+)\-([0-9]+)\-([0-9]+)\-([0-9])$/);
            var data = {
              content_type: ids[1],
              content_id: ids[2],
              widget_id: ids[3],
              widget_mode: ids[4]
            };

            jQuery(\'a.like-button\', widget).click(function() {
              var token = this.getAttribute(\'href\').match(/like\=([a-zA-Z0-9\-_]{32,64})/)[1];
              return Drupal.likeVote(widget, data, token);
            });
          });

          jQuery(\'.pin_box .inbox\').mouseover(function() {
            if (!jQuery(this).hasClass(\'active\')) {
              jQuery(\'.pin_box .inbox\').removeClass(\'active\');
              jQuery(this).addClass(\'active\');
              jQuery(\'.pin_box .inbox .action\').fadeOut();
              var activeTab = jQuery(this).find(\'.action\');
              jQuery(activeTab).fadeIn();
              return false;
            }
          });

          jQuery(\'.pin_box .inbox\').mouseleave(function() {
            if (jQuery(this).hasClass(\'active\')) {
              jQuery(\'.pin_box .inbox\').removeClass(\'active\');
              jQuery(\'.pin_box .inbox .action\').fadeOut();
              return false;
            }
          });

      
        });
      }
    );

    if (checkBrowser()){ 

      jQuery(\'.pin_box .inbox\').mouseover(function() {
        if (!jQuery(this).hasClass(\'active\')) {
          jQuery(\'.pin_box .inbox\').removeClass(\'active\');
          jQuery(this).addClass(\'active\');
          jQuery(\'.pin_box .inbox .action\').fadeOut();
          var activeTab = jQuery(this).find(\'.action\');
          jQuery(activeTab).fadeIn();
          return false;
        }
      });

      jQuery(\'.pin_box .inbox\').mouseleave(function() {
        if (jQuery(this).hasClass(\'active\')) {
          jQuery(\'.pin_box .inbox\').removeClass(\'active\');
          jQuery(\'.pin_box .inbox .action\').fadeOut();
          return false;
        }
      });
    }


  });
 
})(jQuery);

', array('type' => 'inline',  'scope' => 'footer', 'weight' => 1));

function pinboard_get_comments($pid, $node) {
	$out = '';
  $i = 4;
  $comments = comment_load_multiple(array(), array('pid' => $pid, 'nid' => $node->nid));
  $j = count($comments);
  if($j>0){
    $out.='<div class="comment" style="text-align:center;min-height:15px;color:#336699;">评论</div>';
  }
  foreach ($comments as $com) {
    $comment = comment_view($com, $node);
		$out .= '<div class="comment">'.theme('user_picture', array('account' => $comment['#comment'])).''.theme('username', array('account' => $comment['#comment'])).' '.pinboard_truncate_utf8(strip_tags(render($comment['comment_body'])),200, true, true).'</div>';

    if (!$i) { 
      if ($j > 5) { 
         $out .= '<div class="comment"><a href="'.url("node/$node->nid", array('fragment' => 'comment-form')).'">'.t('查看所有 !count 个评论...', array('!count' => $j)).'</a></div>';
      }
      return $out;
    }
    $i--;
//    unset($comment['comment_body']);
//    unset($comment['links']);
//    $out .= '<pre>'. check_plain(print_r($comment[], 1)) .'</pre>';
	}	
  return $out;
} 

/**
 * Preprocess function for the thumbs_up_down template.
 */
function pinboard_preprocess_rate_template_thumbs_up(&$variables) {
  extract($variables);

  $variables['up_button'] = theme('rate_button', array('text' => t('喜欢'), 'href' => $links[0]['href'], 'class' => 'rate-thumbs-up-btn-up'));

  $info = array();
  if ($mode == RATE_CLOSED) {
    $info[] = t('投票已结束.');
  }
  if ($mode != RATE_COMPACT && $mode != RATE_COMPACT_DISABLED) {
    if (isset($results['user_vote'])) {
      $info[] = format_plural($results['count'], '@count 喜欢', '@count 喜欢');
    }
    else {
      $info[] = format_plural($results['count'], '@count 喜欢', '@count 喜欢');
    }
  }
  $variables['info'] = implode(' ', $info);
}


function pinboard_truncate_utf8($string, $len, $wordsafe = FALSE, $dots = FALSE, &$ll = 0) {

  if (drupal_strlen($string) <= $len) {
    return $string;
  }

  if ($dots) {
    $len -= 4;
  }

  if ($wordsafe) {
    $string = drupal_substr($string, 0, $len + 1); // leave one more character
    if ($last_space = strrpos($string, ' ')) { // space exists AND is not on position 0
      $string = substr($string, 0, $last_space);
      $ll = $last_space;
    }
    else {
      $string = drupal_substr($string, 0, $len);
	  $ll = $len;
    }
  }
  else {
    $string = drupal_substr($string, 0, $len);
	$ll = $len;
  }

  if ($dots) {
    $string .= '...';
  }

  return $string;
}

/*function pinboard_preprocess_page(&$vars) {
    // HACK: Use custom 403 and 404 pages
    if (strpos(drupal_get_headers(), '403 Forbidden') !== FALSE) {
        $vars['template_files'][] = "page-403";
    }
    if (strpos(drupal_get_headers(), '404 Not Found') !== FALSE) {
        $vars['template_files'][] = "page-404";
    }
}*/


