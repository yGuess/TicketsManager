<?php
    require_once('../include.php');
    $con = null;

    /*
     *  连接数据库
     */
    function connect(){
        global $con;
        $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('连接数据库失败!');
        mysqli_set_charset($con,DB_CHARSET);
        mysqli_select_db($con,DB_DBNAME);
    }

    /*
     *  insert($table,$arr)
     *  $table 插入数据的表名
     *  $arr   插入的数据,键/值对(字段/值)
     */
    function insert($table , $arr){
        global $con;
        $key = join(',',array_keys($arr));
        $value = null;
        foreach(array_values($arr) as $v){
            $value[] = "'".$v."'";
        }
        $va = join(',',$value);
        $sql = "insert into {$table}({$key}) values({$va})";
        mysqli_query($con,$sql);
        //echo mysqli_error($con);
        return mysqli_insert_id($con);
    }

    /*
     *  delete($table,$where=null)
     *  $table  插入数据的表名
     *  $where  删除语句条件,默认为Null
     */
    function delete($table,$where=null){
        global $con;
        $where = $where==null?null:"where ".$where;
        $sql = "delete from {$table} {$where}";
        mysqli_query($con,$sql);
        return mysqli_affected_rows($con);
    }

    /*
     *  update($table,$arr,$where=null)
     *  $table 插入数据的表名
     *  $arr   插入的数据,键/值对(字段/值)
     *  $where 修改语句条件,默认为Null
     */
    function update($table,$arr,$where=null){
        global $con;
        $str = $sep =null;
        foreach ($arr as $key => $val) {
            if ($str == null) {
                $sep = '';
            } else {
                $sep = ',';
            }
            $str .= $sep.$key . "='" . $val . "'";
        }
        $sql = "update {$table} set {$str} ".($where == null ? null : "where ".$where);
        //echo $sql;
        mysqli_query($con,$sql);
        //echo mysqli_error($con);
        return mysqli_affected_rows($con);
    }

    /*
     *	获取表中所有数据
	 *  $sql sql查询语句
     */
    function fetchAll($sql){
        global $con;
        $result = mysqli_query($con,$sql);
        $rows = null;
        while(@$row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $rows[] = $row;
        }
        return $rows;
    }

    /*
     *	获取表中单行数据
	 *  $sql sql查询语句
     */
    function fetchOne($sql,$result_type=MYSQLI_ASSOC){
        global $con;
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result,$result_type);
        return $row;
    }

    /*
     *	获取表中数据行数
     */
    function getResultNum($sql){
        global $con;
        $result = mysqli_query($con,$sql);
        return mysqli_num_rows($result);
    }

    /*
     *  取消数据库自动提交
	 *  $sql sql查询语句
     */
    function cancelAutoCommit(){
        global $con;
        mysqli_autocommit($con,'false');
    }

    /*
     *  设置数据库自动提交
     */
    function setAutoCommit(){
        global $con;
        mysqli_autocommit($con,'true');
    }

    /*
     *  提交数据
     */
    function commit(){
        global $con;
        mysqli_commit($con);
    }

    /*
     * 回滚并取消执行结果
     */
    function rollback(){
        global $con;
        mysqli_rollback($con);
    }