<?php

namespace app\model;

use app\core\DbModel;

class UpdateAccount extends DbModel{

    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    
    public static function tableName(): string {
        return 'member';
    }

    public function rules() {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 100]],
            'confirmPassword' => [self::RULE_REQUIRED]
        ];
    }

    public function attributes(): array {
        return [
            'username', 'email', 'password'
        ];
    }

    public static function primaryKey(): string {
        return 'id';
    }
}