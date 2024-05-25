<?php
/**
* CG Chat Module  - Joomla 4.x/5.x Module
* Version			: 1.0.1
* Package			: CG Chat
* copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
* license    		: https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
* From Kide ShoutBox
*/

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use ConseilGouz\Component\CGChat\Site\Helper\CGChatHead;
use ConseilGouz\Component\CGChat\Site\Helper\CGChatUser;
use ConseilGouz\Component\CGChat\Site\Helper\CGChatTemplate;
use ConseilGouz\Component\CGChat\Site\View\CGChat\HtmlView;

if (DEFINED("CGCHAT_LOADED")) {
    return;
} // component already active

$defines = JPATH_BASE."/components/com_cgchat/index.html";
if (!file_exists($defines)) {
    echo "You need install com_cgchat";
    return;
}
$app = Factory::getApplication();
$lang = $app->getLanguage();
$lang->load("com_cgchat");

$tpl = CGChatTemplate::getInstance();
$session = $app->getSession();
if (!$session->get("template", '', 'cgchat')) {
    $tpl->tuser = $params->get('template');
}
HtmlView::preparar();
$tpl->view = 'cgchat';
$tpl->check_language();

$kuser = CGChatUser::getInstance();
$privs = $params->get('show_sessions', 0) && $params->get('show_privados', 0) && $kuser->can_write ? 1 : 0;
CGChatHead::addScript("
cgchat.show_hour = ".$params->get('show_hour', 0).";
cgchat.show_sessions = ".$params->get('show_sessions', 0).";
cgchat.autoiniciar = ".$params->get('autoiniciar', 0).";
cgchat.show_privados = ".($privs && $params->get('enable_privates', 1) ? 1 : 0).";");
$tpl->assign('com', 'mod');
$tpl->assign('show_hour', $params->get('show_hour', 0));
$tpl->assign('autoiniciar', $params->get('autoiniciar', 0));
$tpl->assign('show_sessions', $params->get('show_sessions', 0));
$tpl->assign('show_privados', $privs);

$tpl->display();
