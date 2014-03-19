<?php

class CompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('checkoutCompra','checkoutBono'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	function actionCreate()
	{
		$model=new Compra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Compra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Compra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Compra']))
			$model->attributes=$_GET['Compra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Compra the loaded model
	 * @throws CHttpException
	 */

	public function actionCheckoutCompra(){
		// Send an empty HTTP 200 OK response to acknowledge receipt of the notification 
   		header('HTTP/1.1 200 OK');		

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		//$header = "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
		$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
		$header .= "Host: www.sandbox.paypal.com\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		//abro socket de paypal
		$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
		
		// assign posted variables to local variables	
		if(!isset($_POST['txn_id'])){
			echo "No hay txn_id";			
			Yii::app()->end();
		}else{	
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$payment_amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
			$custom = $_POST['custom'];
			$precio = $_POST['amount'];


			//cojo el id_usuario y el id_promo del campo custom
			$ids = explode('_',$custom);
			if($ids!=false && !empty($ids)){				
				$idUsuario = $ids[0];
				$idPromocion = $ids[1];
			}

			if (!$fp) {
				// HTTP ERROR								
				Yii::app()->end();
			}else{
				fputs ($fp, $header . $req);
				while (!feof($fp)) {
					$res = fgets ($fp, 1024);
					if (strcmp ($res, "VERIFIED") == 0) {		
						// check the payment_status is Complete
						if(strcmp($payment_status, "Completed")!=0){
											
						}else{
							// Comprobar que el txn_id no se ha procesado todavía
							$compra = Compra::model()->find('referencia='.$txn_id);
							if($compra){						
								return;
							}
							
							// check that payment_amount/payment_currency are correct							

							if(!empty($idUsuario) && !empty($idPromocion)){

								$promocion = Promocion::model()->find('id=:id',array(':id'=>$idPromocion));

								if($promocion->precio != $precio) {
									Yii::app()->getModule('user')->sendMail(Yii::app()->params['websiteEmail'],'Nueva compra con precio erroneo','El usuario con id '.$idUsuario.' ha comprado la promocion con id '.$idPromocion.'. Ha pagado: '.$precio.', sin embargo el precio marcado de la promoción era: '.$promocion->precio);
								}

								$this->insertarCompra($idUsuario,$idPromocion,$txn_id,$precio,$custom);
								//envío email al comprador
								Yii::app()->getModule('user')->sendMail($payer_email,'Compra en ProEmocion','Ha comprado una promoción. Para ver los detalles de la compra acceda a su panel de usuario en www.proemocion.com. Si tiene alguna duda contacte con el equipo de ProEmoción a través del correo electrónico o del teléfono.');			

								//enviar email a proemocion para informar de la compra			
								$message = "El usuario con identificador ".$idUsuario." ha comprado la promoción con identificador ".$idPromocion.", cuyo precio es ".$precio." y la referencia es ".$txn_id;
								Yii::app()->getModule('user')->sendMail(Yii::app()->params['websiteEmail'],'Nueva compra',$message);								
							}else{
								Yii::app()->getModule('user')->sendMail($payer_email,'Compra promocion no verificada','No se han podido recuperar todos los datos del comprador o de la promoción.');	
							}
						}
					}else if (strcmp ($res, "INVALID") == 0) {	
						// log for manual investigation
						
						$mail_From = "From: paypal@paypal.com";
                        $mail_To = "proemocion@proemocion.com";
                        $mail_Subject = "INVALID IPN";
                        $mail_Body = $req;
 
                        foreach ($_POST as $key => $value){
                            $emailtext .= $key . " = " .$value ."\n\n";
                        }
 
                        mail($mail_To, $mail_Subject, $emailtext . "\n\n" . $mail_Body, $mail_From);
					}
				}
				fclose ($fp);
			}		
		} 
	}

	/*public function actionCheckoutCompra2(){
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);

		$result['PAYERID'] = $payerId; 
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = 0.00;

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				//payment was completed successfully
				
				$this->render('confirm');
			}
			
		}
	}*/

	public function insertarCompra($idUsuario,$idPromocion,$referencia,$precio,$custom){			
			$model=new Compra;

			$model->id_usuario = $idUsuario;
			$model->id_promo = $idPromocion;
			$model->referencia = $referencia;
			$model->precio = $precio;
			$model->fecha_compra = date("Y-m-d H:i:s");
			$model->estado = 1;

			if($model->save()){
				//$this->render('comprado',array('compra'=>$model));
			}else{
				//$this->render('nocomprado',array('compra'=>$model));
			}
	}

	function insertarCompraPrueba(){
			$model=new Compra;

			$model->id_usuario = 7;
			$model->id_promo = 1;
			$model->referencia = "referenciaxxisu87sx";
			$model->precio = "37.50";
			$model->fecha_compra = date("Y-m-d H:i:s");
			$model->estado = 1;

			$guardado = $model->save();
			print_r($model->getErrors());
			if($guardado)
				$this->render('comprado',array('compra'=>$model));
			else
				$this->render('nocomprado',array('compra'=>$model));

	}

	public function actionCheckoutBono(){
		// Send an empty HTTP 200 OK response to acknowledge receipt of the notification 
   		header('HTTP/1.1 200 OK');


		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate		
		$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
		$header .= "Host: www.sandbox.paypal.com:443\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
		
		// assign posted variables to local variables	
		if(!isset($_POST['txn_id'])){		
			echo "No hay txn_id";
			Yii::app()->end();
		}else{	
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$payment_amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
			$custom = $_POST['custom'];
			$precio = $_POST['amount'];

			$idUsuario = 0;
			$idBono = 0;

			$mail_From    = "proemocion@proemocion.com";
	      	$mail_To      = "proemocion@proemocion.com";
	      	$mail_Subject = "Ejecutado IPN";

			//cojo el id_usuario y el id_promo del campo custom
			$ids = explode('_',$custom);
			if($ids!=false && !empty($ids)){
				$idUsuario = $ids[0];
				$idBono = $ids[1];
			}

			 mail("hugoepila@gmail.com", "Guay", "ids: ".$ids[0].$ids[1]."\n\n", "proemocion@proemocion.com");	

			if (!$fp) {
				// HTTP ERROR		
				mail("hugoepila@gmail.com", "No FP", "No se encuentra FP. app()->end()". "\n\n", "proemocion@proemocion.com");		
				Yii::app()->end();
			}else{
				 mail("hugoepila@gmail.com", "FP ok", "el FP está bien... \n\n", "proemocion@proemocion.com");
				fputs ($fp, $header . $req);
				while (!feof($fp)) {

					$res = fgets ($fp, 1024);					
					
					if (strcmp ($res, "VERIFIED") == 0) {
						$todook = true;
						
                        $mail_Subject = "VERIFIED IPN";
                        $mail_Body = $req;
 
                        foreach ($_POST as $key => $value){
                            $emailtext .= $key . " = " .$value ."\n\n";
                        }               

						// check the payment_status is Completed
						if(strcmp($payment_status, "Completed")!=0){									
						}else{
							// Comprobar que el txn_id no se ha procesado todavía
							$compra = UsersCuentas::model()->find('referencia='.$txn_id);
							if($compra){
								mail("hugoepila@gmail.com", "La compra ya existe", "salgo de la función porque la referencia ya existe \n\n", "proemocion@proemocion.com");
								return;
							}

							//Establezco la fecha de caducidad
							
							$fecha = date ( "Y-m-d H:i:s" );
							$fecha_fin = strtotime ( '+2 month' , strtotime ( $fecha ) ) ;
							$fecha_fin= date ( 'Y-m-d H:i:s' , $fecha_fin );						

							if(!empty($idUsuario) && !empty($idBono)){

								$bono = Cuenta::model()->find('id=:id',array(':id'=>$idBono));

								if(empty($bono)){
									Yii::app()->getModule('user')->sendMail($payer_email,'Bono invalido','No se han podido recuperar los datos del Bono.');
									return;
								}	

								if($bono->precio != $precio){
									 mail($mail_To, $mail_Subject,'El usuario con id: '.$idUsuario.' ha comprado el Bono con id: '.$idBono.' pero no coincide el precio que ha pagado con el que marca el Bono: Pagado -> '.$precio.', precio indicado: '.$bono->precio, $mail_From);
								}

								//guardo los datos de la compra
								$this->insertarCompraBono($idUsuario,$idBono,$txn_id,$precio,$custom,$fecha_fin);

								//actualizo los datos del usuario-empresa
								$profile = Profile::model()->find('id=:id',array(':id'=>$idUsuario));

								$profile->tipocuenta = $idBono;

								if($profile->update()){							
									//enviar email a proemocion para informar de la compra						
									Yii::app()->getModule('user')->sendMail(Yii::app()->params['websiteEmail'],'Nuevo BONO',$message);	

									//envío email al usuario-empresa que ha comprado el bono
									Yii::app()->getModule('user')->sendMail($payer_email,'Compra de Bono en ProEmoción','¡Enhorabuena!, has comprado un bono en ProEmoción. Los datos de su cuenta se han actualizado. Ya puede comenzar a publicar sus promociones y ganar dinero.');

								}else{
									 mail($mail_To, $mail_Subject,'El usuario con id: '.$idUsuario.' ha comprado el Bono con id: '.$idBono.' pero no se ha podido almacenar en la Base de Datos '.$bono->precio, $mail_From);
								}
							
							}else{
								Yii::app()->getModule('user')->sendMail($payer_email,'Compra Bono no verificada','No se han podido recuperar todos los datos del comprador o del Bono.');	
							}
												
						}					
					}else if (strcmp ($res, "INVALID") == 0) {
						// log for manual investigation		
						
						$mail_From = "From: paypal@paypal.com";
                        $mail_To = "proemocion@proemocion.com";
                        $mail_Subject = "INVALID IPN";
                        $mail_Body = $req;
 
                        foreach ($_POST as $key => $value){
                            $emailtext .= $key . " = " .$value ."\n\n";
                        }
 
                        mail($mail_To, $mail_Subject, $emailtext . "\n\n" . $mail_Body, $mail_From);
					}
				}
				fclose ($fp);								
				mail("hugoepila@gmail.com", "Se fini", "Termino el while \n\n", "proemocion@proemocion.com");	      	
			}		
		} 
	}

   	public function insertarCompraBono($idUsuario,$idBono,$referencia,$precio,$custom,$fecha_fin){			
			$model=new UsersCuentas;

			$model->id_usuario = $idUsuario;
			$model->id_cuenta = $idBono;
			$model->referencia = $referencia;
			$model->cant_pagado = $precio;
			$model->fecha_inicio = date("Y-m-d H:i:s");
			$model->fecha_fin = $fecha_fin;
			$model->estado = 1;

			if($model->save()){
				//$this->render('comprado',array('compra'=>$model));
			}else{
				//$this->render('nocomprado',array('compra'=>$model));
			}
	}

	public function loadModel($id)
	{
		$model=Compra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Compra $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
