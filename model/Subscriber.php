<?php

namespace app\model;

use app\core\DbModel;

class Subscriber extends DbModel{
    
    public string $email = '';
    
    public static function tableName(): string {
        return 'subscriber';
    }

    public function attributes(): array{
        return [
            'email'
        ];
    } 

    public static function primaryKey(): string {
        return 'id';
    }

    public function rules(): array{
        return [
            'email' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array {
        return [
            'email' => ''
        ];
    }

}