<?php

namespace app\controller;

use app\core\Controller;
use app\model\ContentForm;

class ContentController extends Controller{
    public function getContents($where = '', $orderBy = '', $limit = ''){
        $contentForm = new ContentForm();
        return $contentForm::getAll(ContentForm::class, $where,  $orderBy, $limit);
    }

    public function updateActive($where, $isActive){
        $contentForm = new ContentForm();
        $contentForm::updateWhere($where, ContentForm::class, $isActive);
    }

    public function deleteContent($where){
        $contentForm = new ContentForm();
        $contentForm->deleteOne($where, ContentForm::class);
    }

    public function getContent($where){
        $contentForm = new ContentForm();
        return $contentForm::findOne($where, ContentForm::class);
    }

    public function hasContent($where){
        if($this->getContent($where)){
            return true;
        }
        return false;
    }
}