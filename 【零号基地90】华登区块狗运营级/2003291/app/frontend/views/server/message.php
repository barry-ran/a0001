<?php

/**
 * @author shuang
 * @date 2016-12-9 23:59:01
 */
use yii\helpers\Url;
?>
<section class="content">
    <?php echo $this->render("//layouts/prompt"); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="small-box bg-333 big-title h50" style="padding-left: 15px;"><?php echo Yii::t('app',"反馈列表")?></div>
        </div>
    </div>
    <!--表格-->
    <div class="h-scroll">
        <div class="box-body bg-white paddingb0">
            <div class="row margint10 marginb10">
                <div class="col-lg-2 pull-left">
                    <a href="<?php echo Url::toRoute("send"); ?>" class="btn bg-blue color-white" style="width:100%;"><?php echo Yii::t('app',"问题反馈")?></a>
                </div>
            </div>
            <div id="w1" class="grid-view">
                <table id="example1" class="table table-bordered table-striped"><thead>
                        <tr>
                            <th><?php echo Yii::t('app',"序号")?></th>
                            <th><?php echo Yii::t('app',"标题")?></th>
                            <th><?php echo Yii::t('app',"内容")?></th>
                            <th><?php echo Yii::t('app',"图片")?></th>
                            <th><?php echo Yii::t('app',"状态")?></th>
                            <th><?php echo Yii::t('app',"回复内容")?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data): ?>
                            <?php $k=1;foreach ($data as $item): ?>
                                <tr>
                                    <td><?php echo $k; ?></td>
                                    <td><?php echo $item["problem"]; ?></td>
                                    <td><?php echo $item["content"]; ?></td>
                                    <td>
                                        <?php if ($item["picture"]): ?>
                                            <a href="/<?php echo $item["picture"]; ?>" target="_blank"><img src="/<?php echo $item["picture"]; ?>" width="100" height="100"/></a>
                                        <?php endif; ?>
                                    </td>
                                    <th><?php echo $item["status"] == 1? "待回复" : "已回复"; ?></th>
                                    <th><?php echo $item["replay"]; ?></th>
                                </tr>
                            <?php $k++;endforeach; ?>
                            <tr>
                                <td colspan="6"><div class="empty"><?php echo Yii::t('app',"没有找到数据。")?></div></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="pagination" style="float:right;">
                    <?php
                    echo
                    \yii\widgets\LinkPager::widget([
                        'pagination' => $pager,
                        'nextPageLabel' => '下一页',
                        'prevPageLabel' => '上一页',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>