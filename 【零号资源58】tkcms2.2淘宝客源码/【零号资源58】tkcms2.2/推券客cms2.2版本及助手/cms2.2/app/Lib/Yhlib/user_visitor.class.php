<?php

/**
 * 访问者
 *
 * @author andery
 */
class user_visitor
{
    // 登陆状态
    public $is_login = false;

    public $info = null;

    public $error = '';
    
    public $field = 'id,username,nickname,phone,email,avatar,password,score,money';
    
    public function __construct()
    {
        $this->check();
    }
    
    public function check()
    {
        if (session('user_info')) {
            // 已经登陆
            $this->info = session('user_info');
            $this->is_login = true;
        } else {
            $this->is_login = false;
        }
        
        return $this->is_login;
    }

    /**
     * 获取用户信息
     */
    public function get($key = null, $real = false)
    {
        $info = null;
        if (is_null($key) && $this->info['id']) {
            $info = M('user')->find($this->info['id']);
        } else {
            if (isset($this->info[$key]) && $real === false) {
                return $this->info[$key];
            } else {
                $info = M('user')->where(array(
                    'id' => $this->info['id']
                ))->getField($key);
            }
        }
        return $info;
    }
	
	
	 /**
     * 微信登陆
     */
    public function wechatlogin($username)
    {
        $where['openid'] = $username;
        $user_info = M('user')->where($where)
            ->field($this->field)
            ->find();
		
        if ($user_info){
		$this->assign_info($user_info);
         return true;
        }
        
        $this->error = '账号不存在';
        
        return false;
    }

    /**
     * 登陆
     */
    public function login($username, $password, $remember = null)
    {
        $where['username'] = $username;
        $where['phone'] = $username;
        $where['openid'] = $username;
        $where['_logic'] = 'or';
        
        $user_info = M('user')->where($where)
            ->field($this->field)
            ->find();
        
        if ($user_info) {
            if ($user_info['password'] == md5($password)) {
                
                $this->assign_info($user_info);
                
                if ($remember) {
                    $this->remember();
                }
                
                return true;
            }
            
            $this->error = '账号或者密码不正确';
            
            return false;
        }
        
        $this->error = '账号不存在';
        
        return false;
    }
    
    public function info_update()
    {
        $id = $this->info['id'];
        
        $where = array(
            'id'=>$id
        );
        
        $user_info = M('user')->where($where)->field($this->field)->find();
        
        $this->assign_info($user_info);
    }

    /**
     * 登陆会话
     */
    public function assign_info($user_info)
    {
        $where = array(
            'id'=>$user_info['id']
        );
        
        $data = array(
            'last_time'=>time(),
            'last_ip'=>get_client_ip(),
            'login_count'=>array('exp','login_count+1')
        );
        
        M('user')->where($where)->save($data);
        
        unset($user_info['password']);
        
        session('user_info', $user_info);
        $this->info = $user_info;
    }

    /**
     * 记住密码
     */
    public function remember()
    {
        cookie(session_name(), cookie(session_name()), 3600 * 24 * 14);
    }

    public function register($username, $phone, $email, $password, $data = array())
    {
        if($username){
            if($this->check_username($username)){
                $this->error = '账号已经存在';
                return false;
            }
        }else if($phone){
            if($this->check_phone($phone)){
                $this->error = '手机号码已经存在';
                return false;
            }
            if(!$username){
                $username = substr($phone, 3);
            }
        }else if($email){
            if($this->check_email($email)){
                $this->error = '邮箱地址已经存在';
                return false;
            }
            if(!$username){
                $username = reset(explode('@', $email));
            }
        }else{
            $this->error = '账号信息不能为空';
            return false;
        }
        
        if(!$password){
            $this->error = '密码不能为空';
            return false;
        }
        
        $data['username'] = $username;
        $data['nickname'] = isset($data['nickname'])?$data['nickname']:$username;
        $data['phone'] = $phone;
        $data['email'] = $email;
        $data['password'] = md5($password);
        $data['money'] = 0;
		$data['avatar'] = '/static/tqkpc/images/noimg.png';
        $data['frozen'] = 0;
        $data['score'] = 0;
        $data['reg_ip'] = get_client_ip();
        $data['reg_time'] = time();
        $data['last_time'] = 0;
        $data['last_ip'] = 0;
        $data['login_count'] = 0;
        $data['create_time'] = time();
        $data['status'] = 1;
        
        $mo = M('user');
        
        $res = false;
        if($mo->create($data)){
            $res = $mo->add();
        }
        
        if($res === false){
            $this->error = $mo->getError()?$mo->getError():$mo->getDbError();
            return false;
        }
        
        $where = array(
            'id'=>$res
        );
        
        $user_info = M('user')->where($where)
            ->field($this->field)
            ->find();
        
        $this->assign_info($user_info);
        
        return true;
    }

    public function check_username($username)
    {
        $exist = M('user')->where(array(
            'username' => $username
        ))->count('id');
        
        if ($exist) {
            return true;
        }
        return false;
    }

    public function check_phone($phone)
    {
        $exist = M('user')->where(array(
            'phone' => $phone
        ))->count('id');
        
        if ($exist) {
            return true;
        }
        return false;
    }

    public function check_email($email)
    {
        $exist = M('user')->where(array(
            'email' => $email
        ))->count('id');
        
        if ($exist) {
            return true;
        }
        return false;
    }

    /**
     * 退出
     */
    public function logout()
    {
        session('user_info', null);
    }
}