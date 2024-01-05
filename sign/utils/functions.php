<?php
//sha256加密
function sha2($text)
{
  $re = hash('sha256', $text, true);
  return bin2hex($re);
}
//文件上传
//本质上是把缓冲区中的文件移动到指定的文件夹下，php中一个函数
//文件随机名称
function randomFilename($filename)
{
  //根据.拆分$filename，文件名与文件后缀，
  $arr = explode('.', $filename);
  //boy.png,拆分后为 boy 与  png
  //在文件名的后面添加当前的时间，精确的秒+6位随机数
  //$arr[0]文件名，arr[1]文件后缀
  $time = date('Y-m-d_H_i_s');
  $arr[0] .= '_' . $time;
  //添加随机数
  $randNum = rand(100000, 999999);
  $arr[0] .= '_' . $randNum;
  //boy_2023_11-21_14_58_23_454342
  //返回合成后的新的文件名与文件后台,/boy_2023_11-21_14_58_23_454342.png
  return implode('.', $arr);
}
//检查文件类型
function checkFileExtension($filename)
{
  //检查文件类型
  $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx");
  //检查文件大小
  $arr = explode(".", $filename);
  $extention = end($arr);
  if (in_array($extention, $allowedExts)) {
    return true;
  } else {
    return false;
  }
}
//检查文件大小
function checkFileSize($fileSize)
{
  //限制文件最大为20M
  return $fileSize <= 1024 * 1024 * 20;
}
//上传文件，把文件上传到uploads文件夹下
function uploadFile($file, $path)
{
  //获取上传文件的文件名与文件大小
  $fileName = $file["name"];
  $fileSize = $file["size"];
  if (checkFileExtension($fileName) && checkFileSize($fileSize)) {
    //修改上传后的文件名
    $fileName = randomFilename($fileName);
    //把上传后的文件移动uploads文件夹下
    $from = $file["tmp_name"];
    //获取网站的根目录
    $root = $_SERVER['DOCUMENT_ROOT'];


    $to = "./uploads/" . $path;
    if (!file_exists($to)) {
      if (mkdir($to, 0777, true)) {
        echo '目录创建成功';
      } else {
        echo '无法创建目录';
      }
    }
    $to .= "/" . $fileName;
    move_uploaded_file($from, $to);
    return $to;
  } else {
    return false;
  }
}
