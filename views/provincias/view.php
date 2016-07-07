<?php
$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','Listado').'  Provincias', 'url'=>array('index')),
	array('label'=>Yii::t('app','Nueva').'  Provincia', 'url'=>array('create')),
	array('label'=>Yii::t('app','Actualizar').'  Provincia', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Borrar').'  Provincia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Listado').'  Provincias', 'url'=>array('admin')),
);
?>

<h3>Viendo Provincia #<?php echo $model->id; ?>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
       <?php echo CHtml::link('Nuevo',array('Provincias/create')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Actualizar',array('Provincias/update', 'id'=>$model->id)); ?>
    </li>
    <li class="divider"></li>
    <li><?php echo CHtml::link('Listado',array('Provincias/admin')); ?></li>
  </ul>
</div>
    </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
'attributes'=>array(
    'id',
    'provincia',
),
)); ?>