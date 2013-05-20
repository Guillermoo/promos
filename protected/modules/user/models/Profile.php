<?php

/**
 * This is the model class for table "{{profiles}}".
 *
 * The followings are the available columns in table '{{profiles}}':
 * @property integer $user_id
 * @property string $username
 * @property string $lastname
 * @property integer $contacto_id
 * @property string $paypal_id
 * @property string $tipocuenta
 * @property string $fecha_creacion
 * @property string $fecha_fin
 * @property string $fecha_pago
 *
 * The followings are the available model relations:
 * @property Contactos $contacto
 * @property Users $user
 */
class Profile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return '{{profiles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('username, lastname, contacto_id, paypal_id, tipocuenta, fecha_creacion, fecha_fin, fecha_pago', 'required'),
			//array('contacto_id', 'numerical', 'integerOnly'=>true),
			array('username, lastname', 'length', 'max'=>50),
			array('paypal_id', 'length', 'max'=>40),
			//array('tipocuenta', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, lastname, contacto_id, paypal_id, tipocuenta, fecha_creacion, fecha_fin, fecha_pago', 'safe', 'on'=>'search'),
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
		);
	}
	
	/*Función que determina los campos que va a devolver según nos convenga, desde
	 * user se llamara a field algo así:
	 * $this->_modelReg=Profile::model()->paraComprador()->findAll();*/
	public function scopes()
	    {
	        return array(
	            'paraTodos'=>array(
	                //'condition'=>'visible='.self::VISIBLE_ALL,
	                //'order'=>'position',
	            ),
	            'paraAdmin'=>array(
	                //'condition'=>'visible>='.self::VISIBLE_REGISTER_USER,
	                'order'=>'position',
	            ),
	            'paraComprador'=>array(
	                //'condition'=>'visible>='.self::VISIBLE_REGISTER_USER,
	                'order'=>'position',
	            ),
	            'paraEmpresa'=>array(
	                //'condition'=>'visible>='.self::VISIBLE_ONLY_OWNER,
	                'order'=>'position',
	            ),
	        );
	    }

    /*(G) De momento no hay nada programado.*/
    public function setFechaActivacion($value) {
        $this->fecha_activacion=date('Y-m-d H:i:s',$value);
    }
    
    public function setFechaFin($value) {
    	/*Código necesario para calcular la fecha en la que se le acaba al usuario
    	 el periodo activo*/
        $this->fecha_fin=date('Y-m-d H:i:s',$value);
    }
    
    
    /*Código necesario para calcular la fecha en la que realizó el pago*/
	public function setFechaPago($value) {
        $this->fecha_pago=date('Y-m-d H:i:s',$value);
    }
	    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'lastname' => 'Lastname',
			'contacto_id' => 'Contacto',
			'paypal_id' => 'Paypal',
			'tipocuenta' => 'Tipo de cuenta',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_fin' => 'Fecha Fin',
			'fecha_pago' => 'Fecha Pago',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('contacto_id',$this->contacto_id);
		$criteria->compare('paypal_id',$this->paypal_id,true);
		$criteria->compare('tipocuenta',$this->tipocuenta,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}