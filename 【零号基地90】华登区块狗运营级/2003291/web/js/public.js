(function(factory){if(typeof define==='function'&&define.amd){define(['jquery'],factory);}else if(typeof exports==='object'){factory(require('jquery'));}else{factory(jQuery);}}(function($){var pluses=/\+/g;function encode(s){return config.raw?s:encodeURIComponent(s);}
function decode(s){return config.raw?s:decodeURIComponent(s);}
function stringifyCookieValue(value){return encode(config.json?JSON.stringify(value):String(value));}
function parseCookieValue(s){if(s.indexOf('"')===0){s=s.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,'\\');}
try{s=decodeURIComponent(s.replace(pluses,' '));return config.json?JSON.parse(s):s;}catch(e){}}
function read(s,converter){var value=config.raw?s:parseCookieValue(s);return $.isFunction(converter)?converter(value):value;}
var config=$.cookie=function(key,value,options){if(value!==undefined&&!$.isFunction(value)){options=$.extend({},config.defaults,options);if(typeof options.expires==='number'){var days=options.expires,t=options.expires=new Date();t.setTime(+t+days*864e+5);}
return(document.cookie=[encode(key),'=',stringifyCookieValue(value),options.expires?'; expires='+options.expires.toUTCString():'',options.path?'; path='+options.path:'',options.domain?'; domain='+options.domain:'',options.secure?'; secure':''].join(''));}
var result=key?undefined:{};var cookies=document.cookie?document.cookie.split('; '):[];for(var i=0,l=cookies.length;i<l;i++){var parts=cookies[i].split('=');var name=decode(parts.shift());var cookie=parts.join('=');if(key&&key===name){result=read(cookie,value);break;}
if(!key&&(cookie=read(cookie))!==undefined){result[name]=cookie;}}
return result;};config.defaults={};$.removeCookie=function(key,options){if($.cookie(key)===undefined){return false;}
$.cookie(key,'',$.extend({},options,{expires:-1}));return!$.cookie(key);};}));


var url = 'http://lf2.221bk.cn';
//获取路径？后字段
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURI(r[2]);
    return '';
}

// token
var token = GetQueryString('token');
if (token == "") {
	var c_token = $.cookie('c_token');
	if (c_token) {
		token = c_token;
	}
} else {
	$.cookie('c_token', token, { expires: 10 });
}
console.log("=======token======")
console.log(token)
// var tokenHref = GetQueryString('token');
// if (tokenHref == '' || tokenHref == undefined || tokenHref == null) {
	
// } else {
    // localStorage.setItem('token', tokenHref);
// }
// var token = localStorage.getItem('token');




// 返回键
function historygo(){
	// location.href = history.go(-1);
	location.href="app://goback";
}

//跳转个人中心页面
function myIndex(){
	location.href="app://myIndex";
}

function isErr(res){
	if(res.status == "0002"){
				layer.msg(res.message,{time:1*1000},function() {
			// location.href="app://logout";
		});
	}else{
		layer.msg(res.message,{time:1*1000},function() {
			// location.href="app://logout";
			window.location.href="http://lf1.221bk.cn/login.html";
		});
	}
}

//title
$("title").html("Lucky zodiac");




