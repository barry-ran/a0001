(function ($) {
    $.receipt = {
        config: {
            droppid: $("#my_purchases-pid"),
            dropsid: $("#my_purchases-sid"),
            dropunit: $("#my_purchases-unit"),
            intqin: $("#my_purchases-quantity_in"),
            intprice: $("#my_purchases-price")
        },
        btn: $("#toolbar a"),
        close:function(){
            $("#proform .close").click();
        },
        init: function (d) {
            $.extend(this.config, d);
            this.addBtn();
            this.addClick();
        },
        /*绑定添加商品事件*/
        addClick: function () {
            var _this = this;
            $(".modal-header h3").html("添加商品");
            this.btn.click(function(){
                _this.resetData();
            });
        },
        /*绑定编辑商品事件*/
        editClick: function (a) {
            $(".modal-header h3").html("编辑商品");
            this.btn.click();
            this.resetData(a);
        },
        resetData: function (a) {
            var $pid = null, $sid = null, $unit = null, $price = null, $quantity_in = null;
            if (typeof a !== "undefined") {
                $pid = a.attr("data-pid");
                $sid = a.attr("data-sid");
                $unit = a.attr("data-unit");
                $price = a.attr("data-price");
                $quantity_in = a.attr("data-quantity_in");
                this.config.id = a.attr("data-id");
            }
            this.config.intqin.val($quantity_in);
            this.config.intprice.val($price);
            this.config.droppid.setDropdownData({def_value: $pid});
            this.config.dropsid.setDropdownData({def_value: $sid});
            this.config.dropunit.setDropdownData({def_value: $unit});
        },
        //获取数据
        getData: function () {
            return $("form").serialize() + "&rid=" + this.config.rid + "&id=" + this.config.id;
        },
        //保存、编辑商品
        saveData: function () {
            var _this = this;
            $.ajax({url: this.config.saveurl, data: _this.getData(), dataType: "json", type: "get", beforeSend: function () {
                    $(".loading").show();
                },
                success: function (e) {
                    var $tip = $("<p></p>");
                    $(".modal-body").append($tip);
                    $tip.addClass("tip");
                    $p = $("#proform .tip");
                    if (e.status === true) {
                        $p.html("成功").addClass("alert-success");
                        $("#table").bootstrapTable("refresh", {url: _this.config.refreshUrl});
                    } else {
                        $p.html(e.errors).addClass("alert-warning");
                    }
                    $p.animate({opacity: 0}, 2000, "swing", function () {
                        $p.remove();
                        if(_this.config.id > 0){
                            _this.close();
                        }
                    });
                }
            }).done(function () {
                $(".loading").hide();
            });
        },
        //绑定添加商品
        addBtn: function () {
            var _this = this;
            $("#proform .btn-success").unbind();
            $("#proform .btn-success").bind("click", function () {
                _this.saveData();
            });
        },
        /*
         * 删除数据
         * @params {object} $a 
         * return boolean
         */
        deleteClick:function(a){
          var $id = a.attr("data-id"),_this = this;  
          $.ajax({
              type:"get",
              data:{id:$id},
              dataType:"json",
              url:this.config.delurl,
              success:function(e){
                  if(e.status === true){
                      $("#table").bootstrapTable("refresh", {url: _this.config.refreshUrl});
                      $.alert("删除成功");
                  }else{
                      $.alert(e.erros);
                  }
              }
          });
        }
    };
})(jQuery);