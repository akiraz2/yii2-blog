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

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.6.1.min.js"></script>

<div class="container">
	<div class="buy_title">欢迎垂询挖金MiCard！请您填写简单信息，提交后我们将在24小时内和您联系。</div>

	<div class="add_form">
		<div class="reg_tip"></div>
		<!--form method="post" action="/index.php?m=waging&c=index&a=product_order" id="myform"-->
		<div class="form_box">
			<span>姓名：</span>
			<div><input type="text" id="real_name" name="real_name" size="20"></div>
		</div>

		<div class="form_box">
			<span>手机：</span>
			<div><input type="text" id="phone" name="phone" size="11"></div>
		</div>

		<!--div class="form_box">
			 <span>店名：</span>
			 <div><input type="text" id="shop" name="shop" size="20"></div>
		   </div-->

		<div class="form_box">
			<span></span>
			<input name="from_3g" type="hidden" value="3g">
			<div class="btn"><input type="submit" name="dosubmit" id="dosubmit" value="提交" class="sub_btn"></div>
		</div>
		<!--/form-->
	</div>

	<div class="buy_title">MiCard的价格如下：</div>
	<div class="price_table">
		<table width="100%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<th>项目</th>
				<th>软件价格</th>
				<th>实施费用</th>
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
	<span><strong>备注</strong>:</span> <br>
	1.本软件不限用户数。 <br>
	2.软件价格和实施费用为一次性。<br>

	3.挖金科技承诺付款后三个月内无效退款。

</div>

<script type="text/javascript">
	var real_name=$("#real_name");
	var phone=$("#phone");
	//var shop=$("#shop");

	//on blur
	real_name.blur(checkreal_name);
	phone.blur(checkPhone);
	//shop.blur(checkShop);


	function checkreal_name(){
		var txt=real_name.val();
		if(txt==""){$(".reg_tip").show().text("姓名不能为空!");return false;}
		else{
			$(".reg_tip").hide().text("");
			return true;
		}
	};


	function checkPhone(){
		var result=false;
		var txt=phone.val();
		var filter=/^1[3|4|5|7|8][0-9]\d{8}$/;
		if(txt==""){
			$(".reg_tip").show().text("手机号不能为空!");
			result=false;
		}

		if(!filter.test(txt)){
			$(".reg_tip").show().text("手机号格式不正确!");
			result=false;
		}

		{
			$.ajax({
				dataType: "",
				url: "<?php echo $this->createUrl('contact/ajaxCheckMobile'); ?>",
				type: "get",
				async:false,
				data : "phone=" + txt,//"r=contact/ajaxCheckMobile&phone=" + txt,
				success:function(data){  //判断帐号已经存在!
					if(0 == data){
						$(".reg_tip").show().text("该手机号已经存在!");
						result = false;
					}else{
						$(".reg_tip").hide().text("");
						result = true;
					}
				}
			});
		}
		return result;
	};

	function checkShop(){
		var txt=shop.val();
		if(txt==""){$(".reg_tip").show().text("店名不能为空!");return false;}
		else{
			$(".reg_tip").hide().text("");
			return true;
		}
	};

	$("#dosubmit").click(function(){
		var real_name = $("#real_name").val();
		var phone = $("#phone").val();
		if(checkreal_name() && checkPhone()){ //ajax保存注册信息

			$.ajax({
				dataType: "",
				url: "<?php echo $this->createUrl('/contact/create'); ?>",
				type: "get",
				async:false,
				data : "real_name=" + real_name + "&phone=" + phone,
				success:function(data){  //判断帐号已经存在!
					if(0 == data){
						alert("提交成功!我们将在24小时内与您联系！");
						WeixinJSBridge.call('closeWindow');
						return true;
					}else{
						alert("提交失败!");
					}
				}
			})

		}else{
			return false;
		}
	});

</script>