

<?php
/**
 * @var $model Vencimientos * @var $form CActiveForm
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
                <?php echo $form->label($model,'fecha'); ?>
                <?php echo $form->textField($model,'fecha',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'idCoope'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'sector'); ?>
                <?php echo $form->textField($model,'sector',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'tema'); ?>
                <?php echo $form->textArea($model,'tema',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'plazo'); ?>
                <?php echo $form->textField($model,'plazo',$readonly); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'habil'); ?>
                <?php echo $form->checkBox($model,'habil'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'fechaLimite'); ?>
                <?php echo $form->textField($model,'fechaLimite',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
