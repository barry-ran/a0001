<include file="public:top" />
<body>
	<include file="public:head" />
	<!--wrap-->
	<div id="dtk_mian">
		
		<div class="container cl">
			<div class="fwrap">
			<volist name="brand" key="k" id="bo">	
				<div class="fbrand indexblock" id="floor1">
					<ul class="cl">
						<li><div class="floor"><h2>{$k}F</h2><h4>{$bo.name}</h4></div></li>
<?php
$brandlist=$bo['brandlist'];	
?>
<volist name="brandlist" offset="0" id="child">	
<li><a  target="_blank" href="{:U('cate/index',array('k'=>$child['brand']))}"><div class="brandcell"><img src="{$child.logo}"/><span>{$child.brand}</span></div></a></li>
</volist> 	
					</ul>
				</div>
				</volist> 
			</div>
		</div>
	</div>
	<include file="public:foot" />
	<script type="text/javascript">
		$(window).scroll(function() {
			var wst = $(window).scrollTop() 
			for(i = 1; i < $(".fbrand").length; i++) { 
				if($("#floor" + i).offset().top <= wst) { 
					$('.floorNav a').removeClass("cur");
					$(".fnav" + i).addClass("cur");
				}
			}
		})
		$('.floorNav a').click(function() {
			$('.floorNav a').removeClass("cur");
			$(this).addClass("cur");
		});
	</script>
</body>
</html>