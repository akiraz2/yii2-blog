<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

	<header><div class="back"><a href="javascript:history.back()"></a></div>订单耗费时间</header>

	<div id="container"><!--主体内容开始-->

		<div class="content_box">

			<div class="data_top">
				<div class="address">
					<span>车型：</span><select>
						<option>F6</option>
						<option>F3</option>
						<option>F5</option>
					</select>
				</div>
				<div class="date">
					<a href="javascript:void(0)" class="sub"></a><div class="d_date"></div>  <a href="javascript:void(0)" class="add plus_disabled"></a>
				</div>
			</div>


			<table width="100%" border="0" cellspacing="1" class="performance">
				<tr>
					<th width="20%">顾问</th>
					<th width="20%"><a href="time_data_percent.html">当月</a></th>
					<th width="20%"><a href="time_data_percent.html">次月</a></th>
					<th width="20%"><a href="time_data_percent.html">叁月</a></th>
					<th width="20%"><a href="time_data_percent.html">多月</a></th>
				</tr>
				<tr class="red">
					<td>No.1</td>
					<td>160</td>
					<td>120</td>
					<td>180</td>
					<td>150</td>
				</tr>
				<tr>
					<td>张传金</td>
					<td>160</td>
					<td>100</td>
					<td>110</td>
					<td>120</td>
				</tr>
				<tr>
					<td>王五</td>
					<td>160</td>
					<td>120</td>
					<td>170</td>
					<td>150</td>
				</tr>
				<tr>
					<td>李四</td>
					<td>160</td>
					<td>120</td>
					<td>180</td>
					<td>120</td>
				</tr>
			</table>


		</div>



	</div><!--主体内容结束-->
	<script type="text/javascript">
		$(function(){
			var a = new Date(),b=new Date();
			var year,month,s;

			function getday(){
				year=a.getFullYear();
				month=(a.getMonth()+1)<10?"0"+(a.getMonth()+1):(a.getMonth()+1);
				s=year+ " - " +month;
				$(".d_date").text(s);
			}
			getday();//初始化日期

			$(".add").click(function(){ //日期增加一个月，获取日期ajax报表
				if(parseInt(a.getTime())>=parseInt(b.getTime())){
					$(this).addClass("plus_disabled");
					alert("暂无该月报表!");
				}else{
					a.setMonth(a.getMonth() + 1);
					getday();
				}
			});
			$(".sub").click(function(){ //日期减少一个月，获取日期ajax报表
				$(".add").removeClass("plus_disabled");
				a.setMonth(a.getMonth() - 1);
				getday();
			});
		});
	</script>











<?php $this->widget('system.web.widgets.CTreeView',array(
	'collapsed'=>false,
	'animated'=>'slow',
	'data'=>array(
		1=>array(
			'text'=>'<span>系统设置</span>',
			'children'=>array(
				array('text'=>'首页',),
			),
		),
		2=>array(
			'text'=>'<span>分类管理</span>',
			'expanded'=>true,
			'children'=>array(
				array('text'=>'<a href="'.$this->createUrl('/admin/postCategory').'">所有分类</a> <a href="'.$this->createUrl('/admin/postCategory').'">增加子分类</a>',),
				array('text'=>'<a href="'.$this->createUrl('/admin/postCategory/add').'">增加新分类</a>',),
			),
		),
		3=>array(
			'text'=>'<span>文章管理</span>',
			'expanded'=>true,
			'children'=>array(
				array('text'=>'所有分类',),
				array('text'=>'发表新文章',),
				array('text'=>'审核文章',),
			),
		),
	),
));

?>