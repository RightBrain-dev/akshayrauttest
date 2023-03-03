<?php
//   phpinfo();
//   exit;
class Rest
{
  
    protected $request;
    protected $serviceName;
    protected $params;
    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD']!="POST")
        {
            $this->throwError($errorCode="123","Request Method invalid");
        }
        $handler = fopen('php://input','r');
        $this->request = file_get_contents("php://input");
        
        $this->validateRequest();
    }
    public function processApi()
    {
        $api = new Api;
        $rMethod = new reflectionMethod('Api',$this->serviceName);
        if(!method_exists($api,$this->serviceName))
        {
            $this->throwError($errorCode="123","Method does not exist.");
        }
        $rMethod->invoke($api);
        
    }
    public function validateRequest()
    {
        if($_SERVER['CONTENT_TYPE']!=="application/json")
        {
            $this->throwError($errorCode="123","Invalidate request");
            exit;
        }
        $data = json_decode($this->request,true);
        if(!isset($data['name'])||empty($data['name']))
        {
            $this->throwError($errorCode="123","API name required");
            exit;
        }
        $this->serviceName = $data['name'];
        if(!isset($data['params'])||!is_array($data['params']))
        {
            $this->throwError($errorCode="123","Params Required");
            exit;
        }

        $this->params = $data['params'];
    }
    public function throwError($code,$message)
    {
        header("content-type: application/json");
        echo  json_encode(['code'=>$code,"message"=>$message]);
    }

    public function returnResponse($code,$data)
    {
        header("content-type: application/json");
        echo  json_encode(['response'=>["status"=>$code,"result"=>$data]]);
    }


}
?>