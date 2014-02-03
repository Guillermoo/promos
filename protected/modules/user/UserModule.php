<?php
/**
 * Yii-User module
 * 
 * @author Mikhail Mangushev <mishamx@gmail.com> 
 * @link http://yii-user.2mx.org/
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @version $Id: UserModule.php 132 2011-10-30 10:45:01Z mishamx $
 */

class UserModule extends CWebModule
{
	/**
	 * @var int
	 * @desc items on page
	 */
	public $user_page_size = 10;
	
	/**
	 * @var int
	 * @desc items on page
	 */
	public $fields_page_size = 10;
	
	/**
	 * @var string
	 * @desc hash method (md5,sha1 or algo hash function http://www.php.net/manual/en/function.hash.php)
	 */
	public $hash='md5';
	
	/**
	 * @var boolean
	 * @desc use email for activation user account
	 */
	public $sendActivationMail=true;
	
	/**
	 * @var boolean
	 * @desc allow auth for is not active user
	 */
	public $loginNotActiv=false;
	
	/**
	 * @var boolean
	 * @desc activate user on registration (only $sendActivationMail = false)
	 */
	public $activeAfterRegister=false;
	
	/**
	 * @var boolean
	 * @desc login after registration (need loginNotActiv or activeAfterRegister = true)
	 */
	public $autoLogin=true;
	
	public $registrationUrl = array("/user/registrarcomprador");
	public $registrationCompanyUrl = array("/user/registrationCompany");
	public $recoveryUrl = array("/user/recovery/recovery");
	public $loginUrl = array("/user/login");
	public $logoutUrl = array("/user/logout");
	public $adminUrl = array("/user/admin");
	public $adminEmpresaUrl = array("/user/empresas");
	public $crearPromocionUrl = array("/user/promocion/create");
    public $adminPromocionesUrl = array("/user/promociones");
	public $promocionesUrl = array("/user/mispromociones");
    public $contactoUrl = array("/site/contact");
	public $contactoEmpresaUrl = array("/user/site/contact");
    public $contactoAdminUrl = array("/site/contactadmin");
	public $homeUrl = array("/user/home");//'user/home' => 'user/empresa/home',
    public $homeCompradorUrl = array("/user/profile");//Yii::app()->user->returnUrl;//'user/home' => 'user/empresa/home',
	public $homeAdminUrl = array("/user/admin/home");//'user/home' => 'user/empresa/home',
	public $profileUrl = array("/user/profile");
	public $cuentaUrl = array("/user/cuentas");
	public $empresaUrl = array("/user/empresa");
	public $bajaUrl = array("/user/baja");
	public $returnUrl = array("/user/profile");
	public $returnLogoutUrl = array("/user/login");
	public $promosStock = array("/user/promocion/promosStock");
	public $promosActivas = array("/user/promocion/promosActivas");
	public $promosDestacadas = array("/user/promocion/promosDestacadas");
	public $historialcompras = array("/user/compra/historialCompras");
	public $listaUsuarios = array("/user/admin");
	public $listaCategorias = array("/categoria");
	public $comprado = array("/user/compra/comprado");
	public $ventasUrl = array("/user/compra/");
	/**
	 * @var int
	 * @desc Remember Me Time (seconds), defalt = 2592000 (30 days)
	 */
	public $rememberMeTime = 2592000; // 30 days
	
	public $fieldsMessage = '';
	
	/**
	 * @var array
	 * @desc User model relation from other models
	 * @see http://www.yiiframework.com/doc/guide/database.arr
	 */
	public $relations = array();
	
	/**
	 * @var array
	 * @desc Profile model relation from other models
	 */
	public $profileRelations = array();
	
	/**
	 * @var boolean
	 */
	public $captcha = array('registration'=>true);
	
	/**
	 * @var boolean
	 */
	//public $cacheEnable = false;
	
