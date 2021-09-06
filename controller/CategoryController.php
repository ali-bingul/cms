<?php

namespace app\controller;

use app\core\Controller;
use app\model\Category;

class CategoryController extends Controller{

    public function getCategories(){
        $category = new Category();
        return $category->getAll(Category::class);
    }
}