<?php

/*
Name: Animated Additional Group Images
Author: Destroy666
Version: 1.2
Requirements: Plugin Library
Info: Plugin for MyBB forum software, coded for versions 1.8.x (may also work in 1.6.x/1.4.x after some changes).
It displays additional group images in postbit/memberlist/profile by using a "carousel" JS.
3 new templates, 5 template edits, 7 new settings
Released under GNU GPL v3, 29 June 2007. Read the LICENSE.md file for more information.
Support: official MyBB forum - http://community.mybb.com/mods.php?action=profile&uid=58253 (don't PM me, post on forums)
Bug reports: my github - https://github.com/Destroy666x

© 2015 - date("Y")
*/

if(!defined('IN_MYBB'))
{
	die('What are you doing?!');
}

// PluginLibrary for new templates
if(!defined('PLUGINLIBRARY'))
{
    define('PLUGINLIBRARY', MYBB_ROOT.'inc/plugins/pluginlibrary.php');
}

function animated_additional_images_info()
{
    global $db, $lang;
	
	$lang->load('animated_additional_images_acp');
	
	// Plugin Library notice
	$animated_additional_images_pl = '';
	if(!file_exists(PLUGINLIBRARY))
		$animated_additional_images_pl = $lang->pluginlibrary_missing.'<br />';
	
	// Configuration link
	$animated_additional_images_cfg = '<br />';
	$gid = $db->fetch_field($db->simple_select('settinggroups', 'gid', "name='animated_additional_images'"), 'gid');
	
	if($gid)
		$animated_additional_images_cfg = '<a href="index.php?module=config&amp;action=change&amp;gid='.$gid.'">'.$lang->configuration.'</a>
<br />
<br />';
	
	return array(
		'name'			=> $lang->animated_additional_images,
		'description'	=> $lang->animated_additional_images_info.'<br />
'.$animated_additional_images_pl.$animated_additional_images_cfg.'
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ZRC6HPQ46HPVN">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif" style="border: 0;" name="submit" alt="Donate">
<img alt="" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" style="border: 0; width: 1px; height: 1px;">
</form>',
		'website'		=> 'https://github.com/Destroy666x',
		'author'		=> 'Destroy666',
		'authorsite'	=> 'https://github.com/Destroy666x',
		'version'		=> 1.2,
		'codename'		=> 'animated_additional_images',
		'compatibility'	=> '18*'
    );
}

function animated_additional_images_activate()
{ 
	global $db, $lang;
	
	$lang->load('animated_additional_images_acp');
	
	// Modify templates
	require_once MYBB_ROOT.'/inc/adminfunctions_templates.php';
	find_replace_templatesets('headerinclude', '#'.preg_quote('general.js?ver=').'([A-Za-z0-9_]*)'.preg_quote('"></script>').'#i', 'general.js?ver=$1"></script>
{$additional_images_js}');
	find_replace_templatesets('postbit', '#'.preg_quote("{\$post['groupimage']}").'#i', "{\$post['groupimage']}
				{\$post['additional_images_html']}");
	find_replace_templatesets('postbit_classic', '#'.preg_quote("{\$post['groupimage']}").'#i', "{\$post['groupimage']}
				{\$post['additional_images_html']}");
	find_replace_templatesets('member_profile', '#'.preg_quote('{$groupimage}').'#i', '{$groupimage}
					{$additional_images_html}');
	find_replace_templatesets('memberlist_user', '#'.preg_quote("{\$usergroup['groupimage']}").'#i', "{\$usergroup['groupimage']}
	{\$additional_images_html}");
	
	// Settings
	if(!$db->fetch_field($db->simple_select('settinggroups', 'COUNT(1) AS cnt', "name ='animated_additional_images'"), 'cnt'))
	{
		$animated_additional_images_settinggroup = array(
			'gid'			=> NULL,
			'name'			=> 'animated_additional_images',
			'title'			=> $db->escape_string($lang->animated_additional_images),
			'description'	=> $db->escape_string($lang->animated_additional_images_settings),
			'disporder'		=> 666,
			'isdefault'		=> 0
		); 
		
		$db->insert_query('settinggroups', $animated_additional_images_settinggroup);
		$gid = (int)$db->insert_id();
		
		$d = -1;
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_posts',
			'title'			=> $db->escape_string($lang->animated_additional_images_posts),
			'description'	=> $db->escape_string($lang->animated_additional_images_posts_desc),
			'optionscode'	=> 'onoff',
			'value'			=> 1
		);
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_profile',
			'title'			=> $db->escape_string($lang->animated_additional_images_profile),
			'description'	=> $db->escape_string($lang->animated_additional_images_profile_desc),
			'optionscode'	=> 'onoff',
			'value'			=> 1
		);
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_memberlist',
			'title'			=> $db->escape_string($lang->animated_additional_images_memberlist),
			'description'	=> $db->escape_string($lang->animated_additional_images_memberlist_desc),
			'optionscode'	=> 'onoff',
			'value'			=> 1
		);
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_announcements',
			'title'			=> $db->escape_string($lang->animated_additional_images_announcements),
			'description'	=> $db->escape_string($lang->animated_additional_images_announcements_desc),
			'optionscode'	=> 'onoff',
			'value'			=> 1
		);
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_pms',
			'title'			=> $db->escape_string($lang->animated_additional_images_pms),
			'description'	=> $db->escape_string($lang->animated_additional_images_pms_desc),
			'optionscode'	=> 'onoff',
			'value'			=> 1
		);
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_previews',
			'title'			=> $db->escape_string($lang->animated_additional_images_previews),
			'description'	=> $db->escape_string($lang->animated_additional_images_previews_desc),
			'optionscode'	=> 'onoff',
			'value'			=> 1
		);
		
		$animated_additional_images_settings[] = array(
			'name'			=> 'animated_additional_images_time',
			'title'			=> $db->escape_string($lang->animated_additional_images_time),
			'description'	=> $db->escape_string($lang->animated_additional_images_time_desc),
			'optionscode'	=> 'numeric',
			'value'			=> 5000
		);
		
		foreach($animated_additional_images_settings as &$current_setting)
		{
			$current_setting['sid'] = NULL;
			$current_setting['disporder'] = ++$d;
			$current_setting['gid'] = $gid;
		}
		
		$db->insert_query_multiple('settings', $animated_additional_images_settings);
		
		rebuild_settings();
	}
}

