<?php

/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 6/13/16
 * Time: 6:40 PM
 */
namespace common\yivic\components;
use yii\helpers\ArrayHelper;
use Yii;
class YivicModel extends \yii\base\Model
{
    public static function createMultiple($modelClass, $multipleModels = [], $pk = 'id')
    {
        $model    = new $modelClass;

        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];
        
        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, $pk, $pk));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item[$pk]) && !empty($item[$pk]) && isset($multipleModels[$item[$pk]])) {
                    $models[] = $multipleModels[$item[$pk]];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);
        return $models;
    }
}