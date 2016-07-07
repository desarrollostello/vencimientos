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

?><p class="note">Los campos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
            <?php echo $form->labelEx($model,'cooperativa'); ?>
            <?php echo $form->textField($model,'cooperativa',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
            <?php echo $form->error($model,'cooperativa'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'presidente'); ?>
            <?php echo $form->textField($model,'presidente',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
            <?php echo $form->error($model,'presidente'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'telefono'); ?>
            <?php echo $form->textField($model,'telefono',array_merge($readonly,array('size'=>60,'maxlength'=>200))); ?>
            <?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'mail'); ?>
            <?php echo $form->textField($model,'mail',array_merge($readonly,array('size'=>60,'maxlength'=>200))); ?>
            <?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'web'); ?>
            <?php echo $form->textField($model,'web',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
            <?php echo $form->error($model,'web'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'direccion'); ?>
            <?php echo $form->textField($model,'direccion',array_merge($readonly,array('size'=>60,'maxlength'=>250))); ?>
            <?php echo $form->error($model,'direccion'); ?>
	</div>
<div class="row">
<label for="Localidades">Localidades</label><?php 
    $this->widget('application.components.Relation', array(
        'model' => $model,
        'relation' => 'localidad',
        'fields' => 'localidad',
        'allowEmpty' => false,
        'style' => 'dropdownlist',
        'showAddButton' => false,
        'htmlOptions' => $disabled
        )
); ?>
</div>