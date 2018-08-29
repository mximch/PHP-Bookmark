<!-- // 处理新注册信息脚本 -->
<?php
// 包含此应用程序的函数文件
require_once('bookmark_fns.php');

// 创建变量
$email=$_POST['email'];
$username=$_POST['username'];
$passwd=$_POST['passwd'];
$passwd2=$_POST['passwd2'];

// 启动会话
session_start();
try{
    //检查填写的表格
    if (!filled_out($_POST)) {
        throw new Exception('您未正确填写表格,请返回重试');
    }

    //检查邮箱地址是否有效
    if (!valid_email($email)) {
        throw new Exception('这不是一个有效的邮箱地址,请返回重试');
    }

    //检查两次输入密码是否相同
    if ($passwd!=$passwd2) {
        throw new Exception('两次密码输入不匹配,请返回重试');
    }

    //检查密码长度是否符合要求
    if ((strlen($passwd)<6)||(strlen($passwd)>16)) {
        throw new Exception('您的密码必须在6到16个字符之间,请返回重试');
    }

    //开始注册
    //这个函数也可以抛出异常
    register($username,$email,$passwd);
    //将用户名注册为会话变量
    $_SESSION['valid_user']=$username;

    //提供会员页面的链接
    do_html_header('注册成功');
    echo '注册成功,开始跳转到会员页面设置您的书签';
    do_html_url('member.php','跳转至会员页面');

    //页脚
    do_html_footer();
}
catch (Exception $e){
    do_html_header('问题');
    echo $e->getMessage();
    do_html_footer();
    exit;
}