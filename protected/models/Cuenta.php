<?php

/**
 * This is the model class for table "{{cuentas}}".
 *
 * The followings are the available columns in table '{{cuentas}}':
 * @property integer $id
 * @property string $nombre
 * @property string $precio
 * @property string $duracion
 *
 * The followings are the available model relations:
 * @property Empresas[] $empresases
 */
class Cuenta extends CActiveRecord
{
	//Duración en semanas
	const DURACION_CUENTA_TRIAL=2;
	
	const CUENTA_TRIAL = 1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cuenta the static model class
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
		return '{{cuentas}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, precio, duracion', 'required'),
			array('nombre, precio, duracion', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, precio, duracion', 'safe', 'on'=>'search'),
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
			//'profile' => array(self::HAS_MANY, 'Profile', 'tipocuenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'titulo' => 'Tipo de cuenta',//Cuando se muestra desde el profile
			'precio' => 'Precio',
			'duracion' => 'Duracion',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('precio',$this->precio,true);
		$criteria->compare('duracion',$this->duracion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getCuentas()
	{
		return CHtml::listData(Cuenta::model()->findAll(),'id','titulo');
	}

	public static function editCuentas(){

	}

	public static function getCuentaUsuario($idUsuario){
		//me devuelve los datos de la cuenta que tiene asociada el usuario: tipo, fecha_inicio, fecha_fin, activa....
	}

	public static function changeCuentaUsuario($idUsuario,$idCuenta){
		//cambiar el tipo de cuenta asociada al usuario. Tendré que setear la fecha de inicio de la nueva cuenta y la fecha de fin.
	}
}