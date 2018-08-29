<!-- // 用户修改密码时候要填的表单 -->
<?php
require_once('bookmark_fns.php');
session_start();
do_html_header('修改密码');

// 创建变量
$old_passwd=$_POST['old_passwd'];
$new_passwd=$_POST['new_password'];
$new_passwd2=$_POST['new_password2'];

try{
    check_valid_user();
    if (!filled_out($_POST)) {
        throw new Exception('你还没有完整的填写表格，请再试一次');
    }
    if ($new_passwd!=$new_passwd2) {
        throw new Exception('两次输入密码不相同，请修改');
        
    }
    if ((strlen($new_passwd)>16)||(strlen($new_passwd)<6)){
        throw new Exception('新密码必须在6到16个字符之间，请重试');
        
    }

    // 更新密码
    change_password($_SESSION['valid_user'],$old_passwd,$new_passwd);
    echo '密码已修改';
}
    catch(Exception $e){
        echo $e->getMessage();
    }
    display_user_menu();
    do_html_footer();
    ?>