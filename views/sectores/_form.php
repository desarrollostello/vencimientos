<?php
/**
 * @var $model Sectores * @var $form CActiveForm
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

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'sector'); ?>
    <?php echo $form->textField($model,'sector',array_merge($readonly,array('size'=>60,'maxlength'=>200))); ?>
    <?php echo $form->error($model,'sector'); ?>
</div>


