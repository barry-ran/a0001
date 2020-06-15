<include file="public:head_nosearch" />
	<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">卖家报名</h1>
 			<include file="public:navright" />
		</header>
<!--header-->
<main>
	<div class="am-u-md-8 am-u-sm-centered am-padding-top">
	   	<form action="/index.php?g=m&m=baoming&a=enroll" method="post" class="am-form" id="enroll-form">
	      <fieldset class="am-form-set">
	        <input name="goods_url" required="required" type="text" id="goods_url" autocomplete="off" class="baominginput" placeholder="报名活动商品的淘宝地址">
	        <input name="goods_price" required="required"  type="text" id="goods_price" autocomplete="off" class="baominginput" placeholder="参加活动的最低价格">
	        <input type="text" id="goods_quan" name="goods_quan" required="required" autocomplete="off" class="baominginput" placeholder="参加活动的专享优惠券金额">
	           <input name="person_name" required="required" id="person_name"  type="text" autocomplete="off" class="baominginput" placeholder="您的称呼">
	              <input type="text" type="text" id="person_qq" name="person_qq" required="required" autocomplete="off" class="baominginput" placeholder="联系QQ">
	              <textarea  id="reason" name="reason" autocomplete="off" placeholder="您还可以在这里从客观的角度评价您的商品优势，将有助于报名审核通过。" cols="30" rows="6"> </textarea>
	      </fieldset>
	      <input type="hidden" name="from" value="{$_SERVER['HTTP_REFERER']}"/>
	      <button type="submit" id="smt" class="am-btn btn-main am-radius am-btn-block">提交报名</button>
	    </form>
	</div>
</main>
<include file="public:amz_foot" />
<script>
	$('#enroll-form').submit(function(){
		$.post($(this).attr('action'), $(this).serialize(), function(json){
			if(json.status != 1){
				layer.msg(json.msg, {
					icon: 2
				});
				return false;
			}
			layer.msg(json.msg, {
				icon: 1
			}, function(){
				var index = parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
			});
		}, 'json');
		return false;
	});		
</script>
</body>
</html>