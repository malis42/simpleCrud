<?php


namespace app\models;


use app\core\Model;

class Address extends Model
{
    public function getTableName(): string
    {
        return 'addresses';
    }

    public function getAttributes(): array
    {
        return ['country_id', 'city', 'zip-code', 'address_line_1', 'address_line_2'];
    }

    public function rules(): array
    {
        return [
            'city'              => [self::RULE_REQUIRED],
            'zip-code'          => [self::RULE_REQUIRED],
            'address_line_1'    => [self::RULE_REQUIRED]
        ];
    }


}