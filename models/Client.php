<?php


namespace app\models;

use app\core\DbModel;
use app\core\Model;

class Client extends DbModel
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function getTableName(): string
    {
        return 'clients';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name'              => [self::RULE_REQUIRED],
            'email'             => [self::RULE_REQUIRED, self::RULE_EMAIL,
                                    [self::RULE_UNIQUE, 'class' => self::class]],
            'password'          => [self::RULE_REQUIRED,
                                    [self::RULE_MIN, 'min' => 8],
                                    [self::RULE_MAX, 'max' => 24]],
            'passwordConfirm'   => [self::RULE_REQUIRED,
                                    [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function getAttributes(): array
    {
        return ['name', 'email', 'password'];
    }

    public function getLabel(): array
    {
        return [
            'name'              => 'Full name',
            'email'             => 'Email',
            'password'          => 'Password',
            'passwordConfirm'   => 'Confirm password'
        ];
    }
}