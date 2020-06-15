var myScroll,pullDownEl, pullDownOffset;
function pullDownAction () {
    from_id = parseInt($(".live-product-box:first").find(".lpt-desc-num").children("span").html());
    alert(from_id);
    $.ajax({
        type: 'GET',
		//url: more_url+"&from="+from_id,
		dataType: 'json',
		success: function(json){
			for(i=0;i<json.length;i++){
				goods = json[i];
				var uts = new Date(goods.pushtime * 1000);
				hours = uts.getHours();
				if(hours<10){
					hours = "0"+hours;
				}
				minut = uts.getMinutes();
				if(minut<10){
					minut = "0"+minut; 
				}
				goods_url = url+'&id='+goods.id+'&pid='+pid;
				str = '<div class="live-product-box"><div class="live-prod-time"><span>'+hours+':'+minut+'</span></div><div class="live-prod-pic"><img class="user-icon" src="'+live_head_img+'"><div class="lpi-desc"><a href="'+goods_url+'"><img src="'+goods.pic+'_220x220.jpg"></a></div></div><div class="live-prod-text"><img class="user-icon" src="'+live_head_img+'"><div class="lpt-desc"><p class="lpt-desc-con">原价'+goods.o_price+'元,【券后仅需'+goods.price+'元】<br/>'+goods.introduce+'</p><div class="lpt-desc-buy" onclick="javascript:window.location.href='+goods_url+'"><div class="lpt-desc-num"><label></label><span>'+goods.qid+'</span>号</div><a href="'+goods_url+'"><div class="lpt-desc-buynow"><span>领券购买</span></div></a></div></div></div></div>';
				$('#content .live-product-box:first').before(str);
			}
			myScroll.refresh();
			myScroll.scrollToElement(document.querySelector('#content .live-product-box:nth-of-type(11)'),0);
			$('.pullDownLabel').html("");
		},
		error: function(xhr, type){
			$('.pullDownLabel').html("");
		}
    });
}


function loaded() {
    pullDownEl = document.getElementById('content');
    pullDownOffset = pullDownEl.offsetHeight;//表示获取元素自身的高度
    myScroll = new iScroll('wrapper',{
        vScrollbar:false,
        onScrollMove:function(){
            if (this.y > 5 && !pullDownEl.className.match('flip')) {
               pullDownEl.className = 'flip';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = "<i class='iconfont icon-gengxin'></i>已经到顶了";
                this.minScrollY = 0;
            }
        },
        onScrollEnd:function(){
            if (pullDownEl.className.match('flip')) {
                pullDownEl.className = 'loading';
                  pullDownEl.querySelector('.pullDownLabel').innerHTML = "";
                 // pullDownAction();
            }

        }
    });
    myScroll.scrollToElement(document.querySelector('#content .live-product-box:last-child'),1000);
    //myScroll.scrollToElement(document.querySelector('#content .live-product-box:nth-last-child(1)'),1000);
}

//document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

/* * * * * * * *
 *
 * Use this for high compatibility (iDevice + Android)
 *
 */

	
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);


/*
 * * * * * * * */


/* * * * * * * *
 *
 * Use this for iDevice only
 *
 */
//document.addEventListener('DOMContentLoaded', loaded, false);
/*
 * * * * * * * */


/* * * * * * * *
 *
 * Use this if nothing else works
 *
 */
//window.addEventListener('load', setTimeout(function () { loaded(); }, 200), false);
/*
 * * * * * * * */

