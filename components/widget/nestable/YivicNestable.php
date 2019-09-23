<?php

/**
 * @copyright Copyright &copy; Arno Slatius 2015
 * @package yii2-nestable
 * @version 1.0
 */

namespace common\yivic\components\widget\nestable;

use slatiusa\nestable\Nestable;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Create nestable lists using drag & drop for Yii 2.0.
 * Based on jquery.nestable.js plugin.
 *
 * @author Arno Slatius <a.slatius@gmail.com>
 * @since 1.0
 */
class YivicNestable extends Nestable {

    /**
     * @var string the ID of the controller that should handle the actions specified here.
     * If not set, it will use the currently active controller. This property is mainly used by
     * [[urlCreator]] to create URLs for different actions. The value of this property will be prefixed
     * to each action name to form the route of the action.
     */
    public $controller;


    public $template = '{view} {update} {delete}';

    /**
     * @var callable a callback that creates a button URL using the specified model information.
     * The signature of the callback should be the same as that of [[createUrl()]].
     * If this property is not set, button URLs will be created using [[createUrl()]].
     */
    public $urlCreator;

    public $buttons = [];

    public $buttonOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->controller = Yii::$app->controller->id;

    }

    protected function renderItems($_items = NULL) {

        $_items = is_null($_items) ? $this->items : $_items;
        $items = '';
        $dataid = 0;
        foreach ($_items as $item) {
            $options = ArrayHelper::getValue($item, 'options', ['class' => 'dd-item dd3-item']);
            $options = ArrayHelper::merge($this->itemOptions, $options);
            $dataId  = ArrayHelper::getValue($item, 'id', $dataid++);
            $options = ArrayHelper::merge($options, ['data-id' => $dataId]);

            $contentOptions = ArrayHelper::getValue($item, 'contentOptions', ['class' => 'dd3-content']);
            $content = $this->handleLabel;

            $actionButton = Html::tag('span', $this->renderButton($dataId),['class' => 'nestable-action-group']);
            $content .= Html::tag('div', ArrayHelper::getValue($item, 'content', '').$actionButton , $contentOptions);

            $children = ArrayHelper::getValue($item, 'children', []);
            if (!empty($children)) {
                // recursive rendering children items
                $content .= Html::beginTag('ol', ['class' => 'dd-list']);
                $content .= $this->renderItems($children);
                $content .= Html::endTag('ol');
            }

            $items .= Html::tag('li', $content, $options) . PHP_EOL;
        }
        return $items;
    }


    /**
     * Creates a URL for the given action and model.
     * This method is called for each button and each row.
     * @param string $action the button name (or action ID)
     * @param string $id $model the data model
     */
    public function createUrl($action, $id)
    {
        $params = is_array($id) ? $id : ['id' => (string) $id];
        $params[0] = $this->controller ? $this->controller . '/' . $action : $action;
        return Url::toRoute($params);
    }
    /**
     * @inheritdoc
     */
    protected function renderButton($id)
    {
        $buttonGroup = '';
        $buttonGroup .= Html::a('<i class="fa fa-eye"></i>',
            $this->createUrl('view',$id),
            [
                'title' => Yii::t('yii', 'View'),
                'aria-label' => Yii::t('yii', 'View'),
                'data-pjax' => '0',
                'data-method' => 'post'
            ]);
        $buttonGroup .= Html::a('<i class="fa fa-pencil"></i>',
            $this->createUrl('update',$id),
            [
                'title' => Yii::t('yii', 'Update'),
                'aria-label' => Yii::t('yii', 'Update'),
                'data-pjax' => '0',
                'data-method' => 'post'
            ]);
        $buttonGroup .= Html::a('<i class="fa fa-trash"></i>',
            $this->createUrl('delete',$id),
            [
                'title' => Yii::t('yii', 'Delete'),
                'aria-label' => Yii::t('yii', 'Delete'),
                'data-pjax' => '0',
                'data-method' => 'post'
            ]);

        return $buttonGroup;
    }

}