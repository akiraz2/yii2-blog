<form  action="<?php echo Yii::$app->getUrlManager()->createUrl(["/blog/default/index"])?>" method="get">
    <div class="search">
        <input type="text" name="keyword" id="keyword" value="<?php if(isset($_GET['keyword']) && strlen($_GET['keyword'])>0) echo $_GET['keyword']; else echo '内容关键词'; ?>" class="search_input" onblur="if(this.value=='') this.value='内容关键词';"onfocus="if(this.value=='内容关键词') this.value='';"/>
        <input type="submit" class="search_submit"  id="search_submit" value="搜索"/>
    </div>
</form>