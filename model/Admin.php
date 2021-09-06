<?php

namespace app\model;
use app\core\DbModel;

class Admin extends DbModel{

    // Attributes
    public string $username = '';
    public string $password = '';
    public string $confirmPassword = '';

    // hash password and call save method of DbModel
    // this DbModel::save() method save admin to database
    public function save(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    
    // this method return rule names for attributes
    public function rules(): array{
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
            'confirmPassword' => [self::RULE_REQUIRED]
        ];
    }

    // return table name of admin
    public static function tableName(): string{
        return 'admin';
    }

    // return attribute names of admin
    public function attributes(): array{
        return [
            'username', 'password'
        ];
    }

    // return name of primary key
    public static function primaryKey(): string{
        return 'id';
    }

    
}

?>