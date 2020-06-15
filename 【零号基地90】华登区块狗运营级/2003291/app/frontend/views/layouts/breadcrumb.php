<?php
/**
 * @author shuang
 * @date 2016-11-7 19:56:53
 */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="small-box bg-333 big-title" style="padding: 15px;">
            <?php if (isset($breadcrumb) && is_array($breadcrumb)): ?>
                <?php foreach ($breadcrumb as $item): ?>
                    <li><span><?php echo $item; ?></span></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li><span><?php echo isset($breadcrumb) ? $breadcrumb : null; ?></span></li>
            <?php endif; ?>
        </div>
    </div>
</div>