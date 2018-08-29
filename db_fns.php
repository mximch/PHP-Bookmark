<!-- // 链接数据库的函数 -->
<?php

function db_connect(){
    $result=new mysqli('localhost','bm_user','password','bookmarks');
    if (!$result) {
        throw new Exception("无法连接数据库");
    }else {
        return $result;
    }
}
?>