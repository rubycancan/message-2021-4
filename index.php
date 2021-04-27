<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$filename = 'msg.txt';
$msgs = [];
//检测文件是否存在
if (file_exists($filename)) {
  //读取文件的内容
  $string = file_get_contents($filename);
  if(strlen($string))  {
    $msgs = unserialize($string);
  }
}

//存储表单信息
// if (isset($_POST['sub'])) {
//     $name = $_POST['name'];
//     $title = $_POST['title'];
//     $time = time();
//     $content = $_POST['content'];
//     $data = compact('name','title','time','content');
//     array_push($msgs, $data);
//     $str = serialize($msgs);
//     if (file_put_contents($filename,$str)) {
//       echo '<script> alert("留言成功！");location.href="index.php"; </script>';
//     } else {
//       echo '<script> alert("留言失败！");location.href="index.php"; </script>';
//     }
// }
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
			</div>
      <hr/>
			<div class="jumbotron">
				<h2>
				</h2>
				<p>
				你可以在留言板里留下你想要告诉大家的信息哦~^_^
				</p>
				<!-- <p>
					<a class="btn btn-primary btn-large" href="#">查看更多</a>
				</p> -->
			</div>
      <?php if(is_array($msgs) && count($msgs) > 0): ?>
			<table class="table">
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							用户名
						</th>
						<th>
							标题
						</th>
						<th>
							时间
						</th>
            <th>
              内容
            </th>
            <th>
              操作
            </th>
					</tr>
				</thead>
        <?php $i = 1; foreach ($msgs as $k => $msg): ?>
					<tr class="table-danger">
						<td>
						<?php echo $i++; ?>
						</td>
						<td>
							<?php echo $msg['name']; ?>
						</td>
						<td>
							<?php echo $msg['title']; ?>
						</td>
						<td>
						  <?php echo date('m/d/Y H:i:s',$msg['time']); ?>
						</td>
            <td>
              <?php echo $msg['content']; ?>
            </td>
            <td>
              <a href="edit.php?id=<?php echo $k; ?>" style="color:gray">编辑</a>|<a href="javascript:del(<?php echo $k; ?>)" style="color:grey">删除</a>
            </td>
					</tr>
        <?php endforeach; ?>

				</tbody>
			</table>
    <?php endif; ?>
			<!-- <h3>
			请留言
			</h3>
      <hr/>

      <div class="row">
    		<div class="col-md-6">
    			<form role="form" action="#" method="post">
    				<div class="form-group">

    					<label for="name">
    						用户名
    					</label>
    					<input type="text" class="form-control" id="name" name="name" required>
    				</div>
    				<div class="form-group">

    					<label for="title">
    						标题
    					</label>
    					<input type="text" class="form-control" id="title" name="title" required>
    				</div>
    				<div class="form-group">

    					<label for="content">
    						内容
    					</label>
    					<!-- <input type="textarea" class="form-control" id="content" name="content" rows="10" cols="30"> -->
              <!-- <textarea  class="form-control" name="content" id="content" rows="8" cols="80" required></textarea> -->
    					<!-- <p class="help-block">
    						Example block-level help text here.
    					</p> -->
    				<!-- </div> -->
    				<!-- <div class="checkbox">

    					<label>
    						<input type="checkbox"> Check me out
    					</label>
    				</div> -->
            <!-- <hr/>
    				<button type="submit" name="sub" class="btn btn-primary">
    					发布留言
    				</button>
    			</form>
          <br/>
    </div>
  </div> -->
  <a href="add.php">
    <button  name="sub" class="btn btn-outline-secondary">
      我要留言
    </button>
  </a>

		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
      function del(id) {
        if(confirm("确定删除吗？")) {
          location.href="del.php?id="+id;
        }
      }
    </script>
  </body>
</html>
