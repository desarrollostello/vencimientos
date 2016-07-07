<?php
$this->breadcrumbs=array(
	'Vencimientos'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','Nuevo').'  Vencimiento', 'url'=>array('create')),
	array('label'=>Yii::t('app','Actualizar').'  Vencimiento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Borrar').'  Vencimiento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Listado').'  Vencimientos', 'url'=>array('admin')),
);
?>

<h3>Viedma Vencimiento #<?php echo $model->id; ?>
<div class="clear"></div>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
       <?php echo CHtml::link('Nuevo',array('Vencimientos/create')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Actualizar',array('Vencimientos/update', 'id'=>$model->id)); ?>
    </li>
    <li class="divider"></li>
    <li><?php echo CHtml::link('Listado',array('Vencimientos/admin')); ?></li>
  </ul>
</div>
</h3>
<?php 
if ($model->fecha!='') {
$fecha=date('d-m-Y',strtotime($model->fecha));
}
else {
$fecha='';
}
$this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
'attributes'=>array(
    'id',
    array('name'=>'Fecha', 'value'=>$fecha,),
    'coope.cooperativa',
    'tema.tema',
    'plazo',
    'habil',
    'fechaLimite',
    array(
        'name'=>'Cumplido',
        'value'=>($model->cumplido)?'SI':'NO',
    ),
    'observaciones',
),
)); ?>


