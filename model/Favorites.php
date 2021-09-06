<?php 

namespace app\model;

use app\core\DbModel;

class Favorites extends DbModel{

    public int $member_id = 0;
    public int $post_id = 0;

    public static function tableName(): string {
        return 'favorites';
    }

    public function attributes(): array {
        return [
            'member_id', 'post_id'
        ];
    }

    public static function primaryKey(): string {
        return 'id';
    } 

    public function rules() {
        return [

        ];
    }


}