<?php

namespace app\services;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\model\Member;

class MemberService {
    public function getMembers($orderBy = '', $limit = ''){
        $member = new Member();
        return $member::getAll(Member::class, '',  $orderBy, $limit);
    }

    public function deleteMember($where){
        $member = new Member();
        $member->deleteOne($where, Member::class);
    }

    public function getMember($where){
        $member = new Member();
        return $member::findOne($where, Member::class);
    }
}