	public $tableUsers = '{{users}}';
	public $tableProfiles = '{{profiles}}';
	public $tableProfileFields = '{{profiles_fields}}';

    public $defaultScope = array(
            'with'=>array('profile'),
    );
	
	static private $_user;
	static private $_users=array();
	static private $_userByName=array();
	static private $_sadmin;
        static private $_admin;
	static private $_company;
	static private $_trial;
	static private $_buyer;
	static private $_admins;
	
	/**
	 * @var array
	 * @desc Behaviors for models
	 */
	public $componentBehaviors=array();
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
		));
		
		//En cualquiera de las vistas del módulo user se cargará el theme 'admin'.
		//Yii::app()->theme = 'admin';
		//Yii::app()->theme = 'froggy';

	}
	
	public function getBehaviorsFor($componentName){
        if (isset($this->componentBehaviors[$componentName])) {
            return $this->componentBehaviors[$componentName];
        } else {
            return array();
        }
	}

	public function beforeControllerAction($controller, $action)
	{
		Yii::app()->theme = 'froggy'; //lo cargo aquí porque sino, si utlizas algún dato del módulo usuario en el frontend se carga el theme del backend

		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	/**
	 * @param $str
	 * @param $params
	 * @param $dic
	 * @return string
	 */
	public static function t($str='',$params=array(),$dic='user') {
		if (Yii::t("UserModule", $str)==$str)
		    return Yii::t("UserModule.".$dic, $str, $params);
        else
            return Yii::t("UserModule", $str, $params);
	}
	
	/**
	 * @return hash string.
	 */
	public static function encrypting($string="") {
		$hash = Yii::app()->getModule('user')->hash;
		if ($hash=="md5")
			return md5($string);
		if ($hash=="sha1")
			return sha1($string);
		else
			return hash($hash,$string);
	}
	
	/**
	 * @param $place
	 * @return boolean 
	 */
	public static function doCaptcha($place = '') {
		if(!extension_loaded('gd'))
			return false;
		if (in_array($place, Yii::app()->getModule('user')->captcha))
			return Yii::app()->getModule('user')->captcha[$place];
		return false;
	}
	
	/**
	 * Return admin status.
	 * @return boolean
	 */
	public static function isAdmin($id=null) {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if (!isset(self::$_admin)) {
				//if(self::user()->superuser)
				if ($id==null)
					$id = Yii::app()->user->id;
					
				if(Yii::app()->authManager->checkAccess('admin', $id)){
					//swdgsg;
					self::$_admin = true;
				}
				else
					self::$_admin = false;	
			}
			return self::$_admin;
		}
	}
	
	/**
	 * (G)Return company status.
	 * @return boolean
	 */
	public static function isCompany() {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if (!isset(self::$_company)) {
				/*if  (($id==null)|| (!isset($id)  )){ //|| (!isset($id)
					$id = Yii::app()->user->id;
				}*/
                
				$id = Yii::app()->user->id;
                
				//if(Yii::app()->authManager->checkAccess('empresa',Yii::app()->user->id))
				if(Yii::app()->authManager->checkAccess('empresa', $id))
                    self::$_company = true;				
				else
					self::$_company = false;	
			}
			return self::$_company;
		}
	}
	
/**
	 * (G)Return company status.
	 * @return boolean
	 */
	public static function isTrial($id=null) {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if (!isset(self::$_trial)) {
				//if(self::user()->superuser)
				if ($id==null)
					$id = Yii::app()->user->id;
				if(Yii::app()->authManager->checkAccess('trial', $id))
					self::$_trial = true;
				else
					self::$_trial = false;	
			}
			return self::$_trial;
		}
	}
	
/**
	 * (G)Return buyer status.
	 * @return boolean
	 */
	public static function isBuyer($id=null) {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if (!isset(self::$_buyer)) {
				//if(self::user()->superuser)
				if ($id==null)
					$id = Yii::app()->user->id;
					
				if(Yii::app()->authManager->checkAccess('comprador', $id))
					self::$_buyer = true;
				else
					self::$_buyer = false;	
			}
			return self::$_buyer;
		}
	}
	