function animated_additional_images_deactivate()
{   
	require_once MYBB_ROOT.'/inc/adminfunctions_templates.php';
	find_replace_templatesets('headerinclude', '#\s*'.preg_quote('{$additional_images_js}').'#i', '');
	find_replace_templatesets('postbit', '#\s*'.preg_quote("{\$post['additional_images_html']}").'#i', '');
	find_replace_templatesets('postbit_classic', '#\s*'.preg_quote("{\$post['additional_images_html']}").'#i', '');
	find_replace_templatesets('member_profile', '#\s*'.preg_quote('{$additional_images_html}').'#i', '');
	find_replace_templatesets('memberlist_user', '#\s*'.preg_quote('{$additional_images_html}').'#i', '');
}

function animated_additional_images_install()
{
	global $lang;
	
	$lang->load('animated_additional_images_acp');
	
	if(!file_exists(PLUGINLIBRARY))
	{
		flash_message($lang->pluginlibrary_missing, 'error');
		admin_redirect('index.php?module=config-plugins');
	}
	
	global $PL;
	$PL or require_once PLUGINLIBRARY;
	
	$PL->templates('animatedadditionalimages', $lang->animated_additional_images, array(
		'all' => '<div class="additional_images">
	{$images}
</div>',
		'image' => '<img src="{$image}" title="{$title}" alt="{$title}" class="{$first} additional_img" style="display: {$display};" />',
		'js' => '<script type="text/javascript">
function animate_additional_images() {
	$(".additional_images").each(function() {
		var th = $(this);
		if(th.find(".additional_img").length > 1)
		{
			var current = th.find(".additional_img_active");
			var img = current.next(".additional_img");
			var next = img.length ? img : th.find(".additional_img_first");
			
			current.removeClass("additional_img_active").fadeOut(function() {
				next.fadeIn().addClass("additional_img_active")
			});
		}
	});
}

$(document).ready(function() {
    setInterval(animate_additional_images, {$switchtime});
});
</script>'
	));
}

function animated_additional_images_is_installed()
{
	global $db;
	
	return $db->fetch_field($db->simple_select('templates', 'COUNT(1) AS cnt', "title ='animatedadditionalimages_js'"), 'cnt');
}

function animated_additional_images_uninstall()
{   
	global $lang;
	
	$lang->load('animated_additional_images_acp');
	
	if(!file_exists(PLUGINLIBRARY))
	{
		flash_message($lang->pluginlibrary_missing, 'error');
		admin_redirect('index.php?module=config-plugins');
	}
	
	global $PL, $db;
	$PL or require_once PLUGINLIBRARY;
	
	$PL->templates_delete('animatedadditionalimages');
	$db->delete_query('settings', "name LIKE ('animated\_additional\_images\_%')");
	$db->delete_query('settinggroups', "name = 'animated_additional_images'");
	
	rebuild_settings();
}

$plugins->add_hook('global_start', 'animated_additional_images_global');

