<?php 
    namespace app\model;
    use app\core\Model;
    use app\core\Application;
    class AdminLoginForm extends Model{
        
        public string $username = '';
        public string $password = '';
        
        public function rules(): array{
            return [
                'username' => [self::RULE_REQUIRED],
                'password' => [self::RULE_REQUIRED]
            ];
        }

        public function login(){
            $admin = Admin::findOne(['username' => $this->username], Admin::class);
            if(!$admin){
                $this->addError('email', "Admin username is incorrect");
                return false;
            }
            if(!password_verify($this->password, $admin->password)){
                $this->addError('password', "Password is incorrect");
                return false;
            }
            return Application::$app->loginAdmin($admin);
        }
    
        public function labels(): array{
            return [
                "username" => "Username",
                "password" => "Password"
            ];
        }
    }

?>