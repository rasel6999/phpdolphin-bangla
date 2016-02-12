<?php

 

function sidebar($values) {

global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings, $plugins;
 

$bst = time() - 1*60*60;






		 
$sql="SELECT idu,image,username,first_name,last_name FROM users where online>'$bst' ORDER BY online DESC LIMIT 0,100 ";
 
$TMPL['friendsactivitys'].='<div class="sidebar-header">'.$LNG['user_Online'].'</div><div class="sidebar-fa-content scrollable">';




  if ($result=mysqli_query($db,$sql))
  { 

  while ($row=mysqli_fetch_row($result))
    {
if(($currentTime - $row['online']) > $bst) {
						$icon = 'offline';
					} else {
						$icon = 'online';
					}



 

 $button .=' <div class="notification-padding"><div class="sidebar-users"><a onclick="openChatWindow(\''.$row[0].'\', \''.$row[2].'\', \''.addslashes(realName($row[2], $row[3], $row[4])).'\', \''.$CONF['url'].'\', \''.$CONF['url'].'/'.$CONF['theme_url'].'/images/icons/'.$icon.'.png\')"><img src="'.$CONF['url'].'/'.$CONF['theme_url'].'/images/icons/'.$icon.'.png" class="sidebar-status-icon"><img src="'.$CONF['url'].'/thumb.php?src='.$row[1].'&w=25&h=25&t=a"> '.realName($row[2], $row[3], $row[4]).'</a></div></div> ';
    }  
}  

$TMPL['friendsactivitys'].="$button";

$TMPL['friendsactivitys'].= ' </div>';

##############online record##################
 $TotalRcount = $result->num_rows;

$female_total="SELECT idu FROM users where online>'$bst' AND gender='2' ";
$female_total=mysqli_query($db,$female_total);
$female_total = $female_total->num_rows;


$male_total="SELECT idu FROM users where online>'$bst' AND ( gender='1' or gender='0')";
$male_total=mysqli_query($db,$male_total);
$male_total = $male_total->num_rows;

 /*
$staff_total="SELECT count(*) FROM users where online>'$bst' ";
$staff_total=mysqli_query($db,$staff_total);



*/

################################################

$TMPL['friendsactivitys'].= ' <div class="sidebar-header">'.$LNG['more_Online'].'</div><div class="notification-padding"><b>'.$LNG['total_Online'].'</b> '.$TotalRcount.'</div>   <div class="notification-padding"> <b>'.$LNG['male_Online'].'</b> '.$male_total.'</div>   <div class="notification-padding"><b>'.$LNG['female_Online'].'</b> '.$female_total.'</div><div class="notification-padding"><b>'.$LNG['staff_Online'].'</b> '.$staff_total.'</div>  <div class="notification-padding"><b>'.$LNG['latest_user'].'</b> <a>rdx rasel</a></div>';









$re='<link href="'.$CONF['url'].'/plugins/sidebar/sidebar.css" rel="stylesheet" type="text/css"><script type="text/javascript">$(function(){if((screen.width<=640||window.matchMedia&&window.matchMedia("only screen and (min-width: 640px)").matches)&&$(".widget-friends-activity").offset()){var i=$(".widget-friends-activity").offset().top;$(window).scroll(function(){var t=$(window).scrollTop();t>i?$(".widget-friends-activity").css({width:"20%",position:"fixed",top:"46px"}):$(".widget-friends-activity").css({width:"98%",position:"relative",top:"1px"})})}});</script><div id="rdxsidebar" class="rdxsidebar" >
'.$TMPL['friendsactivitys'].' </div>';




return $re; 
}
?>
