<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php Yii::app()->bootstrap->register();?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/statics/css/backend.css" />
</head>

<body screen_capture_injected="true">

<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
	'type' => '', // null or 'inverse'
	'brand' => '后台管理',//Yii::app()->name,
	'brandUrl' => '/backend.php',
	'collapse' => true, // requires bootstrap-responsive.css
	'fluid' => true,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => array(
				array('label' => '控制面板', 'url' => array('/site/index'), 'visible' => !Yii::app()->user->isGuest),
				array('label' => '网站管理', 'url' => '#', 'items' => array(
					array('label' => '栏目管理', 'url' => array('/Catalog/admin')),
					array('label' => '列表页管理', 'url' => array('/Show/admin')),
					'---',
				), 'visible' => !Yii::app()->user->isGuest),
				array('label' => '系统管理', 'url' => '#', 'items' => array(
					array('label' => '管理员管理', 'url' => array('/admin/admin')),
					'---',
					array('label' => '数据库备份', 'url' => array('/backup')),
				)),
			),
		),
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'htmlOptions' => array('class' => 'pull-right'),
			'items' => array(
				array('label' => '网站前台', 'url' => Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/'),
				array('label' => '站点配置', 'icon' => 'wrench', 'url' => array('/settings/index'), 'visible' => !Yii::app()->user->isGuest),
				array('label' => '登录', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
				array('label' => Yii::app()->user->name, 'icon' => 'user', 'url' => '#', 'items' => array(
					array('label' => '个人资料', 'icon' => 'user', 'url' => '#'),
					array('label' => '退出', 'icon' => 'off', 'url' => array('/site/logout'))
				), 'visible' => !Yii::app()->user->isGuest),
			),
		),
	),
));
?>

<div class="container-fluid" id="page">
	<?php echo $content; ?>
	<div class="clear"></div>

	<footer>
	</footer><!-- footer -->
</div><!-- page -->

</body>
</html>

