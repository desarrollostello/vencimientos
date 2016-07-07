<?php

/**
 * This is the model class for table "localidades".
 */
class Localidades extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'localidades':
	 * @var integer $id
	 * @var string $localidad
	 * @var integer $idProvincia
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Localidades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'localidades';
	}

	public function rules()
	{
            return array(
                array('localidad, idProvincia', 'required'),
                array('idProvincia', 'numerical', 'integerOnly'=>true),
                array('localidad', 'length', 'max'=>250),
                array('id, localidad, idProvincia', 'safe', 'on'=>'search'),
            );
	}

	public function relations()
	{
            return array(
                'cooperativas' => array(self::HAS_MANY, 'Cooperativas', 'idLocalidad'),
                'provincia' => array(self::BELONGS_TO, 'Provincias', 'idProvincia'),
            );
	}

	public function attributeLabels()
	{
            return array(
                'id' => Yii::t('app', 'ID'),
                'localidad' => Yii::t('app', 'Localidad'),
                'idProvincia' => Yii::t('app', 'Provincia'),
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
                'localidad'=>array('asc'=>'t.localidad','desc'=>'t.localidad desc',),
                'idProvincia'=>array('asc'=>'t.idProvincia','desc'=>'t.idProvincia desc',),
            );
            //$sort->defaultOrder = 't.xxxxxx';
            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.localidad',$this->localidad,true);
            $criteria->compare('t.idProvincia',$this->idProvincia);
            $data= new CActiveDataProvider(get_class($this), array(
                'criteria'=>$criteria,
                'sort'=>$sort,
            ));
            /*se usan para pasar a excel, ver actionExportarExcel*/
            $_SESSION['localidades-criteria']=$criteria;
            $_SESSION['localidades-sort']=$sort;
            $_SESSION['localidades-clase']=get_class($this);
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
