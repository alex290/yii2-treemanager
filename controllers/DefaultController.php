<?php

namespace alex290\treemanager\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $dataPost = \Yii::$app->request->get();
            $dataArr = json_decode($dataPost['data']);
            
            $this->saveModel($dataPost['name'], $dataArr);
        }
        return TRUE;
    }
    
    protected function saveModel($patch, $data, $parent = 0) {
        $numb = 0;
        foreach ($data as $value) {
            $model = $patch::find()->where(['id' => $value->id])->one();
            $model->weight = $numb;
            $model->parent_id = $parent;
            $model->save();
            if (isset($value->children)) {
                $this->saveModel($patch, $value->children, $value->id);
            }
            $numb++;
        }
    }
}
