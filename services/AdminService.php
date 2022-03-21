<?php

namespace app\services;

use app\model\Admin;

class AdminService {
    public function getAdmin(){
        $admin = new Admin();
        return $admin::findOne(['id' => $_SESSION['admin']], Admin::class);
    }
}