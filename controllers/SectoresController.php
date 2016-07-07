<?php
/**
 * @var $this SectoresController * @var $model Sectores * @var $_model Sectores */
class SectoresController extends Controller
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
            $model=new Sectores;
            $this->performAjaxValidation($model);
            if(isset($_POST['Sectores']))
            {
                $model->attributes=$_POST['Sectores'];
                $iid = Yii::app()->db->createCommand("SELECT max(id) from sectores")->queryScalar();
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
            if(isset($_POST['Sectores']))
            {
                $model->attributes=$_POST['Sectores'];
                if($model->save()) {
                    Yii::app()->user->setFlash('success',"Datos grabados correctamente!");
                    $this->redirect(array('view','id'=>$model->id));
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
            $dataProvider=new CActiveDataProvider('Sectores');
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
            ));
	}



	public function actionExportarExcel()
	{
            $criteria= $_SESSION['sectores-criteria'];
            $sort=$_SESSION['sectores-sort'];
            $model=$_SESSION['sectores-clase'];
            $columnas=$_SESSION['sectores-columnas'];
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

            $criteria= $_SESSION['sectores-criteria'];
            $sort=$_SESSION['sectores-sort'];
            $model=$_SESSION['sectores-clase'];
            $columnas=$_SESSION['sectores-columnas'];
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
            $model=new Sectores('search');
            $model->unsetAttributes();
            if(isset($_GET['Sectores']))
                $model->attributes=$_GET['Sectores'];

            $columnas= array(
                'id',
                'sector',
            );

            $_SESSION['sectores-columnas']=$columnas;
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
				$this->_model=Sectores::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sectores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
