<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015
 * @package   yii2-tree-manager
 * @version   1.0.4
 */

namespace 'dd/mm/yyy'widget\tree;

use kartik\base\AssetBundle;

/**
 * Asset bundle for TreeViewInput widget.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class TreeViewInputAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $depends = [
        ''dd/mm/yyy'widget\tree\TreeViewAsset'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/kv-tree-input']);
        $this->setupAssets('js', ['js/kv-tree-input']);
        parent::init();
    }
}
