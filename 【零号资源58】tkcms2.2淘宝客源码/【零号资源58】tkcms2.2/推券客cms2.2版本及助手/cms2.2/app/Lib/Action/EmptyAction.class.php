<?php
class EmptyAction extends Action {
    public function _empty() {
		$this->redirect('index/index');
		exit;

       // send_http_status(404);
        $this->display(TMPL_PATH . '404.html');
    }
}