<?php

/**
 * This is the model class for table "{{contactos}}".
 *
 * The followings are the available columns in table '{{contactos}}':
 * @property integer $id
 * @property string $telefono
 * @property string $fax
 * @property string $cp
 * @property integer $barrio
 * @property string $direccion
 * @property integer $poblacion_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Poblacion $poblacion
 * @property Profiles[] $profiles
 */
class Contacto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contactos the static model class
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
		return '{{contactos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id', 'required'),
			array('id, barrio, poblacion_id,telefono,fax,cp', 'numerical', 'integerOnly'=>true),
			array('telefono, fax', 'length', 'max'=>50),
			array('cp', 'length', 'max'=>11),
			array('direccion', 'length', 'max'=>120),
			//array('telefono,fax,cp', 'numerical','integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, telefono, fax, cp, barrio, direccion, poblacion_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'id'),
			//'profile' => array(self::BELONGS_TO, 'Profile', 'id'),
			//'empresa'=>array(self::BELONGS_TO, 'Empresa', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'User',
			'telefono' => 'Telefono',
			'fax' => 'Fax',
			'cp' => 'Cp',
			'barrio' => 'Barrio',
			'direccion' => 'Direccion',
			'poblacion_id' => 'Poblacion',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('barrio',$this->barrio);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('poblacion_id',$this->poblacion_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}