/**
	 * (G)Return superadmin status.
	 * @return boolean
	 */
	public static function isSuperAdmin($id=null) {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if (!isset(self::$_sadmin)) {
				//if(self::user()->superuser)
				if ($id==null)
					$id = Yii::app()->user->id;
					
				if(Yii::app()->authManager->checkAccess('superadmin', $id))
					self::$_sadmin = true;
				else
					self::$_sadmin = false;	
			}
			return self::$_sadmin;
		}
	}

	/**
	 * Return admins.
	 * @return array syperusers names
	 */	
	public static function getAdmins() {
		if (!self::$_admins) {
			$admins = User::model()->active()->superuser()->findAll();
			$return_name = array();
			foreach ($admins as $admin)
				array_push($return_name,$admin->username);
			self::$_admins = ($return_name)?$return_name:array('');
		}
		return self::$_admins;
	}
	
    public static function to_slug($string){
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $string)));
    }
	
	/**
	 * Send mail method
	 */
	public static function sendMail($email,$subject,$message) {
    	$adminEmail = Yii::app()->params['websiteEmail'];
	    $headers = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
	    $message = wordwrap($message, 70);
	    $message = str_replace("\n.", "\n..", $message);
	    return mail($email,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
	}
	
	//(H)
	public static function enviarEmail($email,$subject,$message, $altBody){
			
			/* hugo */
			//Envío el email al usuario registrado
			$mail = new phpmailer();
			$mail->From = Yii::app()->params['websiteEmail'];			
			$mail->FromName = 'Proemocion';
			$mail->AddAddress($email);             
			$mail->subject();
			$mail->Body = $message;
			$mail->AltBody = $altBody;			
			if(!$mail->Send()) {
				Yii::app()->user->setFlash('registration',UserModule::t("El email no se ha podido enviar.."));
				Yii::app()->user->setFlash('registration',UserModule::t('Error: ' . $mail->ErrorInfo));
   				exit;
			}
		}

	public static function enviarEmailArchivoAdj($email,$subject,$message, $altBody, $archivo){
			
			/* hugo */
			//Envío el email al usuario registrado
			$mail = new phpmailer();
			$mail->From = Yii::app()->params['websiteEmail'];			
			$mail->FromName = 'Proemocion';
			$mail->AddAddress($email);             
			$mail->subject();
			$mail->Body = $message;
			$mail->AltBody = $altBody;	
			$mail->AddAttachment($archivo,'comprado.pdf');		
			if(!$mail->Send()) {
				Yii::app()->user->setFlash('registration',UserModule::t("El email no se ha podido enviar.."));
				Yii::app()->user->setFlash('registration',UserModule::t('Error: ' . $mail->ErrorInfo));
   				exit;
			}
	}
		
	/**
	 * Return safe user data.
	 * @param user id not required
	 * @return user object or false
	 */
	public static function user($id=0,$clearCache=false) {
        if (!$id&&!Yii::app()->user->isGuest)
            $id = Yii::app()->user->id;
		if ($id) {
            if (!isset(self::$_users[$id])||$clearCache)
                self::$_users[$id] = User::model()->with(array('profile'))->findbyPk($id);
			return self::$_users[$id];
        } else return false;
	}
	
	/**
	 * Return safe user data.
	 * @param user name
	 * @return user object or false
	 */
	public static function getUserByName($username) {
		if (!isset(self::$_userByName[$username])) {
			$_userByName[$username] = User::model()->findByAttributes(array('username'=>$username));
		}
		return $_userByName[$username];
	}
	
	/**
	 * Return safe user data.
	 * @param user id not required
	 * @return user object or false
	 */
	public function users() {
		return User;
	}
}
