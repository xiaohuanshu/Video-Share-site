<?php
namespace Home\Controller;
use Think\Controller;
class EditorController extends Controller {
    public function index(){
        $this->display();
    }
    
    public function ueditor(){
    	$data = new \Org\Util\Ueditor();
		echo $data->output();
    }
}