<!-- // 从用户书签列表中删除选定书签的脚本 -->
<?php
require_once('bookmark_fns.php');
session_start();

// 创建变量
$del_me=$_SESSION['del_me'];
$valid_user=$_SESSION['valid_users'];

do_html_header('删除书签');
check_valid_user();

if (!(filled_out($_POST))) {
    echo '<p>您未选中任何将要删除的书签,<br>请重试</p>';
    display_user_menu();
    do_html_footer();
    exit;
}else{
    if (count($del_me)>0) {
        foreach($del_me as $url){
            if (delete_bm($valid_user,$url)) {
                echo '删除'.htmlspecialchars($url).'<br>';
            }else{
                echo '无法删除'.htmlspecialchars($url).'<br>';
            }
        }
    }else{
        echo '没有选择书签删除';
    }    
}

// 获取用户保存的书签
if ($url_array=get_user_urls($valid_user)) {
    display_user_urls($url_array);
}

display_user_menu();
do_html_footer();

?>