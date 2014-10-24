<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 14-7-8
 * Time: 下午8:52
 */
class UserModel
{
    protected $_tableName = 'eo_user';

    public function __construct()
    {
        $this->_db = db::getInstance();
    }
    public function hasUser($userName)
    {
        return $this->_db->findOne($this->_tableName,'username',['username'=>$userName],'limit 1');
    }
    public function hasMail($emailAddress)
    {
        return $this->_db->findOne($this->_tableName,'mail',['mail'=>$emailAddress],'limit 1');
    }
    public function getUser($field = '*',$where,$log = null)
    {
        return $this->_db->find($this->_tableName,$field,$where,$log);
    }
    public function getUserOne($field = '*',$where,$log = null)
    {
        return $this->_db->findOne($this->_tableName,$field,$where,$log);
    }
    public function addLog($data)
    {
//        $_arr = [
//            'login'=>'登录',
//            'logout'=>'退出',
//            'register'=>'注册',
//            'getPay'=>'找回密码',
//            'changePwd'=>'修改密码'
//        ];
        return $this->_db->insert($this->_tableName.'_log',[
            'keyword' => $data['type'],
            'userId' => $data['userId'],
//            'content' => $_arr[$data['type']]
            'content' => $data['content']
        ]);
    }
    public function insertUser($data)
    {

        try {
            $this->_db->beginTransaction();
            $data['infoId'] =  $this->_db->insert($this->_tableName.'_info',[
                'nikename'=>date('YmdHis').rand(100,9999)
            ]);
            $userId = $this->_db->insert($this->_tableName,$data);
            $this->_db->commit();
            $this->addLog([
                'type' => 'register',
                'userId' => $userId,
                'content' => '注册成功'
            ]);
            return true;
        } catch (Exception $e)  {
            $this->_db->rollback();
            $this->addLog([
                'type' => 'register',
                'userId' => $userId,
                'content' => '注册失败'.$e->getFile().':'.$e->getLine().':'.$e->getCode().':'.$e->getMessage()
            ]);
        }
        return false;
    }


}