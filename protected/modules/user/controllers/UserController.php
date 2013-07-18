<?php

class UserController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	public $layout = 'user_column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
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
                            'actions'=>array('index','view'),
                            'users'=>UserModule::getAdmins(),
			),
                        array('allow',
                            'actions'=>array('contacto'),
                            'users'=>array('@'),
                        ),
			array('deny',  // deny all users
                            'users'=>array('*'),
			),
		);
	}	
	
	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->_model = $this->loadModel();
		$this->render('view',array(
			'model'=>$this->_model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANNED. ' AND id!='.User::ID_SUPERADMIN,
		    ),
				
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
/**
	 * Displays the contact page
	 */
	public function actionContacto()
	{
            //Se hacen dos action para manejar el contacto, actionContactoAdmin, actionContactoEmrpesa
            if (UserModule::isAdmin()){
                $model=new ContactAdminForm;
            }elseif(UserModule::isCompany()){
                $model=new ContactEmpresaForm;
            }
		
            if(isset($_POST['ContactForm']))
            {
                    $model->attributes=$_POST['ContactForm'];
                    if($model->validate())
                    {
                            $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                            $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                            $headers="From: $name <{$model->email}>\r\n".
                                    "Reply-To: {$model->email}\r\n".
                                    "MIME-Version: 1.0\r\n".
                                    "Content-type: text/plain; charset=UTF-8";

                            mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                            Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                            $this->refresh();
                    }
            }
            $this->render('contact',array('model'=>$model));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */

	public function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=User::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
