<?php
$this->breadcrumbs=array(
	'Localidadess'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','Nueva').'  Localidad', 'url'=>array('create')),
	array('label'=>Yii::t('app','Actualizar').'  Localidad', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Borrar').'  Localidad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Administrar').'  Localidades', 'url'=>array('admin')),
);
?>

<h3>Viendo Localidad #<?php echo $model->id; ?>
<div class="clear"></div>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
       <?php echo CHtml::link('Nuevo',array('Localidades/create')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Actualizar',array('Localidades/update', 'id'=>$model->id)); ?>
    </li>
    <li class="divider"></li>
    <li><?php echo CHtml::link('Listado',array('Localidades/admin')); ?></li>
  </ul>
</div>
</h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'localidad',
		'provincia.provincia',
	),
)); ?>