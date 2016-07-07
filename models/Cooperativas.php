<?php

/**
 * This is the model class for table "cooperativas".
 */
class Cooperativas extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'cooperativas':
	 * @var integer $id
	 * @var string $cooperativa
	 * @var string $presidente
	 * @var string $telefono
	 * @var string $mail
	 * @var string $web
	 * @var string $direccion
	 * @var integer $idLocalidad
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Cooperativas the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}

	public function tableName()
	{
            return 'cooperativas';
	}

	public function rules()
	{
            return array(
                array('cooperativa, presidente, telefono, mail, web, direccion, idLocalidad', 'required'),
                array('idLocalidad', 'numerical', 'integerOnly'=>true),
                array('cooperativa, presidente, web, direccion', 'length', 'max'=>250),
                array('telefono, mail', 'length', 'max'=>200),
                array('id, cooperativa, presidente, telefono, mail, web, direccion, idLocalidad', 'safe', 'on'=>'search'),
            );
	}

	public function relations()
	{
            return array(
                'localidad' => array(self::BELONGS_TO, 'Localidades', 'idLocalidad'),
                'vencimiento' => array(self::HAS_MANY, 'Vencimientos', 'idCoope'),
                'feriado' => array(self::HAS_MANY, 'Feriados', 'idCoope'),
            );
	}

	public function attributeLabels()
	{
            return array(
                'id' => Yii::t('app', 'ID'),
                'cooperativa' => Yii::t('app', 'Cooperativa'),
                'presidente' => Yii::t('app', 'Presidente'),
                'telefono' => Yii::t('app', 'Telefono'),
                'mail' => Yii::t('app', 'Mail'),
                'web' => Yii::t('app', 'Web'),
                'direccion' => Yii::t('app', 'Direccion'),
                'idLocalidad' => Yii::t('app', 'Localidad'),
            );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
            $criteria=new CDbCriteria;
            $sort = new CSort();
            $sort->attributes = array(
                'id'=>array('asc'=>'t.id','desc'=>'t.id desc',),
                'cooperativa'=>array('asc'=>'t.cooperativa','desc'=>'t.cooperativa desc',),
                'presidente'=>array('asc'=>'t.presidente','desc'=>'t.presidente desc',),
                'telefono'=>array('asc'=>'t.telefono','desc'=>'t.telefono desc',),
                'mail'=>array('asc'=>'t.mail','desc'=>'t.mail desc',),
                'web'=>array('asc'=>'t.web','desc'=>'t.web desc',),
                'direccion'=>array('asc'=>'t.direccion','desc'=>'t.direccion desc',),
                'idLocalidad'=>array('asc'=>'t.idLocalidad','desc'=>'t.idLocalidad desc',),
            );
            //$sort->defaultOrder = 't.xxxxxx';
            $criteria->with=array('localidad');
            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.cooperativa',$this->cooperativa,true);
            $criteria->compare('t.presidente',$this->presidente,true);
            $criteria->compare('t.telefono',$this->telefono,true);
            $criteria->compare('t.mail',$this->mail,true);
            $criteria->compare('t.web',$this->web,true);
            $criteria->compare('t.direccion',$this->direccion,true);
            $criteria->compare('t.idLocalidad',$this->idLocalidad);

            $data= new CActiveDataProvider(get_class($this), array(
                    'criteria'=>$criteria,
                    'sort'=>$sort,
            ));
            /*se usan para pasar a excel, ver actionExportarExcel*/
            $_SESSION['cooperativas-criteria']=$criteria;
            $_SESSION['cooperativas-sort']=$sort;
            $_SESSION['cooperativas-clase']=get_class($this);

            return $data;
	}

public function afterFind(){
    parent::afterFind();
    //$this->fecha = Varios::dateconvert($this->fecha,2);
}

public function beforeSave() {
    //$this->fecha = Varios::dateconvert($this->fecha,1);
    //$this->descripcion=strtoupper($this->descripcion);
    // no sacar return , lo usa CActiveRecord.update
    return parent::beforeSave();
}

}
