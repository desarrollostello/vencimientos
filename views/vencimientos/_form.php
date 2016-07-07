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

?><p class="note"> Campos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
            <?php // echo $form->labelEx($model,'fecha'); ?>
            <?php // echo $form->textField($model,'fecha',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
            <?php // echo $form->error($model,'fecha'); ?>
	</div>-->

        <div class="row">
            <?php echo $form->labelEx($model,'fecha'); ?>
            <?php
                if ($model->fecha!='') {
                $model->fecha=date('d-m-Y',strtotime($model->fecha));
                }
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'fecha',
                'value'=>$model->fecha,
                'language' => 'es',
                'htmlOptions' => array('readonly'=>"readonly"),

                'options'=>array(
                'autoSize'=>true,
                'defaultDate'=>$model->fecha,
                'dateFormat'=>'dd-mm-yy',
                'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.jpg',
                'buttonImageOnly'=>true,
                'buttonText'=>'Fecha',
                'selectOtherMonths'=>true,
                'showAnim'=>'slide',
                'showButtonPanel'=>true,
                'showOn'=>'button',
                'showOtherMonths'=>true,
                'changeMonth' => 'true',
                'changeYear' => 'true',
                ),
                )); 
           ?>
        <?php echo $form->error($model,'fecha'); ?>
        </div>

	<div class="row">
            <?php echo $form->labelEx($model,'plazo'); ?>
            <?php echo $form->textField($model,'plazo',$readonly); ?>
            <?php echo $form->error($model,'plazo'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'habil'); ?>
            <?php echo $form->checkBox($model,'habil'); ?>
            <?php echo $form->error($model,'habil'); ?>
	</div>
<!--
	<div class="row">
            <?php echo $form->labelEx($model,'fechaLimite'); ?>
            <?php echo $form->textField($model,'fechaLimite',array_merge($readonly,array('size'=>10,'maxlength'=>10))); ?>
            <?php echo $form->error($model,'fechaLimite'); ?>
	</div>
-->
<div class="row">
<label for="Cooperativas">Cooperativas</label><?php 
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
<div class="row">
<label for="Temas">Temas</label><?php 
$this->widget('application.components.Relation', array(
    'model' => $model,
    'relation' => 'tema',
    'fields' => 'tema',
    'allowEmpty' => false,
    'style' => 'dropdownlist',
    'showAddButton' => false,
    'htmlOptions' => $disabled
    )
); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'cumplido'); ?>
    <?php echo $form->checkBox($model,'cumplido'); ?>
    <?php echo $form->error($model,'cumplido'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'observaciones'); ?>
    <?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($model,'observaciones'); ?>
</div>		