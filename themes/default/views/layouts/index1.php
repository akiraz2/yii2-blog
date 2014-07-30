<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

	<div class="banner clearfix">
		<ul class="slider">
			<li class="No1" style=" display:block; opacity:1; filter:alpha(opacity=100);"></li>
			<li class="No2"></li>
			<li class="No3"></li>
		</ul>
		<div class="slider_page">
			<a href="javascript:;" class="current"></a>
			<a href="javascript:;"></a>
			<a href="javascript:;"></a>
		</div>
		<a href="javascript:;" class="up_down up"></a>
		<a href="javascript:;" class="up_down down"></a>
	</div>
	<script type="text/javascript">
		$(".banner").mouseenter(function() {
			$(".up_down").fadeIn().css("display", "inline-block");
		}).mouseleave(function() {
				$(".up_down").fadeOut();
			})
	</script>

	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->

<?php $this->endContent(); ?>