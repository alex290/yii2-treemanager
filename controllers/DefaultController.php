<?php

namespace alex290\treemanager\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        // $dataPost = \Yii::$app->request->get();
        $dataPost = \Yii::$app->request->post();

        if (!empty($dataPost)) {
            $dataArr = json_decode($dataPost['data']);

            $this->saveModel($dataPost['name'], $dataArr,  $dataPost['numb'], 0);
        }

        return TRUE;
    }

    protected function saveModel($patch, $data, $numb, $parent = 0)
    {
        $firstNumb = $numb;

        foreach ($data as $value) {
            $model = $patch::find()->where(['id' => $value->id])->one();
            $model->weight = $firstNumb;
            $model->parent_id = $parent;
            $model->save();
            if (isset($value->children)) {
                $this->saveModel($patch, $value->children, $numb, $value->id);
            }
            $firstNumb++;
        }
    }
}
