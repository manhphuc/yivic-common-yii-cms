<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\yivic\components\grid;

/**
 * SerialColumn displays a column of row numbers (1-based).
 *
 * To add a SerialColumn to the [[GridView]], add it to the [[GridView::columns|columns]] configuration as follows:
 *
 * ```php
 * 'columns' => [
 *     // ...
 *     [
 *         'class' => 'yii\grid\SerialColumn',
 *         // you may configure additional properties here
 *     ],
 * ]
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RatingColumn extends Column
{
    /**
     * @inheritdoc
     */
    public $header = 'No.';

    public $value = null;

    /**
     * @inheritdoc
     */

    public function getValue() {
        return $this->value;
    }
    
    protected function renderDataCellContent($model, $key, $index)
    {
        $option = '';
        for ($i = 0 ; $i <= 5; $i ++) {
            if($i == 0) {
                $option .= '<option value '.($this->value == $i ? 'selected' : '') .'>'. $i .'</option>';
            } else {
                $option .= '<option value="' . $i .'" '.($this->value == $i ? 'selected' : '') .'>'. $i .'</option>';
            }
        }
        $rateStar = '<select class="rating-star">'.$option.'</select>';
        return $rateStar;
    }
}
