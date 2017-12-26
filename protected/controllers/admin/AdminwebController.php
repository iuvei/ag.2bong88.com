<?php

class AdminwebController extends AdminController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

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
				'actions'=>array('index','view','create','update','admin','delete','customProfile'),
				'roles'=>array('admin'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('ResetSubPass','EditSub','AddSub','addSubAccHandle','SubAccount','customProfile','portalPage','BalanceInfo','Statistic','Announcement','ChangePassword','ChangeSecKey','ViewLog','transfer'),
				'roles'=>array('agent','admin','master','superMaster','ProSuperMaster'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('LoginOption','UpdateLoginOption'),
				'roles'=>array('admin','agent'),
			),
			array(
			
				'allow',
				'actions'=>array('editMember','getCusSetting'),
				'roles'=>array('agent','admin','master','superMaster','ProSuperMaster'),
			
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('portalPage','BalanceInfo','Statistic','Announcement','ChangePassword','ChangeSecKey','ViewLog','transfer'),
				'roles'=>array('agentSub','masterSub','superMasterSub','ProSuperMasterSub'),
			),
			/*
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('wadmin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('wadmin'),
			),*/
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
	public function actionCreate()
	{
		$model=new Admin;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Admin']))
		{
			$model->attributes=$_POST['Admin'];
			$model->password = $model->hashPassword($model->password);
			$model->parentUser = Yii::app()->user->getId();
			if($model->save())
			{
				$auth = Yii::app()->authManager;
				$auth->assign($model->role,$model->Id);
				$this->redirect(array('admin'));
			}
				
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
		$oldPass = $model->password;
		$dataOkie  = "";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Admin']))
		{
			$dataOkie  = "";
			$model->attributes=$_POST['Admin'];
			
			if($model->password !="")
			{
				$model->password = $model->hashPassword($model->password);
			}
			else
				$model->password = $oldPass;
			
			if($model->save())
					$dataOkie = "Cập nhật thành công";
					else var_dump($model->getErrors());
		}

		$this->render('update',array(
			'model'=>$model,
			'dataOkie'=>$dataOkie,
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
		$dataProvider=new CActiveDataProvider('Admin');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Admin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Admin']))
			$model->attributes=$_GET['Admin'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Admin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Admin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Admin $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionCustomProfile()
	{
		
		$this->layout = "white";
		$model=Admin::model()->findByPk(Yii::app()->user->getId());
		if($model!=null)
		{
			
			$this->render('customProfile',array(
			
				'model'=>$model,
			
			));
			
		}
		
	}
	public function actionPortalPage()
	{
		
		$this->layout = "white";
		$model=Admin::model()->findByPk(Yii::app()->user->getId());
		if($model!=null)
		{
			
			$this->render('portalPage',array(
			
				'model'=>$model,
			
			));
			
		}
		
	}
	public function actionBalanceInfo()
	{
            $this->layout = "white";
            $user_id = Yii::app()->user->getId();
            $model = Admin::model()->findByPk($user_id);

            if($model!=null)
            {
                $type = Yii::app()->user->getState("typeUser");
//                $type = str_replace("Sub","",$type);
                /**
                 * Thang thua va tong giao dich trong ngay
                 */
                $fdate = strtotime(date("m/d/Y", strtotime("today"))." 00:00:00");
                $tdate = strtotime(date("m/d/Y", strtotime("today"))." 23:59:59");
                
                $criteria = new CDbCriteria();
                if($type=="ProSuperMaster")
                {
                    $criteria->condition = "parentUser = :user AND role = :role";
                    $criteria->params = array(":user"=>$user_id,":role"=>"superMaster");
                }
                elseif($type=="superMaster")
                {
                    $criteria->condition = "parentUser = :user AND role = :role";
                    $criteria->params = array(":user"=>$user_id,":role"=>"master");
                }
                elseif($type=="master")
                {
                    $criteria->condition = "parentUser = :user AND role = :role";
                    $criteria->params = array(":user"=>$user_id,":role"=>"agent");
                }
                elseif($type=="agent")
                {
                    $criteria->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser = :userId)";
                    $criteria->params = array(":start"=>$fdate,':end'=>$tdate,':status'=>'running',":userId"=>$user_id,":status2"=>"waiting");
                }
                else
                {
                    $criteria->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2";
                    $criteria->params = array(":start"=>$fdate,':end'=>$tdate,':status'=>'running',":status2"=>"waiting");
                }
                if($type!="agent" && $type!="admin")
                {
                    $data = Admin::model()->findAll($criteria);
                }
                else
                {
                    $criteria->limit = 1000;
                    $criteria->distinct = true;
                    $criteria->select = array("username");
                    $criteria->order = "Id DESC";
                    $data = betData::model()->findAll($criteria);
                }
                
                $totalMemBerWinLost = 0;
                $TotalBPstake = 0;
                $totalEarn = 0;
                foreach($data as $user)
                {
                    $criteria2 = new CDbCriteria();
                    $criteria2->limit = 1000;
                    $criteria2->select = array("winLost","BPstake", "com");
                    $criteria2->order = "Id DESC";
                    if($type!="agent" && $type!="admin")
                    {
                        switch ($type) {
                            case "ProSuperMaster":
                                $criteria2->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser IN (SELECT Id From table_admin WHERE `role` = 'master' AND parentUser = :userId)))";
                                $criteria2->params = array(":start" => $fdate, ':end' => $tdate, ':status' => 'running', ":userId" => $user->Id, ":status2" => "waiting");
                                break;
                            case "superMaster":
                                $criteria2->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser = :userId))";
                                $criteria2->params = array(":start" => $fdate, ':end' => $tdate, ':status' => 'running', ":userId" => $user->Id, ":status2" => "waiting");
                                break;
                            case "master":
                                $criteria2->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser = :userId)";
                                $criteria2->params = array(":start" => $fdate, ':end' => $tdate, ':status' => 'running', ":userId" => $user->Id, ":status2" => "waiting");
                                break;
                            default:
                                break;
                        }
                    } else {
                        $criteria2->condition = "timeUpdate >= :start AND timeUpdate <= :end AND username = :username AND lbloddsStatus != :status AND lbloddsStatus != :status2";
                        $criteria2->params = array(":start"=>$fdate,':end'=>$tdate,':username'=>$user->username,':status'=>'running',":status2"=>"waiting");
                    }
                    $winlost = betData::model()->findAll($criteria2);
                    $dataAll = 0;
                    $totalBet = 0;
                    $userCom = 0;
                    foreach($winlost as $wl)
                    {
                        $dataAll += $wl->winLost;
                        $totalBet += $wl->BPstake;
                        if($wl->winLost!=0)
                        {
                            $userCom += $wl->com;
                        }
                    }
                    $totalMemBerWinLost += $dataAll;
                    $TotalBPstake += $totalBet;
                    $totalEarn += $dataAll + $userCom;
                }
                
                /**
                 * Thang thua va tong giao dich hom qua
                 */
                $fdate_yesterday = strtotime(date("m/d/Y", strtotime("yesterday"))." 00:00:00");
                $tdate_yesterday = strtotime(date("m/d/Y", strtotime("yesterday"))." 23:59:59");
                
                $criteria_yesterday = new CDbCriteria();
                if($type=="ProSuperMaster")
                {
                    $criteria_yesterday->condition = "parentUser = :user AND role = :role";
                    $criteria_yesterday->params = array(":user"=>$user_id,":role"=>"superMaster");
                }
                elseif($type=="superMaster")
                {
                    $criteria_yesterday->condition = "parentUser = :user AND role = :role";
                    $criteria_yesterday->params = array(":user"=>$user_id,":role"=>"master");
                }
                elseif($type=="master")
                {
                    $criteria_yesterday->condition = "parentUser = :user AND role = :role";
                    $criteria_yesterday->params = array(":user"=>$user_id,":role"=>"agent");
                }
                elseif($type=="agent")
                {
                    $criteria_yesterday->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser = :userId)";
                    $criteria_yesterday->params = array(":start"=>$fdate_yesterday,':end'=>$tdate_yesterday,':status'=>'running',":userId"=>$user_id,":status2"=>"waiting");
                }
                else
                {
                    $criteria_yesterday->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2";
                    $criteria_yesterday->params = array(":start"=>$fdate_yesterday,':end'=>$tdate_yesterday,':status'=>'running',":status2"=>"waiting");
                }
                if($type!="agent" && $type!="admin")
                {
                    $data = Admin::model()->findAll($criteria_yesterday);
                }
                else
                {
                    $criteria_yesterday->limit = 1000;
                    $criteria_yesterday->distinct = true;
                    $criteria_yesterday->select = array("username");
                    $criteria_yesterday->order = "Id DESC";
                    $data = betData::model()->findAll($criteria_yesterday);
                }
                
                $totalMemBerWinLost_yesterday = 0;
                $TotalBPstake_yesterday = 0;
                $totalEarn_yesterday = 0;
                foreach($data as $user)
                {
                    $criteria3 = new CDbCriteria();
                    $criteria3->limit = 1000;
                    $criteria3->select = array("winLost","BPstake", "com");
                    $criteria3->order = "Id DESC";
                    if($type!="agent" && $type!="admin")
                    {
                        switch ($type) {
                            case "ProSuperMaster":
                                $criteria3->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser IN (SELECT Id From table_admin WHERE `role` = 'master' AND parentUser = :userId)))";
                                $criteria3->params = array(":start" => $fdate_yesterday, ':end' => $tdate_yesterday, ':status' => 'running', ":userId" => $user->Id, ":status2" => "waiting");
                                break;
                            case "superMaster":
                                $criteria3->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser = :userId))";
                                $criteria3->params = array(":start" => $fdate_yesterday, ':end' => $tdate_yesterday, ':status' => 'running', ":userId" => $user->Id, ":status2" => "waiting");
                                break;
                            case "master":
                                $criteria3->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser = :userId)";
                                $criteria3->params = array(":start" => $fdate_yesterday, ':end' => $tdate_yesterday, ':status' => 'running', ":userId" => $user->Id, ":status2" => "waiting");
                                break;
                            default:
                                break;
                        }
                    } else {
                        $criteria3->condition = "timeUpdate >= :start AND timeUpdate <= :end AND username = :username AND lbloddsStatus != :status AND lbloddsStatus != :status2";
                        $criteria3->params = array(":start"=>$fdate_yesterday,':end'=>$tdate_yesterday,':username'=>$user->username,':status'=>'running',":status2"=>"waiting");
                    }
                    $winlost = betData::model()->findAll($criteria3);
                    $dataAll = 0;
                    $totalBet = 0;
                    $userCom = 0;
                    foreach($winlost as $wl)
                    {
                        $dataAll += $wl->winLost;
                        $totalBet += $wl->BPstake;
                        if($wl->winLost!=0)
                        {
                            $userCom += $wl->com;
                        }
                    }
                    $totalMemBerWinLost_yesterday += $dataAll;
                    $TotalBPstake_yesterday += $totalBet;
                    $totalEarn_yesterday += $dataAll + $userCom;
                }
                
                $this->render('BalanceInfo',array(	
                    'model'=>$model,
                    'todayTotalBPstake' => number_format($TotalBPstake,2),
                    'todayTotalBPstake_yesterday' => number_format($TotalBPstake_yesterday,2),
                    'todayTotalEarn' => number_format($totalEarn,2),
                    'yesterdayTotalEarn' => number_format($totalEarn_yesterday,2),
                    'todayWinlost' => number_format($totalMemBerWinLost,2),
                    'yesterdayWinlost' => number_format($totalMemBerWinLost_yesterday,2),
                ));
            }
		
	}
	public function actionStatistic()
	{
		
		$this->layout = "white";
		$model=Admin::model()->findByPk(Yii::app()->user->getId());
		if($model!=null)
		{
			
			$this->render('Statistic',array(
			
				'model'=>$model,
			
			));
			
		}
		
	}
	public function actionAnnouncement()
	{
		
		$this->layout = "white";
		$this->render("Announcement");
	}
	public function actionLoginOption()
	{
		$this->layout = "white";
		if(isset($_GET['custId']))
		{
			$id = $_GET['custId'];
			if($id!=Yii::app()->user->getId())
				return;
			$user = Admin::model()->findByPk($id);
			if($user==null)
				return;
			$this->render("loginOption",array(
			
				'user'=>$user,
			
			));
		}
		
	}
	public function actionUpdateLoginOption()
	{
		$data =  file_get_contents('php://input');
		$data = str_replace("'",'"',$data);
		$data = json_decode($data);
		$id = Yii::app()->user->getId();
		$user = Admin::model()->findByPk($id);
		$errorCode = 0;
		$message = "";
		if($user==null)
		{
			$errorCode = 1;
			$message = "User not exist!!!";
		}
		if($user->nickname!="")
		{
			$errorCode = 3;
			$message = "Bạn không thể thay đổi nickname nhiều lần!";
		}
		if($errorCode==0)
		{
			$user->nickname = $data->nickname;
			if($user->save())
			{
				$errorCode = 0;
				$message = "Thay đổi thành công!";
			}
			else
			{
				$errorCode = 2;
				$message = "Thay đổi không thành công!!!";
			}
		}
		$data = array(
		
			'ErrorCode'=>$errorCode,
			'ErrorMessage'=>$message,
		
		);
		echo  json_encode($data);
	}
	public function actionChangePassword()
	{
		if(isset($_POST['txtNewPwd']))
		{
			$message = "";
			$code = 0;
			$txtNewPwd = $_POST['txtNewPwd'];
			$txtConfirmPwd = $_POST['txtConfirmPwd'];
			$txtOldPwd = $_POST['txtOldPwd'];
			if($txtOldPwd==$txtNewPwd)
			{
				$message = "mật khẩu phải khác với mật khẩu hiện tại";
			}
			if($txtNewPwd!=$txtConfirmPwd)
			{
				$message = "Mật khẩu xác nhận không trùng với mật khẩu mới!";
				$code = 1;
			}
			$user = Admin::model()->findByPk(Yii::app()->user->getId());
			if($user==null)
			{
				$message = "Người dùng không tồn tại!";
				$code = 2;
			}
			if(!$user->validatePassword($txtOldPwd))
			{
				$message =  "Mật khẩu hiện tại không đúng";
				$code = 3;
			}
			if($message=="")
			{
				$user->password = $user->hashPassword($txtNewPwd);
				$user->save();
				$message = "Thay đổi thành công!!!";
				$code = 0;
			}
			
			$data = array(
			
				'errCode'=>$code,
				'errMsg'=>$message,
			
			);
			header("Content-Type:text/plain");
			echo str_replace("\"","'",json_encode($data));
		}
		else
		{
			$this->layout = "white";
			$this->render("changePass");
		}
	}
	
	public function actionChangeSecKey()
	{
		
		if(isset($_POST['txtSecCode']))
		{
			$message = "";
			$code = 0;
			$txtSecCode = $_POST['txtSecCode'];
			$txtConfirmSecCode = $_POST['txtConfirmSecCode'];
			$inputSecCode = $_POST['inputSecCode'];
			if($inputSecCode==$txtSecCode)
			{
				$message = "Mã bảo mật phải khác với mật khẩu hiện tại";
			}
			if($txtSecCode!=$txtConfirmSecCode)
			{
				$message = "Mã bảo mật xác nhận không trùng với mật khẩu mới!";
				$code = 1;
			}
			$user = Admin::model()->findByPk(Yii::app()->user->getId());
			if($user==null)
			{
				$message = "Người dùng không tồn tại!";
				$code = 2;
			}
			if($user->hashPassword($inputSecCode)!=$user->secKey)
			{
				$message =  "Mã bảo mật hiện tại không đúng";
				$code = 3;
			}
			if($message=="")
			{
				$user->password = $user->hashPassword($txtSecCode);
				$user->save();
				$message = "Thay đổi thành công!!!";
				$code = 0;
			}
			
			$data = array(
			
				'errCode'=>$code,
				'errMsg'=>$message,
			
			);
			header("Content-Type:text/plain");
			echo str_replace("\"","'",json_encode($data));
		}
		else
		{
			$this->layout = "white";
			$this->render("changeSecKey");
		}
	}
	
	public function actionViewLog()
	{
		$this->layout = "white";
		$this->render("viewLog");
	}
	public function actionTransfer()
	{
		$this->layout = "white";
		$this->render("transfer");
	}
	public function actiongetCusSetting()
	{
		$this->layout = "white";
		if(isset($_GET['id']) && isset($_GET['type']))
		{
			$id = $_GET['id'];
			$type = $_GET['type'];
			if($id==0)
			{
				if($type=="user")
					$user = new User;
				else
					$user = new Admin;
				$admin = Admin::model()->findByPk(Yii::app()->user->getId());
				$this->render("cusSettingNew",array(
					
					'user'=>$user,
					'admin'=>$admin,
					
				));
			}
			else
			{
				if($type=="user")
					$user = User::model()->findByPk($id);
				else
					$user = Admin::model()->findByPk($id);
				if($user!=null)
				{
					if(Yii::app()->user->getState("typeUser")=="agent" && $user->parentUser!=Yii::app()->user->getId() && $type="user")
						return;
					if($user->parentUser!=Yii::app()->user->getId())
						return;
					$admin = Admin::model()->findByPk(Yii::app()->user->getId());
					$this->render("cusSetting",array(
						
						'user'=>$user,
						'admin'=>$admin,
						
					));
				}
			}
		}
	}
	public function actioneditMember()
	{
		if(isset($_GET['custid'])&& isset($_GET['USER']))
		{
			$this->layout = "white";
			$custId = $_GET['custid'];
			$custUser = $_GET['USER'];
			$this->render("editMember",array(
				
				'custId'=>$custId,
				'custUser'=>$custUser,
				
			));
		}
	}
	public function actionSubAccount()
	{
		$this->layout = "white";
		
		$admin = Admin::model()->findAllByAttributes(array(
		
			'role'=>Yii::app()->user->getState('typeUser')."Sub",
			'level'=>2,
			'parentUser'=>Yii::app()->user->getId(),
			
		
		));
		$this->render('subAccount',array(
			
			'listSub'=>$admin,
		
		));
	}
	public function actionaddSubAccHandle()
	{
		if(isset($_POST['number1']) && isset($_POST['number2']) && isset($_POST['txtPwd']))
		{
			$number1 = (int)$_POST['number1'];
			$number2 = (int)$_POST['number2'];
			$txtPwd = $_POST['txtPwd'];
			$id = Yii::app()->user->getId();
			$admin = Admin::model()->findByPk($id);
			if($admin!=null)
			{
				$username = $admin->Username."Sub".$number1.$number2;
				$sub = new Admin;
				$sub->Username = $username;
				$sub->role = $admin->role."Sub";
				$sub->key = "thaihoc";
				$sub->password = $sub->hashPassword($txtPwd);
				$sub->level = 2;
				$sub->parentUser = $admin->Id;
				if($sub->save())
				{
					$auth = Yii::app()->authManager;
					$auth->assign($sub->role,$sub->Id);
					$data = array(
			
						'errCode'=>0,
						'errMsg'=>'',
					
					);
					header("Content-Type:text/plain");
					echo str_replace("\"","'",json_encode($data));
				}
				else
				{
					$message = "";
					foreach($sub->getErrors() as $errors)
					{
						foreach($errors as $error)
						{
							$message .= $error;
						}
					}
					$data = array(
			
						'errCode'=>102,
						'errMsg'=>$message,
					
					);
					header("Content-Type:text/plain");
					echo str_replace("\"","'",json_encode($data));
				}
			}
		}
	}
	public function actionAddSub()
	{
		$this->layout = "white";
		
		$id = Yii::app()->user->getId();
		$admin = Admin::model()->findByPk($id);
		if($admin!=null)
		{
			$this->render("_formEditSub",array(
			
				'admin'=>$admin,
			
			));
		}
	}
	public function actionEditSub()
	{
		if(isset($_POST['SubAccId']))
		{
			$SubAccId = $_POST['SubAccId'];
			$chkStatus = $_POST['chkStatus'];
			$sub = Admin::model()->findByPk($SubAccId);
			if($sub!=null)
			{
				if($sub->parentUser==Yii::app()->user->getId() && $sub->role = Yii::app()->user->getState("typeUser")."Sub")
				{
					if($chkStatus=="true")
					{
						$sub->status = 2;
						$sub->save();
						
						
					}
					else
					{
						$sub->status = 1;
						$sub->save();
					}
					$data = array(
			
						'errCode'=>0,
						'errMsg'=>"",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
				}
				else
				{
					$data = array(
			
						'errCode'=>102,
						'errMsg'=>"Truy câp trái phép",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
				}
			}
			else
			{
				$data = array(
			
						'errCode'=>102,
						'errMsg'=>"Truy câp trái phép",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
			}
		}
		
		else
		{
			$this->layout = "white";
			$username = isset($_GET['User'])?$_GET['User']:"";
			$subId = isset($_GET['SubAccId'])?$_GET['SubAccId']:"";
			$sub = Admin::model()->findByPk($subId);
			if($sub!=null)
			{
				$this->render("_EditSub",array(
					
						'username'=>$username,
						'subId'=>$subId,
						'sub'=>$sub,
					
					));
			}
		}
	}
	
	public function actionResetSubPass()
	{
		
		if(isset($_POST['SubAccId']))
		{
			$SubAccId = $_POST['SubAccId'];
			
			$sub = Admin::model()->findByPk($SubAccId);
			if($sub!=null)
			{
				if($sub->parentUser==Yii::app()->user->getId() && $sub->role = Yii::app()->user->getState("typeUser")."Sub")
				{
					$newPass = $_POST['txtNewPwd'];
					$confirm = $_POST['txtConfirmPwd'];
					if($newPass==$confirm)
					{
						$sub->password = $sub->hashPassword($newPass);
						$sub->save();
						$data = array(
			
						'errCode'=>0,
						'errMsg'=>"Đổi mật khẩu thành công!",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
					}
					else
					{
						$data = array(
			
						'errCode'=>102,
						'errMsg'=>"Mật khẩu xác nhận và mật khẩu mới không trùng nhau",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
					}
					
				}
				else
				{
					$data = array(
			
						'errCode'=>102,
						'errMsg'=>"Truy câp trái phép",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
				}
			}
			else
			{
				$data = array(
			
						'errCode'=>102,
						'errMsg'=>"Truy câp trái phép",
						
						);
						header("Content-Type:text/plain");
						echo str_replace("\"","'",json_encode($data));
			}
		}
		else
		{
			$this->layout = "white";
			$username = isset($_GET['User'])?$_GET['User']:"";
			$subId = isset($_GET['SubAccId'])?$_GET['SubAccId']:"";
			$sub = Admin::model()->findByPk($subId);
			if($sub!=null)
			{
				$this->render("_subPass",array(
					
						'username'=>$username,
						'subId'=>$subId,
						'sub'=>$sub,
					
					));
			}
		}
	}
	
}
