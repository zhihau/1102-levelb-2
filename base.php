<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web02";
    protected $user="root";
    protected $pw='';
    protected $pdo;
    public $table;
    // 希望建構式裡面的程式碼盡量精簡
    public function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
        
    }

    
    public function find($id){
        $sql="SELECT * FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }
echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function all(...$arg){
        $sql="SELECT * FROM $this->table ";

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ".$arg[0])." ".$arg[1];

            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ",$arg[0]);
                }else{
                    $sql .= $arg[1];
                    
                }
            break;
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function math($method,$col,...$arg){
        $sql="SELECT $method($col) FROM $this->table ";

        switch(count($arg)){
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }

                $sql .=" WHERE ".implode(" AND ".$arg[0])." ".$arg[1];

            break;
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ",$arg[0]);
                }else{
                    $sql .= $arg[1];
                    
                }
            break;
        }


        return $this->pdo->query($sql)->fetchColumn();
    }
    public function save($array){
        if(isset($array['id'])){
            //update
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            $sql="UPDATE $this->table 
                     SET ".implode(",",$tmp)."
                   WHERE `id`='{$array['id']}'";
        }else{
            //insert

            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`) 
                                     VALUES('".implode("','",$array)."')";
        }

        return $this->pdo->exec($sql);
    }

    public function del($id){
        $sql="DELETE FROM $this->table WHERE ";

        if(is_array($id)){
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }

            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }

        return $this->pdo->exec($sql);
    }
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}
$User=new DB("user");
$News=new DB("news");
$View=new DB("view");
$Que=new DB("que");
$Log=new DB("log");

/*
* 先找到有沒有今日的瀏覽人數紀錄
*   * 有->瀏覽人次加1
*   * 沒有->增加今日的新紀錄，瀏覽人次為1
*/

if(!isset($_SESSION['view'])){
    echo "xxx";
    if($View->math('count','*',['date'=>date("Y-m-d")])>0){
        echo "aaa";
        $view=$View->find(['date'=>date("Y-m-d")]);
        $view['total']++;
        // $view['total']+=1;
        // $view['total']=$view['total']+1;
        $View->save($view);
        $_SESSION['view']=$view['total'];
    }else{
        echo "bbb";
        $View->save(['date'=>date("Y-m-d"),'total'=>1]);
        $_SESSION['view']=1;
    }
}else{
    echo "yyy";
}

?>