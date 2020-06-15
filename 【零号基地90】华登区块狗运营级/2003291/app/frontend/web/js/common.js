function logOut(){
    document.getElementById("logout").click();
}

$(".large").focus(function() {
	$(this).parent().parent().css("margin-top", "24px");
});
$(".large").blur(function() {
	$(this).parent().parent().css("margin-top", "10px");
});
$(".closeInput").on("click", function() {
	$(this).prev().find("input").val("");
});

