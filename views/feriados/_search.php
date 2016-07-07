

<?php
/**
 * @var $model Feriados * @var $form CActiveForm
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
                <?php echo $form->label($model,'anio'); ?>
                <?php echo $form->textField($model,'anio',$readonly); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'fecha'); ?>
                <?php echo $form->textField($model,'fecha',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'repite'); ?>
                <?php echo $form->textField($model,'repite',$readonly); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'pasaAfecha'); ?>
                <?php echo $form->textField($model,'pasaAfecha',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
