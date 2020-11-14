<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\shop\public/../application/admin\view\order\index.html";i:1605066252;}*/ ?>
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
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>编号</th>
            <th>订单号</th>
            <th>用户名</th>
            <th>金额</th>
            <th>支付状态</th>
            <th>订单状态</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="center" class="first-cell"><span><?php echo $vo['order_sn']; ?></span></td>
            <td align="center" class="first-cell"><span><?php echo $vo['username']; ?></span></td>
            <td align="center" class="first-cell"><span><?php echo $vo['money']; ?></span></td>
            <td align="center" class="first-cell"><span><?php if($vo['pay_status'] == '1'): ?>已支付<?php else: ?>未支付<?php endif; ?></span></td>
            <td align="center" class="first-cell"><span>
                <?php if($vo['status'] == 0): ?>
                    下单
                <?php elseif($vo['status'] == 1): ?>
                    已审核
                <?php elseif($vo['status'] == 2): ?>
                    已发货
                <?php else: ?>
                    未知状态
                <?php endif; ?>
            </span></td>
            <td align="center">
                <?php if($vo['status'] == '2'): else: if((($vo['pay'] == 1) and ($vo['status'] == 1)) or(($vo['pay'] == 2)and($vo['pay_status'] == 1))): ?>
                <a href="<?php echo url('send','id='.$vo['id']); ?>">发货</a>
                <?php endif; endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
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
