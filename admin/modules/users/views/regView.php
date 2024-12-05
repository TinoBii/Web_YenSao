<?php
get_header();
?>

<form class="form" method="post" action="">
    <span class="title">Đăng ký</span>
    <label for="fullname" class="label">fullname</label>
    <input type="text" id="fullname" name="fullname"  class="input">
    <?php echo form_error('fullname')?>
    <label for="email" class="label">Email</label>
    <input type="email" id="email" name="email"  class="input">
    <?php echo form_error('email')?>
    <label for="username" class="label">Username</label>
    <input type="text" id="username" name="username" class="input">
    <?php echo form_error('username')?>
    <label for="password" class="label">Password</label>
    <input type="password" id="password" name="password" class="input">
    <?php echo form_error('password')?>
    <button type="submit" class="submit" name='btn-reg'>Đăng ký</button>
    <!-- <button type="submit" class="submit" name='btn-reg' class="btn btn-outline-danger">Create new</button> -->
    <?php echo form_error('account')?>
</form>

<?php
get_footer();
?>

