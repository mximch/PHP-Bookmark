<!-- // 添加新书签脚本 -->
<?php
// 包含在该应用内的函数文件
require_once('bookmark_fns.php');
session_start();

// 开始输出html
do_html_header('添加书签');

check_valid_user();
display_add_bm_form();

display_user_menu();
do_html_footer();

?>