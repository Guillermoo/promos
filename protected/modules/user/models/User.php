<?php

class User extends CActiveRecord
{
	const STATUS_BANNED=-1;
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_PAGAR=2;//Si es = a 2 es que tiene que pagar
	const STATUS_OK=3;
	const ID_SUPERADMIN=-1;
	const ID_COMPRADOR=0;
	const ID_ADMIN=1;
	const ID_EMPRESA=2;
	const ID_TRIAL=2;
	
	//TODO: Delete for next version (backward compatibility)
	const STATUS_BANED=-1;
	
	public $regMode = false;
	public $cambiaRole = false;
	
	private $_modelReg;
	private $_model;
	private $passwordHash;
	
	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
     * @var timestamp $create_at
     * @var timestamp $lastvisit_at
	 */


	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return Yii::app()->getModule('user')->tableUsers;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.CConsoleApplication
		return ((get_class(Yii::app())=='CConsoleApplication' || (get_class(Yii::app())!='CConsoleApplication' && Yii::app()->getModule('user')->isAdmin()))?array(
			//array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			//array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			//array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED,self::STATUS_PAGAR,self::STATUS_OK), 'except' => 'admin'),
			array('superuser', 'in', 'range'=>array(self::ID_COMPRADOR,self::ID_ADMIN,self::ID_EMPRESA,self::ID_TRIAL)),
            array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('email,password, superuser, status', 'required'),
			array('superuser, status', 'numerical', 'integerOnly'=>true),
			array('id, password, email, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
				):((Yii::app()->user->id==$this->id)?array(
			array('username, email', 'required', 'except' => 'admin'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
		):array()));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        $relations = Yii::app()->getModule('user')->relations;
        if(isset($_GET['id']))
			$id=$_GET['id'];
		else
			$id=Yii::app()->user->id;

        if (Yii::app()->authManager->checkAccess('empresa', $id))
            $relations['empresa'] = array(self::HAS_ONE, 'Empresa', 'user_id');
            $relations['profile'] = array(self::HAS_ONE, 'Profile', 'user_id');
            $relations['item'] = array(self::HAS_ONE, 'Item', 'foreign_id');
            $relations['promocion'] = array(self::HAS_MANY, 'Promocion', 'user_id');
        return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => UserModule::t("Id"),
			'username'=>UserModule::t("username"),
			'password'=>UserModule::t("password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
			'email'=>UserModule::t("E-mail"),
			'verifyCode'=>UserModule::t("Verification Code"),
			'activkey' => UserModule::t("activation key"),
			//'createtime' => UserModule::t("Registration date"),
			'create_at' => UserModule::t("Registration date"),
			'lastvisit_at' => UserModule::t("Last visit"),
			'superuser' => UserModule::t("User type"),
			'status' => UserModule::t("Status"),
		);
	}
	
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'basic'=>array(
                'select' => 'id,username',
            ),
            'notactive'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANNED,
            ),
            'superuser'=>array(
                'condition'=>'superuser=1 || superuser=-1',
            ),
            'status'=>array(
                'select' => 'id,status',
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, create_at, lastvisit_at, superuser, status',
            ),
            'nombre'=>array(
            	'select' => 'nombre',
            	'condition' => 'id='.Yii::app()->user->id,
             )
        );
    }
	
	public function defaultScope()
    {
        return CMap::mergeArray(Yii::app()->getModule('user')->defaultScope,array(
            'alias'=>'user',
            'select' => 'user.id, user.username, user.email, user.create_at, user.lastvisit_at, user.superuser, user.status',
        ));
    }
	
    /*
     * Función que devuelve lo items de los desplegables. 
     * Estas listas son estáticas, las dinámicas se hacen de otra forma.
     * */
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_BANNED => UserModule::t('Banned'),
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Faltan campos'),
				self::STATUS_PAGAR => UserModule::t('Pendiente pago'),
				self::STATUS_OK => UserModule::t('Activo'),
			),
			'AdminStatus' => array(/*Se cargará el combo tipos de usuarios a la hora de crear usuarios desde
									desde el menú admin*/
				'0' => UserModule::t('Comprador'),
				'1' => UserModule::t('Admin'),
				'2' => UserModule::t('Empresa'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
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
        $criteria->compare('username',$this->username,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('create_at',$this->create_at);
        $criteria->compare('lastvisit_at',$this->lastvisit_at);
        $criteria->compare('superuser',$this->superuser);
        $criteria->compare('status',$this->status);
       // $criteria->condition='superuser !='.User::ID_SUPERADMIN;
        //$criteria->with = array('empresa');
        //$criteria->condition = array('condition'=>'id > '. User::ID_SUPERADMIN . ''); /*Para que no se muestre el superuser!!!!*/

        /*$sort = new CSort;
		$sort->attributes = array(
			'person_fname' => array(
			'asc' => 'person.fname',
			'desc' => 'person.fname DESC',
		),
		'person_lname' => array(
			'asc' => 'person.lname',
			'desc' => 'person.lname DESC',
		),
		'*',
		);*/

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        	'pagination'=>array(
				'pageSize'=>Yii::app()->getModule('user')->user_page_size,
			),
			//'sort'=>$sort,
        ));
    }
    
	protected function beforeSave()
	{
	  if ($this->isNewRecord) {
	  		$this->username = $this->email;//(PILLA USERNAME!!!)
	        $this->passwordHash = sha1($this->password);
	  }
	  return parent::beforeSave(); // don't forget this line!
	}
	
	protected function afterSave()
	{
		if (($this->cambiaRole) || ($this->isNewRecord) ){
			//(G)Asignamos el rol dinámicamente consultando el campo user.status;
			$this->setRole();
			
			//$esEmpresa = UserModule::isCompany($this->id);
			$esEmpresa = Yii::app()->authManager->checkAccess('empresa', $this->id);
			if (isset($this->profile)){
				if($esEmpresa){
					//(G)Creamos profile, empresa(si es usuario empresa)
					$this->crearModelosRelacionados();
				}
			}
			
		}
		return parent::afterSave();
	}
	
	protected function beforeDelete(){
		
		if (parent::beforeDelete()){
			if ($this->guardaRegistroUsuarioBorrado($this->id) )
				return true;
		}
		return false;
		
	}
	
    
	/*Función que asigna el rol según el tipo de usuario, se ejecuta nada mas crear el usuario*/
	private function setRole(){
		
			$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
			
			if ($this->superuser == 0){
				$authorizer->authManager->revoke('empresa', $this->id);
				$authorizer->authManager->revoke('admin', $this->id);				
				$authorizer->authManager->assign('comprador', $this->id);		
			}
			elseif($this->superuser == 1){
				$authorizer->authManager->revoke('comprador', $this->id);
				$authorizer->authManager->revoke('empresa', $this->id);
				$authorizer->authManager->assign('admin', $this->id);
			}
			elseif($this->superuser == 2){
				$authorizer->authManager->revoke('comprador', $this->id);
				$authorizer->authManager->revoke('admin', $this->id);
				$authorizer->authManager->assign('empresa', $this->id);
			}
			else
				throw new CHttpException(404,'Error setting roles.');
	}
	
	/** (G)Se crean en la bd los registros profile y empresa para este usuario
	 * Al modelo profile le cargamos el tipo de cuenta que se ha selecionado.*/
	public function crearModelosRelacionados(){
		Profile::crearNuevoProfileParaElUsuario($this->id);
		Empresa::crearNuevaEmpresaParaElUsuario($this->id);
	}
	
	/*
	 * Deberíamos guardar la información del usuario borrado. 
	 * */
	private function guardaRegistroUsuarioBorrado($id){
		return true;
	}
	
	
    public function getCreatetime() {
        return strtotime($this->create_at);
    }

    public function setCreatetime($value) {
        $this->create_at=date('Y-m-d H:i:s',$value);
    }

    public function getLastvisit() {
        return strtotime($this->lastvisit_at);
    }

    public function setLastvisit($value) {
        $this->lastvisit_at=date('Y-m-d H:i:s',$value);
    }
	
	/* Estos campos no puede ser nunca inválidos */
	public static function tieneCamposMinimosRellenos($model){
		
		$return = true;
		
		if (isset($model->profile))
			$return = $this->compruebaCamposMinimosProfile($model->profile);
		
		if (isset($model->empresa))
			$return = $this->compruebaCamposMinimosEmpresa($model->empresa);
		
		return $return;
		
	}
	
	private static function compruebaCamposMinimosProfile($profile){
		if (($profile->direccion == null) || ($profile->direccion == 0) )
			$return =  "Falta el cmapo dirección";
		
		elseif (($profile->telefono == null) || (!isset($profile->telefono) || ($profile->telefono === '') ) 	)
			$return = "Falta el cmapo telefono";
		
		elseif (($profile->paypal_id == null) || (!isset($profile->paypal_id) || ($profile->paypal_id === '') ) 	){
			$return = false;
		}
	}
	
	private function compruebaCamposMinimosEmpresa($empresa){
		if (($empresa->nombre == null) || (!isset($empresa->nombre)) )
			$return =  "Falta el cmapo nombre";
		
		elseif (($empresa->cif == null) || (!isset($empresa->cif) )	)
			$return =  "Falta el cmapo cif";	
	}
	
	public static function cuentaCaducada($model){
		//Comprobar si se ha acabado el plazo.
		return false;
	}
	
	public static function compruebaSiTieneQuePagar($model){
		//Comprobar si tiene que pagar
	}
	
	/* Used to debug variables*/
    protected function Debug($var){
        $bt = debug_backtrace();
        $dump = new CVarDumper();
        $debug = '<div style="display:block;background-color:gold;border-radius:10px;border:solid 1px brown;padding:10px;z-index:10000;"><pre>';
        $debug .= '<h4>function: '.$bt[1]['function'].'() line('.$bt[0]['line'].')'.'</h4>';
        $debug .=  $dump->dumpAsString($var);
        $debug .= "</pre></div>\n";
        Yii::app()->params['debugContent'] .=$debug;
    }
    
}

//echo Yii::trace(CVarDumper::dumpAsString(Yii::app()->user),'vardump');
