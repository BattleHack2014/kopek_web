<?php
namespace Crm\Logic\Admin;

use Config\Config;

use Crm\Model\Admin\User\User;

use Crm\Logic\Logic;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\EventDispatcher\Event;

class Menu extends AdminLogic {

    public function actionGet() {
        $menu = Logic::getConfig('menu');
        $items = array();
        foreach ($menu as $resource => $tree) {
            $item = array();
            if ($this->_user->hasResource($resource)) {
                $item = array(
                    'id' => $menu->get($resource .'.id'),
                    'label' => $menu->get($resource .'.label'),
                    'url' => $menu->get($resource .'.url'),
                    'icon' => $menu->get($resource .'.icon'),
                    'css' => $menu->get($resource .'.css')
                );
                foreach ($menu->get($resource .'.items',array()) as $id => $child) {
                    $item['items'][] = array(
                        'id' => $id,
                        'label' => $menu->get($resource .'.items.' . $id . '.label'),
                        'url' => $menu->get($resource .'.items.' . $id . '.url'),
                        'icon' => $menu->get($resource .'.items.' . $id . '.icon'),
                    );
                }
            }
            if ($item)
                $items[] = $item;
        }
        return array('items' => $items);
    }
}