<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  All Rights Reserved
 */

use OpenEMR\Menu\MenuEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use OpenEMR\Events\Globals\GlobalsInitializedEvent;
use OpenEMR\Services\Globals\GlobalSetting;

function oe_module_texting_add_menu_item(MenuEvent $event)
{
    $menu = $event->getMenu();

    $menuItem = new stdClass();
    $menuItem->requirement = 0;
    $menuItem->target = 'mod';
    $menuItem->menu_id = 'mod0';
    $menuItem->label = xlt("Text Messaging Service");
    $menuItem->url = "/interface/modules/custom_modules/text-messaging-app/public/index.php/notifications";
    $menuItem->children = [];
    $menuItem->acl_req = ["patients", "docs"];
    $menuItem->global_req = [];

    foreach ($menu as $item) {
        if ($item->menu_id == 'teximg') {
            $item->children[] = $menuItem;
            break;
        }
    }

    $event->setMenu($menu);

    return $event;
}


/**
 * @var EventDispatcherInterface $eventDispatcher
 * @var array                    $module
 * @global                       $eventDispatcher @see ModulesApplication::loadCustomModule
 * @global                       $module          @see ModulesApplication::loadCustomModule
 */

function createTextMessageGlobals(GlobalsInitializedEvent $event)
{
    $instruct = xl('Obtain API Key to send messages');
    $event->getGlobalsService()->createSection("Text Messaging", "Report");
    $setting = new GlobalSetting(xl('TextBelt API Key'), 'encrypted', '', $instruct);
    $event->getGlobalsService()->appendToSection("Text Messaging", "texting_enables", $setting);
    $api_key = xl('Obtain API Key');
    $key_settings = new GlobalSetting(xl('Reply API Key'), 'encrypted', '', $api_key);
    $event->getGlobalsService()->appendToSection("Text Messaging", "response_key", $key_settings);

}

$eventDispatcher->addListener(GlobalsInitializedEvent::EVENT_HANDLE, 'createTextMessageGlobals');
$eventDispatcher->addListener(MenuEvent::MENU_UPDATE, 'oe_module_texting_add_menu_item');
