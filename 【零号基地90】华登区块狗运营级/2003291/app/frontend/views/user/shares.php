<?php $this->registerJsFile("js/clipboard.min.js", [\frontend\assets\AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']); ?>
<div class="Body">
    <div class="Bdy ng-scope">
        <div class="bdy ng-scope">
            <div class="Main">
                <div ngd-btc2usd="ngd-btc2usd" class="ng-isolate-scope">
                    <div>
                        <div ngd-hint="apiErr" ngd-hint-lv="err" class="ng-isolate-scope">
                            <div class="hint ng-binding ng-hide err"></div>
                        </div>
                        <div class="Section deposit ng-scope">
                            <div class="inf2 inf2a">
                                <em><?php echo Yii::t('app', '钱包地址'); ?></em>
                                <span class="cnt">
                                    <input id="foo" class="txt larger" placeholder="钱包地址" readonly="readonly" value="1efuyayw545fewafwq" />
                                    <button class="btn" data-clipboard-target="#foo" aria-label="复制成功！" style="margin-top: 5px;"><?php echo Yii::t('app', '一键复制'); ?></button> 
                                </span>
                            </div>
                        </div>
                        <div class="Section deposit ng-scope">
                            <div class="inf2 inf2a"><em><?php echo Yii::t('app', '推荐二维码'); ?></em>
                                <p ngd-qrcode="current.uri" class="btcQR ng-isolate-scope">
                                    <img src="data:image/gif;base64,R0lGODdhbwBvAIAAAAAAAP///ywAAAAAbwBvAAAC/4SPqcHtD+F6p9UYblS8+29g4jg5miaFGMi25QhbSQrI9apurhfbNuuj5FC4m85IJM16maEraHIaRUlotXg9/kBQa476FSLDSsTWzDhx050um3POquHvecneri+bUz2a/yIWJ4X3V3iXx0eDSKflVzg4JsmkyBToWJnJ4xfp1VdGeUnj2cn5KOUGarkHNvlWCki4d0gmxyo2N/p6KknrGvuXetaaK7gLDMnreWkbjItqrJkoWjSMNVtLtqh9HEON+b2ZKfz8SX6UpQtMjP2ZborpvTMNLf1bbE/KO8+vn3+ML2A9fgQbCbw3MCHCXv0owQACb5ksd7ccWuwBcV00Rv9Jvl38WI5jNoYkt5kDmSqjL3YfrEUx9KRayHawTIpj1i6jukgHw8XU+NIXI54jD55rJrGRP6FFFR7l9g9ZRaP7mi58ejKqToAKRWZNOTIpU2cvXd6suLMbV5JjkcI7SzbtuLWwdrRaSg9m1p71sOKkuNAr1qRg9yYqLHbi4LX4/E61Ks6f3JVVS5YLtaasWs2c4Xq2irnlRqgdJ451iXqVQcUzLUtlmzc157qsg+Y0jXu168mxIyp7m1dlbbmFS/8yS7r20N+zN/8t3ne0Xr5kjZtUZ7yx9GT2ntO9Vj3s5fG2lUbDa9j83PV/sx8+/319TeegyRNNzxswd+HH6ev/Vz6cf/tlph179QHFHXSu8YcYfAjSBFx/zb0WmX+yIQcYene1VqGBu5FnXXxulbeVhxdGiJ14FEZXRoE2OdVagytKyNI5tEkIV4qiyQeejcwVmCN4lIGjYoke+cbja/N1VmRmJ5ZH3I/vMZlhZdc99NhVDhImYG+qPKgekMktCBmEX3oVookygfmiXvKQqV6UDjXjXZJBkjgmSo6FR6OU/8W12UV0ZrmnmDvet6SCHW7YXZbu6ebTn4uuOaRs/EXa5pFULjkgnwTtKSejhiZY2Z1XTvimZBE+alegSL5DZJ+NtiAjrO2NuZyaM+aqKjoHttlrW2b2euqTdz4amo6t/wJVo3T5wVprQ8z26KyDmkY7z5OWsvjZoat2dWCJ20Lq5LeBhVsulDGWiq6br94W57v4CcktoWtmCq+cg7qrLqqu7hqgnbgOKy+j+E5XZrbs8ontwccWhDCt1W7KIYG5LfvpxMFCTKxF3X58McEU6wnswjcySClUKIFMbsSmarywYCCmW+zE1GU8LZiT9qsjehB/qPOUNY9MXbLMYZimrWih+K+yjgbson0zy+q0p1CzODSGieHIsYX3xjwwbFwXJOOzP536MsC66Zvwzmhivd3P7co8642pgu1t0BFzqWTTjMn958ngir31fZ2SmjOruRVusrnjpik4vyzTTfe4JTVj1CSgutrtcZ6qVW1wl/waHQ+WVeZctp+Chr0s6T37HevjXc/peVSkIw74V18TrXLKQB9QAAA7" width="111" height="111">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('share') ?>  
    var clipboard = new Clipboard('.btn'); 
			clipboard.on('success', function(e) { 
			    var msg = e.trigger.getAttribute('aria-label'); 
			    alert(msg); 
			 
			    e.clearSelection(); 
			});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['share'], \yii\web\View::POS_END); ?>  