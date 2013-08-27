<?php

/**
 * PluginFsMenu
 * 
 * 
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     Filipe Synthis <goulartfs@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z filipe $
 */
abstract class PluginFsMenu extends BaseFsMenu {

    public function __toString() {
        parent::__toString();
        return $this->getLabel();
    }

    /**
     * Verifica se existe filhos para menu e retorna o numero, caso não existe retorna false
     * @return mixed numero de filhos ou false
     */
    public function hasChild() {
        $menus = Doctrine::getTable('FsMenu')->findByFsMenuId($this->getId());

        return ($menus->count()) ? $menus->count() : false;
    }

    public function getChild() {
        return Doctrine::getTable('FsMenu')->findByFsMenuId($this->getId());
    }

    public function getUrlFor() {
        $link = $this->getRoute() . $this->getReferId();

        if ($this->getType() != 'custom') {
            $link = url_for($this->getRoute() . $this->getReferId());
        }

        if ($this->getIsGeneratedAfter()) {
            $linkMethod = 'findOneBy' . str_replace('get', '', $this->getLink());
            $link = url_for($this->getRoute() . Doctrine::getTable($this->getType())->$linkMethod($this->getReferId()));
        }

        return $link;
    }

    public function getTarget() {
        $target = null;
        if ($this->getIsBlank()) {
            $target = "_blank";
        }

        return $target;
    }

    public function getTypeLabel() {
        $string = $this->getType();

        switch ($string) {
            case 'page':
                $string = 'Página';
                break;
            case 'fund':
                $string = 'Fundo';
                break;
            case 'document':
                $string = 'Documento';
                break;
            case 'module':
                $string = 'Módulo';
                break;
            case 'custom':
                $string = 'Custom';
                break;
        }

        return $string;
    }

}