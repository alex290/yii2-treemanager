<?php

namespace alex290\treemanager;

use alex290\treemanager\TreeAssetsBundle;
use yii\helpers\Html;
use Yii;

/**
 * This is just an example.
 */
class TreeManager extends \yii\base\Widget {

    public $modelTree;
    public $path = null;
    public $delete = 'delete';
    public $update = 'update';
    public $firstWeight = 0;

    public function run() {
        TreeAssetsBundle::register($this->view);
        
        if ($this->path == null) {
            $this->path = $this->getPath();
        }
        
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

    protected function getTreeHtml($treesTemp) {
        
        $tree = '<ol class="dd-list" data-numb="'.$this->firstWeight.'">';
        foreach ($treesTemp as $treeTemp) {
            $tree .= '<li class="dd-item dd3-item" data-id="' . $treeTemp['id'] . '">';
            $tree .= '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">' . $treeTemp['name'];
            $tree .= '<div class="editor-tree">';
            $tree .= Html::a('<i class="fa fa-pencil fas fa-edit" aria-hidden="true"></i>', [$this->path . '/' . $this->update, 'id' => $treeTemp['id']], ['class' => "btn btn-success", 'title' => "Изменить"]);
            $tree .= Html::a('<i class="fa fa-trash-o fas fa-trash-alt" aria-hidden="true"></i>', [$this->path . '/' . $this->delete, 'id' => $treeTemp['id']], ['class' => "btn btn-danger", 'data-confirm' => "Вы уверены, что хотите удалить этот элемент?", 'title' => "Удалить", 'data-method' => "post"]);
            $tree .= '</div></div>';
            if (isset($treeTemp['childs'])) {
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

    protected function getPath() {
        $path = \yii\helpers\Url::to();
        $controllerId = Yii::$app->controller->id;
        $url = explode($controllerId, $path);
        $urlPath = $url[0] . $controllerId;
        return $urlPath;
    }

}
