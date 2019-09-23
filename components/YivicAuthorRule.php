<?php
namespace common\yivic\components;

use yii\rbac\Rule;
use Yii;
/**
 * Checks if authorID matches user passed via params
 */
class YivicAuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if(isset($params['model'])){
            $model = $params['model'];
        }
        else{
            $id = Yii::$app->request->get('id');
            $model= Yii::$app->controller->findUserModel($id);
        }
        return $model->createdBy();
    }
}