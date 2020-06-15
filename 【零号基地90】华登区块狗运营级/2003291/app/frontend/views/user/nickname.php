<?php
use yii\helpers\Url;




?>
<div  class="Body">
    <div  class="ng-scope">
        <div class="ng-scope">
            <?php echo $this->render("_linktop"); ?>
            <div class="panel">
                 
                <div  class="panelC">
                     <?php echo $this->render("//layouts/prompt"); ?>
                    <form action= "<?php echo Url::toRoute(["nickname"]); ?>" method="post">
                        修改昵称：<input type="text" name="truename"><br>
                    <button type="submit">确定</button>
                    </form>
           
                </div>
            </div>
        </div>
    </div>
</div>

