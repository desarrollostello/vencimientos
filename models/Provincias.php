<?php

/**
 * This is the model class for table "provincias".
 */
class Provincias extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'provincias':
	 * @var integer $id
	 * @var string $provincia
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Provincias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'provincias';
	}

	public function rules()
	{
		return array(
			array('provincia', 'required'),
			array('provincia', 'length', 'max'=>250),
			array('id, provincia', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'localidades' => array(self::HAS_MANY, 'Localidades', 'idProvincia'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'provincia' => Yii::t('app', 'Provincia'),
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
                    'provincia'=>array('asc'=>'t.provincia','desc'=>'t.provincia desc',),
                );
                //$sort->defaultOrder = 't.xxxxxx';
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.provincia',$this->provincia,true);
		$data= new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
                /*se usan para pasar a excel, ver actionExportarExcel*/
                $_SESSION['provincias-criteria']=$criteria;
                $_SESSION['provincias-sort']=$sort;
                $_SESSION['provincias-clase']=get_class($this);

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
