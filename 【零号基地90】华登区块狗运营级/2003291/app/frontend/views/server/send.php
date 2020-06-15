<?php
/**
 * @author shuang
 * @date 2016-12-9 23:58:01
 */
use yii\helpers\Url;
?>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="small-box bg-333 big-title h50" style="padding-left: 15px;"><?php echo Yii::t('app',"问题提交")?></div>
        </div>
    </div>
    <form action="<?php echo yii\helpers\Url::toRoute(["server/send"]); ?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-12" style="font-size: 1.5rem">
            <div class="box-body bg-white paddingl15 paddingr15">
                <div class="form-group field-addissueform-title required">
                    <label class="control-label" for="addissueform-title"><?php echo Yii::t('app',"标题")?></label>
<!--                    <input id="addissueform-title" class="form-control" name="problem" type="text">-->
                    <select id="addissueform-title" class="form-control" name="problem">
                        <option value="系统错误"><?php echo Yii::t('app',"1.系统错误")?></option>
                        <option value="金额错误"><?php echo Yii::t('app',"2.金额错误")?></option>
                        <option value="修改资料"><?php echo Yii::t('app',"3.修改资料")?></option>
                        <option value="买方不打款"><?php echo Yii::t('app',"4.买方不打款")?></option>
                        <option value="卖方不点击确认收款"><?php echo Yii::t('app',"5.卖方不点击确认收款")?></option>
                        <option value="遇到纠纷请求仲裁"><?php echo Yii::t('app',"6.遇到纠纷请求仲裁")?></option>
                        <option value="其他问题"><?php echo Yii::t('app',"7.其他问题")?></option>
                    </select>
                    <div class="help-block"></div>
                </div> 
                <div class="form-group field-addissueform-title required">
                    <label class="control-label"><?php echo Yii::t('app',"上传图片")?></label>
                    <input name="WB_UserServer[picture]" class="form-control"id="file"  style="width:300px;" type="file">
                    <div style="width: 200px;height: 200px;display: none">
                        <img src="" id="img1" width="100%"height="100%"/>
                    </div>
                    <div class="help-block"></div>
                </div> 
                <div class="form-group field-addissueform-info required">
                    <label class="control-label" for="addissueform-info"><?php echo Yii::t('app',"问题内容")?></label>
                    <textarea id="addissueform-info" class="form-control" name="content" rows="5"></textarea>
                    <div class="help-block"></div>
                    <center>
                        <button type="submit" class="btn bg-blue color-white send-message"><?php echo Yii::t('app',"确定")?></button>
                    </center>
                </div>					
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                
                    <center>
<!--                        <button type="button" class="btn bg-blue color-white send-message">确定</button>-->
                    </center>
                
            </div>
        </div>
    </form>
   
</section>
 <script src="/js/jquery-2.0.2.min.js"></script>
      <script>

   $("#file").change(function(){
        var read=new FileReader() // 创建FileReader对像;
        read.readAsDataURL(this.files[0])  // 调用readAsDataURL方法读取文件;
                 read.onload=function(){
                          url=read.result  // 拿到读取结果;\
                          $('#img1').parent().css("display","block");
                          $('#img1').attr('src',url);
//                        console.log(url);
        }
   })

</script>