

<?php
/**
 * @var $model Cooperativas * @var $form CActiveForm
 */



   $soloLectura=(empty($soloLectura)?0:$soloLectura);
   if ($soloLectura) {
      $readonly=array('readonly'=>'readonly') ;
      $disabled=array('disabled'=>'disabled') ;
      $modificaObs2=false;
   }
   else{
      $readonly=array() ;
      $disabled=array() ;
      $modificaObs2=true;
   }

?>   
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id',$readonly); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'cooperativa'); ?>
                <?php echo $form->textField($model,'cooperativa',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'presidente'); ?>
                <?php echo $form->textField($model,'presidente',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'telefono'); ?>
                <?php echo $form->textField($model,'telefono',array_merge($readonly,array('size'=>60,'maxlength'=>200))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'mail'); ?>
                <?php echo $form->textField($model,'mail',array_merge($readonly,array('size'=>60,'maxlength'=>200))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'web'); ?>
                <?php echo $form->textField($model,'web',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'direccion'); ?>
                <?php echo $form->textField($model,'direccion',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'idLocalidad'); ?>
                <?php ; ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
