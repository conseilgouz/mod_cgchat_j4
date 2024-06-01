<?php
/**
* CG Chat Module  - Joomla 4.x/5.x Module
* Package			: CG Chat
* copyright 		: Copyright (C) 2024 ConseilGouz. All rights reserved.
* license    		: https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
* From Kide ShoutBox
*/

namespace ConseilGouz\Module\Cgchat\Site\Field;

defined('_JEXEC') or die();
use Joomla\Filesystem\Folder;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;

class CGChattemplatesField extends FormField
{
    protected $type = 'cgchattemplates';

    protected function getInput()
    {
        $folders = Folder::folders(JPATH_ROOT.'/components/com_cgchat/templates');
        $s = array();
        foreach ($folders as $f) {
            $s[] = (object)array('text' => $f);
        }
        return HTMLHelper::_('select.genericlist', $s, $this->name, 'class="inputbox"', 'text', 'text', $this->value, $this->id);
    }
}
