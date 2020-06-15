<?php
class loginAction extends FirstendAction
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index(){

        if($this->visitor->is_login){
            $this->redirect(U('user/ucenter','',''));
        }	
        $this->_config_seo(array(
            'title'=>'用户登录'
            )); 

        $this->display();
    }


    public function register()
    {
        if($this->visitor->is_login){
            $this->redirect('user/ucenter');
        }

        if(IS_POST){
      $phone = trimall(I('phone','','htmlspecialchars'));

       $username = trimall(I('username','','htmlspecialchars'));

       $email = trimall(I('email','','htmlspecialchars'));

       $password =trimall(I('password','','htmlspecialchars'));

       $repassword = trimall(I('repassword','','htmlspecialchars'));

            $code = I('code','','trim');
			
			if(!is_numeric($phone)){
			 $this->ajaxReturn(0, '非法操作');
			}

            if($_SESSION['verify'] != md5($code)){
                $this->ajaxReturn(0, '验证码错误');
            }

            if($password != $repassword){
                $this->ajaxReturn(0, '两次密码输入不一致');
            }

            $res = $this->visitor->register($username, $phone, $email, $password, $data);

            if($res){
                return $this->ajaxReturn(1, '注册成功', U('user/ucenter'));
            }

            $this->ajaxReturn(0, $this->visitor->error);
        }


        $this->_config_seo(array(
            'title'=>'用户注册'
            ));

        $this->display();
    }





    public function login(){

        if($this->visitor->is_login){

            $this->redirect(U('user/ucenter','',''));
        }	

        if(IS_POST){

       $username = trimall(I('username','','htmlspecialchars'));

        $password = trimall(I('password','','htmlspecialchars'));

            $remember = I('remember','trim', 0);

            $code = I('code','','trim');

            if($_SESSION['verify'] != md5($code)){
                $this->ajaxReturn(0, '验证码错误');
            }

            $res = $this->visitor->login($username, $password, $remember);

            if($res){
                $role=$this->visitor->get('webmaster');

                if($role==1){

                    if(empty($callback)){$callback=U('zhan/ucenter');}
                    if(strpos($callback, '/login') !== false){
                        $callback = U('zhan/ucenter');
                    }
                    return $this->ajaxReturn(1, '登录成功', $callback?$callback:U('zhan/ucenter'), array(
                        'id'=>$this->visitor->get('id'),
                        'nickname'=>$this->visitor->get('nickname'),
                        'role'=>$this->visitor->get('webmaster')
                        ));

                }else{
// $callback = I('callback','trim');
                    if(empty($callback)){$callback=U('user/ucenter');}

                    if(strpos($callback, '/login') !== false){
                        $callback = U('user/ucenter');
                    }
                    return $this->ajaxReturn(1, '登录成功', $callback?$callback:U('user/ucenter'), array(
                        'id'=>$this->visitor->get('id'),
                        'nickname'=>$this->visitor->get('nickname'),
                        'role'=>$this->visitor->get('webmaster')
                        ));


                }






            }

            $this->ajaxReturn(0, $this->visitor->error);
        }


    }


    public function logout()
    {
        $this->visitor->logout();
        redirect('/');
        exit();
        $callback = $_SERVER['HTTP_REFERER'];
        if(
            strpos($callback, '/login') !== false ||
            strpos($callback, '/user') !== false 
            ){
            $callback = C('yh_headerm_html');
    }

    redirect($callback);
}

Public function verify(){ 

    import('ORG.Util.Image');

    Image::buildImageVerify();
}

}  