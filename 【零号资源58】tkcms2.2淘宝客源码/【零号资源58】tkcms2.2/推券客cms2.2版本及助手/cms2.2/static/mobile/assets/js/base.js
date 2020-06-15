var u = navigator.userAgent;
if(u.indexOf('iPhone')> -1) {
$("input,textarea").focus(function(){
   $("#navso").css({"bottom":"45px","position":"fixed"});
});
$("input,textarea").blur(function(){
   $("#navso").css("bottom","0px");
 });
}else{
window.setTimeout(function () {
document.activeElement.scrollIntoViewIfNeeded();
 }, 400);
}

function back(){
        var last_page_url = (document.referrer);
        if(last_page_url){
            window.history.back(-1);
        }else{
            window.location.href ='/';
        }
    }
