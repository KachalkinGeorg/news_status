<?php


// Protect against hack attempts
if (!defined('NGCMS')) die ('HAL');

class NewsStatusFilter extends NewsFilter {
    function showNews($newsID, $SQLnews, &$tvars, $mode = array()) {
	global $config, $mysql;

	$row = $mysql->record("select * from " . prefix . "_news where id = " . db_squote($newsID)." LIMIT 1");
	
	$b=date('Y.m.d');
	$date=LangDate('Y.m.d', $row['postdate']);;

		if ($date == $b) {
			$news_status = '<span style="color:#F00">New!</span>';
		}
		elseif ($date == $b-1) {
			$news_status = '<span style="color:#0F0">New!</span>';
		}
		elseif ($date == $b-2) {
			$news_status = '<span style="color:#FF0">New!</span>';
		}
		else {
			$news_status = '&nbsp;';
		}
		
	$tvars['vars']['news_status'] = $news_status;
	
	}
}
register_filter('news','news_status', new NewsStatusFilter);
?>