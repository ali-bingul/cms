<?php 

namespace app\model;

use app\core\DbModel;

class ReplyComment extends DbModel{

    public int $comment_id = 0;
    public string $content = '';

    public static function tableName(): string {
        return 'admin_comment';
    }

    public function attributes(): array {
        return [
            'comment_id', 'content'
        ];
    }

    public static function primaryKey(): string {
        return 'id';
    }

    public function rules() {
        return [
            'content' => [self::RULE_REQUIRED]
        ];
    }
}