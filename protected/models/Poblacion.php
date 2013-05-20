<?php

/**
 * This is the model class for table "{{poblaciones}}".
 *
 * The followings are the available columns in table '{{poblaciones}}':
 * @property integer $idpoblacion
 * @property string $idprovincia
 * @property string $poblacion
 * @property string $poblacionseo
 * @property string $postal
 * @property string $latitud
 * @property string $longitud
 *
 * The followings are the available model relations:
 * @property Contactos[] $contactoses
 * @property Provincias $idprovincia0
 */
class Poblacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Poblacion the static model class
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
		return '{{poblaciones}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idprovincia, poblacion', 'required'),
			array('idprovincia', 'length', 'max'=>11),
			array('poblacion, poblacionseo', 'length', 'max'=>150),
			array('postal', 'length', 'max'=>5),
			array('latitud, longitud', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idpoblacion, idprovincia, poblacion, poblacionseo, postal, latitud, longitud', 'safe', 'on'=>'search'),
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
			'contactos' => array(self::HAS_MANY, 'Contactos', 'poblacion_id'),
			'provincias' => array(self::BELONGS_TO, 'Provincias', 'idprovincia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idpoblacion' => 'Idpoblacion',
			'idprovincia' => 'Idprovincia',
			'poblacion' => 'Poblacion',
			'poblacionseo' => 'Poblacionseo',
			'postal' => 'Postal',
			'latitud' => 'Latitud',
			'longitud' => 'Longitud',
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

		$criteria->compare('idpoblacion',$this->idpoblacion);
		$criteria->compare('idprovincia',$this->idprovincia,true);
		$criteria->compare('poblacion',$this->poblacion,true);
		$criteria->compare('poblacionseo',$this->poblacionseo,true);
		$criteria->compare('postal',$this->postal,true);
		$criteria->compare('latitud',$this->latitud,true);
		$criteria->compare('longitud',$this->longitud,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}