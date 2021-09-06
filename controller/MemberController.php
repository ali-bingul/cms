<?php 
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Member;
use app\model\UpdateAccount;

class MemberController extends Controller{

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

    public function updateMember(Request $request, Response $response){
        $updateAccount = new UpdateAccount();
        $memberController = new MemberController();
        $currentMember = $memberController->getMember(['id' => $_SESSION['member']]);
        if($request->isPost()){
            $updateAccount->loadData($request->getBody());
            $oldpassword = $request->getBody()['oldpassword'];
            if(password_verify($oldpassword, $currentMember->password) && ($updateAccount->password == $updateAccount->confirmPassword)){
                $updateAccount->password = password_hash($updateAccount->password, PASSWORD_DEFAULT);
                $updateAccount->email = $currentMember->email;
                if($updateAccount->validate() && $updateAccount->update(" WHERE id = " . $_SESSION['member'])){
                    Application::$app->session->setFlash('success', "You successfully updated your account!");
                    Application::$app->response->redirect('/cms/account');
                    exit;
                }
                return $this->render('account', [
                    'model' => $updateAccount
                ]);
            }
            return $this->render('account', [
                'model' => $updateAccount
            ]);
        }
    }

    public function sendEmailToMember(Request $request, Response $response){
        $body = $request->getBody();
        $mailController = new MailController();
        $memberController = new MemberController();
        $member = $memberController->getMember(['id' => $body['id']]);
        $result = $mailController->sentMailToMember($member, $body['subject'], $body['body']);
        if($result == true){
            $msg = "Mail successfully sended to member";  
        }
        else{
            $msg = "Mail can not be sended to member" . $result;
        }
        Application::$app->session->setFlash('success', $msg);
        return $response->redirect('/cms/admin/members');
    }
}