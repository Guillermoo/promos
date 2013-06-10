<?php

class User extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANNED=-1;
	const ID_SUPERADMIN=1;
	const ID_COMPRADOR=0;
	const ID_ADMIN=1;
	const ID_EMPRESA=2;
	
	
	//TODO: Delete for next version (backward compatibility)
	const STATUS_BANED=-1;
	
	public $regMode = false;
	
	private $_modelReg;
	private $_model;
	
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
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED)),
			array('superuser', 'in', 'range'=>array(self::ID_COMPRADOR,self::ID_ADMIN,self::ID_EMPRESA)),
            array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('username, email, superuser, status', 'required'),
			array('superuser, status', 'numerical', 'integerOnly'=>true),
			array('id, username, password, email, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
		):((Yii::app()->user->id==$this->id)?array(
			array('username, email', 'required'),
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
            //$relations['contacto'] = array(self::HAS_ONE, 'Contacto', 'user_id');
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
            'MuestraEnIndex'=>array(
                'condition'=>'id!='.self::ID_SUPERADMIN,
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
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, create_at, lastvisit_at, superuser, status',
            ),
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
     * */
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Active'),
				self::STATUS_BANNED => UserModule::t('Banned'),
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
        $criteria->compare('password',$this->password);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('activkey',$this->activkey);
        $criteria->compare('create_at',$this->create_at);
        $criteria->compare('lastvisit_at',$this->lastvisit_at);
        $criteria->compare('superuser',$this->superuser);
        $criteria->compare('status',$this->status);
        //$criteria->condition = array('condition'=>'id > '. User::ID_SUPERADMIN . ''); /*Para que no se muestre el superuser!!!!*/

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        	'pagination'=>array(
				'pageSize'=>Yii::app()->getModule('user')->user_page_size,
			),
        ));
    }
    
	protected function beforeSave()
	{
	  if ($this->isNewRecord) {
	        $this->passwordHash = sha1($this->password);
	  }
	  return parent::beforeSave(); // don't forget this line!
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
    
    /*(G) Función para obtener los campos. 
     * Si queremos que se muestren unos campos u otros en función de quien los llama,
     * este es el momento. */
	/*public static function getFields() {
		$this->_model=Profile::model()->paraTodos()->findAll();
		
		return $this->_model;
		/*if ($this->regMode) {
			if (!$this->_modelReg)
				$this->_modelReg=Profile::model()->paraTodos()->findAll();
			return $this->_modelReg;
		} else {
			if (!$this->_model)
				$this->_model=Profile::model()->paraCommprador()->findAll();
			return $this->_model;
		}
	}*/
    
	/*Función que asigna el rol según el tipo de usuario, se ejecuta nada mas crear el usuario*/
	public function setRole(){
			$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
			
			if ($this->superuser == 0)
				$authorizer->authManager->assign('comprador', $this->id);			
			elseif($this->superuser == 1)
				$authorizer->authManager->assign('admin', $this->id);
			else //=2
				$authorizer->authManager->assign('empresa', $this->id);
	}
	
	/*Función que asigna el rol según el tipo de usuario, se ejecuta nada mas crear el usuario*/
	public function crearModelosRelacionados(){

		if ($this->superuser == 2){//Es un usuario-empresa
			$this->crearNuevoProfileParaElUsuario();
			$this->crearNuevaEmpresaParaElUsuario();
			//$this->crearNuevoContactoParaElUsuario();
		}
	}
	
	private function crearNuevoProfileParaElUsuario(){
		
		$profile=new Profile;
		/*(G)Creamos el perfil con el id del nuevo usuario. Al ser creado desde el admin sólo hay
		que crear el usuario, no los datos del perfil o contacto, eso ya lo hará el usuario(o el admin desde update.*/
		$profile->user_id=$this->id;
		//$profile->contacto_id = $contacto_id;
		$profile->save();
		$this->debug($profile->getErrors());
	}
	
	private function crearNuevaEmpresaParaElUsuario(){
		
		$empresa= new Empresa;
		$empresa->user_id = $this->id;
		$empresa->cuenta_id = 1;//Habría que pasarle la variable con el valor que ha elegido el admin
		$empresa->save();
		
	}
	
	/*private function crearNuevoContactoParaElUsuario(){
		
		$contacto = new Contacto;
		$contacto->user_id = $this->id;
		$contacto->save();
		
		/*$profile->tipocuenta=; (G)FALTA ASIGNAR VALORES AUTOMÁTICOS
		$profile->fecha_creacion=;
			
	}*/
	
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
