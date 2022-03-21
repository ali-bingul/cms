<?php 
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\UpdateAccount;
use app\services\MailService;
use app\services\MemberService;

class MemberController extends Controller{

    public function updateMember(){
        $request = new Request();
        $response = new Response();
        $updateAccount = new UpdateAccount();
        $memberService = new MemberService();
        $currentMember = $memberService->getMember(['id' => $_SESSION['member']]);
        if($request->isPost()){
            $updateAccount->loadData($request->getBody());
            $oldpassword = $request->getBody()['oldpassword'];
            if(password_verify($oldpassword, $currentMember->password) && ($updateAccount->password == $updateAccount->confirmPassword)){
                $updateAccount->password = password_hash($updateAccount->password, PASSWORD_DEFAULT);
                $updateAccount->email = $currentMember->email;
                if($updateAccount->validate() && $updateAccount->update(" WHERE id = " . $_SESSION['member'])){
                    Application::$app->session->setFlash('success', "You successfully updated your account!");
                    Application::$app->response->redirect('/account');
                    exit;
                }
                $params = [
                    "model" => $updateAccount,
                ];
                echo $this->templates->render("acount", $params);
            }
            $params = [
                "model" => $updateAccount,
            ];
            echo $this->templates->render("acount", $params);
        }
    }
    
    public function sendEmailToMember(){
        $request = new Request();
        $response = new Response();
        $body = $request->getBody();
        $mailService = new MailService();
        $memberService = new MemberService();
        $member = $memberService->getMember(['id' => $body['id']]);
        $result = $mailService->sentMailToMember($member, $body['subject'], $body['body']);
        if($result == true){
            $msg = "Mail successfully sended to member";  
        }
        else{
            $msg = "Mail can not be sended to member" . $result;
        }
        Application::$app->session->setFlash('success', $msg);
        return $response->redirect('/admin/members');
    }
}