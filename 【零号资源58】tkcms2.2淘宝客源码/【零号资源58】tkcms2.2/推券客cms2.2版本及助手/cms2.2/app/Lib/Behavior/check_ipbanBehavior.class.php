<?php
/*��ֹIP����*/

defined('THINK_PATH') or exit();

class check_ipbanBehavior extends Behavior {

    public function run(&$params){
        if (false === $setting = S('setting')) {
            $setting = D('setting')->setting_cache();
        }
        if (!$setting['yh_ipban_switch']) return false;
        $ip = get_client_ip();
        $ipban_mod = D('ipban');
        $ipban_mod->clear(); //�����������
        $isban = $ipban_mod->where(array('type'=>'ip', 'name'=>$ip))->count();
        $isban && exit('�Բ�������IP����ֹ���ʱ�վ��');
    }
}