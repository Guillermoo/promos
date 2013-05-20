<?php

/**
 * This is the model class for table "{{provincias}}".
 *
 * The followings are the available columns in table '{{provincias}}':
 * @property string $idprovincia
 * @property string $provincia
 * @property string $provinciaseo
 * @property string $provincia3
 *
 * The followings are the available model relations:
 * @property Poblaciones[] $poblaciones
 */
class Provincia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Provincia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provincias}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provincia, provinciaseo', 'required'),
			array('provincia, provinciaseo', 'length', 'max'=>50),
			array('provincia3', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idprovincia, provincia, provinciaseo, provincia3', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'poblaciones' => array(self::HAS_MANY, 'Poblaciones', 'idprovincia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idprovincia' => 'Idprovincia',
			'provincia' => 'Provincia',
			'provinciaseo' => 'Provinciaseo',
			'provincia3' => 'Provincia3',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idprovincia',$this->idprovincia,true);
		$criteria->compare('provincia',$this->provincia,true);
		$criteria->compare('provinciaseo',$this->provinciaseo,true);
		$criteria->compare('provincia3',$this->provincia3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}