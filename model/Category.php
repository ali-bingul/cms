<?php
    namespace app\model;

use app\core\DbModel;

    class Category extends DbModel{

        public string $name = '';
        public string $slug = '';

        public static function tableName(): string {
            return "category";
        }

        public function attributes(): array {
            return [
                "name", "slug"
            ];
        }

        public static function primaryKey(): string{
            return 'id';
        }

        public function rules(): array{
            return [
                'name' => []
            ];
        }
    }

?>
