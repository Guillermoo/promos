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
	
	const CUENTA_TRIAL=0;
	const CUENTA_LITE=1;
	const CUENTA_BASIC=2;
	const CUENTA_DELUXE=3;	
	
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
			array('direccion,telefono,cp,poblacion_id,paypal_id','required', 'except' => 'admin'),
			array('barrio,poblacion_id,telefono,fax,cp', 'numerical', 'integerOnly'=>true),
			array('telefono, fax', 'length', 'max'=>50),
			array('tipocuenta', 'length', 'max'=>11),
			array('fecha_activacion, fecha_fin,fecha_pago', 'length', 'max'=>51),
			//array('fecha_activacion, fecha_fin,fecha_pago', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, lastname, paypal_id, tipocuenta, fecha_activacion, fecha_fin, fecha_pago,telefono, fax, cp, barrio, direccion, poblacion_id', 'safe', 'on'=>'search'),
		);
	}
	
	protected function beforeSave()
	  {
	  	if ($this->checkeaFechas()==true)
	  		return true;
  		else
	  		return false;
	  }
	  
	protected function afterSave()
        {
        	if (!$this->isNewRecord){
				//Si es admin elq ue está actualizando el id es otro.
        		$model = User::model()->findByPk($this->user_id);
        		if ($model->status=3){
        			if(User::tieneCamposMinimosRellenos($model) != true){
						$model->status=2;
						$model->save();
					}	
        		}
        	}else{//Si es nueva profile
        		$this->tipocuenta = Cuenta::CUENTA_TRIAL;
        		$this->setFechasCreacion();
        	}
		 	
			parent::afterSave();
        }
	  
	/*Esta función tiene que comprobar que las fechas sean correctas. Fecha pago < Fecha activacion < Fecha Fin*/
	private function checkeaFechas(){
		return true;
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
            'cuenta' => array(self::BELONGS_TO, 'Cuenta', 'tipocuenta'),
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
	    
	/*
	 * Cuando se crea una cuenta desde la parte pública o desde admin se asignarán las fechas
	 * para la cuenta trial(La cuenta que todo el mundo tiene cuando se registra).
	 */
    private function setFechasCreacion(){
    	$today = "";
    	$this->setFechaActivacion($today);
    	$this->setFechaFin($today + Cuenta::DURACION_CUENTA_TRIAL);
    	$this->setFechaPago($today);//La cuentra trial es como no tiene que pagar, realmente no importa que día pagó
    }
    
    /*
     * Esta función es la encargada de asignar los valores de las fechas en
     * función del tipo de cuenta, duración... $this->tipocuenta, $this->meses
     * */
    private function setFechasTrasPagar(){
    	//Los valores que hagan falta.
    	/*$today = "";
    	setFechaActivacion($today);
    	setFechaFin($today + Cuenta::DURACION_CUENTA_TRIAL);
    	setFechaPago($today);*/
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
			'username' => 'Nombre',
			'lastname' => 'Apellido',
			//'contacto_id' => 'Contacto',
			'paypal_id' => 'Cuenta de Paypal',
			'tipocuenta' => 'Tipo de cuenta',
			'fecha_activacion' => 'Fecha Activación',
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
		//$criteria->compare('contacto_id',$this->contacto_id);
		$criteria->compare('paypal_id',$this->paypal_id,true);
		$criteria->compare('tipocuenta',$this->tipocuenta,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function actualizaFechaTrasActivacion($profile=null){
		if (isset($profile)){
			$find->profile->fecha_activacion = time();
			$find->profile->fecha_fin = time() + Cuenta::DURACION_CUENTA_TRIAL;
			//Igual da fallo de validación!!!!
			$find->profile->save(false);
		}
	}
	
	
}