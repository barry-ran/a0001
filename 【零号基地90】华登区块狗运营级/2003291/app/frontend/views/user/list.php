<?php
use yii\helpers\Url;
?>
<div  class="Body">
    <div  class="ng-scope">
        <div class="ng-scope">
           
            <div class="panel">
           
                <div  class="panelC">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', '公告标题'); ?></th>
                            <th><?php echo Yii::t('app', '发布时间'); ?></th>
                            <th><?php echo Yii::t('app', '操作'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $item): ?>
                            <tr>
                                <td><?php echo $item["title"]; ?></td>
                                <td><?php echo Yii::$app->formatter->asDate($item["created_at"]); ?></td>
                                <td><a class="pjax-false" href="<?php echo Url::toRoute(["user/detail", "id" => $item["id"]]); ?>"><?php echo Yii::t('app', '查看详情'); ?></a></td>
                           
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                   <div class="pagination" style="float:right;">
                    <?php
                    echo
                    \yii\widgets\LinkPager::widget([
                        'pagination' => $pager,
                        'nextPageLabel' => Yii::t('app', '下一页'),
                        'prevPageLabel' => Yii::t('app', '上一页'),
                    ]);
                    ?>
                </div>
           
                </div>
            </div>
        </div>
    </div>
</div>
