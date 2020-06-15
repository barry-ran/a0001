<?php
/**
 * @author shuang
 * @date 2017-1-13 21:02:31
 */
?>
<section class="content">

    <header data-am-widget="header" class="am-header am-header-default" style="height: 8%;background-color:#F7CA4B;">
        <div class="am-header-left am-header-nav">
            <a href="javascript:history.go(-1);" class="">
                <i class="am-header-icon am-icon-angle-left"></i>
            </a>
        </div>

        <h1 class="am-header-title">
            <a href="#title-link" class="">
                公告
            </a>
        </h1>
    </header>

    <div class="am-g">
        <div class="am-u-sm-12" style="padding-left: 0px;padding-right: 0px;">
            <p align="center"><?php echo $data->title; ?></p>
            <div class="essay"><span><?php echo $data->content; ?></span></div>
        </div>
    </div>
    
</section>