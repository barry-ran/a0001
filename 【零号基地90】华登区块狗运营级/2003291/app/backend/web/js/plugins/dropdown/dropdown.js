function dropdown(trigger, conf) {
    var self = this,
            $text = $('.text', trigger),
            aw = {},
            uid = Math.random().toString().slice(10),
            drop = $("input[type='hidden']", trigger),
            $selected_value,
            $cont;
    $.extend(self, {
        fl_search: function (word) {
            var $sel = $('a.drop-selected', $cont);
            if (word === $sel.next().text().substring(0, 1).toUpperCase()) {
                return $sel.next().index();
            } else {
                return aw[word];
            }
        },
        load: function (e) {
            if (conf.disabled !== false) {
                $text.focus(function () {
                    $(this).blur();
                });
            }
            if (typeof conf.width !== 'undefind') {
                trigger.width(conf.width);
            }
            trigger.css({width: trigger.width() + 30 + 10 + "px"});
            $text.css({width: trigger.width() - 40 + "px"});
            
            trigger.on('click', ".aca , .arrow , input", function (e) {
                self.click(e);
            });
            trigger.delegate('a', 'click', function (e) {
                self.select($(this));
                $cont.hide();
                return false;
            });
            self.setData(conf);
            $(document).bind('click.dropDocumentEvent', self.close);
        },
        click: function (e) {
            $cont = $('div', trigger);
            if ($cont.is(':hidden')) {
                $cont.show().css({
                    width: $text.outerWidth() + 30 + 'px',
                    'margin-left':trigger.css('padding-left')
                });
                if ($("a", trigger).length > 10) {
                    $cont.css({
                        height: '210px',
                        overflowY: 'scroll'
                    }).scrollTop(($("a.drop-selected", trigger).index() - 4) * $("a.drop-selected", trigger).outerHeight());
                }
            } else {
                $cont.hide();
            }
            e.preventDefault();
        },
        select: function (a) {
            var text = a.html();
            $('a', trigger).removeClass('drop-selected');
            a.addClass('drop-selected');
            $text.val(self.delHtmlTag(text));
            if (a.attr('data-value') !== drop.val()) {
                $selected_value = a.attr('data-value');
                drop.val($selected_value);
                $text.change(conf.callback($selected_value));
            }
            return false;
        },
        close: function (e) {
            if (!$(e.target).parent().data('dropdown') || $(e.target).parent().data('dropdown').getUid() !== uid) {
                $("div", trigger).hide();
            }
        },
        setData: function (conf) {
            var t = [],
                    flag = false;
            if (conf.data) {
                t.push('<ul>');
                if ($.isArray(conf.data)) {
                    $.each(conf.data, function (j, k) {
                        k.id == conf.def_value ? flag = true : null;
                        t.push('<li><a href="javascript:;" data-value="' + k.id + '" >' + k.name + '</a></li>');
                    });
                }
                t.push('</ul>');
                $("div", trigger).empty().append(t.join(""));
                var $data_value, $a_def;
                if (conf.def_value && flag) {
                    $a_def = $('a[data-value="' + conf.def_value + '"]', trigger);
                    $data_value = conf.def_value;
                } else {
                    $a_def = $('a:first', trigger);
                    $data_value = $('a:first', trigger).attr('data-value');
                }
                $text.val(self.delHtmlTag($a_def.text()));
                $a_def.addClass('drop-selected');
                drop.val($data_value);
            } else {
                $("div", trigger).empty();
            }
        },
        reset: function () {
            $('a:first', trigger).click();
            drop.val('');
        },
        getValue: function () {
            return $selected_value;
        },
        getConf: function () {
            return conf;
        },
        getUid: function () {
            return uid;
        },
        delHtmlTag:function(s){
            return s.replace(/<[^>]+>/g,"");
        }
    });
    self.load();
}
$.fn.dropdown = function (conf) {
    var opt = {
        data: null,
        def_value: null,
        callback: function (v) {

        }
    };
    var el = this.data("dropdown");
    if (el) {
        return this;
    }
    conf = $.extend(true, {},
            opt, conf);
    return this.each(function () {
        el = new dropdown($(this), conf);
        $(this).data("dropdown", el);
    });
};
$.fn.setDropdownData = function (conf) {
        var dropdown = $(this).data('dropdown');
        conf = $.extend(true, {},
                dropdown.getConf(), conf);
        return this.each(function () {
            dropdown.setData(conf);
        });
    };