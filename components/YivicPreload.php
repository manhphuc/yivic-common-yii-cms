<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 3/8/16
 * Time: 11:36 AM
 */

namespace common\yivic\components;

use Yii;
use yii\base\Component;

/**
 * Class YivicPreload
 * @package 'dd/mm/yyy'yivic
 * @property string $locale The homepage URL.
 */
class YivicPreload extends Component
{
    public $locale;

    /* @var $globalSettings array store global settings of application */
    public $globalSettings;

    // To-do: get personal setting of a user from db
    /* @var $personalSettings array store personal settings a user */
    public $personalSettings;

    /**
     * Init function of YivicPreload
     */
    public function init(){
        parent::init();
        if (empty($_GET['locale'])) {
            $this->locale = 'en';
        }
    }
    public function setLocale($locale) {
        $this->locale = $locale;
    }
}