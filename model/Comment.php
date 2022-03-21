<?php

namespace app\model;

use app\core\DbModel;

class Comment extends DbModel{

    public int $member_id = 0;
    public string $content = '';
    public string $post_id = '';

    public static function tableName(): string {
        return 'comment';
    }

    public function attributes(): array {
        return [
            'member_id', 'content', 'post_id'
        ];
    }

    public static function primaryKey(): string{
        return 'id';
    }

    public function rules(): array{
        return [
            'content' => [self::RULE_REQUIRED]
        ];
    }
}