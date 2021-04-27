<?php
header('content-type:text/html;charset=utf-8');
$filename = 'msg.txt';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  echo '<script>alert("出现错误，不能删除该条记录！");location.href="index.php";</script>';
}

if(file_exists($filename)) {
  $string = file_get_contents($filename);
  if(strlen($string)) {
      $msgs = unserialize($string);
      unset($msgs[$id]);
      $str  = serialize($msgs);
      if(file_put_contents($filename, $str)) {
        echo '<script>alert("删除成功!");location.href="index.php";</script>';
      } else {
        echo '<script>alert("删除失败！");location.href="index.php";</script>';
      }
  } else {
      echo '<script>alert("出错，找不到数据文件里的数据！");location.href="index.php";</script>';
  }
} else {
  echo '<script>alert("数据文件不存在，无法进行删除！");location.href="index.php";</script>';
}
 ?>
