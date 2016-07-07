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

?><p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'tema'); ?>
    <?php echo $form->textField($model,'tema',array_merge($readonly,array('size'=>60,'maxlength'=>150))); ?>
    <?php echo $form->error($model,'tema'); ?>
</div>
<div class="row">
<label for="Sectores">Sectores</label><?php 
$this->widget('application.components.Relation', array(
    'model' => $model,
    'relation' => 'sector',
    'fields' => 'sector',
    'allowEmpty' => false,
    'style' => 'dropdownlist',
    'showAddButton' => false,
    'htmlOptions' => $disabled
)
    ); ?>
</div>	