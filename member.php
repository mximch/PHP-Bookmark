<!-- // 用户主页面，包含该用户所有当前书签 -->
<?php

// 在这个应用中包含函数文件
require_once('bookmark_fns.php');
session_start();

// 创建变量
if (!isset($_POST['username'])) {
    //如果不存在->设置为虚拟值
    $_POST['username']=" ";
}
$username=$_POST['username'];
if (!isset($_POST['passwd'])) {
    //如果不存在->设置为虚拟值
    $_POST['passwd']=" ";
}
$passwd=$_POST['passwd'];

if ($username && $passwd) {
    //尝试登陆
    try{
        // 在user_auth_fns.php库中定义了这个函数login
        login($username,$passwd);
        //如果在数据库包含注册用户ID
        // 用户名保存到会话变量中
        $_SESSION['valid_user']=$username;
    }
    catch(Exception $e){
        // 未成功登陆
        do_html_header("遇到一些问题：");
        echo '您未能成功登录，<br> 您应该点击以下网址登录';
        do_html_url('login.php','Login');
        do_html_footer();
        exit;
    }
}

do_html_header('主页');
// user_auth_fns.php>check_valid_user()
// 检查用户是否拥有一个注册的对话 针对没有登录却处于会话中的用户
check_valid_user();
// 获取用户保存的书签
// url_fns.php>get_user_urls()
if ($url_array=get_user_urls($_SESSION['valid_user'])) {
    // output_fns.php>display_user_urls()
    // 表格的形式在浏览器中输入用户标签
    display_user_urls($url_array);
}
// 显示菜单设置
display_user_menu();
do_html_footer();
?>