<?php

namespace app\core\form;

use app\controller\CategoryController;
$categoryController = new CategoryController();

class SelectField extends BaseField{
    public function renderInput(): string {
        return 
        Select::begin() . 
        "<option>deneme</option>"   . 
        Select::end();
    }
}