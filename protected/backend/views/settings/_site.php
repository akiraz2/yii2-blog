<?php foreach ($values as $key => $val): ?>
    <div class="control-group">
        <?php echo CHtml::label($model->getAttributesLabels($key), $key); ?>
        <?php 
        if($key === 'about' || $key === 'statistics')
            echo CHtml::textArea(get_class($model) . '[' . $category . '][' . $key . ']', $val, array('class'=>'span6', 'style'=>'height:100px')); 
        else 
            echo CHtml::textField(get_class($model) . '[' . $category . '][' . $key . ']', $val, array('class'=>'input-xxlarge')); 
 
        ?>
        <?php echo CHtml::error($model, $category); ?>
    </div>
<?php endforeach; ?>