<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<meta name="Robots" Content="All">
	<meta name="googlebot" content="All">
	<meta name="keywords" content="<?php echo CHtml::encode($this->seoKeywords); ?>" />
	<meta name="description" content="<?php echo CHtml::encode($this->seoDescription); ?>" />
	<meta name="author" content="Hikecms" />
	<meta name="Copyright" content="Hikecms" />

	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" rel="shortcut icon">

	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.sgallery.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/search_common.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="header"><!--header start-->

	<div class="top">
		<div class="logo"><a href="/"></a></div>
		<div class="top_right">
			<div class="login">您好，欢迎来到挖金科技！</div>
			<div class="share">
				<span>分享到：</span>
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a></div>
				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
			</div>

			<div class="clear"></div>
			<div class="nav"><!--导航栏开始-->
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>$this->mainMenu,
					'activateItems'=>true,
					'activateParents'=>true,
				)); ?>
			</div><!--导航栏结束-->
			<div class="clear"></div>
		</div>

	</div>
</div><!--header end-->
<?php echo $content; ?>

<div class="clear"></div>

<div class="footer">
	<div class="footer_content">
		Copyright ©2014 挖金科技  粤ICP备14012277号-1
		<div class="weibo">
			<a href="http://weibo.com/3989752847" target="_blank" title="新浪微博"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/mweibo.gif" width="30" height="30"></a>
			<a href="http://t.qq.com/szwaging" target="_blank" title="腾讯微博"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/qqmb.gif" width="30" height="30"></a>
			<a href="/about/contact/">微信订阅号：挖金科技</a>
		</div>
	</div>
</div>

</body>
</html>
