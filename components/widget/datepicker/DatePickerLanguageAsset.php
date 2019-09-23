<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 12/4/15
 * Time: 10:32 AM
 */
namespace common\yivic\components\widget\datepicker;
use common\yivic\components\YivicAssetBundle;
/**
 * DatePickerLanguageAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\datepicker
 */
class DatePickerLanguageAsset extends YivicAssetBundle
{
    public $sourcePath = '@vendor/bower/bootstrap-datepicker/dist/locales';
    public $depends = [
        'dosamigos\datepicker\DateRangePickerAsset'
    ];
}

