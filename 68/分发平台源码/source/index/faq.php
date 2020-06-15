<?php

//decode by 精品资源分享网www.xiomao.cn
echo '<div class="section packages-faq">
	<div class="packages-faq-wrap text-left">
		<div class="packages-faq-header">FAQ</div>
		<div class="packages-faq-content">
			<ol class="packages-faq-list">
				<li>
				<div class="faq-title">如何扩充应用容量？</div>
				<ol class="faq-list-items">
					<li>1、应用管理 -> 已用容量 -> 扩充容量</li>
					<li>2、注册初始赠送 ';
echo IN_REGSPACE;
echo ' MB容量</li>
				</ol>
				</li>
				';
if (IN_SPEEDPOINTS) {
	echo '<li>
				<div class="faq-title">如何升级应用的下载通道？</div>
				<ol class="faq-list-items">
					<li>1、应用管理 -> 管理 -> 基本信息 -> 下载通道</li>
					<li>2、每个应用需单独升级并扣除 ';
	echo IN_SPEEDPOINTS;
	echo ' 下载点数</li>
				</ol>
				</li>';
}
echo '				';
if (IN_ADPOINTS) {
	echo '<li>
				<div class="faq-title">如何去除应用安装页的底部广告？</div>
				<ol class="faq-list-items">
					<li>1、应用管理 -> 管理 -> 基本信息 -> 去除广告</li>
					<li>2、每个应用需单独去除并扣除 ';
	echo IN_ADPOINTS;
	echo ' 下载点数</li>
				</ol>
				</li>';
}
echo '			</ol>
		</div>
	</div>
</div>';