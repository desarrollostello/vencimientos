<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
$this->breadcrumbs=array(
	'Feriados'=>array(Yii::t('app', 'admin')),
	Yii::t('app', 'Listado'),
);


?>
<h3> Listado de &nbsp;Feriados
<?php       
?>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
        <?php echo CHtml::link('Nuevo',array('Feriados/create')); ?>
    </li>
<!--    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
    <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
    <li class="divider"></li>
    <li><a href="#"><i class="i"></i> Make admin</a></li>-->
  </ul>
</div>
</h3>
<?php

$this->menu=array(
    array('label'=>Yii::t('app', 'Nuevo').'  Feriado', 'url'=>array('create')),
    // array('label'=>'Exportar a Excel','url'=>array('exportarExcel')),
    // array('label'=>'Exportar a PDF','url'=>array('exportarPDF')),
);

/*
 * las columnas se definen en el controlador
 * porque se usan las mismas para pasar a excel
 * agrego los botones */
$columnas[]=array('class'=>'CButtonColumn',);
$this->widget('zii.widgets.grid.CGridView', array(
'id'=>'feriados-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=> $columnas,
	
)); ?>
