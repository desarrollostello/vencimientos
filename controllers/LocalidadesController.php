<?php
/**
 * @var $this LocalidadesController * @var $model Localidades * @var $_model Localidades */
class LocalidadesController extends Controller
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
            $model=new Localidades;
            $this->performAjaxValidation($model);
            if(isset($_POST['Localidades']))
            {
                $model->attributes=$_POST['Localidades'];
                $iid = Yii::app()->db->createCommand("SELECT max(id) from localidades")->queryScalar();
                $model->id = (int) $iid + 1;
                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('admin'));
                }
            }
            $this->render('create',array(
                'model'=>$model,
            ));
	}

	public function actionUpdate()
	{
		$model=$this->loadModel();

		$this->performAjaxValidation($model);

		if(isset($_POST['Localidades']))
		{
			$model->attributes=$_POST['Localidades'];
		
			if($model->save()) {
                                Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
				$this->redirect(array('update','id'=>$model->id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Localidades');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}



	public function actionExportarExcel()
	{

            $criteria= $_SESSION['localidades-criteria'];
            $sort=$_SESSION['localidades-sort'];
            $model=$_SESSION['localidades-clase'];
            $columnas=$_SESSION['localidades-columnas'];


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

            $criteria= $_SESSION['localidades-criteria'];
            $sort=$_SESSION['localidades-sort'];
            $model=$_SESSION['localidades-clase'];
            $columnas=$_SESSION['localidades-columnas'];


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
		$model=new Localidades('search');
                $model->unsetAttributes();
		if(isset($_GET['Localidades']))
			$model->attributes=$_GET['Localidades'];

                $columnas= array(
                    array(
                    'name'=>'id',
                    'value'=>'$data->id',
                    'sortable'=>'true',
                    'header'=>'ID',
                    'htmlOptions'=>array('width'=>'10%', 'style'=>'text-align: center'),
                    ),
                    array(
                        'name'=>'localidad',
                        'value'=>'$data->localidad',
                        'sortable'=>'true',
                        'header'=>'LOCALIDAD',
                        'htmlOptions'=>array('width'=>'40%', 'style'=>'text-align: center'),
                    ),
                    array(
                    'name'=>'idProvincia',
                    'value'=>'$data->provincia->provincia',
                    'sortable'=>'true',
                    'header'=>'PROVINCIA',
                    'filter'=>CHtml::listData(Provincias::model()->findAll(array('order'=>'provincia')),'id','provincia'),
                    'htmlOptions'=>array('width'=>'40%', 'style'=>'text-align: center'),
                    ),
                );

                $_SESSION['localidades-columnas']=$columnas;

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
				$this->_model=Localidades::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='localidades-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
