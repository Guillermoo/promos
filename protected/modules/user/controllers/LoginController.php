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
					/*if(UserModule::isCompany() || UserModule::isTrial()){
						$this->realizaComprobacionesMantenimiento();
					}*/
					$this->redirigeSegunTipoUsuario();
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else{
			$this->redirect(Yii::app()->getModule('user')->homeUrl);
		}
	}
	
	private function realizaComprobacionesMantenimiento(){
		
		$model = $this->loadModel();
			
		//COMPROBACIONES AL LOGEARSE. DEBERÍA COMPROBAR COSAS TAMBIÉN CUANDO ES = 2 
		if ( ($model->status == 3) ){
			if (User::cuentaCaducada($model) ){//Si devuelve true hay que cambiar
				$model->status = 2;
			};
			if (User::tieneCamposMinimosRellenos($model) != true ){//Si devuelve true hay que cambiar
				$model->status = 1;
			};
			if ($model->status != 3)
				$model->save(false);
		}
	}
	
	private function redirigeSegunTipoUsuario(){
		
		if(UserModule::isCompany() || UserModule::isTrial()){//Para el dashboard.
			//En función del estado en el que está se mostrará en el menú
			//algún tipo de advertencia.
			$this->redirect(Yii::app()->getModule('user')->homeUrl);
		}
		
		elseif(UserModule::isBuyer())//Por si estabamirando una promoción
			$this->redirect(Yii::app()->user->returnUrl);
			
		elseif(UserModule::isSuperAdmin() || UserModule::isAdmin())
			$this->redirect('admin');
		else
			$this->redirect(Yii::app()->homeUrl);//A la home pero de la parte pública
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel()
	{
		$model=User::model()->findByPk(Yii::app()->user->id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
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

}