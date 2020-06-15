<?php
// 转入卢宝总数
 $totalturninnum = \common\models\UserTransform::find()->where('in_userid = :in_userid',[':in_userid' => $user->id])->sum('amount');

?>
<style>
    th,td{
        text-align: center;
    }
</style>

<div class="formbody">
    <div class="formtitle"><span>基本信息</span></div>
    <div class="toolsli">
        <ul class="toollist">
            <li><h2>账号 ：<?php echo $user->username; ?></h2></li>
            <li><h2>手机号：<?php echo $user->userprofile->phone; ?></h2></li>
            <li><h2>真实姓名：<?php echo $userbank?$userbank->name:''; ?></h2></li>
            <li><h2>身份证：<?php echo $user->userprofile->idcard; ?></h2></li>
            <li><h2>最近登录ip：<?php echo $user->login_ip; ?></h2></li>
            <li><h2>最近登录时间：<?php echo Yii::$app->formatter->asDatetime($user->last_login_at); ?></h2></li>
            <li><h2>账号状态：<?php echo $user->iseal?"被封":"正常"; ?></h2></li>
            <li><h2>交易付款超时次数：<?php echo $user->overtime_num; ?></h2></li>
            <li><h2>交易异常次数：<?php echo $user->except_num; ?></h2></li>
            <?php
                $refer = \common\models\User::find()->andWhere(["=","id",$user->userprofile->referrerid])->one();  
            ?>
            <li><h2>推荐人账号：<?php echo $refer ? $refer->username : "系统账号"; ?></h2></li>

        </ul>
    </div>
    <div class="formtitle"><span>账户详情</span></div>
    <div class="toolsli">
        <ul class="toollist">
            <li><h2>积分：<?php echo Yii::$app->formatter->asDecimal(floor($user->wallet->hcg_wa*10000)/10000,0); ?></h2></li>
            <?php $belong_count = \common\models\UserZodiac::find()->where('userid = :belong and is_overtime = 0',[':belong'=>$user->id])->count();?>
            <li><h2>拥有宠物(成长中)数量：<?php echo $belong_count; ?></h2></li>

        </ul>
    </div>
    <div class="toolsli">
        <ul class="toollist">
            <table class="table table-bordered" >
                <tr>
                    <th>宠物名称</th>
                    <th>买入价格</th>
                    <th>当前价格</th>
                    <th>是否到期</th>
                    <th>宠物周期(天)</th>
                    <th>宠物收益比例</th>
                    <th>获得收益</th>

                </tr>
                <?php foreach($list as $value){?>
                    <tr>
                        <td><?php echo $value['name']?></td>
                        <td><?php echo $value['old_hcg']?></td>
                        <td><?php echo $value['hcg']?></td>
                        <td><?php echo $value['is_overtime']?></td>
                        <td><?php echo $value['due']?></td>
                        <td><?php echo $value['award']?></td>
                        <td><?php echo $value['earn']?></td>
                    </tr>
                <?php }?>
            </table>
        </ul>
    </div>
</div>