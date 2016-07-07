<?php
/**
 * @var $this CooperativasController * @var $model Cooperativas * @var $_model Cooperativas */
class CooperativasController extends Controller
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
        /*
	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index','view','exportarPDF','ExportarExcel'),
				'expression'=>"Seguridad::tieneRol('SALUD_MENTAL_ADMIN')",
			),
			array('allow', 
				'actions'=>array('create','update'),
				'expression'=>"Seguridad::tieneRol('SALUD_MENTAL_ADMIN')",
			),
			array('allow', 
				'actions'=>array('admin','delete'),
				'expression'=>"Seguridad::tieneRol('SALUD_MENTAL_ADMIN')",
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
        */
        public function actionEnviarMail() {
        Yii::import('ext.yii-mail.YiiMailMessage');
        $message = new YiiMailMessage;        
        
        $message->subject = 'My Subject';
        $message->view ='miVista';//nombre de la vista q conformara el mail
        $message->setBody('','text/html');//codificar el html de la vista
        $message->from =('maurotello73@gmail.com'); // alias del q envia
        $message->setTo('maurotello73@gmail.com'); // a quien se le envia
        
        Yii::app()->mail->send($message);
        }
        public function actionMail(){
 // $consta = Constaglobal::model()->findByAttributes(array('idInvGlobal'=>$IdInv));
            $this->widget('application.extensions.email.Debug'); 
            $email = Yii::app()->email;
            $email->to = 'maurotello73@gmail.com';
            $email->subject = 'Subject text';
            $email->view = 'miVista';
            $var1 = "Hola prueba";
            $var2="Salio todo bien";
            $email->viewVars = array('var1'=>$var1,'var2'=>$var2);
            $email->send();
            
        }
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	public function actionCreate()
	{
            $model=new Cooperativas;
            $this->performAjaxValidation($model);
            if(isset($_POST['Cooperativas']))
            {
                $model->attributes=$_POST['Cooperativas'];
                $iid = Yii::app()->db->createCommand("SELECT max(id) from cooperativas")->queryScalar();
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

		if(isset($_POST['Cooperativas']))
		{
			$model->attributes=$_POST['Cooperativas'];
		
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
		$dataProvider=new CActiveDataProvider('Cooperativas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}



	public function actionExportarExcel()
	{

            $criteria= $_SESSION['cooperativas-criteria'];
            $sort=$_SESSION['cooperativas-sort'];
            $model=$_SESSION['cooperativas-clase'];
            $columnas=$_SESSION['cooperativas-columnas'];


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

            $criteria= $_SESSION['cooperativas-criteria'];
            $sort=$_SESSION['cooperativas-sort'];
            $model=$_SESSION['cooperativas-clase'];
            $columnas=$_SESSION['cooperativas-columnas'];


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
		$model=new Cooperativas('search');
                $model->unsetAttributes();
		if(isset($_GET['Cooperativas']))
			$model->attributes=$_GET['Cooperativas'];

                $columnas= array(
                		'id',
		'cooperativa',
		'presidente',
		'telefono',
		'mail',
		'web',
		/*
		'direccion',
		'idLocalidad',
		*/
                );

                $_SESSION['cooperativas-columnas']=$columnas;

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
				$this->_model=Cooperativas::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		return $this->_model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cooperativas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
