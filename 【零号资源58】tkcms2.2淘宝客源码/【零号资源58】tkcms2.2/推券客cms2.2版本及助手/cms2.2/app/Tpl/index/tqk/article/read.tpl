<include file="public:top" />
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
				<div class="headlines-l white-bar">
					<div class="pd-15">
						<div class="headlines-con">
							<p class="f-14"><a href="{:U('article/index')}{$trackurl}">优惠券头条</a><i class="iconfont icon-tubiao04"></i><a href="{:U('article/index/',array('cateid'=>$info['cate_id']))}">{$info.catename}</a></p>
							<div class="title">
								<h3>{$info.title}</h3>
								<p>{:date('Y-m-d',$info['add_time'])}</p>
							</div>
							<div class="con">
								{$info.info}
								
							<div style="text-align: center; padding-top: 30px;">	<a href="javascript:history.back(-1)" class="back">返回>></a></div>
								
							</div>
							<div class="post">
                            <if condition="$next_article neq null">
											<p><a href="<if condition="C('URL_MODEL') eq 2">/article/view_{:$next_article['id']}<else/>{:U('/article/read',array('id'=>$next_article['id']))}</if>"><span class="c-999 mr-10">上一篇：</span>{$next_article.title}</a></p>
										<else />
												<p><a><span class="c-999 mr-10">上一篇：</span>到头了</a></p>
										</if>
										<if condition="$previous_article neq null">
											<p>	<a href="<if condition="C('URL_MODEL') eq 2">/article/view_{:$previous_article['id']}<else/>{:U('/article/read',array('id'=>$previous_article['id']))}</if>"><span class="c-999 mr-10">下一篇：</span>{$previous_article.title}</a></p>
										<else />
											<p>	<a><span class="c-999 mr-10">下一篇：</span>到底了</a></p>
										</if>
							</div>
						</div>
					</div>
				</div>
				<div class="headlines-r white-bar">
					<div class="pd-15">
						<img src="__STATIC__/tqkpc/images/youhaohuo.png" class="mb-20"/>
						<ul>
								<volist name="sellers" id="vo">
							<li>
								<div class="row cl">
									<div class="col-sm-4 col-xs-4">
										<a href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" target="_blank"><img src="{$vo.pic_url}_300x300" alt="" width="90" height="90"/></a>
									</div>
									<div class="col-sm-8 col-xs-8">
										<a href="{:U('/item/',array('id'=>$vo['id']))}{$trackurl}" target="_blank" class="tit">{$vo.title}</a>
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