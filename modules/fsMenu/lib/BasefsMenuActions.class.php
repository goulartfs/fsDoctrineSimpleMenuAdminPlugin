<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseFsMenuActions
 *
 * @author FILIPE
 */
class BaseFsMenuActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->redirect('fsMenu/customList');
    }

    public function executeCustomList(sfWebRequest $request) {

        $models = sfConfig::get('app_fsmenu_model');
        $lista = array();

        if (count($models)) {
            foreach ($models as $type => $value) {
                $list_object = null;
                $value['route'] = (isset($value['route']))?$value['route']:"";
                
                $list = Doctrine::getTable($value['model'])->findAll();

                if ($list->count()) {
                    foreach ($list as $object) {
                        $list_object[$object->$value['value']()] = (isset($value['alter_option_label'])) ? $value['alter_option_label'][$object->$value['option']()] : $object->$value['option']();
                    }
                }

                $lista[$value['model']] = array('title' => $value['title'], 'route' => $value['route'], 'link' => $value['value'], 'options' => $list_object, 'is_generated_after'=>(isset($value['is_generated_after']))?$value['is_generated_after']:0);
            }
        }

        $this->list_of_models = $lista;
        $this->list_of_modules = sfConfig::get('app_fsmenu_module');

        $this->menu = Doctrine::getTable('FsMenu')->createQuery('m')
                ->where('m.fs_menu_id is null')
                ->orderBy('m.ordem asc')
                ->execute();
    }

    public function executeUpdateList(sfWebRequest $request) {
        $this->setLayout(false);
        $array = $request->getParameter('arrayorder');

        foreach ($array as $ordem => $id) {
            if (!is_int($ordem))
                continue;
            $menu = Doctrine::getTable('FsMenu')->findOneById($id);
            $menu->setOrdem($ordem);
            $menu->setFsMenuId((isset($array['parent']) && (!empty($array['parent']))) ? $array['parent'] : NULL);

            $menu->save();
        }

        $this->array = "Atualizado";
    }

    public function executeCreateMenu(sfWebRequest $request) {
        $menu = $request->getParameter('menu');

        $new_menu = new FsMenu();
        $new_menu->setLabel((isset($menu['label']) && !empty($menu['label'])) ? $menu['label'] : "Rótulo");
        $new_menu->setLabelEn((isset($menu['label_en']) && !empty($menu['label_en'])) ? $menu['label_en'] : "Label");
        $new_menu->setIsGeneratedAfter((isset($menu['is_generated_after'])) ? $menu['is_generated_after'] : 0);
        
        $new_menu->setType($menu['type']);
        
        $new_menu->setLink($menu['link']);
        $new_menu->setRoute($menu['route']);
        $new_menu->setReferId($menu['refer_id']);
        
        $new_menu->setIsBlank((isset($menu['is_blank'])) ? 1 : 0);
        $new_menu->setOrdem(1000);
        $new_menu->save();

        $this->item = $new_menu;
    }

    public function executeRemoveMenu(sfWebRequest $request) {
        $menu_id = $request->getParameter('id');
        $menu = Doctrine::getTable('FsMenu')->findOneById($menu_id);
        $menu->delete();
    }

    public function executeUpdateMenu(sfWebRequest $request) {
        $menu_edited = $request->getParameter('menu');
        $menu = Doctrine::getTable('FsMenu')->findOneById($menu_edited['id']);

        $menu->setLabel((isset($menu_edited['label']) && !empty($menu_edited['label'])) ? $menu_edited['label'] : "");
        $menu->setLabelEn((isset($menu_edited['label_en']) && !empty($menu_edited['label_en'])) ? $menu_edited['label_en'] : "");
        $menu->setType($menu_edited['type']);

        if ($menu_edited['type'] == 'custom') {
            $menu->setLink($menu_edited['link']);
        }

        $menu->setIsBlank((isset($menu_edited['is_blank'])) ? 1 : 0);
        $menu->save();

        $this->retorno = $menu->getLabel();
    }

}

?>
