<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@gmail.com
 * Date: 12/4/15
 * Time: 10:01 AM
 */
namespace common\yivic\components\widget\datepicker;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use DateTime;


/**
 * DateRangePicker renders a DatePicker range input.
 */
class DateRangePicker extends InputWidget
{
    use DatePickerTrait;
    /**
     * @var string the attribute name for date range (to Date)
     */
    public $attributeTo;
    /**
     * @var string the name for date range (to Date)
     */
    public $nameTo;
    /**
     * @var string the value for date range (to Date value)
     */
    public $valueTo;

    /**
     * @var array HTML attributes for the date to input
     */
    public $optionsFrom;
    /**
     * @var array HTML attributes for the date to input
     */
    public $optionsTo;

    /**
     * @var string the label to. Defaults to 'to'.
     */
    public $labelTo = 'to';

    /**
     * @var \yii\widgets\ActiveForm useful for client validation of attributeTo
     */
    public $form;

    /**
     * @var string the pluginOptions separator
     */
    protected $_separator;

    /**
     * @var string the template to render. Used internally.
     */
    private $_template = '{inputFrom}{inputTo}{input}';

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->_separator = ' - ';
        if ($this->size) {
            Html::addCssClass($this->options, 'input-' . $this->size);
            Html::addCssClass($this->optionsTo, 'input-' . $this->size);
            Html::addCssClass($this->containerOptions, 'input-group-' . $this->size);
        }
        Html::addCssClass($this->optionsFrom, 'form-control form-filter input-sm');
        Html::addCssClass($this->optionsTo, 'form-control form-filter input-sm');

        $this->optionsFrom['id'] = $this->options['id'] . '_from';
        $this->optionsFrom['placeholder'] = 'From';
        $this->optionsTo['id'] = $this->options['id'] . '_to';
        $this->optionsTo['placeholder'] = 'To';
    }

    /**
     * @inheritdoc
     */
    public function run()
    {

        $dateRange = array_filter(explode($this->_separator, $this->getParamValue()));

        if (!empty($dateRange) && is_array($dateRange)) {
            $calendarButton = '<span class="input-group-btn">
											<button class="btn btn-sm default" type="button">
											<i class="fa fa-calendar"></i>
											</button>
											</span>';
            $inputFrom = Html::textInput($this->name, isset($dateRange[0]) ? $dateRange[0] : null, $this->optionsFrom);
            $inputFrom = Html::tag(
                'div',
                $inputFrom . $calendarButton,
                [
                    'class' => 'input-group date date-picker margin-bottom-5',
                    'data-date-format' => 'dd/mm/yyyy'
                ]
            );
            $inputTo = Html::textInput(null, isset($dateRange[1]) ? $dateRange[1] : null, $this->optionsTo);
            $inputTo = Html::tag(
                'div',
                $inputTo . $calendarButton,
                [
                    'class' => 'input-group date date-picker',
                    'data-date-format' => 'dd/mm/yyyy'
                ]
            );

            $input = $this->hasModel()
                ? Html::activeHiddenInput($this->model, $this->attribute, $this->options)
                : Html::hiddenInput($this->name, '', $this->options);
        } else {
            $calendarButton = '<span class="input-group-btn">
											<button class="btn btn-sm default" type="button">
											<i class="fa fa-calendar"></i>
											</button>
											</span>';
            $inputFrom = Html::textInput($this->name, $this->value, $this->optionsFrom);
            $inputFrom = Html::tag(
                'div',
                $inputFrom . $calendarButton,
                [
                    'class' => 'input-group date date-picker margin-bottom-5',
                    'data-date-format' => 'dd/mm/yyyy'
                ]
            );
            $inputTo = Html::textInput(null, $this->value, $this->optionsTo);
            $inputTo = Html::tag(
                'div',
                $inputTo . $calendarButton,
                [
                    'class' => 'input-group date date-picker',
                    'data-date-format' => 'dd/mm/yyyy'
                ]
            );

            $input = $this->hasModel()
                ? Html::activeHiddenInput($this->model, $this->attribute, $this->options)
                : Html::hiddenInput($this->name, '', $this->options);
        }
        echo Html::tag(
            'div',
            strtr(
                $this->_template,
                ['{inputFrom}' => $inputFrom, '{inputTo}' => $inputTo, '{input}' => $input]
            ), $this->containerOptions);
        $this->registerClientScript();

    }

    /**
     * Registers required script for the plugin to work as DateRangePicker
     */
    public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();
        // @codeCoverageIgnoreStart
        if ($this->language !== null) {
            $this->clientOptions['language'] = $this->language;
            DatePickerLanguageAsset::register($view)->js[] = 'bootstrap-datepicker.' . $this->language . '.min.js';
        } else {
            DateRangePickerAsset::register($view);
        }
        // @codeCoverageIgnoreEnd
        $idDateFilter = $this->options['id'];
        $idDateFrom = $this->optionsFrom['id'];
        $idDateTo = $this->optionsTo['id'];

        $selectorFrom = "jQuery('#$idDateFrom')";
        $selectorTo = "jQuery('#$idDateTo')";
        $selectorFilter = "jQuery('#$idDateFilter')";
        $triggerFunction = "function InputRangeChange(event) {
            if({$selectorFrom}.val() != '' || {$selectorTo}.val() != '' ) {
                {$selectorFilter}.val({$selectorFrom}.val() + ' - ' + {$selectorTo}.val());
            } else {
                {$selectorFilter}.val('');
            }
        }";

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        $js[] = "$selectorFrom.parent().datepicker($options);";
        $js[] = "$selectorTo.parent().datepicker($options);";
        $js[] = "$selectorFrom.change($triggerFunction)";
        $js[] = "$selectorTo.change($triggerFunction)";
        // @codeCoverageIgnoreStart
        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "$selectorFrom.on('$event', $handler);";
            }
        }
        // @codeCoverageIgnoreEnd
        $view->registerJs(implode("\n", $js));
    }

    public function getParamValue()
    {
        if ($this->hasModel()) {
            $modelName = $this->model->formName();
            if (isset(Yii::$app->request->queryParams[$modelName])) {
                $arrayParam = Yii::$app->request->queryParams[$modelName];
                return isset($arrayParam[$this->attribute]) ? $arrayParam[$this->attribute] : null;
            }
            return null;
        }
        return null;
    }
    public static function searchDateRange($attribute, $dateRange, $separator)
    {
        $filterArray = [];

        $dateRangeArray = array_filter(explode($separator, $dateRange));
        $dateFrom = isset($dateRangeArray[0]) ? DateTime::createFromFormat('d/m/Y', $dateRangeArray[0])->format('Y-m-d') : null;
        $dateTo = isset($dateRangeArray[1]) ? DateTime::createFromFormat('d/m/Y', $dateRangeArray[1])->format('Y-m-d') : null;

        if(!empty($dateRangeArray)) {
            if ($dateFrom !== null && $dateTo !== null) {
                $filterArray[] = 'between';
                $filterArray[] = $attribute;
                $filterArray[] = $dateFrom;
                $filterArray[] = $dateTo;
                return $filterArray;
            } else if ($dateFrom !== null && $dateFrom != $separator) {
                $filterArray[] = '>=';
                $filterArray[] = $attribute;
                $filterArray[] =  $dateFrom;;
                return $filterArray;

            } else if ($dateTo !== null && $dateFrom != $separator) {
                $filterArray[] = '<=';
                $filterArray[] = $attribute;
                $filterArray[] = $dateTo;
                return $filterArray;
            }
        }
        return ['like',$attribute,''];
    }
}