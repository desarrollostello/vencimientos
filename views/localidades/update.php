<?php
$this->breadcrumbs=array(
	'Localidades'=>array('admin'),
	$model->id=>array('update','id'=>$model->id),
	Yii::t('app', 'Actualizar'),
);

$this->menu=array(
    array('label'=>Yii::t('app','Nueva').'  Localidad', 'url'=>array('create')),
    array('label'=>Yii::t('app','Listado').'  Localidades', 'url'=>array('admin')),
);
?>

<?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
    if ($key=='counters') {continue;}
    echo "<div class='grabado_ok'>{$message}</div>";
}
 ?>

<h3>Actualizar Localidad #<?php echo $model->id; ?> 
<div class="clear"></div>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
        <?php echo CHtml::link('Listado',array('Localidades/admin')); ?>
    </li>
    <li class="divider"></li>
    <li>
        <?php echo CHtml::link('Nueva',array('Localidades/create')); ?>
    </li>
<!--    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> Make admin</a></li>-->
  </ul>
</div>
</h3>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'localidades-form',
	'enableAjaxValidation'=>false,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Actualizar'),array('class'=>'btn btn-large btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
