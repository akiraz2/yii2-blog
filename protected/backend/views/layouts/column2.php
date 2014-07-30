<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div id="sidebar-nav">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>array_merge(
			array(
				array('label'=>'主菜单'),
				array('label'=>'控制面板', 'icon'=>'home', 'url'=>array('/site/index')),
				'---',
				array('label'=>'子菜单'),
			),
			$this->menu
		),
	)); ?>
</div>

<div id="sidebar-content">
	<div class="row-fluid">
		<div class="span12">
			<?php if (isset($this->breadcrumbs)): ?>
				<?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
			<?php endif ?>
			<?php echo $content; ?>
		</div>
	</div>
</div>

<?php $this->endContent(); ?>