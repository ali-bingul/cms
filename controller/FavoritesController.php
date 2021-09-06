<?php

namespace app\controller;

use app\core\Controller;
use app\model\Favorites;

class FavoritesController extends Controller
{

    public function getFavorites($where = '', $orderBy = '', $limit = '')
    {
        $favorites = new Favorites();
        return $favorites->getAll(Favorites::class, $where, $orderBy, $limit);
    }

    public function addFavorites()
    {
    }

    protected function getFavorite($where)
    {
        $favorites = new Favorites();
        return $favorites::findOne($where, Favorites::class);
    }

    public function isFavorite($where)
    {
        // if($this->getFavorite($where)){
        //     return true;
        // }
        // return false;
        $favorites = new Favorites();
        $tableName = 'favorites';
        $sql = "SELECT * FROM $tableName $where";
        $statement = $favorites->prepare($sql);
        $statement->execute();
        if ($statement->fetchObject(static::class)) {
            return true;
        }
        return false;
    }

    public function addFavorite($member_id, $post_id)
    {
        $favorites = new Favorites();
        $tableName = Favorites::tableName();
        $sql = "INSERT INTO $tableName (member_id, post_id) VALUES ($member_id, $post_id)";
        $statement = $favorites->prepare($sql);
        $statement->execute();
    }

    public function deleteFavorite($whereQuery)
    {
        $favorites = new Favorites();
        // $favorites->deleteOne($where, Favorites::class);
        $tableName = Favorites::tableName();
        $sql = "DELETE FROM $tableName $whereQuery";
        $statement = $favorites->prepare($sql);
        $statement->execute();
    }
}
