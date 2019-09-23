<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 12/28/15
 * Time: 12:04 PM
 */
namespace common\yivic\components;
use yii\db\ActiveRecord;

class YivicActiveRecord extends ActiveRecord {
    const IS_DELETED = 0;
    const IS_ENABLED = 1;
}