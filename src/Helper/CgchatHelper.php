<?php
/**
* CG Chat Module  - Joomla 4.x/5.x Module
* Package			: CG Chat
* copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
* license    		: https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
* From Kide ShoutBox
*/
namespace ConseilGouz\Module\Cgchat\Site\Helper;

use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Helper for mod_articles_news
 *
 * @since  1.6
 */
class CgchatHelper implements DatabaseAwareInterface
{
    use DatabaseAwareTrait;
}
