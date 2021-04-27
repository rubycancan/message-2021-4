<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$filename = 'msg.txt';
if(isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  echo '<script>alert("出现错误，不能编辑该条记录！");location.href="index.php";</script>';
}

if (file_exists($filename)) {
  $string = file_get_contents($filename);
  if (strlen($string)) {
    $msgs = unserialize($string);
    if ($id >= 0) {
      $data = $msgs[$id];
    } else {
      echo '<script>alert("该条记录不存在！");location.href="index.php";</script>';
    }
  } else {
    echo '<script>alert("数据文件里没有任何数据！");location.href="index.php";</script>';
  }
} else {
  echo '<script>alert("数据文件不存在，无法进行修改！");location.href="index.php";</script>';
}

if (isset($_POST['edit'])) {
    $name = strip_tags($_POST['name']);
    $title = strip_tags($_POST['title']);
      $time = time();
    $content = strip_tags($_POST['content']);
    $newdata = compact('name','title','time','content');
    unset($msgs[$id]);
    $msgs[$id] =  $newdata;
    ksort($msgs);
    $str = serialize($msgs);
    if(file_put_contents($filename, $str)) {
      echo '<script>alert("修改成功！");location.href="index.php";</script>';
    } else {
      echo '<script>alert("修改失败！");location.href="index.php";</script>';
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>留言板</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					留言板 <small>v1.0</small>
				</h1>
        <br/>
          <a id="back" href="index.php" class="btn btn-link">返回首页</a>
			</div>
      <hr/>
			<div class="jumbotron">
				<h2>
				</h2>
				<p>
				你可以在留言板里留下你想要告诉大家的信息哦~^_^
				</p>

			</div>

			<h3>
			编辑
			</h3>
      <hr/>

      <div class="row">
    		<div class="col-md-6">
    			<form role="form" action="#" method="post">
    				<div class="form-group">

    					<label for="name">
    						用户名
    					</label>
    					<input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name']; ?>" required>
    				</div>
    				<div class="form-group">

    					<label for="title">
    						标题
    					</label>
    					<input type="text" class="form-control" id="title" name="title" value="<?php echo  $data['title']; ?>" required>
    				</div>
    				<div class="form-group">

    					<label for="content">
    						内容
    					</label>

              <textarea  class="form-control" name="content" id="content" rows="8" cols="80" required><?php echo $data['content']; ?></textarea>

    				</div>

            <hr/>
    				<button type="submit" name="edit" class="btn btn-info">
    					编辑完成
    				</button>

    			</form>
          <br/>
    </div>
  </div>

		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <style media="screen">
      #back {
        position:relative;left:-10px
      }
    </style>
  </body>
</html>
