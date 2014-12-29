<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;
use funson86\blog\Module;
?>

<div class="form">

    <?php $form = ActiveForm::begin([
        'id'=>'comment-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{input}{label}{error}",
        ],
    ]); ?>

    <?= $form->field($model, 'author')->textInput((['maxlength' => 32])); ?>
    <?= $form->field($model, 'email')->textInput((['maxlength' => 32])); ?>
    <?= $form->field($model, 'url')->textInput((['maxlength' => 64])); ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6])->label(false); ?>

    <div class="form-group">
        <label class="col-lg-1 control-label" for="">&nbsp;</label>
        <?= Html::button(Module::t('blog', 'Add comments'), ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div><!-- form -->

<?php $this->registerJs('
    jQuery(function(){
        jQuery(".btn-success").click(function(){
            var result = true;
            if(jQuery("#blogcomment-author").val() == "" || jQuery("#blogcomment-email").val() == "" || jQuery("#blogcomment-content").val() == ""){
                result = false;
            }

            if(result){
                jQuery(".btn-success").attr("disabled", "disable");
                jQuery.post("' . Yii::$app->request->absoluteUrl . '",
                    {
                        "BlogComment[author]":jQuery("#blogcomment-author").val(),
                        "BlogComment[email]":jQuery("#blogcomment-email").val(),
                        "BlogComment[url]":jQuery("#blogcomment-url").val(),
                        "BlogComment[content]":jQuery("#blogcomment-content").val(),
                    },
                    function(data,status){
                        if(data == "success"){
                            jQuery(".comment:last").after("<div class=\'comment\'><div class=\'author\'><a href=\'" + jQuery("#blogcomment-url").val() + "\'>" + jQuery("#blogcomment-author").val() +"</a>&nbsp;<span>" + "正在审核" + "</span></div><div class=\'content\'>" + jQuery("#blogcomment-content").val() +"</div></div>");
                        }else{
                        }
                    });
            }else{
                return false;
            }
        });
    });
    function currentTime(){
        var d = new Date(),str = "";
        str += d.getFullYear()+"年";
        str  += d.getMonth() + 1+"月";
        str  += d.getDate()+"日";
        str += d.getHours()+"时";
        str  += d.getMinutes()+"分";
        str+= d.getSeconds()+"秒";
        return str;
    }
') ?>