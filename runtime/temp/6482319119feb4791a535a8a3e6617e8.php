<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"D:\shop\public/../application/index\view\pay\checkout.html";i:1605099441;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="/static/index/style/base.css" type="text/css">
	<link rel="stylesheet" href="/static/index/style/global.css" type="text/css">
	<link rel="stylesheet" href="/static/index/style/header.css" type="text/css">
	<link rel="stylesheet" href="/static/index/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/static/index/style/footer.css" type="text/css">

	<script type="text/javascript" src="/static/index/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/static/index/js/cart2.js"></script>

</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<?php if(empty(\think\Session::get('user')) || ((\think\Session::get('user') instanceof \think\Collection || \think\Session::get('user') instanceof \think\Paginator ) && \think\Session::get('user')->isEmpty())): ?>
					<li>您好，欢迎来到京西！[<a href="<?php echo url('user/login'); ?>">登录</a>] [<a href="register.html">免费注册</a>] </li>
					<?php else: ?>
					<li><?php echo \think\Session::get('user.username'); ?>您好，欢迎来到京西！[<a href="<?php echo url('user/logout'); ?>">退出</a>]  </li>
					<?php endif; ?>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="/static/index/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>
	<form action="<?php echo url('order'); ?>" method="post">
		<!-- 主体部分 start -->
		<div class="fillin w990 bc mt15">
			<div class="fillin_hd">
				<h2>填写并核对订单信息</h2>
			</div>

			<div class="fillin_bd">
				<!-- 支付方式  start-->
				<div class="pay">
					<h3>收货人信息 </h3>
					<div class="pay_info">
						<span style="color: red">*</span>收货人:&nbsp;&nbsp;&nbsp;<input type="text" name="people"><br/>
						<span style="color: red">*</span>详细地址:<input type="text" name="address"><br/>
						<span style="color: red">*</span>电话号码:<input type="text" name="phone"><br/>
					</div>


				</div>

				<!-- 支付方式  start-->
				<div class="pay">
					<h3>支付方式 </h3>
					<div class="pay_info">
						<input type="radio" name="pay"  value="2">支付宝
						<input type="radio"  name="pay"  value="1">货到付款
					</div>


				</div>

				<div class="pay">
					<h3>积分使用 </h3>
					<div class="pay_info">
						<input type="radio" name="is_use_score" value="1">是否使用积分
					</div>


				</div>
				<!-- 支付方式  end-->


				<!-- 商品清单 start -->
				<div class="goods">
					<h3>商品清单</h3>
					<table>
						<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col2">规格</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<tr>
							<td class="col1"><a href=""><img src="/<?php echo $vo['goods_info']['goods_thumb']; ?>" alt="" /></a>  <strong><a href=""><?php echo $vo['goods_info']['goods_name']; ?></a></strong></td>
							<td class="col2">
								<?php if(is_array($vo['attrs']) || $vo['attrs'] instanceof \think\Collection || $vo['attrs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['attrs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
								<p><?php echo $v['attr_name']; ?>：<?php echo $v['attr_value']; ?></p>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</td>
							<td class="col3">￥<?php echo $vo['goods_info']['shop_price']; ?></td>
							<td class="col4"> <?php echo $vo['goods_count']; ?></td>
							<td class="col5"><span>￥<?php echo $vo['goods_info']['shop_price'] * $vo['goods_count']; ?></span></td>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="5">
								<ul>
									<li>
										<span>总商品金额：</span>
										<em>￥<?php echo $total; ?></em>
									</li>

								</ul>
							</td>
						</tr>
						</tfoot>
					</table>
				</div>
				<!-- 商品清单 end -->

			</div>

			<div class="fillin_ft">
				<input type="submit" name="" value="提交订单" id="">
				<p>应付总额：<strong>￥<?php echo $total; ?>元</strong></p>

			</div>
		</div>
		<!-- 主体部分 end -->
	</form>


	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/static/index/images/xin.png" alt="" /></a>
			<a href=""><img src="/static/index/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/static/index/images/police.jpg" alt="" /></a>
			<a href=""><img src="/static/index/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
</html>
