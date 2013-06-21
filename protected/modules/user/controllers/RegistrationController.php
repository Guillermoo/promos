<?php
class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	
	public function validaEmail($username,$soucePassword){
		
		if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
				$identity=new UserIdentity($username,$soucePassword);
				$identity->authenticate();
				Yii::app()->user->login($identity,0);
				$this->redirect(Yii::app()->controller->module->returnUrl);
		} else {
			if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
				return Yii::app()->user->setFlash('info',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
			} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
				return Yii::app()->user->setFlash('info',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
			} elseif(Yii::app()->controller->module->loginNotActiv) {
				return Yii::app()->user->setFlash('info',UserModule::t("Thank you for your registration. Please check your email or login."));
			} else {
				return Yii::app()->user->setFlash('info',UserModule::t("Thank you for your registration. Please check your email."));
			}
			//$this->refresh();
		}
	}
	
	public function enviaEmailValidacion($email,$activkey){

		if (Yii::app()->controller->module->sendActivationMail) {
			$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $activkey, "email" => $email));
			UserModule::sendMail($email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
			
			//UserModule::enviarEmail($model->email,UserModule::t("You registered from {site_name}"),UserModule::t("Uohhh! gracias por registrarte!!<b>ko!</b>, {activation_url}"),UserModule::t('Uohhh! gracias por registrarte!!, {activation_url}'));
			//$this->enviarEmail($model->email);
		}
	}
	
	protected function completaCampos($model,$tipoUser,$status){
		
		$soucePassword = $model->password;
		$model->username = $model->email;//(PILLA USERNAME!!!)
		$model->activkey=UserModule::encrypting(microtime().$model->password);
		$model->password=UserModule::encrypting($model->password);
		$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
		$model->superuser=$tipoUser;
		$model->status= $status; //Al registrarse siempre va a tener este estado, sea trial o no.
		return $model;
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
	
	/**
	 * Registration user
	 */
	/*
	 * public function actionRegistration() {
            $model = new RegistrationForm;
            
            //La página de registro tiene que cargarse con el theme classic
            Yii::app()->theme = 'classic';
            
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model));
				Yii::app()->end();
			}
			
		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					//$profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
					if($model->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->superuser=User::ID_COMPRADOR; //Then role = comprador;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
						if ($model->save()) {

							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
								UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}
							
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
								}
								$this->refresh();
							}
						}
					}// else $profile->validate();
				}
			    $this->render('/user/registration',array('model'=>$model));
		    }
	}*/
	
}