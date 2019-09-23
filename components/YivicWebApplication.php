<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 3/10/16
 * Time: 2:43 PM
 */

namespace common\yivic\components;

use \yii\web\Application;
use yii\image\ImageDriver;
/**
 * Class YivicWebApplication

 * @property YivicWebUser $yivicUser The user component. This property is read-only.
 * @property ImageDriver $image
 * @property $uploadDir
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class YivicWebApplication extends Application
{

    /**
     * Returns the user component.
     * @return YivicWebUser the user component.
     */
    public function getUploadDir() {
        return \Yii::getAlias('@root/uploads');
    }

    public function getYivicUser()
    {
        return $this->get('yivicUser');
    }
    /*
     *  @property user $yivicUser The user component. This property is read-only.

     */

    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'yivicUser' => ['class' => 'common\yivic\components\YivicWebUser'],
        ]);
    }
}