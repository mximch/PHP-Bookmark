<!-- // 应用包含文件集合 -->
<?php
    //我们可以在所有文件中包含此文件
    //这样，每个文件都将包含我们所有的函数和异常
    require_once('data_valid_fns.php');
    require_once("db_fns.php");
    require_once('user_auth_fns.php');
    require_once('output_fns.php');
    require_once('url_fns.php');
?>