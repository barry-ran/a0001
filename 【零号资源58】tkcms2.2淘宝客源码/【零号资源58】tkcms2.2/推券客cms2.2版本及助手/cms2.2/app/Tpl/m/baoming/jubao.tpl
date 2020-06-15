<include file="public:head_nosearch" />
	<header data-am-widget="header" class="am-header am-header-default am-header-fixed white-nav">
	      	<div class="am-header-left am-header-nav">
			    <a href="javascript:history.go(-1);" class="iconfont icon-left"></a>
			</div>
			<h1 class="am-header-title">举报投诉</h1>
 			<include file="public:navright" />
		</header>
<main>
    <div class="am-u-md-8 am-u-sm-centered am-padding-top">
		<form action="/index.php?g=m&m=baoming&a=report" method="post" id="report-form">
			<div class="am-alert am-alert-secondary" >如果发现优惠券失效，或者有其它违规行为，欢迎在这里举报给我们。</div>
		      <fieldset class="am-form-set">
		 		<textarea style="width: 100%;" required="required" name="reason"  placeholder="" rows="7"></textarea>
		      </fieldset>
		      <input type="hidden" name="from" value="{$_SERVER['HTTP_REFERER']}"/>
		      <input type="hidden" name="url" value="https://item.taobao.com/item.htm?id={:I('num_iid')}"/>
			  <input type="hidden" name="num_iid" value="{:I('num_iid')}"/>
			  <input type="hidden" name="from" value="{$_SERVER['HTTP_REFERER']}"/>
		      <button type="submit" id="smt" class="am-btn btn-main am-radius am-btn-block">提交举报</button>
		</form>
  	</div>
</main>
<include file="public:amz_foot" />
<script>
	$('#report-form').submit(function(){
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
</body></html>
