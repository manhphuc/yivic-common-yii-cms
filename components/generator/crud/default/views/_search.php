<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search margin-bottom-10">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="input-group">

        <?= '<?=' ?> $form->field($model, 'globalSearch', [
            'options' => [
                'tag' => false,
            ],
        ])->textInput([
            'placeholder' => Yii::t('app', 'Search...'),
            'class' => 'form-control'
        ])->label(false); ?>

        <span class="input-group-btn">
            <?= '<?=' ?> Html::submitButton(Yii::t('app', 'Search') . ' <i class="m-icon-swapright m-icon-white"></i>', ['class' => 'btn green-haze']) ?>
        </span>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
