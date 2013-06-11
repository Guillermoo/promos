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
					
					if(UserModule::isBuyer())
						$this->redirect('profile');
					elseif(UserModule::isCompany())
						$this->redirect('profile');//A promociones, la url habrá que cambiarla cuando se cree el modelo promociones}
					elseif(UserModule::isSuperAdmin() || UserModule::isAdmin())
						$this->redirect('admin');
					else
						$this->redirect(Yii::app()->homeUrl);
					/*if (Yii::app()->user->returnUrl=='/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);*/
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else{
			//$this->redirect(Yii::app()->controller->module->returnUrl);
			$this->redirect('profile');
		}
	}

	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}