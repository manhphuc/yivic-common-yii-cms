<?php

/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 12/17/15
 * Time: 12:27 PM
 */
namespace common\yivic\components;

use yii\db\Migration;

class YivicMigration extends Migration
{
    public $commonFields = [];

    public function init()
    {
        parent::init();
        $this->commonFields = [
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'published_at' => $this->dateTime(),
            'creator_id' => $this->integer()->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
            'is_enabled' => $this->boolean()->defaultValue(1),
            'ordering_weight' => $this->integer(),
            'params' => $this->text(),
        ];
    }

    public function commonCreateTable($tableName, $params, $options = null)
    {
        $this->createTable($tableName, array_merge($params, $this->commonFields), $options);
        $this->commonCreateIndex($tableName, 'created_at');
        $this->commonCreateIndex($tableName, 'updated_at');
        $this->commonCreateIndex($tableName, 'published_at');
        $this->commonCreateIndex($tableName, 'creator_id');
        $this->commonCreateIndex($tableName, 'is_deleted');
        $this->commonCreateIndex($tableName, 'is_enabled');
    }

    public function commonCreateIndex($tableName, $field)
    {
        $this->createIndex('IX_' . uniqid($this->db->schema->getRawTableName($tableName)) . '_' . $field, $tableName,
            $field);
    }
}