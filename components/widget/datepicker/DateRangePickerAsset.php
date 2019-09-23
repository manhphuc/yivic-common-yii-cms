<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 12/4/15
 * Time: 10:39 AM
 */

namespace common\yivic\components\widget\datepicker;

use common\yivic\components\YivicAssetBundle;

class DateRangePickerAsset extends YivicAssetBundle
{
    public $baseUrl = '@web';
    public $css = [
        'libs/bootstrap-daterangepicker/daterangepicker-bs2.css'
    ];
    public $depends = [
        'common\yivic\components\widget\DatePicker\DatePickerAsset'
    ];
}