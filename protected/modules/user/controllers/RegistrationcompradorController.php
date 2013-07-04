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
					if($model->validate()){
						$model = $this->completaCampos($model,User::ID_COMPRADOR,User::STATUS_NOACTIVE);
						//Start a transaction in case something goes wrong
				        $transaction = Yii::app( )->db->beginTransaction( );
				        try {
				            //Save the model to the database
					       	$model->save();
							$this->enviaEmailValidacion($model->email,$model->activkey);
							
							$this->validaEmail($model->username,$model->password);
			                
							$transaction->commit();
							
							//$this->refresh();
				        } catch(CDbException $e) {
				            //Yii::app( )->handleException( $e );
				            if(!isset($_GET['ajax']))
						        Yii::app()->user->setFlash('error','Normal - error message');
						        
				            $transaction->rollback( );
				        }
						
					} else $model->validate();
				}
			    $this->render('/user/registration',array('model'=>$model));
		    }
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