<?php
/**
 * @var $model Localidades * @var $form CActiveForm
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
            <?php echo $form->labelEx($model,'localidad'); ?>
            <?php echo $form->textField($model,'localidad',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
            <?php echo $form->error($model,'localidad'); ?>
	</div>
<div class="row">
<label for="Provincias">Provincias</label><?php 
$this->widget('application.components.Relation', array(
    'model' => $model,
    'relation' => 'provincia',
    'fields' => 'provincia',
    'allowEmpty' => false,
    'style' => 'dropdownlist',
    'showAddButton' => false,
    'htmlOptions' => $disabled
    )
); ?>
</div>		