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
					
					$this->lastViset();//Last time visited
					
					$id =Yii::app()->user->getId();
					$params=array('id'=>$id);
					
					/*if (Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id))
						$this->render('adminMenu');
					else
						$this->render('empresaMenu');*/
						
					if(Yii::app()->user->checkAccess('comprador',$params))
						//devuelve el usuario a la página anterior, debería mandarlo a profile?
						$this->redirect(Yii::app()->controller->module->returnUrl);
					elseif(Yii::app()->user->checkAccess('empresa',$params))
						$this->redirect('profile');//A promociones, la url habrá que cambiarla cuando se cree el modelo promociones
					elseif(Yii::app()->user->checkAccess('superadmin',$params) || Yii::app()->user->checkAccess('admin',$params))
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
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}

	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}