<?php  
//require_once '../config.php';
require_once '../config.php';
function login(){
  if(empty($_POST['email'])){
  $GLOBALS['message'] = '輸入郵箱';
  return;
 }
  if(empty($_POST['password'])){
   $GLOBALS['message'] = '輸入密碼';

  return;
 }
  $email = $_POST['email'];
  $password = $_POST['password'];
  $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  if(!$conn){
  $GLOBALS['message'] ='连接数据库失败';
  return;
} 
  $query = mysqli_query($conn, "select * from users where email = '{$email}' limit 1;");
  if(!$query){
  $GLOBALS['message'] ='登录失败';
  return;
} 
   $query_users = mysqli_fetch_assoc($query);
   if(!$query_users){
  $GLOBALS['message'] ='账号不存在';
  return;
}

   //var_dump($users);
   if($query_users['password'] !== $password){
    $GLOBALS['message'] ='账号密码不匹配';
  return;  
}


header('Location:/admin/');



  


  


}


if($_SERVER['REQUEST_METHOD'] ==='POST'){
  login();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <link rel="stylesheet" href="/static/assets/vendors/animate/animate.css">
</head>
<body>
  <div class="login">




    <form class="login-wrap <?php echo isset($message) ? ' shake animated':''?>" action='<?php echo $_SERVER['PHP_SELF']; ?>' method = 'post' autocomplete = 'off' novalidate>

      <img class="avatar" src="/static/assets/img/default.png">
      <?php if(isset($message)): ?>
      <!-- <p><?php echo $message ?></p> -->
      <div class="alert alert-danger">
         <?php echo $message; ?>
      </div>
      <?php endif ?>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong> 用户名或密码错误！
      </div> -->
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name='email' type="email" class="form-control" placeholder="邮箱" autofocus value="<?php echo empty($_POST['email']) ?  '': $_POST['email'] ;?>">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码" name='password'>
      </div>
      <button class="btn btn-primary btn-block" >登 录</button >
    </form>
  </div>
</body>
</html>
