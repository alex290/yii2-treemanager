Yii2 Tree Manager Category
==========================

Расширение сортируется при помощи перетаскивания мышкой

 ![](https://raw.githubusercontent.com/alex290/yii2-treemanager/master/scr/img/demo.jpg)

Установка
---------

Предпочтительным способом установки этого расширения является
[composer](http://getcomposer.org/download/).

Запустить

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
php composer.phar require --prefer-dist alex290/yii2-treemanager "*"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

или добавить

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
"alex290/yii2-treemanager": "*"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

в раздел require вашего `composer.json` файла.

в конфиге `web.php` прописать

	'modules' => [
        'treemanager' => [
            'class' => 'alex290\treemanager\Module',
            'layout' => false,
        ],
    ],

 

Применение
----------

После установки запустить виджет:

	$arrModel = app\models\Category::find();

	 <?= TreeManager::widget([
            'modelTree' => $arrModel, 
        ]) ?>

Дополнительные параметры

    'path' => '/admin/category', //Изменить путь для ссылок редактирования и удаления
    'delete' => 'delete', //Изменить Action для удаления
    'update' => 'update', //Изменить Action для редактирования
    'firstWeight' = 0; //Изменить начальный вес (По умалчанию 0)


Сама модель использует обязательные поля

	'id',
	'name' - Наименование - varchar,
	'parent_id' - Родитель - int (0 - главная или id родителя),
	'weight' - Вес(порядок)  - int,
