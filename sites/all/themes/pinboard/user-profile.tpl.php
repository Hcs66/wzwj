<?php global $base_url; 
if (arg(1)) {
  $acc = user_load(arg(1));
}
$destination = drupal_get_destination();

?>
<div class="top-profile-block">
  <div class="left">
    <?php print str_replace(array('s=50','user_picture'),array('s=192','user_picture_big','width="192"',''),render($user_profile['user_picture'])); ?>
  </div>
  <div class="center">
    <h1><?php print $acc->name; ?></h1>
    <div class="stat">
      <a href="<?php print url('user/'.$acc->uid.'/followers'); ?>"><?php print pinboard_helper_count_followers($acc->uid);?><span> <?php print t('followers');?></span></a>,
      <a href="<?php print url('user/'.$acc->uid.'/following'); ?>"><?php print pinboard_helper_count_following($acc->uid);?><span> <?php print t('following');?></span></a>
    </div>
    <div class="actions">
      <a href="<?php print url('user/'.$acc->uid.'/board'); ?>"><?php print t('查看所有发表的信息'); ?></a>
      <a href="<?php print url('user/'.$acc->uid.'/feed.rss'); ?>"><?php print t('订阅RSS'); ?></a>
    </div>
  </div>
</div>
<div class="clr"/>
<?php print pinboard_helper_userpage_pins (); ?>
<?php 

//unset($user_profile['field_about']);
//unset($user_profile['user_picture']);
//unset($user_profile['field_name']);
//unset($user_profile['userpoints']);
//unset($user_profile['field_location']);
//unset($user_profile['field_url']);
//unset($user_profile['summary']);
//unset($user_profile['simplenews']);
//unset($user_profile['field_birthdayu']);
//print '<div class="user_profile_main"><pre>'. check_plain(print_r($user, 1)) .'</pre></div>'; 

?>