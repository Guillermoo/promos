<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();//Para que se actualize la última vez visitado
					$this->redirigeSegunTipoUsuario();
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else{
			$this->redirect(Yii::app()->getModule('user')->homeUrl);
		}
	}
	
	private function redirigeSegunTipoUsuario(){
		
		if(UserModule::isBuyer() || UserModule::isCompany()){
			if(UserModule::isCompany()){
				$this->compruebaEstados();
				//En función del estado en el que está se mostrará en el menú
				//algún tipo de advertencia.
			}	
			$this->redirect(Yii::app()->getModule('user')->homeUrl);
		/*elseif(UserModule::isCompany())
			$this->redirect(Yii::app()->getModule('user')->homeUrl);*///A promociones, la url habrá que cambiarla cuando se cree el modelo promociones}
		}
		elseif(UserModule::isSuperAdmin() || UserModule::isAdmin())
			$this->redirect('admin');
		else
			$this->redirect(Yii::app()->homeUrl);
	}
	
	private function compruebaEstados(){
		//Comprobar si se ha acabado el plazo y pasar la cuenta a status=2. 
		//Comprobar si le faltan campos por rellenar.
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}