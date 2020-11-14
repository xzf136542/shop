<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\shop\public/../application/admin\view\order\send.html";i:1605071839;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/static/admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo url('add'); ?>">添加新商品</a></span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">

</div>

<!-- 商品列表 -->

<div class="list-div" id="listDiv">
    <h1>联系人信息</h1>
    <table cellpadding="3" cellspacing="1">
        <tr>
            <td>收货人:<?php echo $goods_info['people']; ?></td>
            <td>电话号码:<?php echo $goods_info['phone']; ?></td>
            <td>收货地址:<?php echo $goods_info['address']; ?></td>
            <td style="color: red">总金额:<?php echo $goods_info['money']; ?></td>

        </tr>

    </table>
    <h1>商品详情</h1>
    <table cellpadding="3" cellspacing="1">
        <?php if(is_array($goods_info['order_detail']) || $goods_info['order_detail'] instanceof \think\Collection || $goods_info['order_detail'] instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_info['order_detail'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
       <tr>
            <td>商品名称:<?php echo $vo['goods_info']['goods_name']; ?></td>
           <td>商品数量:<?php echo $vo['goods_count']; ?></td>
           <td>购买属性信息:<?php if(is_array($vo['attrs']) || $vo['attrs'] instanceof \think\Collection || $vo['attrs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['attrs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <?php echo $v['attr_name']; ?>:<?php echo $v['attr_value']; endforeach; endif; else: echo "" ;endif; ?></td>
       </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <h1>订单发货</h1>
    <form action="" method="post">
    <table cellpadding="3" cellspacing="1">

            <tr>
                <td> 快递公司</td>
                <td>

                    <select name="com" id="">
                        <?php if(is_array(\think\Config::get('express')) || \think\Config::get('express') instanceof \think\Collection || \think\Config::get('express') instanceof \think\Paginator): $i = 0; $__LIST__ = \think\Config::get('express');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>

                <td> 快递单号</td>
                <td>
                    <input type="text" name="no">
                </td>

            </tr>


    </table>
        <input type="submit" value="点击提交" style="margin-left: 500px;margin-top: 100px; width: 100px;height: 50px;color: #00a0e9;background-color: #0000cc">
    </form>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- 分页开始 -->
    <table id="page-table" cellspacing="0">
        <tr>
            <td width="80%">&nbsp;</td>
            <td align="center" nowrap="true">
            </td>
        </tr>
    </table>
    <!-- 分页结束 -->
</div>


<div id="footer">
    共执行 7 个查询，用时 0.028849 秒，Gzip 已禁用，内存占用 3.219 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>

<script type="text/javascript" src ="/static/admin/JS/jquery-1.8.3.min.js"></script>
