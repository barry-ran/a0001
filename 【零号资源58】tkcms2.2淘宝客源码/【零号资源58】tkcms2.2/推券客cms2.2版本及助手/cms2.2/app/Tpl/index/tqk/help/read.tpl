<include file="public:top" />
	<body>
<include file="public:head" />
		<!--wrap-->
		<div class="wrap">
			<div class="container cl">
				<div class="etao-88db-guide-newer clearfix">
					<div class="etao-88db-sidebar f-l">
						<div id="magix_vf_sidebar">
							<div class="etao-2927-guide-nav">
								<ul class="etao-2927-side-nav">
						<volist name="helps" id="vo">	
									<li <if condition="$id eq $vo['id']"> class="etao-2927-active"</if>>
										<a href="{:U('help/index',array('id'=>$vo['id']))}">{$vo.title}</a>
									</li>
					</volist>		 	
								</ul>
							</div>
						</div>
					</div>
					<div class="etao-88db-main-wrap f-r">
						<div id="magix_vf_main">
							<div class="etao-c282-guide-main-container">
								<ul id="J_magix_vf_main_guide_data">
									<li class="">
										<div class="etao-c282-question-wrapper">
											{$help.info}
										</div>
									</li>
									<li>	
										<div class="etao-c282-question-wrapper">
									<br /><br />
								</div>
								</li>
								</ul>
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<include file="public:foot" />
	</body>
</html>