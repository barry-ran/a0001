/**
 * Created by Administrator on 2018/5/30.
 */
//  在body元素的开头插入<a>标签前加入
$('<a id="logout" style="display: none; position: relative; z-index: 99999;" href="VM://logout"></a>').prependTo('body');

function logOut(){
    document.getElementById("logout").click();
}
