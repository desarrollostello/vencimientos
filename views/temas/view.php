<?php
$this->breadcrumbs=array('Temas'=>array('admin'), $model->id,);

$this->menu=array(
	array('label'=>Yii::t('app','Nuevo').'  Tema', 'url'=>array('create')),
	array('label'=>Yii::t('app','Actualizar').'  Tema', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Borrar').'  Tema', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Listado').'  Temas', 'url'=>array('admin')),
);
?>

<h3>Visualizando Tema #<?php echo $model->id; ?>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
       <?php echo CHtml::link('Nuevo',array('Temas/create')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Actualizar',array('Temas/update', 'id'=>$model->id)); ?>
    </li>
    <li class="divider"></li>
    <li><?php echo CHtml::link('Listado',array('Temas/admin')); ?></li>
  </ul>
</div>
    </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tema',
		'sector.sector',
	),
)); ?>