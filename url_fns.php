<!-- // 增加和删除书签以及推荐的函数 -->
<?php
require_once('db_fns.php');

function get_user_urls($username){
    // 从数据库中提取该用户储存的所有URL

    $conn=db_connect();
    $result=$conn->query("select bm_URL from bookmark where username='".$username."'");
    
    if (!$result) {
        return false;
    }
    // 创建一个URL数组
    $url_array=array();
    for($count=1;$row=$result->fetch_row();++$count){
        $url_array[$count]=$row[0];
    }
    return $url_array;
}

function add_bm($new_url){
    // 添加新标签到数据库
    //htmlspecialchars将字符串以html输出
    echo "尝试添加".htmlspecialchars($new_url)."<br />";

    $valid_user=$_SESSION['valid_user'];

    $conn=db_connect();

    // 检查是否为重复的标签
    $result=$conn->query("select *from bookmark where username='$valid_user' and bm_URL='".$new_url."'");
    if ($result&&($result->num_rows>0)) {
        throw new Exception('在线书签已经存在该书签');
        
    }

    // 添加新书签
    if (!$conn->query("insert into bookmark values ('".$valid_user."','".$new_url."'")) {
        throw new Exception('该书签未能成功添加');
        
    }
    return;
}

function delete_bm($user,$url){
    // 删除数据库中一个URL
    $conn=db_connect();

    // 删除书签 用户名-书签
    if (!$conn->query("delete from bookmark where username='".$user."' and bm_url='".$url."'")) {
        throw new Exception('书签无法删除');
        
    }
    return true;
}
?>