<?php
$this->breadcrumbs=array(
	'Cooperativas'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','Listado').'  Cooperativas', 'url'=>array('admin')),
	array('label'=>Yii::t('app','Nueva').'  Cooperativa', 'url'=>array('create')),
	array('label'=>Yii::t('app','Actualizar').'  Cooperativa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Borrar').'  Cooperativa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

);
?>

<h3>Viendo Cooperativa #<?php echo $model->id; ?>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
       <?php echo CHtml::link('Nuevo',array('Cooperativas/create')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Actualizar',array('Cooperativas/update', 'id'=>$model->id)); ?>
    </li>
    <li class="divider"></li>
    <li><?php echo CHtml::link('Listado',array('Cooperativas/admin')); ?></li>
  </ul>
</div>
    </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'cooperativa',
        'presidente',
        'telefono',
        'mail',
        'web',
        'direccion',
        'localidad.localidad',
    ),
)); ?>


<br /><h2> Vencimientos para esta Cooperativa </h2>
<ul><?php foreach($model->vencimiento as $foreignobj) { 
        printf('<li>%s</li>', CHtml::link($foreignobj->fecha, array('vencimientos/view', 'id' => $foreignobj->getPrimaryKey())));
} ?></ul>