function animated_additional_images_global()
{
	global $mybb, $additional_images_js;
	$additional_images_js = $GLOBALS['additional_images_html'] = '';
	
	$switchtime = (int)$mybb->settings['animated_additional_images_time'];
	
	// Check settings and use only necessary hooks, cache templates when needed
	if($switchtime > 0)
	{
		global $plugins;
		
		$yes = false;
		$action = $mybb->get_input('action');
		
		if(THIS_SCRIPT == 'showthread.php' && $mybb->settings['animated_additional_images_posts'])
		{
			$plugins->add_hook('postbit', 'animated_additional_images_postbit1');
			$yes = true;
		}
		elseif(THIS_SCRIPT == 'memberlist.php' && $mybb->settings['animated_additional_images_memberlist'])
		{
			$plugins->add_hook('memberlist_user', 'animated_additional_images_memberlist');
			$yes = true;
		}
		elseif(THIS_SCRIPT == 'member.php' && $action == 'profile' && $mybb->settings['animated_additional_images_profile'])
		{
			$plugins->add_hook('member_profile_end', 'animated_additional_images_profile');
			$yes = true;
		}
		elseif((THIS_SCRIPT == 'announcements.php' || THIS_SCRIPT == 'modcp.php' && in_array($action, array('new_announcement', 'edit_announcement'))) && $mybb->settings['animated_additional_images_announcements'])
		{
			$plugins->add_hook('postbit_announcement', 'animated_additional_images_postbit2');
			$yes = true;
		}
		elseif((THIS_SCRIPT == 'newreply.php' || THIS_SCRIPT == 'editpost.php' || THIS_SCRIPT == 'newthread.php') && $mybb->settings['animated_additional_images_previews'])
		{
			$plugins->add_hook('postbit_prev', 'animated_additional_images_postbit2');
			$yes = true;
		}
		elseif(THIS_SCRIPT == 'private.php' && in_array($action, array('send', 'read')) && $mybb->settings['animated_additional_images_pms'])
		{
			$plugins->add_hook('postbit_pm', 'animated_additional_images_postbit2');
			$yes = true;
		}

		if($yes)
		{
			$GLOBALS['templatelist'] .= !empty($GLOBALS['templatelist'])
											? ',animatedadditionalimages_js,animatedadditionalimages_all,animatedadditionalimages_image'
											: 'animatedadditionalimages_js,animatedadditionalimages_all,animatedadditionalimages_image';
			eval('$additional_images_js = "'.$GLOBALS['templates']->get('animatedadditionalimages_js').'";');
		}
	}
}

function animated_additional_images_postbit1(&$post)
{
	// Cache the result for the same user
	static $images = array();
	if(isset($images[$post['uid']]))
		$post['additional_images_html'] = $images[$post['uid']];
	else
		$images[$post['uid']] = $post['additional_images_html'] =
		get_animated_additional_images($post['usergroup'], $post['displaygroup'], $post['additionalgroups']);
}

function animated_additional_images_postbit2(&$post)
{
	$post['additional_images_html'] = get_animated_additional_images($post['usergroup'], $post['displaygroup'], $post['additionalgroups']);
}

function animated_additional_images_memberlist($user)
{
	$GLOBALS['additional_images_html'] = get_animated_additional_images($user['usergroup'], $user['displaygroup'], $user['additionalgroups']);
}

function animated_additional_images_profile()
{
	global $memprofile;
	$GLOBALS['additional_images_html'] = get_animated_additional_images($memprofile['usergroup'], $memprofile['displaygroup'], $memprofile['additionalgroups']);
}

/*
Get additional group images HTML (any other than displaygroup).
	
@param int - User's usergroup ID.
@param int - User's displaygroup ID.
@param string - User's additionalgroups, comma separated string.
@return string - The resulting HTML, empty if there is nothing to display.
*/
function get_animated_additional_images($usergroup, $displaygroup, $additionalgroups)
{
	$groups = explode(',', $additionalgroups);
	$groups[] = $usergroup;
	
	if($displaygroup == 0)
		$displaygroup = $usergroup;
	
	if(($key = array_search($displaygroup, $groups)) !== false)
		unset($groups[$key]);
	
	$groups = array_filter($groups);
	if(empty($groups))
		return '';
	
	global $templates, $mybb;
	
	static $usergroups_cache = '';
	
	if(!$usergroups_cache)
		$usergroups_cache = $GLOBALS['cache']->read('usergroups');
	
	if(!empty($mybb->user['language']))
		$lang = $mybb->user['language'];
	else
		$lang = $mybb->settings['bblanguage'];
	
	$first = 'additional_img_active additional_img_first';
	$display = 'inline-block';
	$images = '';
	
	foreach($groups as $group)
	{
		$groupinfo = $usergroups_cache[$group];
		if($groupinfo['image'])
		{
			$find = array('{lang}', '{theme}');
			$rep = array($lang, $GLOBALS['theme']['imgdir']);
			
			$image = htmlspecialchars_uni(str_replace($find, $rep, $groupinfo['image']));
			$title = htmlspecialchars_uni($groupinfo['title']);
			eval('$images .= "'.$templates->get('animatedadditionalimages_image').'";');
			$first = '';
			$display = 'none';
		}
	}
	
	eval('$template = "'.$templates->get('animatedadditionalimages_all').'";');
	return $template;
}