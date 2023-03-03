<?php
class Api extends Rest
{
    public $dbConn;
    public function __construct()
    {
        parent::__construct();
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getList()
    {
        $stmt= $this->dbConn->prepare("SELECT e.id, e.parentId,e.name AS user_name, m.name AS parent_name
        FROM user e
        LEFT JOIN user m ON e.parentId = m.id");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($users);
        if(!is_array($users)||empty($users))
        {
            $this->returnResponse(200,"data not found");   
        }else
        {
            $tree = array();
            usort($users, array($this, "sortByOrder"));   
            foreach ($users as $key => $value) {
                $id=$value['id'];
                $parentId=$value['parentId'];
                $user_name=$value['user_name'];
                $parent_name=$value['parent_name'];
                if (!isset($tree[$parentId])) {
                    $tree[$parentId] = array('name' => '', 'children' => array());
                }
                $tree[$id] = array('name' => $user_name, 'children' => array());
                $tree[$parentId]['children'][] =& $tree[$id];
            }
            $rootItems = $tree[0]['children'];
            $this->returnResponse(200,$rootItems);
        }
    }
    function sortByOrder($a, $b) {
        if ($a['parentId'] > $b['parentId']) {
            return 1;
        } elseif ($a['parentId'] < $b['parentId']) {
            return -1;
        }
        return 0;
    }


    function getParentList()
    {
        $stmt= $this->dbConn->prepare("SELECT id,name FROM user");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($users);
        if(!is_array($users))
        {
            $this->returnResponse(200,"data not found");   
        }else
        {
            $this->returnResponse(200,$users);
        }
    }

    function saveMember()
    {
        try
        {
            // print_r($this->params);exit;
            $name = $this->params['name'];
            $parentId = $this->params['parentId'];
            $sql = "INSERT INTO user (name, parentId) VALUES (:val1, :val2)";
            $stmt = $this->dbConn->prepare($sql);
            // Bind parameters to SQL statement
            $stmt->bindParam(':val1', $name);
            $stmt->bindParam(':val2', $parentId);
    
            // Execute SQL statement
            if($stmt->execute())
            {
                $this->returnResponse(200,"Saved");
            }else
            {
                $this->returnResponse(201,"Something went Wrong"); 
            }

        }catch(\Exception $e)
        {
            echo "error : ". $e->getMessage();
        }
    }
}
?>