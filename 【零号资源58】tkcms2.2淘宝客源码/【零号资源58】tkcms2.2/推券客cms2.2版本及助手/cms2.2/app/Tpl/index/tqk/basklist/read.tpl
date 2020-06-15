<include file="public:top" />
<body>
	<include file="public:head" />
	<!--wrap-->
	<div class="wrap">
		<div class="container cl">
			<div class="headlines-l">
				<div class="shai-wrap">
					<div class="shai-tit">
						<h4>晒单赚积分</h4>
						<p>已有<b class="c-main">{$count}</b>小伙伴晒单赚积分了</p>
					</div>
					<div class="shai-con">
						<div class="shai-panel">
							<img src="{$info.avatar}" alt="" class="avatar"/>
							<div class="hline"></div>
							<div class="txt">
								<h3 class="text-overflow">{$info.title}</h3>
								<h4>获得{$info.integray}积分</h4>
							</div>
						</div>
						<div class="shai-body cl">
							<div class="shai-name">
								<h5>{$info.nickname}</h5>
								<span>{$info.create_time|frienddate}</span>
							</div>
							<div class="shai-sub shai-article">
									<!-- <a href="" title="" class="shai-sub-shop">
										<img src="http://image.uc.cn/o/wemedia/s/2017/7f5ef74002fbdaf5f1143b6f0216d320x600x600x35.jpeg;,3,jpegx;3,700x.jpg" alt="" />
										<div class="shai-sub-info">
											<p>{$info.title}</p>
											<h4 class="c-warning">360.00</h4><span class="c-999">500.00</span>
										</div>
									</a> -->
									<div class="shai-sub-con">
										<p style="font-size: 16px;line-height: 32px;">
											{$info.content}
										</p>
										<php>$imgArr = explode(',',$info['images']);</php>
										<volist name="imgArr" id="vo">
											<img src="{$vo}" alt="" style="padding:5px 0;">
										</volist>
									</div>
								</div>
							</div>
							<div class="shai-post cl">
								<if condition="$previous_article neq null">
									<a href="{:U('basklist/read',array('id'=>$previous_article['id']))}" class="cl"><div class="pagestate"><span>上</span><div class="hline"></div></div><p>{$previous_article.title}</p></a>
									<else /> 
									<a class="cl"><div class="pagestate"><span>上</span><div class="hline"></div></div><p>到头了</p></a>
								</if>
								<if condition="$next_article neq null">
									<a href="{:U('basklist/read',array('id'=>$next_article['id']))}" class="cl"><div class="pagestate"><span>下</span><div class="hline"></div></div><p>{$next_article.title}</p></a>
									<else />
									<a class="cl"><div class="pagestate"><span>下</span><div class="hline"></div></div><p>到底了</p></a>
								</if>
								<a href="javascript:" onclick="history.back()" class="back"><p>返回列表</p></a>
							</div>
						</div>
					</div>			
				</div>
				<div class="headlines-r">
					<!--shai-->
					<div class="white-bar mb-20">
						<div class="shai-icon">
							<a href="{:U('user/order')}" class="btn btn-main mb-20" title=""><i class="iconfont icon-camera"></i>我要晒单赚积分</a> 
							<a href="{:U('basklist/course')}" class="btn btn-main-outline" title=""><i class="iconfont icon-zhangdan"></i>晒单赚积分教程</a> 
						</div>
						<div class="jifendaren pd-15">
							<img src="__STATIC__/tqkpc/images/jifendaren.png" class="mb-10"/>
							<ul>
								<volist name="talent" id="vo">
									<li>
										<img src="{$vo.avatar}"/>
										<span>{$vo.nickname}</span>
										<b class="c-main f-r">+{$vo.integray}</b>
									</li>
								</volist>
							</ul>
						</div>
					</div>
					<!--youhaohuo-->
					<div class="white-bar pd-15">
						<img src="__STATIC__/tqkpc/images/youhaohuo.png" class="mb-20"/>
						<ul>
							<volist name="sellers" id="vo">
								<li>
									<div class="row cl">
										<div class="col-sm-4 col-xs-4">
											<a rel="nofollow" href="{:U('/item/',array('id'=>$vo['id']))}" target="_blank"><img src="{$vo.pic_url}_300x300" alt="" width="90" height="90"/></a>
										</div>
										<div class="col-sm-8 col-xs-8">
											<a  rel="nofollow" href="{:U('/item/',array('id'=>$vo['id']))}" target="_blank" class="tit">{$vo.title}</a>
											<p class="c-red f-14">券后价：￥{$vo.coupon_price}</p>
											<p class="f-12 mt-5"><img src="__STATIC__/tqkpc/images/tmall.png" class="va-t mr-5"/>月销<span class="c-primary">{$vo.volume}</span>件</p>
										</div>
									</div>
								</li>
							</volist>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<include file="public:foot" />
	</body>
	</html>