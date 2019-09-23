<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\yivic\components\grid;

use common\yivic\components\YivicAssetBundle;

/**
 * This asset bundle provides the javascript files for the [[GridView]] widget.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GridViewAsset extends YivicAssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.gridView.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
