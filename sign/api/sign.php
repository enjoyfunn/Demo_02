<?php
include_once "../utils/origin.php";
include_once "../utils/functions.php";
include_once "../utils/db.php";

//判断action是否存在
if(isset($_POST['action'])){
    //保存
    if($_POST['action'] =='save'){
        //获取用户id,path
        $userid=$_POST["userid"];
       // $path=$_POST["sign"];
       $signData=$_POST["signData"];
        echo saveSign($conn,$userid,$signData);
    }
    //上传图片
    if($_POST['action'] =='upload'){
        //获取用户id,path
        $file=$_FILES["sign"];
        echo uploadSign($file,"sign");
    }
    
}

if(isset($_GET['action'])){
    //保存
    if($_GET['action'] =='query'){
       
        echo getAllSigns($conn);
    }
   //按用户查询
   if($_GET['action'] =='queryuser'){
       $userid=$_GET['userid'];
    echo getSignsByUserid($conn);
} 
}
//1.保存签名
function save($con,$userid,$path){
    //1.编写sql语句
    $sql="insert into tbl_sign(userid,path) values(?,?)";
    //2.创建预处理语句
    $stmt=mysqli_prepare($con,$sql);
    //3.对占位符进行赋值
    mysqli_stmt_bind_param($stmt,"is",$userid,$path);
    //4.执行查询
    $result=$stmt->execute();
    $ajaxReturn=[];
    if($result){
        $ajaxReturn=[
            "code"=>"200",
            "msg"=>"数据保存成功"
        ];
    }else{
        $ajaxReturn=[
            "code"=>"0",
            "msg"=>"数据保存失败"
        ];
    }
    return json_encode($ajaxReturn,JSON_UNESCAPED_UNICODE);
}

//上传文件
/**
 * $file 上传的文件
 * $path 上传文件的相对路径(./uploads/)
 */
function uploadSign($file,$path)
{
    return uploadFile($file,$path);
}

function saveSign($con,$userid,$signData)
{
   // $path =uploadSign($sign,"sign");
   $path=saveSignImage($signData);
    return save($con,$userid,$path);
}

function saveSignImage($imgData)
{
$image = preg_replace('/^(data:\s*image\/\w+;base64)/', '', $imgData);
//2，解码base64
$image = base64_decode($image);
//3，获取图片类型
preg_match('/^(data:\s*image\/(\w+);base64,)/', $imgData, $result);
$type= $result[2];
//4.获取网站根目录
$root =$_SERVER['DOCUMENT_ROOT'];
//5.创建随机文件名
$relativePath = "/uploads/sign/" ."sign_".date('Y_m_d_His')."_".rand(100000, 999999) .".". $type;
$absolutePath = $root.$relativePath;
//6.保存文件
file_put_contents($absolutePath, $image);
//7.返回相对路径
return $relativePath;


}

function getAllSigns($conn)
{
    $sql="select s.id,username,u.id AS userid,s.created,s.path FROM tbl_user u,tbl_sign s WHERE u.id=s.userid";
    $result=mysqli_query($conn,$sql);
    $data=[];
    while($row=mysqli_fetch_assoc($result)){
        $data[]=["id"=>$row["id"],"userid"=>$row["userid"],"username"=>$row["username"],"path"=>$row["path"],"created"=>$row["created"]];
    }
    return json_encode(["code"=>200,"msg"=>"查询成功","data"=>$data]);
}

function getSignsByUserid($conn)
{
    $sql="select s.id,u.username,u.id AS userid,s.created,s.path FROM tbl_user u,tbl_sign s WHERE u.id=s.userid";
    $result=mysqli_query($conn,$sql);
    $data=[];
    while($row=mysqli_fetch_assoc($result)){
        $data[]=["id"=>$row["id"],"userid"=>$row["userid"],"username"=>$row["username"],"path"=>$row["path"],"created"=>$row["created"]];
    }
    return json_encode(["code"=>200,"msg"=>"查询成功","data"=>$data]);
}