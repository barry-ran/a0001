<?php //use \frontend\models\UserProfile;?>

<!DOCTYPE html>
<html lang="zh-CN" class="ACCOUNT">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php  echo $title2; ?></title>
    <!--<link href="/css/admin.css" rel="stylesheet">-->
    <link href="/css/amazeui.min.css" rel="stylesheet">
    <link href="/css/myassets.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/common2.css" />
    <style>
        html{overflow: initial;}
        .tradeBtn{ padding: 1px 6px; border: 1px solid #1E88E5;}
        a{ color: #1E88E5;}
        #trade div{ color: #1E88E5;}
        #trade .on{ color: #FFFFFF;}
        .hint0{ background: none; text-align: center; font-size: 16px; color: #b3b3b3;}
        body{
            overflow: auto;
        }
    </style>
</head>

<section>
    <div class="am-container">
        <div class="am-g" style="overflow-x: hidden;">
            <div class="am-u-sm-12 bgBlb tcenter balance color-white" style="background-color: #1E88E5;width: 100%;">
                <div class="am-u-sm-6" style="border-right: 1px solid #cccccc;float: left;width: 50%;">
                    <p style="color: #fff;"><?php echo Yii::t('app', '卢宝'); ?></p>
                    <p style="color: #fff"><?php echo $user_wallet['cash_wa']; ?></p>
                </div>
                <div class="am-u-sm-6" style="width:calc(50% - 1px);float: right;">
                    <p style="color: #fff;"><?php echo Yii::t('app', '卢呗'); ?></p>
                    <p style="color: #fff"><?php echo $user_wallet['hcg_wa']; ?></p>
                </div>
            </div>
            <div class="assetsPrice" style="background-color: white;display: flex;flex-wrap: nowrap;justify-content: space-around">
                <div><span style="color: #333;"><?php echo Yii::t('app', '当前价格'); ?>:</span><span style="color: #1E88E5;"><?php echo $sysPriceData['price'] ?></span></div>
                <div><span style="color: #333;"><?php echo Yii::t('app', '高'); ?>:</span><span style="color: #1E88E5;"><?php echo $hPrice['price'] ?></span></div>
                <div><span style="color: #333;"><?php echo Yii::t('app', '低'); ?>:</span><span style="color: #1E88E5;"><?php echo $lPrice['price'] ?></span></div>
            </div>
            <div class="am-u-sm-12 pad0_5">
                <div class="assetsOrder tcenter" style="margin-top: 10px;background-color: #fff;">
                    <div class="assetsC">
                        <a href="/trade/selling.html">
                            <img src="/img/shouchudindan.png"/>
                            <div style="color: #333;"><?php echo Yii::t('app', '发布出售订单'); ?></div>
                        </a>
                    </div>
                    <div class="assetsC">
                        <a href="/trade/buying.html">
                            <img src="/img/goumaidingdan.png"/>
                            <div style="color: #333;"><?php echo Yii::t('app', '发布购买订单'); ?></div>
                        </a>
                    </div>
                    <div class="assetsC">
                        <a href="/trade/tradeorderlist.html?status=qr&order_type=1">
                            <img src="/img/wodedingdan.png"/>
                            <div style="color: #333;"><?php echo Yii::t('app', '订单'); ?></div>
                        </a>
                    </div>
                    <div class="assetsC">
                        <a href="/trade/traderecord.html?status=ywc&type=2&order_type=1">
                            <img src="/img/jiaoyijilul.png"/>
                            <div style="color: #333;"><?php echo Yii::t('app', '交易记录'); ?></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="am-u-sm-12 mt10 pad10" style="background-color: #fff;">
                <div class="assetsTime tcenter" style="width:calc(100%);">
                    <div class="assetsTimeB border-r-orange on" style="width:calc(33.3%);"><?php echo Yii::t('app', '5分钟'); ?></div>
                    <div class="assetsTimeB border-r-orange" style="width:calc(33.3%);"><?php echo Yii::t('app', '5小时'); ?></div>
                    <div class="assetsTimeB" style="width:calc(33.3%);"><?php echo Yii::t('app', '日线'); ?></div>
                </div>

                <div id="main1" class="assetsChart"></div>
                <div id="main2" class="assetsChart ng-hide"></div>
                <div id="main3" class="assetsChart ng-hide"></div>
            </div>
            <div class="pad10">
                <div class="assetsBS width100 mt10 tcenter" id="trade">
                        <div class="assetsBuy item on"><?php echo Yii::t('app', '购买'); ?></div>
                        <div class="assetsSell item"><?php echo Yii::t('app', '出售'); ?></div>
                </div>
            </div>
            <div id="blockBuy" class="width100 pad0_5" style="max-height: 400px; overflow: auto;">
                <div class="lists">
                <?php
                if(!empty($tradeList['data'])) {
                    $isBind = $unbind; // 是否绑定银行卡, 1: 未绑定
                    foreach ($tradeList['data'] as $val) {
                        //  配置提交数据
                        $temp = [
                            'id' => $val['id'],
                            'number' => $val['number'], // 修改: 去掉 * 0.8
                            'price' => $val['price'],
                            'amount' => $val['amount'],
                        ];

                        //  配置账号，订单操作
                        //  2：买入，1：卖出
                        if (!isset($_GET['tradeType']) || (isset($_GET['tradeType']) && $_GET['tradeType'] == 2)) {
                            $username = $val['out_username'];
                            $icon = \frontend\models\WB_UserProfile::getIconByUsername($username) ? \frontend\models\WB_UserProfile::getIconByUsername($username) : 'img/header.png';
//                            $icon = '/img/header.png';
                            $temp['username'] = $username;
                            $strVal = str_replace("\"", "", json_encode($temp));
                            if ($isBind == 1) {
                                $control = "<span class='tradeBtn' style='color: #1E88E5; border: 1px solid #1E88E5;' onclick='goToBind()'>" . Yii::t('app', '买入') . "</span>";
                            } else {
                                $control = "<span class='tradeBtn' style='color:#1E88E5; border: 1px solid #1E88E5;' onclick='t_buy(\"" . $strVal . "\")'>" . Yii::t('app', '买入') . "</span>";
                            }
                        } elseif (isset($_GET['tradeType']) && $_GET['tradeType'] == 1) {
                            $username = $val['in_username'];
                            $icon = \frontend\models\WB_UserProfile::getIconByUsername($username) ? \frontend\models\WB_UserProfile::getIconByUsername($username) : 'img/header.png';
//                            $icon = '/img/header.png';
                            $temp['username'] = $username;
                            $strVal = str_replace("\"", "", json_encode($temp));
                            if ($isBind == 1) {
                                $control = "<span class='tradeBtn' style='color: #1E88E5; border: 1px solid #1E88E5;' onclick='goToBind()'>" . Yii::t('app', '卖出') . "</span>";
                            } else {
                                $control = "<span class='tradeBtn' style='color: #1E88E5; border: 1px solid #1E88E5;' onclick='t_sell(\"" . $strVal . "\")'>" . Yii::t('app', '卖出') . "</span>";
                            }

                        }
                        ?>
                        <div class="am-u-sm-12  pad10" style="width: 100%;display: inline-block; background-color:white; margin-bottom: 10px;">
                            <div class="fl" style="width: 60px;"><img src="<?php echo '/' . $icon; ?>"
                                                                      style="width: 50px;height: 50px;"/></div>
                            <div class="tleft fl" style="width: calc(100% - 140px);">
                                <div class="nick-a" style="color: #b3b3b3;"><?php echo $username; ?></div>
                                <div><span style="color: #b3b3b3;"><?php echo Yii::t('app', '数量'); ?>:</span><span
                                            class="xiane"
                                            style="color: #1E88E5;"><?php echo $val["number"]; // 修改: 去掉 * 0.8 ?></span>
                                </div>
                            </div>
                            <div class="tright color-orange fl" style="width: 80px;">
                                <div class="jiage" style="color: #1E88E5;"></div>
                                <div><?php echo $control; ?></div>
                            </div>
                        </div>

                        <?php
                    }
                }

                ?>
                </div>
                <div class="lists"></div>
            </div>
        </div>
    </div>

<!--    <input type="hidden" id="token" name="token" value="--><?php //echo $_GET['token']?$_GET['token']:''; ?><!--">-->

    <div class="shade"></div>
    <div class="ballBox">
        <div class="ball">
            <input type="hidden" id="tradeId" />
            <input type="hidden" id="tradeType" />

            <div class="client-1"><img src="/img/guanbi.png"></div>
            <div class="client"><p id="title"></p></div>
            <div class="n-pay">
                <span class="x-pay"><?php echo Yii::t('app', '数量'); ?>：</span>
                <span id="number"></span>
                <span class="v-pay"><?php echo Yii::t('app', '卢宝'); ?></span>
            </div>
<!--            <div class="n-pay">-->
<!--                <span class="x-pay">--><?php //echo Yii::t('app', '当前价格'); ?><!--：</span>-->
<!--                <span id="price"></span>-->
<!--            </div>-->

            <div class="n-pay">
                <span class="x-pay"><?php echo Yii::t('app', '线下支付'); ?>：</span>
                <span id="amount"></span>
            </div>

            <div class="password-a">
                <div class="pwd-box"  style="-webkit-box-sizing: border-box;box-sizing: border-box;">
                    <input type="tel" maxlength="6" class="pwd-input" id="pwd-input" style="vertical-align: middle;">
                    <div class="fake-box" id="pwd-clear" style="-webkit-box-sizing: border-box;box-sizing: border-box;width: 100%;">
                        <input type="password" readonly="">
                        <input type="password" readonly="">
                        <input type="password" readonly="">
                        <input type="password" readonly="">
                        <input type="password" readonly="">
                        <input type="password" readonly="">
                    </div>
                </div>
            </div>

            <div class="password1">
                <span id="hint"><?php echo Yii::t('app', '请在3小时内线下打款到卖家账户，否则将影响您的信用值'); ?>。</span>
            </div>
        </div>
    </div>

    
    <script src="/js/3.2.1.js"></script>
    <script src="/js/echarts.min.js"></script>
    <script>
        $(document).ready(function() {
            if($(".assetsBuy").hasClass("on")) {

            }
        });
        function goToBind() {
            alert('请先绑定银行卡!');
            window.location.href = '../user/addcard.html';
        }
        $(".client-1").click(function(){

            $(".shade").hide();
            $(".ballBox").hide();
            $("#pwd-input").val('');
        });
        function t_buy(jsonStr){
            var jsonObj = pzJson(jsonStr);
            $('#tradeId').val(jsonObj.id);
            $('#tradeType').val(1);
            $('#title').text("<?php echo Yii::t('app', '向'); ?> [" + jsonObj.username + "] <?php echo Yii::t('app', '购买'); ?>");
            $('#number').text(jsonObj.number);
            $('#price').text(jsonObj.price);
            $('#amount').text(jsonObj.amount);
            $('#hint').text("<?php echo Yii::t('app', '请在3小时内线下打款到卖家账户，否则将影响你的信用值'); ?>！");
//            $('#popup').fadeIn();
            $(".shade").fadeIn();
            $(".ballBox").fadeIn();
            $("#pwd-input").focus();
        }
        function t_sell(jsonStr){
            var jsonObj = pzJson(jsonStr);
            $('#tradeId').val(jsonObj.id);
            $('#tradeType').val(2);
            $('#title').text("<?php echo Yii::t('app', '向'); ?> [" + jsonObj.username + "] <?php echo Yii::t('app', '出售'); ?>");
            $('#number').text(jsonObj.number);
            $('#price').text(jsonObj.price);
            $('#amount').text(jsonObj.amount);
            $('#hint').text("<?php echo Yii::t('app', '请在3小时内确认收款，否则将影响你的信用值'); ?>！");
//            $('#popup').fadeIn();
            $(".shade").fadeIn();
            $(".ballBox").fadeIn();
            $("#pwd-input").focus();
        }
        //  配置Json数据
        function pzJson(jsonStr){
            //  配置json字符串
            jsonStr = jsonStr.replace(/,/g, '","');
            jsonStr = jsonStr.replace(/:/g, '":"');
            jsonStr = jsonStr.replace(/{/, '{"');
            jsonStr = jsonStr.replace(/}/, '"}');

            return JSON.parse(jsonStr);
        }
        //  密码框
        var a = false;
        var $input = $(".fake-box input");
        $("#pwd-input").on("input", function() {
            var pwd = $(this).val().trim();
            // var token = $("#token").val();
            for (var i = 0, len = pwd.length; i < len; i++) {
                $input.eq(i).val(pwd[i]);
            }
            $input.each(function() {
                var index = $(this).index();
                if (index >= len) {
                    $(this).val("");
                }
            });
            if (len == 6 && a == false) {
                a = true;
                //执行其他操作
                var id = $('#tradeId').val();
                var tradeType = $('#tradeType').val();
                // var token = $("#token").val();
                $.ajax({
                    type: "post",
                    data: {id: id, jymm: pwd, tradeType: tradeType, order_type: 1},
                    dataType: "json",
                    url: "/trade/tradeorder.html",
                    success: function (data) {
                        if (data.status == '0001') {
                            alert(data.msg);
                            window.location.href = '/trade/tradeorderlist.html?order_type=1';
                            // window.location.reload();//  刷新当前页面
                        } else if(data.status == '0004') {
                            alert(data.msg);
                            window.location.href = '/trade/tradecenter.html';
                        } else {
                            alert(data.msg);
                            a = false;
                            //  清除输入框密码
                            $('#pwd-input').val("");
                            for(var z = 0;z < $input.length;z++){
                                $input.eq(z).val('');
                            }
                        }
                    }
                });
            }
        });
    </script>
    <!--5分钟折线图 start-->
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart1 = echarts.init(document.getElementById("main1"));

        // 指定图表的配置项和数据
        var option1 = {
            grid: {
                x: 30,
                y: 0,
                x2: 30,
                y2: 20
            },

            tooltip: {
                trigger: 'axis'
            },
            color: ['#4DA8E9'],

            toolbox: {
                show: true,
                feature: {
                    mark: { show: true },
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: ['line', 'bar', 'stack', 'tiled'] },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            calculable: true,
            xAxis: [{
                type: 'category',
                boundaryGap: false,
                data: [<?php for($i = 0;$i < count($mData['mTime']);$i++){ echo '"'.$mData['mTime'][$i].'",';}?>],
                axisLabel: {
                    show: true,
                    textStyle: {
                        color: '#b3b3b3'
                    }
                },
                axisLine: {
                    lineStyle: {
                        color: '#b3b3b3'
                    }
                }
            }],
            yAxis: [{
                axisLabel: {
                    show: false //控制y轴的刻标不显示
                },
                splitLine: {
                    show: false //关闭分隔线
                },
                axisLine: {
                    show: false //关闭y轴的显示
                },
                axisTick: {
                    show: false
                }
            }],
            series: [{
                type: 'line',
                smooth: true,
                itemStyle: {
                    normal: {
                        areaStyle: { type: 'default' },
                        color: '#BEE3FD', //填充色
                        lineStyle: {
                            color: '#4DA8E9' //折线的颜色
                        }
                    }
                },
                symbolSize: 0, //控制焦点不显示，默认是2
//                data: [110, 120, 21, 54, 260, 21, 10]
                <?php if(!empty($mData['mList'])){
                    ?>
                data: [<?php for($i = 0;$i < count($mData['mList']);$i++){ echo '"'.$mData['mList'][$i]['price'].'",';}?>]
                <?php
            }else{
                    ?>
                data: [<?php for($i = 0;$i < 7;$i++){ echo '"'.$sysPriceData['price'].'",';}?>]
                <?php
            } ?>
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart1.setOption(option1);
    </script>
    <!--5分钟折线图 end-->

    <!--5小时折线图 start-->
    <script type="text/javascript">
        function chart2() {
            var myChart2 = echarts.init(document.getElementById("main2"));

            // 指定图表的配置项和数据
            var option2 = {
                grid: {
                    x: 30,
                    y: 0,
                    x2: 30,
                    y2: 20
                },

                tooltip: {
                    trigger: 'axis'
                },
                color: ['#4DA8E9'],

                toolbox: {
                    show: true,
                    feature: {
                        mark: {show: true},
                        dataView: {show: true, readOnly: false},
                        magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                        restore: {show: true},
                        saveAsImage: {show: true}
                    }
                },
                calculable: true,
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [<?php for ($i = 0; $i < count($mData['mTime']); $i++) {
                        echo '"' . $mData['mTime'][$i] . '",';
                    }?>],
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#b3b3b3'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#b3b3b3'
                        }
                    }
                }],
                yAxis: [{
                    axisLabel: {
                        show: false //控制y轴的刻标不显示
                    },
                    splitLine: {
                        show: false //关闭分隔线
                    },
                    axisLine: {
                        show: false //关闭y轴的显示
                    },
                    axisTick: {
                        show: false
                    }
                }],
                series: [{
                    type: 'line',
                    smooth: true,
                    itemStyle: {
                        normal: {
                            areaStyle: {type: 'default'},
                            color: '#BEE3FD', //填充色
                            lineStyle: {
                                color: '#4DA8E9' //折线的颜色
                            }
                        }
                    },
                    symbolSize: 0, //控制焦点不显示，默认是2
                    //                data: [830, 710, 21, 54, 260, 21, 10]
                    <?php if(!empty($hData['hList'])){
                    ?>
                    data: [<?php for ($i = 0; $i < count($hData['hList']); $i++) {
                        echo '"' . $hData['hList'][$i]['price'] . '",';
                    }?>]
                    <?php
                    }else{
                    ?>
                    data: [<?php for ($i = 0; $i < 7; $i++) {
                        if($i == 7){
                            echo '"' . $sysPriceData['price'];
                        }else {
                            echo '"' . $sysPriceData['price'] . '",';
                        }
                    }?>]
                    <?php
                    } ?>
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart2.setOption(option2);
        }
    </script>
    <!--5小时折线图 end-->

    <!--k线图 start-->
    <script type="text/javascript">
        function chart3() {
            // 基于准备好的dom，初始化echarts实例
            var myChart3 = echarts.init(document.getElementById("main3"));

            // 指定图表的配置项和数据
            var option3 = {
                grid: {
                    x: 30,
                    y: 0,
                    x2: 30,
                    y2: 20
                },

                tooltip: {
                    trigger: 'axis',
                    formatter: function (params) {
                        var res = params[0].seriesName + ' ' + params[0].name;
                        res += '<br/>  open : ' + params[0].value[0] + '  highest : ' + params[0].value[3];
                        res += '<br/>  close : ' + params[0].value[1] + '  lowest : ' + params[0].value[2];
                        return res;
                    }
                },

                toolbox: {
                    show: true,
                    feature: {
                        mark: {show: true},
                        dataZoom: {show: true},
                        dataView: {show: true, readOnly: false},
                        magicType: {show: true, type: ['line', 'bar']},
                        restore: {show: true},
                        saveAsImage: {show: true}
                    }
                },

                xAxis: [{
                    type: 'category',
                    boundaryGap: true,
                    axisTick: {onGap: false},
                    splitLine: {show: false},
                    data: [<?php for ($i = 0; $i < count($dData['dTime']) - 1; $i++) {
                        echo '"' . $dData['dTime'][$i] . '",';
                    }?>],
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#b3b3b3'    // 设置X轴文字的颜色
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#b3b3b3'    // 设置X轴的颜色
                        }
                    }
                }],
                yAxis: [{
                    type: 'value',
                    scale: true,
                    boundaryGap: [0.01, 0.01],
                    axisLabel: {
                        show: false //控制y轴的刻标不显示
                    },
                    splitLine: {
                        show: false //关闭分隔线
                    },
                    axisLine: {
                        show: false //关闭y轴的显示
                    },
                    axisTick: {
                        show: false //控制y轴的刻度不显示
                    }
                }],
                series: [{
                    type: 'k',
                    data: [ // 开盘open，收盘close，最低lowest，最高highest
                        <?php
                        foreach ($dData['dList'] as $d) {
                            if (!empty($d)) {
                                echo "[" . $d['first'] . "," . $d['last'] . "," . $d['low'] . "," . $d['high'] . "],";
                            } else {
                                echo "[0,0," . $sysPriceData['price'] . "," . $sysPriceData['price'] . "],";
                            }
                        }
                        ?>
                        //                    [2323.54, 2324.02, 2321.17, 2334.33],
                        //                    [2316.25, 2317.75, 2310.49, 2325.72],
                        //                    [2320.74, 2300.59, 2299.37, 2325.53],
                        //                    [2300.21, 2299.25, 2294.11, 2313.43],
                        //                    [2297.1, 2272.42, 2264.76, 2297.1],
                        //                    [2270.71, 2270.93, 2260.87, 2276.86],
                        //                    [2264.43, 2242.11, 2240.07, 2266.69],
                        //                    [2242.26, 2210.9, 2205.07, 2250.63],
                        //                    [2190.1, 2148.35, 2126.22, 2190.1]

                    ],
                    candlestick: {
                        itemStyle: {
                            color: '#00DA3D',
                            color0: '#00DA3D'
                        }
                    },

                    lineStyle: {
                        color: '#00DA3D',
                        color0: '#00DA3D'
                    },
                    emphasis: {
                        color: '#00DA3D'
                    }
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart3.setOption(option3);
        }
    </script>
    <!--k线图 end-->
    <script>
        var main2 = false;
        var main3 = false;
        //折线图的切换tab
        $(".assetsTimeB").on("click",function(){
            $(this).addClass("on").siblings(".assetsTimeB").removeClass("on");
            var z = $(".assetsTimeB").index(this);

            $(".assetsChart").addClass("ng-hide");
            $(".assetsChart").eq(z).removeClass("ng-hide");
            if(z == 1){
                if(main2 == false){
                    chart2();
                    main2 = true;
                }
            }else if(z == 2){
                if(main3 == false){
                    chart3();
                    main3 = true;
                }
            }
        });
    </script>

    <!--下拉加载-->
    <?php if($lang == 'en_US'){?>
        <script src="/js/dropload.min_1.js"></script>
    <?php }else{?>
        <script src="/js/dropload.min.js"></script>
    <?php }?>
    <script>
        $(function(){
            var con_btn = '';
            var itemIndex = 0;
            var tab1LoadEnd = false;
            var tab2LoadEnd = false;
            // tab
            $('#trade .item').on('click',function(){
                var $this = $(this);
                itemIndex = $this.index();
                $this.addClass('on').siblings('.item').removeClass('on');
                $('.lists').eq(itemIndex).show().siblings('.lists').hide();

                // 如果选中菜单一
                if(itemIndex == '0'){
                    // 如果数据没有加载完
                    if(!tab1LoadEnd){
                        // 解锁
                        dropload.unlock();
                        dropload.noData(false);
                    }else{
                        // 锁定
                        dropload.lock('down');
                        dropload.noData();
                    }
                    // 如果选中菜单二
                }else if(itemIndex == '1'){
                    if(!tab2LoadEnd){
                        // 解锁
                        dropload.unlock();
                        dropload.noData(false);
                    }else{
                        // 锁定
                        dropload.lock('down');
                        dropload.noData();
                    }
                }
                // 重置
                dropload.resetload();
            });

            var page = 1;
            var page2 = 1;

            // dropload
            var dropload = $('#blockBuy').dropload({
                scrollArea : $('#blockBuy'),
                loadDownFn : function(me){
                    // 加载菜单一的数据
                    if(itemIndex == '0'){
                        page++;
                        $url = '/trade/tradecenterload.html?tradeType=2&page='+ page;
                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        if(data[i].isbind == 1) {
                                            con_btn = '<span class="tradeBtn" style="color: #1E88E5; border: 1px solid #1E88E5;" onclick="goToBind()"><?php echo Yii::t('app', '买入'); ?></span>';
                                        } else {
                                            con_btn = '<span class="tradeBtn" style="color: #1E88E5; border: 1px solid #1E88E5;" onclick="t_buy_load('+data[i].id +',\''+data[i].out_username +'\',\''+data[i].number +'\',\''+data[i].price +'\',\''+data[i].amount +'\')"><?php echo Yii::t('app', '买入'); ?></span>';
                                        }
                                        result += '<div class="am-u-sm-12  pad10" style="width: 100%;display: inline-block; background-color:white; margin-bottom: 10px;">'
                                            +'<div class="fl" style="width: 60px;"><img src="'+ '/' + data[i].icon +'" style="width: 50px;height: 50px;"/></div>'
                                            +'<div class="tleft fl" style="width: calc(100% - 140px);">'
                                            +'<div class="nick-a" style="color: #b3b3b3;">'+ data[i].out_username +'</div>'
                                            +'<div><span style="color: #b3b3b3;"><?php echo Yii::t('app', '数量'); ?>:</span><span class="xiane" style="color: #1E88E5;">'+ data[i].number +'</span></div></div>'
                                            +'<div class="tright color-orange fl" style="width: 80px;">'
//                                            +'<div class="jiage" style="color: #1E88E5;">'+ data[i].price +'</div>'
                                            + con_btn
                                            +'</div>'
                                            +'</div>';
                                    }
                                }else{
                                    // 数据加载完
                                    tab1LoadEnd = true;
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }

                                $('.lists').eq(itemIndex).append(result);
                                // 每次数据加载完，必须重置
                                me.resetload();
                            },
                            error: function(xhr, type){
                                // alert('Ajax error!');
                                // 即使加载出错，也得重置
                                me.resetload();
                            }
                        });
                        // 加载菜单二的数据
                    }else if(itemIndex == '1'){
                        $url = '/trade/tradecenterload.html?tradeType=1&page='+ page2;

                        $.ajax({
                            type: 'GET',
                            url: $url,
                            dataType: 'json',
                            success: function(data){
                                page2++;
                                if(data != null && data.length > 0){
                                    var result = '';
                                    for(var i = 0; i < data.length; i++) {
                                        if(data[i].isbind == 1) {
                                            con_btn = '<span class="tradeBtn" style="color: #1E88E5; border: 1px solid #1E88E5;" onclick="goToBind()"><?php echo Yii::t('app', '卖出'); ?></span>';
                                        } else {
                                            con_btn = '<span class="tradeBtn" style="color: #1E88E5; border: 1px solid #1E88E5;" onclick="t_sell_load('+data[i].id +',\''+data[i].in_username +'\',\''+data[i].number +'\',\''+data[i].price +'\',\''+data[i].amount +'\')"><?php echo Yii::t('app', '卖出'); ?></span>';
                                        }
                                        result += '<div class="am-u-sm-12  pad10" style="width: 100%;display: inline-block; background-color:white; margin-bottom: 10px;">'
                                            +'<div class="fl" style="width: 60px;"><img src="'+ '/' + data[i].icon +'" style="width: 50px;height: 50px;"/></div>'
                                            +'<div class="tleft fl" style="width: calc(100% - 140px);">'
                                            +'<div class="nick-a" style="color: #b3b3b3;">' + data[i].in_username +'</div>'
                                            +'<div><span style="color: #b3b3b3;"><?php echo Yii::t('app', '数量'); ?>:</span><span class="xiane" style="color: #1E88E5;">'+ data[i].number +'</span></div></div>'
                                            +'<div class="tright color-orange fl" style="width: 80px;">'
//                                            +'<div class="jiage" style="color: #1E88E5;">'+ data[i].price +'</div>'
                                            + con_btn
                                            +'</div>'
                                            +'</div>';
                                    }
                                }else{
                                    // 数据加载完
                                    tab2LoadEnd = true;
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }

                                $('.lists').eq(itemIndex).append(result);
                                // 每次数据加载完，必须重置
                                me.resetload();
                            },
                            error: function(xhr, type){
                                // alert('Ajax error!');
                                // 即使加载出错，也得重置
                                me.resetload();
                            }
                        });
                    }
                }
            });
        });

        function t_buy_load(id, username, number, price, amount){
            $('#tradeId').val(id);
            $('#tradeType').val(1);
            $('#title').text("<?php echo Yii::t('app', '向'); ?> [" + username + "] <?php echo Yii::t('app', '购买'); ?>");
            $('#number').text(number);
            $('#price').text(price);
            $('#amount').text(amount);
            $('#hint').text("<?php echo Yii::t('app', '请在3小时内线下打款到卖家账户，否则将影响你的信用值'); ?>！");
//            $('#popup').fadeIn();
            $(".shade").fadeIn();
            $(".ballBox").fadeIn();
            $("#pwd-input").focus();
        }

        function t_sell_load(id, username, number, price, amount){
            $('#tradeId').val(id);
            $('#tradeType').val(2);
            $('#title').text("<?php echo Yii::t('app', '向'); ?> [" + username + "] <?php echo Yii::t('app', '出售'); ?>");
            $('#number').text(number);
            $('#price').text(price);
            $('#amount').text(amount);
            $('#hint').text("<?php echo Yii::t('app', '请在3小时内确认收款，否则将影响你的信用值'); ?>！");
//            $('#popup').fadeIn();
            $(".shade").fadeIn();
            $(".ballBox").fadeIn();
            $("#pwd-input").focus();
        }
    </script>
</section>