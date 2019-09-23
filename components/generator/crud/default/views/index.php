<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>
use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "common\\yivic\\components\\grid\\GridView" : "common\\yivic\\components\\grid\\ListView" ?>;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
    <div class="page-bar">
        <?= "<?= " ?> Breadcrumbs::widget([
        'itemTemplate' => "<li>{link}<i class='fa fa-circle'></i></li>\n",
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => [
            'class' => 'page-breadcrumb'
        ]
        ]) ?>
    </div>
    <h3 class="page-title">
        <?= "<?= " ?>Html::encode($this->title) ?>
    </h3>
    <div class="portlet light bordered">
                   <?php if (!empty($generator->searchModelClass)): ?>
                <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-green-sharp bold uppercase">
                                    <?= '<?=' ?> Yii::t("app", "<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?> Listing") ?>
                                </span>
                                <span class="caption-helper">
                                    <?= '<?=' ?> Yii::t("app", "manage <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>"). "..." ?>
                                </span>
                            </div>
                            <div class="actions">
                                <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i><span class="hidden-480">'.
                                <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                                ['create'],
                                ['class' => 'btn btn-default btn-circle']) ?>
                            </div>
                        </div>

                        <?= '<?=' ?> $this->render('_search', ['model'  => $searchModel ])?>

                        <div class="portlet-body">
                            <?php if ($generator->indexWidgetType === 'grid'): ?>

                                <?= "<?= " ?>GridView::widget([
                                'dataProvider' => $dataProvider,
                                <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n'columns' => [\n" : "'columns' => [\n"; ?>
                                <?= "['class' => 'common\\yivic\\components\\grid\\CheckboxColumn'],"?>
                                <?= "['class' => 'common\\yivic\\components\\grid\\SerialColumn'],"?>
                                <?php
                                $count = 0;
                                if (($tableSchema = $generator->getTableSchema()) === false) {
                                    foreach ($generator->getColumnNames() as $name) {
                                        if (++$count < 6) {
                                            echo "            '" . $name . "',\n";
                                        } else {
                                            echo "            // '" . $name . "',\n";
                                        }
                                    }
                                } else {
                                    foreach ($tableSchema->columns as $column) {
                                        $format = $generator->generateColumnFormat($column);
                                        if (++$count < 6) {
                                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                        } else {
                                            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                        }
                                    }
                                }
                                ?>

                                ['class' => 'common\yivic\components\grid\ActionColumn'],
                                ],
                                ]); ?>
                            <?php else: ?>
                                <?= "<?= " ?>ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemOptions' => ['class' => 'item'],
                                'itemView' => function ($model, $key, $index, $widget) {
                                return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                                },
                                ]) ?>
                            <?php endif; ?></div>
                    </div>
                </div>
        </div>
    </div>
</div>
