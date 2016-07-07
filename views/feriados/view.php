<?php
$this->breadcrumbs=array(
	'Feriados'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','Nuevo').'  Feriado', 'url'=>array('create')),
	array('label'=>Yii::t('app','Acualizar').'  Feriado', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Borrar').'  Feriado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','Listado').'  Feriados', 'url'=>array('admin')),
);
?>

<h3>viendo Feriado #<?php echo $model->id; ?>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
       <?php echo CHtml::link('Nuevo',array('Feriados/create')); ?>
    </li>
    <li>
        <?php echo CHtml::link('Actualizar',array('Feriados/update', 'id'=>$model->id)); ?>
    </li>
    <li class="divider"></li>
    <li><?php echo CHtml::link('Listado',array('Feriados/admin')); ?></li>
  </ul>
</div>
    </h3>
<?php $this->widget('zii.widgets.CDetailView', array(
'data'=>$model,
'attributes'=>array(
    'id',
    'fecha',
    'coope.cooperativa'
),
)); ?>


