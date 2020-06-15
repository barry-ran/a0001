<include file="public:header" />
<!--数据库备份-->
<div class="subnav">
    <h1 class="title_2 line_x">百度链接提交</h1>
</div>
<div class="pad_lr_10">
    <div class="J_tablelist table_list">
        <form action="{:U('tuisong/tuisong')}" method="post">
            <table width="100%" class="table_form contentWrap">
                <thead>
                    <tr>
                        <th colspan="2">推送设置</th>
                    </tr>
                </thead>
                <tr>
                    <th>推送链接个数 :</th>
                    <td><input type="text" name="url_num" size="5" class="input-text" value="500" /></td>
                </tr>

                <tr>
                    <th>推送类型 :</th>
                    <td>
                        <label><input type="radio" checked="checked" value="1" name="url_type"> 商品</label>
                        <label><input type="radio" value="2" name="url_type"> 文章</label>
                    </td>
                </tr>

                <tr>
                    <th width="150"></th>
                    <td><input type="submit" class="smt" name="do" value="一键推送"/></td>
                </tr>
            </table>

        </form>
    </div>
</div>
<include file="public:footer" />
</body>
</html>