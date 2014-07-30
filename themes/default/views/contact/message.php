<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=($catalog->seo_title ? $catalog->seo_title : $catalog->title) . ' - ' . Yii::app()->name;
$this->seoKeywords=($catalog->seo_keywords ? $catalog->seo_keywords : F::sg('site', 'siteKeywords'));
$this->seoDescription=($catalog->seo_description ? $catalog->seo_description : F::sg('site', 'siteDescription'));
$this->breadcrumbs=array(
	$catalog->title,
);
?>

<div class="main"><!--购买下载开始-->

	<div class="main_left">
		<h1>购买与下载</h1>
		<ul>
			<li class="current"><a href="/site/page/5.html">产品购买</a></li>
			<li><a href="/site/page/6.html">产品下载</a></li>
		</ul>
	</div>

	<div class="main_right">
		<h3><span>产品购买</span></h3>

		<div class="buy">
			<br><br><br>
			<div class="success">
				<div class="success_tip">提交成功！<span></span></div><br>
				<p class="wait">请等待我们销售人员与您联系！</p>
			</div>
			<br><br><br>
			<div class="clear"></div>

			<!--div class="buy_title">MiCard的价格如下：<span>(1.本软件不限用户数。 2.挖金科技承诺付款后28天内无条件退款。)</span></div>
			  <div class="price_table">
		<table width="100%" border="0" cellpadding="0" cellspacing="1">
		  <tr>
			<th>项目</th>
			<th>软件价格（一次性）</th>
			<th>实施费用（一次性）</th>
			<th>年服务费</th>
		  </tr>
		  <tr>
			<td>挖金MiCard</td>
			<td class="red">￥20000</td>
			<td class="red">￥20000</td>
			<td class="red">￥10000</td>
		  </tr>
		</table>

			  </div>


			</div-->


		</div>

	</div><!--购买下载结束-->
</div><!-- form -->

