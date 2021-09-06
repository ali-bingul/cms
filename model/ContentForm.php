<?php

namespace app\model;

use app\core\DbModel;

class ContentForm extends DbModel{

    public string $title = '';
    public string $content = '';
    public string $image = '';
    public string $slug = '';
    public string $category = '';

    public function rules(): array {
        return [
            'title' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED],
            'category' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array {
        return [
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Image',
            'category' => "Category"
        ];
    }

    public static function tableName(): string {
        return 'post';
    }

    public function attributes(): array {
        return [
            'title', 'content', 'category'
        ];
    }

    public static function primaryKey(): string {
        return 'id';
    }



}