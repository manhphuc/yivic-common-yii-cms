<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 7/27/16
 * Time: 5:01 PM
 */

namespace common\yivic\components;


use dosamigos\tinymce\TinyMce;
use yii;
class YivicTinyMCE extends TinyMce
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->clientOptions = [
            'fontSize' => 30,
            'content_css' => Yii::getAlias('@web') . '/assets-yivic/tiny-mce/editor-style.css',
            'convert_urls' => false,
            'relative_urls' => false,
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

        ];
    }
}