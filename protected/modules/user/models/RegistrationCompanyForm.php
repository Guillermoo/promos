<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationCompanyForm extends User {
	public $verifyPassword;
	public $verifyCode;
	
	//(G) Hace falta declarar esta variable para que se valide el formulario ya que cuenta no pertenece a User
	public $tipocuenta;
	public $meses;
	
	public function rules() {
		$rules = array(
			array('username, password, verifyPassword, email, tipocuenta, meses', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			//En tipocuenta hay que meter los valores de los tipos de cuenta. Desde Cuenta::getCuentas se podrá hacer
			//array('tipocuenta', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED)),
			//Lo mismo con los meses
			//array('meses', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED)),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')) {
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration')));
		}
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")));
		return $rules;
	}
	
	public function attributeLabels()
	{
		return array(
			'tipocuenta' => UserModule::t("Type of account"),
			'meses' => UserModule::t("Duration of the account"),
		);
	}
	
}