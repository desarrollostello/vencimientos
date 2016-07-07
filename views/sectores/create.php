<?php
$this->breadcrumbs=array(
	'Sectores'=>array(Yii::t('app', 'admin')),
	Yii::t('app', 'Crear'),
);

$this->menu=array(
	//array('label'=>Yii::t('app','List').'  ', 'url'=>array('index')),
	array('label'=>Yii::t('app','Listado').'  Sectores', 'url'=>array('admin')),
);
?>

<h3> Nuevo Sector 
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
        <?php echo CHtml::link('Listado',array('Sectores/admin')); ?>
    </li>
<!--    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> Make admin</a></li>-->
  </ul>
</div>
    </h3>
<div class="clear"></div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sectores-form',
	'enableAjaxValidation'=>false,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('app', 'Crear'),array('class'=>'btn btn-large btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
