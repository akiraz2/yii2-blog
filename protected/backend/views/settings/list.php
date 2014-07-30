<h3>Site Settings</h3>
 
<?php echo CHtml::errorSummary($model); ?>
<?php
echo CHtml::beginForm();
?>
<ul class="nav nav-tabs" id="site-settings">
<?php
 
$tabs = array();
$i = 0;
    foreach ($model->attributes as $category => $values):?>
        <li<?php echo !$i?' class="active"':''?>><a href="#<?php echo $category?>" data-toggle="tab"><?php echo ucfirst($category)?></a></li>
    <?php 
    $i ++;
    endforeach;?>
</ul>
    <div class="tab-content">
        <?php 
        $i = 0;
        foreach ($model->attributes as $category => $values):?>
            <div class="tab-pane<?php echo !$i?' active':''?>" id="<?php echo $category?>">
                <?php
                $this->renderPartial(
                        '_'.$category, 
                        array('model' => $model, 'values' => $values, 'category' => $category)
                    );
                ?>
            </div>
        <?php 
        $i ++;
        endforeach;?>
    </div>
<?php
echo CHtml::submitButton('Submit', array('class' => 'btn'));
echo CHtml::endForm();