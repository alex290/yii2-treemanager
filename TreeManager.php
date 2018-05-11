<?php

namespace alex290\treemanager;
use alex290\treemanager\TreeAssetsBundle;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is just an example.
 */
class TreeManager extends \yii\base\Widget
{
    public $modelTree;
    public $path;


    public function run()
    {
        TreeAssetsBundle::register($this->view);
        $catstree = $this->getTree();
        $modClon = clone $this->modelTree;
        $modOne = $modClon->one();
        //debug($catstree);
        $templ = '<div class="dd">';
        $templ .= $this->getTreeHtml($catstree);
        $templ .= '</div>';
        $templ .= '<div class="model-name-base">';
        $templ .= get_class($modOne);
        $templ .= '</div>';
        return $templ;
    }
    
    protected function getTreeHtml($treesTemp){
        $tree = '<ol class="dd-list">';
        foreach ($treesTemp as $treeTemp) {
            $tree .= '<li class="dd-item dd3-item" data-id="'.$treeTemp['id'].'">';
            $tree .= '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">'.$treeTemp['name'];
            $tree .= '<div class="editor-tree">';
            $tree .= '<a href="'.Url::to([$this->path.'/update', 'id'=>$treeTemp['id']]).'" class="success" title="Изменить"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
            // $tree .= '<a href="'.Url::to([$this->path.'/view', 'id'=>$treeTemp['id']]).'" class="" title="Просмотр"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            $tree .= '<a href="'.Url::to([$this->path.'/delete', 'id'=>$treeTemp['id']]).'" class="danger" title="Удалить" data-method="post"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
            $tree .= '</div></div>';
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
        $modClon = clone $this->modelTree;
        $catstree = $modClon->indexBy('id')->orderBy(['weight' => SORT_ASC])->asArray()->all();
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
