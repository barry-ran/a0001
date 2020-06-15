<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php echo Yii::t('app','添加银行卡')?></title>
    <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />

    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/js.js" type="text/javascript"></script>
</head>
<body>
<div class="page m">
    <ul class="balist">
        <?php foreach ($res as $item): ?>
            <li class="baitem" id="<?php echo $item["id"]; ?>">
                <p class="bait1">
                    <span class="bt1le">
                        <?php if($lang == "en_US"){
                            echo $item["en_name"];
                        } else {
                             echo $item["name"];
                        }?>
                    </span>
                    <?php if($item["isdefault"] == 2 ):?>
                        <a class="bt1lr" style="color: grey;"><?php echo  Yii::t('app', '默认'); ?></a>
                    <?php else:?>
                        <a></a>
                    <?php endif;?>
                </p>
                <p class="bait2"><?php  echo $item["bank_number"]; ?>
                    <input type="hidden" id="bank_id" value="<?php echo $item['id']; ?>" />
                    <a class="bt1lr"><?php echo Yii::t('app', '删除'); ?></a>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="am-u-sm-12 Acard" id="addcard" style="text-align: center;">
        <a class="true datalink"><?php echo Yii::t('app', '添加银行卡'); ?></a>
    </div>

</div>
<script>
    $(".bt1lr").click(function(){
        var id = $('#bank_id').val();
        $.ajax({
            type: "post",
            data: {id:id},
            dataType: "json",
            url: "/user/bank.html",
            success: function (result) {
                if(result.status == true){
                    alert(result.message);
                    location.href = '/user/addcard.html';
                }else{
                    alert(result.message);
                }
            }
        });
    });

    $("#addcard").click(function(){
        window.location = "/user/back.html";
    });
    $(".baitem").click(function(){
        var appdid = $(this).attr("id");
        window.location = "/user/modify.html?id=" + appdid;
    });
    $(function(){
        $('.bt1lr').on("click",function(){
            event.stopPropagation();
            $(this).prop('disabled', false);
        })
    })
</script>
</body>
</html>
