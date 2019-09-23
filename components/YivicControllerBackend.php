<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 3/10/16
 * Time: 2:12 PM
 */

namespace common\yivic\components;

use yii\filters\AccessControl;

class YivicControllerBackend extends YivicController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => null,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}