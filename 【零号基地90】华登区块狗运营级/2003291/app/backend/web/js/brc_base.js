var Base = {};
Base.is_ie = /msie/i.test(navigator.userAgent);
Base.is_ie6 = (Base.is_ie && /msie 6\.0/i.test(navigator.userAgent));
Base.is_opera = /opera/i.test(navigator.userAgent);
Base.Tpl = function () {
    return this._s = new Array();
};
Base.Tpl.prototype = {
    append: function (h) {
        this._s.push(h);
    },
    toString: function () {
        var h = this._s.join("");
        this._s.length = 0;
        return h;
    }
};
Base.centerSize = function (a) {
    var st = document.body.scrollTop || document.documentElement.scrollTop;
    var sl = document.body.scrollLeft || document.documentElement.scrollLeft;
    var ww = document.documentElement.clientWidth;
    var wh = document.documentElement.clientHeight;
    return {
        left: Math.abs(Math.round((ww - a.width) / 2) + (Base.is_ie6 ? sl : 0)) + "px",
        top: Math.abs(Math.round((wh - a.height) / 3) + (Base.is_ie6 ? st : 0)) + "px"
    };
};
Base.center = function (obj, backDiv) {
    if (obj) {
        var dw = obj.outerWidth();
        var dh = obj.outerHeight();
        obj.css("position", Base.is_ie6 ? "absolute" : "fixed").css(Base.centerSize({
            width: obj.outerWidth(),
            height: obj.outerHeight()
        }));
        if (typeof backDiv !== 'undefined') {
            backDiv.css({
                width: (dw + 12) + 'px',
                height: (dh + 12) + 'px'
            });
        }
        return obj;
    }
};
/*遮罩层*/
Base.mask = {
    isOpen: false,
    zIndex: 1000,
    on: function (opacity) {
        if (Base.mask.isOpen) {
            return false;
        }
        Base.mask.isOpen = true;
        var a = $("#bottom_mask");
        if (a.length == 0) {
            a = $('<div id="bottom_mask"></div>').css({
                position: "absolute",
                top: 0,
                left: 0,
                width: "100%",
                background: "#000",
                opacity: opacity || .3,
                display: "none"
            });
            a.appendTo($(document.body));
        }
        a.css({
            width: Math.max(document.body.scrollWidth, document.documentElement.clientWidth),
            height: Math.max(document.body.scrollHeight, document.documentElement.clientHeight),
            zIndex: Base.mask.zIndex
        });
        Base.is_ie6 && $('select').css('visibility', 'hidden');
        a.show();
    },
    off: function () {
        var a = $("#bottom_mask");
        if (a.length == 0)
            return false;
        Base.mask.isOpen = false;
        Base.is_ie6 && $('select').css('visibility', 'visible');
        a.hide();
    }
};
Base.pop = function (conf) {
    conf = conf || {};
    var self = this;
    var c = function () {
        return true;
    };
    self.options = $.extend({
        beforeOpen: c,
        afterOpen: c,
        beforeClose: c,
        afterClose: c,
        ok: c,
        cancel: c,
        pos: 'center',
        mask: false,
        iframe: false
    }, conf);
    conf.trigger && (self.trigger = $(conf.trigger));
    conf.target && (self.target = $(conf.target));
    self.init();
};
Base.pop.position = function (obj, popDiv) {
    var tleft;
    var offset = obj.offset();
    var diff_left = offset.left + obj.outerWidth() - popDiv.outerWidth();
    var diff_right = $(window).width() - offset.left - popDiv.outerWidth();
    if (diff_left < 0 && diff_right < 0) {
        tleft = ($(window).width() - popDiv.outerWidth()) / 2;
    } else if (diff_right > 0 && diff_right > diff_left) {
        tleft = offset.left;
    } else if (diff_left > 0 && diff_left > diff_right) {
        tleft = offset.left + obj.innerWidth() - popDiv.outerWidth();
    }
    popDiv.css({
        top: offset.top + obj.outerHeight(),
        left: tleft
    });
};
$.extend(Base.pop.prototype, {
    init: function () {
        var self = this;
        var opt = self.options;
        var c, d, t;
        t = self.target;
        self.trigger && self.trigger.click(function (e) {
            self.open();
            e.preventDefault();
        });
        if (t) {
            d = opt.iframe && self.target[0].tagName.toLowerCase() == "iframe";
            if (d)
                return;
            (function () {
                t.find(".pop-close, .pop-cancel").on('click', function (e) {
                    opt.cancel();
                    self.close();
                    e.preventDefault();
                }),
                        t.find(".pop-ok").on('click', function (e) {
                    opt.ok();
                    self.close();
                    e.preventDefault();
                })
            })();
        }
    },
    getConf: function () {
        var self = this;
        return self.options;
    },
    open: function () {
        var self = this;
        var opt = self.options;
        opt.beforeOpen(self);
        self.update();
        opt.afterOpen(self);
    },
    close: function (scale) {
        var self = this;
        var opt = self.options;
        if (opt.beforeClose()) {
            opt.mask ? Base.mask.off() : "";
            var c = self.target.get(0);
            if (c && c.tagName && c.tagName.toUpperCase() == "IFRAME") {
                self.target.fadeOut('fast', function () {
                    $(this).remove();
                });
                opt.afterClose();
                Base.pop.current = null;
            } else {
                self.target.hide();
                opt.afterClose();
            }
        }
    },
    update: function () {
        Base.pop.current = this;
        var opt = Base.pop.current.options;
        opt.mask ? Base.mask.on() : "";
        this.target.show();
        if (opt.pos == 'center') {
            Base.center(this.target);
        } else if (typeof opt.pos == 'function') {
            opt.pos.call();
        }
    }
});
Base.tablist = function () {
};
Base.tablist.prototype = {
    opts: {
        delids: null, //选中ids,
        pk: "id",
        tips: {}  //弹出框内容设置
    },
    init: function (d) {
        $.extend(true, this.opts, {}, d);
    },
    getChecked: function () {  //获取选中内容ID
        var item = [],
                ids = $('#table').bootstrapTable('getSelections');
        $.each(ids, function (k, v) {
            item.push(v.id);
        });
        this.opts.delids = item;
    },
    updateMulit: function (d) {  //弹出提示框
        $.extend(true, this.opts.tips, {}, d);
        var self = this.opts.tips.self;
        if (typeof self.attr("data-value") !== "undefined") { // 单条判断
            this.opts.delids = this.opts.tips.self.attr("data-value");
        } else {
            this.getChecked();
        }
        var _popDiv = this.createDialog();   //创建表单
        _popDiv.appendTo("body");
        new Base.pop({
            target: _popDiv,
            mask: true
        }).open();
    },
    createDialog: function () {
        var t = [];
        //
        t.push('<div class="tip">');
        t.push('<div class="tiptop"><span>提示信息</span><a class="pop-close"></a></div>');
        t.push('<form action="' + this.opts.tips.url + '" method="post">');
        t.push('<div class="tipinfo">');
        t.push('<span><img src="/images/ticon.png" /></span>');
        t.push('<div class="tipright"><p>' + this.opts.tips.message + '</p><cite>如果是请点击确定按钮 ，否则请点取消。</cite></div></div>');
        t.push('<input name="' + this.opts.pk + '" type="hidden" value="' + this.opts.delids + '" class="delids" />');
        t.push('<div class="tipbtn"><input name="" type="submit"  class="sure" value="确定" />&nbsp;<input name="" type="button"  class="cancel pop-cancel" value="取消" /></div>');
        t.push('</form>');
        t.push('</div>');
        return $(t.join(""));
    }
};
jQuery.fn.inputOnlyNum = function () {
    $(this).keypress(function (e) {
        if (((e.which >= 45 && e.which <= 57) && e.shiftKey == false) || e.ctrlKey == true || e.which == 0 || e.which == 8) {
            if (e.which == 45) {
                if ($(this).val().indexOf("-") == -1) {
                    $(this).val('-' + $(this).val());
                }
                return false;
            } else if (e.which == 46) {
                if ($(this).val().indexOf(".") == -1) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        }
        return false;
    }).bind("blur", function () {
        if (!jQuery.isnumeric($(this).val())) {
            $(this).val('');
        }
    }).bind("paste", function () {
        if (!jQuery.isnumeric($(this).val())) {
            $(this).val('');
        }
    });
};
function isEmptys(val, elem) {
    if ($.trim(val) === "") {
        return false;
    } else {
        return true;
    }
}