<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\shop\public/../application/admin\view\goods\add.html";i:1604740991;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加新商品 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/static/admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo url('index'); ?>">商品列表</a>
    </span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加新商品 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" >通用信息</span>
            <span class="tab-front" >详细信息</span>
            <span class="tab-front" >商品属性</span>
            <span class="tab-front" >图片添加</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="" method="post">
            <table width="90%" class='tableNav' align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value=""size="30" />
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td>
                        <input type="text" name="goods_sn" value="" size="20"/>
                        <span id="goods_sn_notice"></span><br />
                        <span class="notice-span"id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cate_id">
                            <option value="0">请选择...</option>
                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['lev']); ?><?php echo $v['cate_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="" size="20" />
                    </td>
                </tr>
                <tr>
                    <td class="label">库存：</td>
                    <td>
                        <input type="text" name="goods_number" value="" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_hot" value="1" /> 热卖
                        <input type="checkbox" name="is_new" value="1" /> 新品
                        <input type="checkbox" name="is_rec" value="1" /> 推荐
                    </td>
                </tr>



                <tr>
                    <td class="label">商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35" />
                    </td>
                </tr>

            </table>

            <table width="90%" class='tableNav' align="center" style="display: none">

                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                        <!-- 加载编辑器的容器 -->
                        <script id="container" name="goods_body" type="text/plain"></script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/static/admin/ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/static/admin/ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>
                    </td>
                </tr>
            </table>
            <table width="90%" class='tableNav' align="center" style="display: none">
                <tr>
                    <td class="label">商品类型</td>
                    <td>
                        <select name="type_id" id="type_id">
                            <option value="0">选择类型</option>
                            <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['type_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                    <tr>
                        <td colspan="2" id="showAttr"></td>
                    </tr>
                </tr>

            </table>
            <table width="90%" class='tableNav pics' align="center" style="display: none">
                <tr>
                    <td class="label"></td>
                    <td>
                        <input type="button" value="增加上传" id="addpic">
                    </td>

                </tr>
                <tr>
                    <td class="label">图片上传</td>
                    <td>
                        <input type="file" name="imgs[]" id="">
                    </td>

                </tr>

            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>

<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>

<script type="text/javascript" src ="/static/admin/JS/jquery-1.8.3.min.js"></script>
<script type="text/javascript" >
    $('#tabbar-div span').click(function(){
        $('.tableNav') .hide();
        var index = $(this) .index();
        $('.tableNav') . eq(index).show();
    })

    $('#type_id').change(function(){
        var type_id = $(this).val();
        if(type_id <= 0){
            $('#showAttr') . html('选中合适的内容');
            return;
        }
        $.ajax({
            url:'<?php echo url("showAttr"); ?>',
            type:'post',
            data:{type_id:type_id},
            success:function(res){
                $('#showAttr') . html(res);
            }
        })
    })
    function cloneThis(obj){
        var tr = $(obj).parent().parent();
        if($(obj).html() == '[-]'){
            tr.remove();
        }else{
            var newTr = tr.clone();
            newTr.find('a').html('[-]');
            tr.after(newTr);
        }

    }
    $('#addpic').click(function (){
        var newTr = $(this) .parent().parent().next().clone();
        $('.pics').append(newTr);
    })
</script>