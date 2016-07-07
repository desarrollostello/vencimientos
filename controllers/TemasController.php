<?php
/**
 * @var $this TemasController * @var $model Temas * @var $_model Temas */
class TemasController extends Controller
{
	public $layout='column2';
	private $_model;

	public function filters()
	{
		return array(array('CrugeAccessControlFilter'));
	}
        public function accessRules()
	{
		return array(
			
		);
	}

	public function actionView()
	{
            $this->render('view',array(
                'model'=>$this->loadModel(),
            ));
	}

	public function actionCreate()
	{
            $model=new Temas;
            $this->performAjaxValidation($model);
            if(isset($_POST['Temas']))
            {
                $model->attributes=$_POST['Temas'];
                $iid = Yii::app()->db->createCommand("SELECT max(id) from temas")->queryScalar();
                $model->id = (int) $iid + 1;

                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('admin'));
                }
            }
            $this->render('create',array('model'=>$model,));
	}

	public function actionUpdate()
	{
		$model=$this->loadModel();
		$this->performAjaxValidation($model);
		if(isset($_POST['Temas']))
		{
                    $model->attributes=$_POST['Temas'];
                    if($model->save()) {
                        Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                        $this->redirect(array('view','id'=>$model->id));
                    }
		}
		$this->render('update',array('model'=>$model,));
	}

	public function actionDelete()
	{
            if(Yii::app()->request->isPostRequest)
            {
                $this->loadModel()->delete();
                if(!isset($_GET['ajax']))
                    $this->redirect(array('index'));
            }
            else
                throw new CHttpException(400,
                    Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex()
	{
            $dataProvider=new CActiveDataProvider('Temas');
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
            ));
	}

	public function actionExportarExcel()
	{

            $criteria= $_SESSION['temas-criteria'];
            $sort=$_SESSION['temas-sort'];
            $model=$_SESSION['temas-clase'];
            $columnas=$_SESSION['temas-columnas'];


         $this->widget('application.extensions.EExcelView.EExcelView',
            array(
            'dataProvider'=> new CActiveDataProvider($model,array('pagination'=>false,'criteria'=>$criteria,'sort'=>$sort,)),
            'columns'=> $columnas
            )
        );
         Yii::app()->end();
	}
	public function actionExportarPDF()
	{

            $criteria= $_SESSION['temas-criteria'];
            $sort=$_SESSION['temas-sort'];
            $model=$_SESSION['temas-clase'];
            $columnas=$_SESSION['temas-columnas'];

            $this->widget('application.extensions.EExcelView.EExcelView',
                array(
                'dataProvider'=> new CActiveDataProvider($model,array('pagination'=>false,'criteria'=>$criteria,'sort'=>$sort,)),
                'columns'=> $columnas,
                'exportType'=>'PDF',
                )
            );
         Yii::app()->end();
	}


	public function actionAdmin()
	{
            $model=new Temas('search');
            $model->unsetAttributes();
            if(isset($_GET['Temas']))
                $model->attributes=$_GET['Temas'];

            $columnas= array(
                array(
                    'name'=>'id',
                    'value'=>'$data->id',
                    'sortable'=>'true',
                    'header'=>'ID',
                    'htmlOptions'=>array('width'=>'10%', 'style'=>'text-align: center'),
                ),
                array(
                    'name'=>'idSector',
                    'value'=>'$data->sector->sector',
                    'sortable'=>'true',
                    'header'=>'SECTOR',
                    'filter'=>CHtml::listData(Sectores::model()->findAll(array('order'=>'sector')),'id','sector'),
                    'htmlOptions'=>array('width'=>'40%', 'style'=>'text-align: center'),
                ),
                array(
                    'name'=>'tema',
                    'value'=>'$data->tema',
                    'sortable'=>'true',
                    'header'=>'TEMA',
                    'htmlOptions'=>array('width'=>'40%', 'style'=>'text-align: center'),
                ),
            );
            $_SESSION['temas-columnas']=$columnas;
            $this->render('admin',array(
                'model'=>$model,
                'columnas'=>$columnas,
            ));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Temas::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='temas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
