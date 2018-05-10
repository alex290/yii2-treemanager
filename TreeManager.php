<?php

namespace alex290\treemanager;
use alex290\treemanager\TreeAssetsBundle;

/**
 * This is just an example.
 */
class TreeManager extends \yii\base\Widget
{
    public $modelTree;
    
    public function run()
    {
        TreeAssetsBundle::register($this->view);
        $catstree = $this->getTree();
        debug($catstree);
        $templ = '<div class="dd">';
        $templ .= $this->getTreeHtml($catstree);
        $templ .= '</div>';
        return $templ;
    }
    
    protected function getTreeHtml($treesTemp){
        $tree = '<ol class="dd-list">';
        foreach ($treesTemp as $treeTemp) {
            $tree .= '<li class="dd-item dd3-item" data-id="'.$treeTemp['id'].'">';
            $tree .= '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">'.$treeTemp['name'].'</div>';
            if (isset($treeTemp['childs'])){
                $tree .= $this->getTreeHtml($treeTemp['childs']);
            }
            $tree .= '</li>';
        }
        $tree .= '</ol>';
        return $tree;
    }
    
    protected function getTree() {
        $tree = [];
        $catstree = $this->modelTree;
        foreach ($catstree as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $catstree[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        $treeOne = $tree;
        
        return $treeOne;
    }
}
