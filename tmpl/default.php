<?php
/**
* CG Chat Module  - Joomla 4.x/5.x Module
* Package			: CG Chat
* copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
* license    		: https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
* From Kide ShoutBox
*/

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use ConseilGouz\Component\CGChat\Site\Helper\CGChatTemplate;
use ConseilGouz\Component\CGChat\Site\View\Cgchat\HtmlView;

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

PluginHelper::importPlugin('cgchat');
$response = false;
$contentEventArguments = [
    'context' => 'com_cgchat.cgchat',
    'params'  => $params,
    'response'    => &$response,
];
Factory::getApplication()->triggerEvent('onCGChatStart', $contentEventArguments);
if ($response) { // error found in plugins
   echo $response;
   return false;
}
$tpl = CGChatTemplate::getInstance();
$session = $app->getSession();
if (!$session->get("template", '', 'cgchat')) {
    $tpl->tuser = $params->get('template');
}
HtmlView::preparar();
$tpl->view = 'cgchat';
$tpl->check_language();

$tpl->assign('com', 'mod');
$tpl->assign('show_hour', $params->get('show_hour', 0));
$tpl->assign('autostart', $params->get('autostart', 0));
$tpl->assign('show_sessions', $params->get('show_sessions', 0));

$tpl->display();
