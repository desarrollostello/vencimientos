<?php
$this->breadcrumbs=array(
	'Cooperativas'=>array('admin'),
	$model->id=>array('update','id'=>$model->id),
	Yii::t('app', 'Actualizar'),
);
$this->menu=array(
	//array('label'=>Yii::t('app','List').'  Cooperativass', 'url'=>array('index')),
	array('label'=>Yii::t('app','Nueva').'  Cooperativa', 'url'=>array('create')),
	//array('label'=>Yii::t('app','View').'  Cooperativas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Listado').'  Cooperativas', 'url'=>array('admin')),
);
?>
<?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
    if ($key=='counters') {continue;}
    echo "<div class='grabado_ok'>{$message}</div>";
}
 ?>
<h3> Actualizar Cooperativa #<?php echo $model->id; ?> 
<div class="clear"></div>
<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>Opciones</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li>
        <?php echo CHtml::link('Listado',array('Cooperativas/admin')); ?>
    </li>
    <li class="divider"></li>
    <li>
        <?php echo CHtml::link('Nueva',array('Cooperativas/create')); ?>
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
	'id'=>'cooperativas-form',
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
