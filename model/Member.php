<?php
namespace app\model;
use app\core\DbModel;
class Member extends MemberModel{

    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public function save(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array{
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public static function tableName(): string {
        return "member";
    }

    public function attributes(): array {
        return [
            'username', 'email', 'password'
        ];
    }

    public function labels(): array{
        return [
            'username' => 'Username', 
            'email' => 'Email', 
            'password' => 'Password', 
            'confirmPassword' => 'Confirm Password' 
        ];
    }

    public static function primaryKey(): string{
        return 'id';
    }

    public function getDisplayName(): string {
        return $this->username;
    }
}
?>