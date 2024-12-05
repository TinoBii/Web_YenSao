<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="public/login.css">
  </head>
  <body>

    <div class="center">
        <h1>Đăng Nhập</h1>
        <form method="post">
            <div class="txt_field">
            <input name='username' class="input" type="text">
            <?php echo form_error('username')?>
            <span></span>
            <label>Username</label>
            </div>
            <div class="txt_field">
            <input name='password' class="input" type="password">
            <?php echo form_error('password')?>
            <span></span>
            <label>Password</label>
            </div>
            
            <button type="submit" class="submit" name='btn-login'>Đăng Nhập</button>
            <?php echo form_error('account')?>
           
        </form>
    </div>
    </body>
</html>