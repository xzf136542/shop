<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\shop\public/../application/admin\view\category\add.html";i:1604475058;s:57:"D:\shop\public/../application/admin\view\public\base.html";i:1604475051;}*/ ?>
<!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加分类 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/static/admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
    <span class="action-span"><a href="<?php echo url('index'); ?>">商品分类</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
</h1>

<div class="main-div">
   
<form action="" method="post" name="theForm" enctype="multipart/form-data">
    <table width="100%" id="general-table">
        <tr>
            <td class="label">分类名称:</td>
            <td>
                <input type='text' name='cate_name' maxlength="20" value='' size='27' /> <font color="red">*</font>
            </td>
        </tr>
        <tr>
            <td class="label">上级分类:</td>
            <td>
                <select name="parent_id">

                    <option value="0">顶级分类</option>
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$vo['lev']); ?><?php echo $vo['cate_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>

    </table>
    <div class="button-div">
        <input type="submit" value=" 确定 " />
        <input type="reset" value=" 重置 " />
    </div>
</form>

</div>

<div id="footer">
    共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<script type="text/javascript" src ="/static/admin/JS/jquery-1.8.3.min.js"></script>
