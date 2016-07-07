

<?php
/**
 * @var $model Temas * @var $form CActiveForm
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
                <?php echo $form->label($model,'tema'); ?>
                <?php echo $form->textField($model,'tema',array_merge($readonly,array('size'=>60,'maxlength'=>150))); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'idSector'); ?>
                <?php ; ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
