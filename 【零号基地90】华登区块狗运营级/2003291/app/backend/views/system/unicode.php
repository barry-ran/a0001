<?php
/**
 * @author shuang
 * @date 2016-8-19 14:20:41
 */
?>
<form id="" class="form-section form-horizontal" action="" method="get">
    <div class="form-group">
        <label class="control-label col-sm-2" for="my_product-trait">中文字符</label>
        <div class="col-sm-7">
            <textarea id="my_product-trait" class="form-control" name="content" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="my_product-trait">转换结果</label>
        <div class="col-sm-7">
            <textarea id="my_product-trait" class="form-control" rows="5"><?php echo $content && $content !== "null"  ? $content : null;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label  class="control-label col-sm-2"></label>
        <div class="col-sm-7"><button type="submit" class="btn btn-primary">确定保存</button></div>
    </div>
    <div class="clearfix"></div>
</form>


