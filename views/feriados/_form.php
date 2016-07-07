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
<?php echo $form->errorSummary($model); ?>
	<div class="row">
            <?php echo $form->labelEx($model,'fecha'); ?>
            <?php echo $form->textField($model,'fecha',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
            <?php echo $form->error($model,'fecha'); ?>
	</div>

<div class="row">
<label for="Cooperativa">Cooperativa</label><?php 
    $this->widget('application.components.Relation', array(
        'model' => $model,
        'relation' => 'coope',
        'fields' => 'cooperativa',
        'allowEmpty' => false,
        'style' => 'dropdownlist',
        'showAddButton' => false,
        'htmlOptions' => $disabled
        )
); ?>
</div>
