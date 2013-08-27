<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FsMenuHelper
 *
 * @author FILIPE
 */
class FsMenuHelper {

    public static function getVerboseFsMenu() {
        $fs_menu = Doctrine::getTable('FsMenu')->createQuery('m')
                ->where('m.fs_menu_id is null')
                ->orderBy('m.ordem asc')
                ->execute();
        
        $output = null;
        
        if ($fs_menu->count()) {
            $output = "<ul id=navbar>";
            foreach($fs_menu as $menu){
            $output .= self::getListItem($menu);
            }
            $output .= "</ul>";
        }
        
        return $output;
    }

    public static function getListItem(FsMenu $fs_menu) {
        $output = "<li class=list-{$fs_menu->getId()}>";
        $output .= "<a target={$fs_menu->getTarget()} href={$fs_menu->getUrlFor()}>{$fs_menu->getLabel()}</a>";
        if (($fs_menu->hasChild())) {
            $output .= "<ul>";

            foreach ($fs_menu->getChild() as $filho) {
                $output .= self::getListItem($filho);
            }

            $output .= "</ul>";
        }
        $output .= "</li>";

        return $output;
    }

}

?>
