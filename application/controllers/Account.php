<?php 

class AccountController extends FrontendControllerModel
{

	public function mainAction()
	{

	}
    public function configurationAction()
    {

    }
    public function loginAction()
    {
        $user = new userModel;
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if (false === ($return = String::valueNotEmpty($post))) {
                $this->displayMethodMessage('Error');
                return false;
            }
            if (0 < ($userId = $user->getUserOne('id',[
                'username'=>$post['login_name'],
                'password'=>$post['login_password']
            ]))) {
                $this->displayMethodMessage('Success');
                $user->addLog(['type'=>'login','userId'=>$userId['id'],'content'=>'登录成功']);
            } else {
                $this->displayMethodMessage('Error');
            }

        }
    }
    public function registerAction()
    {

        $user = new userModel;
        if (defined('isAjax')) {
            if ($user->hasUser($this->getRequest()->getPost('username'))) {
                echo json_encode(['msg'=>$this->getMessage('ExtUser')]);
            }
            return false;
        }
        if ( $this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if (false === ($return = String::valueNotEmpty($post))) {
                $this->displayMethodMessage('Error');
                return false;
            }
            $data['level'] = 0; //用户等级
            $data['username'] = $post['signup_name'];
            $data['password'] = $post['signup_password'];
            $data['mail'] = $post['signup_email'];
            if ($user->insertUser($data)) {
                $this->displayMethodMessage('Success');
            }
        }
        unset($user);
    }
}
