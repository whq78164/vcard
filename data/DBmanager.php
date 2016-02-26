<?php

//namespace yii\data;
class DBManager
{
    var $dbHost = '';
    var $dbUser = '';
    var $dbPassword = '';
    var $dbSchema = '';
    var $conn;
    function __construct($host,$user,$password,$schema)
    {
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPassword = $password;
        $this->dbSchema = $schema;
    }
    public function executeFromString($sql,$delimiter = '(;\n)|((;\r\n))|(;\r)',$prefix = '',$commenter = array('#','--'))
    {
        return $this->execute($sql,$delimiter,$prefix ,$commenter);
    }
    public function executeFromFile($sqlPath,$delimiter = '(;\n)|((;\r\n))|(;\r)',$prefix = '',$commenter = array('#','--'))
    {
        //判断文件是否存在
        if(!file_exists($sqlPath))return false;
        $handle = fopen($sqlPath,'rb');
        $sqlStr = fread($handle,filesize($sqlPath));
        fclose($handle);
        return $this->execute($sqlStr,$delimiter,$prefix ,$commenter);
    }
    protected function execute($sqlStr,$delimiter = '(;\n)|((;\r\n))|(;\r)',$prefix = '',$commenter = array('#','--'))
    {
        //通过sql语法的语句分割符进行分割
        $segment = explode(";",trim($sqlStr));
        //var_dump($segment);
        ///去掉注释和多余的空行
        foreach($segment as & $statement):
            $sentence = explode("\n",$statement);
            $newStatement = array();
            foreach($sentence as $subSentence):
                if(''!= trim($subSentence)):
                    //判断是会否是注释
                    $isComment = false;
                    foreach($commenter as $comer):
                      //  if(eregi("^(".$comer.")",trim($subSentence))):
					  if(preg_match('/^\('.$comer.'\)/i',trim($subSentence))):
                            $isComment = true;
                            break;
                        endif;
                    endforeach;
                    //如果不是注释，则认为是sql语句
                    if(!$isComment)
                        $newStatement[] = $subSentence;
                endif;
            endforeach;
            $statement = $newStatement;
        endforeach;
        //对表名加前缀
        if('' != $prefix)://只有表名在第一行出现时才有效，例如 CREATE TABLE talbeName
            $regxTable = "^[\`\'\"]{0,1}[\_a-zA-Z]+[\_a-zA-Z0-9]*[\`\'\"]{0,1}$";//处理表名的正则表达式
            $regxLeftWall = "^[\`\'\"]{1}";
            $sqlFlagTree = array
            (
                "CREATE" => array("TABLE" => array("$regxTable" => 0)),
                "INSERT" => array("INTO" => array("$regxTable" => 0))
            );

            foreach($segment as & $statement):
                $tokens = split(" ",$statement[0]);
                $tableName = array();
                $this->findTableName($sqlFlagTree,$tokens,0,$tableName);
                if(empty($tableName['leftWall'])):
                    $newTableName = $prefix.$tableName['name'];
                else:
                    $newTableName = $tableName['leftWall'].$prefix.substr($tableName['name'],1);
                endif;
                $statement[0] = str_replace($tableName['name'],$newTableName,$statement[0]);
            endforeach;
        endif;
        //组合sql语句
        foreach($segment as & $statement):
            $newStmt = '';
            foreach($statement as $sentence):
                $newStmt = $newStmt.trim($sentence)."\n";
            endforeach;
            $statement = $newStmt;
        endforeach;
        self::saveByQuery($segment);
        return true;
    }
     private function saveByQuery($sqlArray)
    {
     //   $this->conn = mysql_connect($this->dbHost,$this->dbUser,$this->dbPassword);
	 $this->conn = new mysqli($this->dbHost,$this->dbUser,$this->dbPassword);
     //   mysql_select_db($this->dbSchema,$this->conn);
        $this->conn->select_db($this->dbSchema);
        foreach($sqlArray as $sql):
           // mysql_query($sql,$this->conn);
            $this->conn->query($sql);
        endforeach;
    }
    public function close()
    {
       // mysql_close($this->conn);
        $this->conn->close();
      //  mysqli_close($this->conn);
    }
    private function findTableName($sqlFlagTree,$tokens,$tokensKey=0,$tableName = array())
    {
        $regxLeftWall = "^[\`\'\"]{1}";
        if(count($tokens)<=$tokensKey)
            return false;
        if('' == trim($tokens[$tokensKey])):
            return self::findTableName($sqlFlagTree,$tokens,$tokensKey+1,$tableName);
        else:
            foreach($sqlFlagTree as $flag => $v):
            //    if(eregi($flag,$tokens[$tokensKey])):
			if(preg_match('/'.$flag.'/i',$tokens[$tokensKey])):
                    if(0==$v):
                        $tableName['name'] = $tokens[$tokensKey];
                    //    if(eregi($regxLeftWall,$tableName['name'])):
					if(preg_match('/'.$regxLeftWall.'/i',$tableName['name'])):
                            $tableName['leftWall'] = $tableName['name']{0};
                        endif;
                        return true;
                    else:
                        return self::findTableName($v,$tokens,$tokensKey+1,$tableName);
                    endif;
                endif;
            endforeach;
        endif;
        return false;
    }
}

