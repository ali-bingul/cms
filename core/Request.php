<?php
namespace app\core;

class Request {

    // return path with get request
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        // var_dump($_SERVER['REQUEST_URI']);
        // exit;
        $position = strpos($path, '?');
        if($position === false){
            return $path;
        }
        return substr($path, 0, $position);
    }

    // return request method name
    public function method(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(){
        return $this->method() === 'get';
    }

    public function isPost(){
        return $this->method() === 'post';
    }

    // filter data from get or post request and return in array form
    public function getBody(){
        $body = [];
        if($this->isGet()){
            foreach($_GET as $key=>$value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->isPost()){
            foreach($_POST as $key=>$value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}
?>