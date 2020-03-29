<?php

namespace console\model\schema;

Use abp\database\ActiveRecord;

/**
 * Class Migrate
 * @package console\model\schema
 *
 * @property int $migrate_id
 * @property string $name
 * @property int $time
 */
class Migrate extends ActiveRecord
{
    public static function find()
    {
        return new \console\model\query\Migrate(get_called_class());
    }
}