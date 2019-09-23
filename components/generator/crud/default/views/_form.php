<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<?= "<?php" ?> if(Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-block alert-success fade in">
        <?= "<?= " ?>Yii::$app->session->getFlash('success') ?>
    </div>
<?= "<?php" ?> endif;?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-sharp bold uppercase">
                    <?= "<?= " ?>Html::encode($this->title) ?>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

                    <?= "<?php " ?>$form = ActiveForm::begin(['options' => ['class'=> 'form-body']]); ?>

                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                    }
                } ?>
                    <div class="form-group">
                        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?= "<?php " ?>ActiveForm::end(); ?>

                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
