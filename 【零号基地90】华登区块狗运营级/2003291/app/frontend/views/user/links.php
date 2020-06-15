<div  class="Body">
    <!-- ngView: -->
    <div  class="ng-scope">
        <div class="ng-scope">
            <?php echo $this->render("_linktop"); ?>
            <div class="panel">
                <div  class="panelH">
                    <h2><em  class="ng-binding"><?php echo Yii::t('app', '链接'); ?></em></h2></div>
                <div class="panelC References">
                    <div empty="<?php echo Yii::t('app', '加载中...'); ?>"  class="tbl tbl-striped">
                        <div class="tbl-head">
                            <ul class="tbl-tr">
                                <li class="tbl-th account"><?php echo Yii::t('app', '地址/用户名'); ?></li>
                                <li class="tbl-th energy"><?php echo Yii::t('app', '流入能量'); ?></li>
                                <li class="tbl-th activity"><?php echo Yii::t('app', '活跃度'); ?></li>
                                <li class="tbl-th weight"><span><?php echo Yii::t('app', '权值'); ?></span><i ngd-tooltip="<?php echo Yii::t('app', '权值 ( 自己<--> 对方 )'); ?>" class="iF iF-question"></i></li>
                            </ul>
                        </div>
                        <div class="tbl-body">
                            <!-- ngRepeat: ref in references.data -->
                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">csT1ED7FwpTq1wGMQgzt7d2fgi4W1LdCZs</li>
                                <li  class="tbl-td" title="20.926944" title-hold="true">20<span class="dec">.926944</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/12</span><i class="iF iF-connect"></i><span  class="ng-binding">1/9</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">cw4FE3QJbqT6qNXjgzykqVG8GTJhcCE6Er</li>
                                <li  class="tbl-td" title="506.738529" title-hold="true">506<span class="dec">.738529</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/198</span><i class="iF iF-connect"></i><span  class="ng-binding">1/3</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">cKtZgSjvuHszNVTzAprVaXYkt4GLNqWMxD</li>
                                <li  class="tbl-td" title="75.643529" title-hold="true">75<span class="dec">.643529</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/23</span><i class="iF iF-connect"></i><span  class="ng-binding">1/4</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">c96ybBrPUvevsV6EiAaNYBhRnQ6RXe53Lp</li>
                                <li  class="tbl-td" title="0.543758" title-hold="true">0<span class="dec">.543758</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/24</span><i class="iF iF-connect"></i><span  class="ng-binding">1/1</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">c9dFQ3Pz7VAdELqrAL5g9h3faP5A6tGhBW</li>
                                <li  class="tbl-td" title="170.237963" title-hold="true">170<span class="dec">.237963</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/246</span><i class="iF iF-connect"></i><span  class="ng-binding">1/10</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">chwZ7FrSiggcimNuwfLT1ojt6eDeUTeFa2</li>
                                <li  class="tbl-td" title="19.908438" title-hold="true">19<span class="dec">.908438</span></li>
                                <li  class="tbl-td" title="40125.658359" title-hold="true">40,125<span class="dec">.658359</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/247</span><i class="iF iF-connect"></i><span  class="ng-binding">1/5</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">cMtXHw48F1abiVR4oSGwEA78L5mSU6qcR6</li>
                                <li  class="tbl-td" title="111.325190" title-hold="true">111<span class="dec">.32519</span></li>
                                <li  class="tbl-td" title="397556.214447" title-hold="true">397,556<span class="dec">.214447</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/248</span><i class="iF iF-connect"></i><span  class="ng-binding">1/2</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">cQU5KYV3dwngE3kEV7SoNK5pNBc3jHj7fz</li>
                                <li  class="tbl-td" title="21.577149" title-hold="true">21<span class="dec">.577149</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/249</span><i class="iF iF-connect"></i><span  class="ng-binding">1/2</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">cNn2e1PkivGvBaji6V7Nqpo3sYKMAPvVqk</li>
                                <li  class="tbl-td" title="62.466867" title-hold="true">62<span class="dec">.466867</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/250</span><i class="iF iF-connect"></i><span  class="ng-binding">1/3</span></li>
                            </ul>

                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">c36VzC3AXGJ1q3GYJztoG9kUmogSFGkzRr</li>
                                <li  class="tbl-td" title="2.785672" title-hold="true">2<span class="dec">.785672</span></li>
                                <li  class="tbl-td" title="9056.749965" title-hold="true">9,056<span class="dec">.749965</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/261</span><i class="iF iF-connect"></i><span  class="ng-binding">1/197</span></li>
                            </ul>




                            <ul  class="tbl-tr ng-scope">
                                <li  class="tbl-td ng-binding">cBbG24PM9uUpYJJ7VV8MX1MZByeVbSmFH6</li>
                                <li  class="tbl-td" title="569.719918" title-hold="true">569<span class="dec">.719918</span></li>
                                <li  class="tbl-td" title="1.0201" title-hold="true">1<span class="dec">.0201</span></li>
                                <li class="tbl-td"><span  class="ng-binding">1/386</span><i class="iF iF-connect"></i><span  class="ng-binding">1/384</span></li>
                            </ul>

                        </div>
                    </div>
                    <a   class="loadMore full"><?php echo Yii::t('app', '加载更多'); ?><span  class="ng-hide"><?php echo Yii::t('app', '加载中...'); ?></span></a>
                </div>
            </div>

        </div>
    </div>
</div>
