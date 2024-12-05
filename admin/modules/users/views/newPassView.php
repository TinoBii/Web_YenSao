<?php
get_header();
?>

<form class="form" method="post" action="">
    <span class="title">Đặt lại mật khẩu</span>
    
    <label for="password" class="label">Password</label>
    <input type="password" id="password" name="password" class="input">
    <?php echo form_error('password')?>
    <button type="submit" class="submit"name='btn-new-pass' >Đặt lại</button>
    <?php echo form_error('account')?>
</form>
<?php
get_footer();
?>