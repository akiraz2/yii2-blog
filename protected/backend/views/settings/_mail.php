<?php foreach ($values as $key => $val): ?>
    <div class="control-group">
        <?php echo CHtml::label($model->getAttributesLabels($key), $key); ?>
        <?php 
        if($key === 'ssl')
            echo CHtml::checkBox(get_class($model) . '[' . $category . '][' . $key . ']', $val); 
        else 
            echo CHtml::textField(get_class($model) . '[' . $category . '][' . $key . ']', $val, array('class'=>'input-xxlarge')); 
 
        ?>
        <?php echo CHtml::error($model, $category); ?>
    </div>
<?php endforeach; ?>