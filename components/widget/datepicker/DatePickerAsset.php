<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 12/4/15
 * Time: 10:41 AM
 */

namespace common\yivic\components\widget\datepicker;

use common\yivic\components\YivicAssetBundle;
/**
 * DatePickerAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\datepicker
 */
class DatePickerAsset extends YivicAssetBundle
{
//    public $sourcePath = '@vendor/bower/bootstrap-datepicker/dist';
    public $baseUrl = '@web/libs/bootstrap-datepicker';
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
    public function init() {
        $this->css[] = YII_DEBUG ? 'css/bootstrap-datepicker3.css' : 'css/bootstrap-datepicker3.min.css';
        $this->js[] = YII_DEBUG ? 'js/bootstrap-datepicker.js' : 'js/bootstrap-datepicker.min.js';
    }
}