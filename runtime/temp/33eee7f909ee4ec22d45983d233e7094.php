<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\shop\public/../application/admin\view\goods\index.html";i:1604481230;}*/ ?>
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
    <form action="" name="searchForm">
        <img src="/static/admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="cate_id">
            <option value="0">所有分类</option>
            <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $v['id']; ?>" <?php if($v['id'] == \think\Request::instance()->get('cate_id')): ?>selected<?php endif; ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['lev']); ?><?php echo $v['cate_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>

        <!-- 推荐 -->
        <select name="intro_type">
            <option value="0">全部</option>
            <option value="is_rec" <?php if(\think\Request::instance()->get('intro_type') == 'is_rec'): ?>selected<?php endif; ?>>推荐</option>
            <option value="is_new" <?php if(\think\Request::instance()->get('intro_type') == 'is_new'): ?>selected<?php endif; ?>>新品</option>
            <option value="is_hot" <?php if(\think\Request::instance()->get('intro_type') == 'is_hot'): ?>selected<?php endif; ?>>热销</option>
        </select>

        <!-- 关键字 -->
        关键字 <input type="text" name="keyword"  value='<?php echo \think\Request::instance()->get('keyword'); ?>' size="15" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>货号</th>
                <th>价格</th>
                <th>推荐</th>
                <th>新品</th>
                <th>热销</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
                <td align="center" class="first-cell"><span><?php echo $vo['goods_name']; ?></span></td>
                <td align="center"><span onclick=""><?php echo $vo['goods_sn']; ?></span></td>
                <td align="center"><span><?php echo $vo['shop_price']; ?></span></td>
                <td align="center"><img onclick="changeStatus(<?php echo $vo['id']; ?>,'is_rec',this)" src="/static/admin/Images/<?php if($vo['is_rec'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif "/></td>
                <td align="center"><img onclick="changeStatus(<?php echo $vo['id']; ?>,'is_new',this)" src="/static/admin/Images/<?php if($vo['is_new'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif "/></td>
                <td align="center"><img onclick="changeStatus(<?php echo $vo['id']; ?>,'is_hot',this)" src="/static/admin/Images/<?php if($vo['is_hot'] == '1'): ?>yes<?php else: ?>no<?php endif; ?>.gif "/></td>
                <td align="center">
                <a href="<?php echo url('edit','id='.$vo['id']); ?>" title="编辑"><img src="/static/admin/Images/icon_edit.gif" width="16" height="16" border="0" /></a>
                <a href="<?php echo url('remove','id='.$vo['id']); ?>" onclick="" title="回收站"><img src="/static/admin/Images/icon_trash.gif" width="16" height="16" border="0" /></a></td>
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
                        <?php echo $data-> render(); ?>
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
<script type="text/javascript">
    function changeStatus(goods_id,field,obj){
        $.ajax({
            url:"<?php echo url('changStatus'); ?>",
            type:'post',
            data:{goods_id:goods_id,field:field},
            success:function (res){
                if(res.code ==0){
                    alert('error');
                }else{
                    if(res.status ==1){
                        $(obj).attr('src','/static/admin/Images/yes.gif')
                    }else{
                        $(obj).attr('src','/static/admin/Images/no.gif')
                    }
                }
            }
        })
    }
</script>