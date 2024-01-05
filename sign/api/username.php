<?php
//跨域
header("Access-Control-Allow-Origin:*");

include_once "../utils/origin.php";
include_once "../utils/functions.php";
include_once "../utils/db.php";

/**
 * 接收用户名与密码，判断用户名与密码是否正确，如果正确给出一个结果，如果错误，给出另外一个结果
 *  username
 *  password
 *  接收方式GET，POST
 */
//1. 接收
$username = $_POST["username"];


//验证用户名与密码是否正确的sql语句
$sql = "select * from signature where username='" . $username . "'";

//从数据库中获取查询的结果集，使用mysql_query函数
$result = mysqli_query($conn, $sql);
// var_dump($result);
//从结果集中获取数据,mysql_fetch_array
// while($row=mysqli_fetch_assoc($result)){

// }
if (mysqli_num_rows($result) > 0) {


  // }

  //2.判断
  // if($username=="zhangsan" && $password=="123456"){
  //正确
  $result = [
    "code" => 0,
    "msg" => "用户名已经存在"
  ];
  //返回信息

} else {
  //错误
  $result = [
    "code" => 200,
    "msg" => "用户名不存在"
  ];
}
//返回信息
echo json_encode($result, JSON_UNESCAPED_UNICODE);