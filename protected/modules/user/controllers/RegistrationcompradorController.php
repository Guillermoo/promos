<?php
Yii::import('user.controllers.RegistrationController');
class RegistrationcompradorController extends RegistrationController
{

	/**
	 * Registration user
	 */
	public function actionRegistration() {

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
					if($model->validate())
					{
						$this->completaCampos();
						
						if ($model->save()) {

							$this->enviaEmailValidacion($model);
							
							$this->validaEmail($model->username,$soucePassword);
						}
					} else echo $model->validate();
				}
			    $this->render('/user/registration',array('model'=>$model));
		    }
	}
	
	
}