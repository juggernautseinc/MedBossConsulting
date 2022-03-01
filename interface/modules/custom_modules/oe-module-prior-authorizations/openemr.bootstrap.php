<?php

/*
 *
 * @package      OpenEMR
 * @link               https://www.open-emr.org
 *
 * @author    Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright Copyright (c) 2021 Sherwin Gaddis <sherwingaddis@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 *
 */

use OpenEMR\Menu\MenuEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

function oe_module_priorauth_add_menu_item(MenuEvent $event)
{
    $menu = $event->getMenu();

    $menuItem = new stdClass();
    $menuItem->requirement = 0;
    $menuItem->target = 'mod';
    $menuItem->menu_id = 'mod0';
    $menuItem->label = xlt("Prior Authorization Manager");
    $menuItem->url = "/interface/modules/custom_modules/oe-module-prior-authorizations/";
    $menuItem->children = [];
    $menuItem->acl_req = ["patients", "docs"];
    $menuItem->global_req = [];

    foreach ($menu as $item) {
        if ($item->menu_id == 'patimg') {
            $item->children[] = $menuItem;
            break;
        }
    }

    $event->setMenu($menu);

    return $event;
}

function oe_module_priorauth_patient_menu_item(MenuEvent $event)
{
    $menu = $event->getMenu();
    $menuItem = new stdClass();
    $menuItem->requirement = 0;
    $menuItem->target = 'main';
    $menuItem->pid = 'false';
    $menuItem->menu_id = 'prior_auth';
    $menuItem->on_click = "top.restoreSession()";
    $menuItem->label = xlt("Prior Authorization Report");
    $menuItem->url = "/interface/modules/custom_modules/oe-module-prior-authorizations/";
    $menuItem->children = [];

    foreach ($menu as $item) {
        if ($item->menu_id == 'history') {
            $item->children[] = $menuItem;
            file_put_contents("/var/www/html/errors/menu.txt", print_r($menuItem, true));
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


$eventDispatcher->addListener(MenuEvent::MENU_UPDATE, 'oe_module_priorauth_add_menu_item');
$eventDispatcher->addListener(MenuEvent::MENU_UPDATE, 'oe_module_priorauth_patient_menu_item');
