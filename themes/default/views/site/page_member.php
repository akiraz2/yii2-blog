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

<div class="common_content"><!--会员中心开始-->
	<div class="common_title">
		<h3><span>会员专区</span></h3>
	</div>

	<div class="member">

		<div class="member_items">
			<div class="item_list">
				<ul>
					<li>
						<dt><a href="http://web.waging.cn" target='_blank'><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/system.png" width="60" height="60"></a></dt>
						<dd><p class="list_title"><a href="http://web.waging.cn" target='_blank'>进入系统</a></p></dd>
					</li>
					<li>
						<dt><a href="/video/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/video.png" width="60" height="60"></a></dt>
						<dd><p class="list_title"><a href="/site/page/15">培训视频</a></p></dd>
					</li>

					<li>
						<dt><a href="/train/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/subject.png" width="60" height="60"></a></dt>
						<dd><p class="list_title"><a href="/site/page/16">培训题库</a></p></dd>
					</li>

					<!--li>
					   <dt><a href="#"><img src="/statics/images/exam.png" width="60" height="60"></a></dt>
					   <dd><p class="list_title"><a href="#">在线考试</a></p></dd>
					 </li-->

				</ul>
			</div>
		</div>

		<div class="member_item_right">
			<p><strong>建议</strong> ：</p>
			<p>
				1.先看视频<br>
				2.再做题库<br>

			</p>
		</div>

	</div>


</div><!--会员中心结束-->

