<?php

class tuisongAction extends BackendAction
{
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 数据库备份
     */
    public function index()
    {
        $this->display();
    }  

    public function tuisong()
    {
        $items_mo = D('items');
        $article_mo = D('article');
        $url_type = I('post.url_type','','trim');
        $url_num = I('post.url_num','','trim');
        $urls = array();
        $now=time();
        if($url_type == 1){
            if(C('url_model') == 1){
                $item_url = C('yh_site_url')."/index.php/item/id/";
            } else {
                $item_url = C('yh_site_url')."/item/id/";
            }
            $items_list = $items_mo->where('tuisong=0')->order('id desc')->field("id")->limit($url_num)->select();
            $i = 0;
            if(count($items_list)>0){
                foreach ($items_list as $key => $val) {
                    $urls[$i] = $item_url. $val['id'].".html,";
                    $i ++;
                }
                if(C('yh_site_secret') == 0){
                    $url = mb_substr(C('yh_site_url'), 7);
                }else{
                    $url = str_replace("http://","https://",C('yh_site_url'));
                }

                $api = 'http://data.zz.baidu.com/urls?site='.$url.'&token='.trim(C('yh_zhunru'));

                $ch = curl_init();
                $options = array(
                    CURLOPT_URL => $api,
                    CURLOPT_POST => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => implode("\n", $urls),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: text/plain'
                        )
                    );

                curl_setopt_array($ch, $options);
                $result = json_decode(curl_exec($ch),true);
                if($result['success'] && $result['success'] > 0){
                    foreach ($items_list as $key => $val) {
                        $res = $items_mo->where(array('id' => $val['id']))->data(array('tuisong' => 1))->save();
                    }
                    $this->success('您已成功推送'.$result['success'].'个商品');
                } else {
                    $this->error('错误'.$result['error'] . $result['message']);
                }

            }else{
                $this->error('推送商品失败');
            }
        } else {
            if(C('url_model') == 1){
                $item_url = C('yh_site_url')."/index.php/article/read/id/";
            } else {
                $item_url = C('yh_site_url')."/view_";
            }
            $article_list = $article_mo->where('tuisong=0')->order('id desc')->field("id")->limit($url_num)->select();
            $i = 0;
            if(count($article_list)>0){
                foreach ($article_list as $key => $val) {
                    $urls[$i] = $item_url. $val['id'].",";
                    $i ++;
                }
                if(C('yh_site_secret') == 0){
                    $url = mb_substr(C('yh_site_url'), 7);
                }else{
                    $url = str_replace("http://","https://",C('yh_site_url'));
                }

                $api = 'http://data.zz.baidu.com/urls?site='.$url.'&token='.trim(C('yh_zhunru'));

                $ch = curl_init();
                $options = array(
                    CURLOPT_URL => $api,
                    CURLOPT_POST => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => implode("\n", $urls),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: text/plain'
                        )
                    );

                curl_setopt_array($ch, $options);
                $result = json_decode(curl_exec($ch),true);
                if($result['success'] && $result['success'] > 0){
                    foreach ($article_list as $key => $val) {
                        $res = $article_mo->where(array('id' => $val['id']))->data(array('tuisong' => 1))->save();
                    }
                    $this->success('您已成功推送'.$result['success'].'篇文章');
                } else {
                    $this->error('错误'.$result['error'] . $result['message']);
                }

            }else{
                $this->error('推送文章失败');
            }
        }
    }  
}
