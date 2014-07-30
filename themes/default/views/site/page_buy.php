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

<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/table_form.css" rel="stylesheet" type="text/css" />

<div class="main"><!--购买下载开始-->

	<div class="main_left">
		<h1><?php echo $portletTitle; ?></h1>
		<ul>
			<?php
			foreach($portlet as $item)
			{
				$url = $this->createUrl('/site/'.$item->page_type,array('id'=>$item->id));
				echo ($catalog->id == $item->id) ? '<li class="current"><a href="'.$url.'">'.$item->title.'</a></li>' : '<li><a href="'.$url.'">'.$item->title.'</a></li>';
			}
			?>
		</ul>
	</div>

	<div class="main_right">
		<h3><span>产品购买</span></h3>

		<div class="buy">

			<div class="buy_title">欢迎垂询挖金MiCard！请您填写简单信息，提交后我们将在24小时内和您联系。</div>
			<div class="reg_tip" style="margin:20px 0 10px 150px;"></div>
			<form method="post" action="<?php echo $this->createUrl('/contact/create'); ?>" id="myform">
				<ul>
					<li><span>姓名：</span><input type="text" id="real_name" name="Contact[real_name]" size="20" class="member_input"></li>
					<li><span>手机：</span><input type="text" id="phone" name="Contact[phone]" size="11" class="member_input"></li>
					<!--li><span>店名：</span><input type="text" id="shop" name="shop" size="20" class="member_input"></li-->
					<li><span></span><input type="submit" name="dosubmit" id="dosubmit" value="提交" class="sub_btn"></li>
				</ul>
			</form>
			<div class="clear"></div>

			<div class="buy_title">MiCard的价格如下：<span>(1.本软件不限用户数。 2.挖金科技承诺付款后三个月内无效退款。)</span></div>
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


		</div>


	</div>

</div><!--购买下载结束-->

<script language="JavaScript">
	/*$(function(){
	 $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});

	 $("#real_name").formValidator({onshow:" ",onfocus:" "}).inputValidator({min:1,max:11,onerror:"请输入姓名"});

	 $("#phone").formValidator({onshow:"请输入11位手机号",onfocus:"请输入11位手机号"}).inputValidator({min:11,max:11,onerror:"手机号必须是11位数字"});/*.regexValidator({regexp:"mobile",datatype:"enum",onerror:"手机号码必须是数字"}).ajaxValidator({
	 type : "get",
	 url : "/index.php",
	 data :"m=waging&c=index&a=product_order_checkmobile_ajax",
	 datatype : "html",
	 async:'false',
	 success : function(data){
	 if( data == "1" ) {
	 return true;
	 } else {
	 return false;
	 }
	 },
	 //buttons: $("#dosubmit"),
	 onerror : "该手机号已存在",
	 onwait : "请稍候..."
	 });*/

	//$("#shop").formValidator({onshow:" ",onfocus:" "}).inputValidator({min:3,max:100,onerror:"请输入店名"});
	/*
	 });*/
</script>
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
		var result = false;
		var txt=phone.val();
		var filter=/^1[3|4|5|7|8][0-9]\d{8}$/;
		if(txt==""){
			$(".reg_tip").show().text("手机号不能为空!");
			result = false;
		}

		if(!filter.test(txt)){
			$(".reg_tip").show().text("手机号格式不正确!");
			result = false;
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

	$("form").submit(function(){
		if(checkreal_name() && checkPhone()){ //ajax保存注册信息

			return true;
		}else{
			return false;
		}
	});

</script>
