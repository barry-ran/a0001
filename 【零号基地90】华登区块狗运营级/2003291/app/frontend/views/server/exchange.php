<?php

/**
 * @author shuang
 * @date 2016-12-9 23:55:25
 */
use yii\helpers\Url;
?>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="small-box bg-333 big-title h50" style="padding-left: 15px;"><?php echo Yii::t('app',"兑换率")?></div>
        </div>
    </div>
    <!--表格-->
    <div class="h-scroll">
        <div class="box-body bg-white paddingb0">
            <div id="w0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo Yii::t('app',"币种")?></th>
                            <th class="text-center"><?php echo Yii::t('app',"代码")?></th>
                            <th class="text-center"><?php echo Yii::t('app',"交易单位")?></th>
                            <th class="text-center"><?php echo Yii::t('app',"买入价")?></th>
                            <th class="text-center"><?php echo Yii::t('app',"卖出价")?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><img src="/images/mg.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"美元")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">1.10</td>
                            <td class="text-center" style="color: green">0.92</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/zg.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"人民币")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">7.00</td>
                            <td class="text-center" style="color: green">6.50</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/mlxy.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"马币")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">4.50</td>
                            <td class="text-center" style="color: green">3.80</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/xjp.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"新币")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">1.50</td>
                            <td class="text-center" style="color: green">1.28</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/yn.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"印尼盾")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">14600.00</td>
                            <td class="text-center" style="color: green">12300.00</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/tw.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"新台币")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">35.00</td>
                            <td class="text-center" style="color: green">30.00</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/xg.png" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"港币")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">8.50</td>
                            <td class="text-center" style="color: green">7.30</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/am.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"澳门币")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">8.50</td>
                            <td class="text-center" style="color: green">7.30</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/hg.png" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"韩元")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">1200.00</td>
                            <td class="text-center" style="color: green">1000.00</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/rb.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"日圆")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">130.00</td>
                            <td class="text-center" style="color: green">110.00</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/tg.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"泰铢")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">39.00</td>
                            <td class="text-center" style="color: green">32.00</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/adly.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"澳大利亚元")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">1.50</td>
                            <td class="text-center" style="color: green">1.28</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/yg.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"英镑")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">0.86</td>
                            <td class="text-center" style="color: green">0.71</td>
                        </tr>
                        <tr>
                            <td class="text-center"><img src="/images/yuenan.jpg" width="40px;" height="25px;"/></td>
                            <td class="text-center"><?php echo Yii::t('app',"越南盾")?></td>
                            <td class="text-center">1</td>
                            <td class="text-center" style="color: red">24000.00</td>
                            <td class="text-center" style="color: green">20500.00</td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination" style="float:right;">
                    
                </div>
    </div>
</section>