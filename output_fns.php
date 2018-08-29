<!-- // 以HTML形式格式化输出的函数 -->
<?php
    function do_html_header($title){
    // 输出页眉
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <style>
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #3333cc;}
      a { color: #000 }
      div.formblock
         { background: #ccc; width: 300px; padding: 6px; border: 1px solid #000;}
    </style>
</head>
<body>
<div>
    <img  src="bookmark.png" alt="PHPbookmark logo" height="55" width="57" style="float:left; padding_right:6px;"/>

    <h1>在线书签</h1>
    
</div>
    <hr/>
    <?php
        if ($title) {
            do_html_heading($title);
    }
}
function do_html_footer(){
    ?>
    </body>
</html>
<?php
}

function do_html_heading($heading){
    ?>
    <h2><?php echo $heading;?></h2>
    <?php
}
function do_html_url($url,$name){
    ?>
    <br><a  href="<?php echo $url;?>"><?php echo $name;?></a><br>
    <?php
}

function display_site_info(){
    ?>
    <ul>
    <li>在线收藏您的书签</li>
    <li>查看其他用户使用的书签</li>
    <li>与他人分享你最喜爱的书签</li>
    </ul>
<?php
}

function display_login_form(){
?>
    <p><a href="register_form.php">注册会员</a></p>
    <form method="post" action="member.php">
    <div class="formblock">
    <h2>会员登录</h2>

    <p><label for="username">用户名：</label>
    <br/>
    <input type="text" name="username" id="username"></p>

    <p><label for="passwd">密码：</label>
    <br/>
    <input type="password" name="passwd" id="passwd"></p>

    <button type="submit">登录</button>

    <p><a href="forgot_form.php">忘记密码？</a></p>
    </div>

    </form>
<?php
}

function display_registration_form(){
    ?>
    <form action="register_new.php" method="post">
    <div class="formblock">
    <h2>立即注册</h2>

    <p><label for="email">邮箱：</label>
    <br/>
    <input type="email" name="email" id="email" size+"30" maxlength="100" required />
    </p>

    <p><label for="username">用户名：</label>
    <br/>
    <input type="text" name="username" id="username" size+"16" maxlength="16" required />
    </p>

    <p><label for="passwd">密码：</label>
    <br/>
    <input type="password" name="passwd" id="passwd" size+"16" maxlength="16" required />
    </p>

    <p><label for="passwd2">确认密码：</label>
    <br/>
    <input type="password" name="passwd2" id="passwd2" size+"16" maxlength="16" required />
    </p>

    <button type="submit">注册</button>
    </div>
</form>
<?php
}

function display_user_urls($url_array){
    //显示网址集合

    //设置全局变量，我们可以稍后测试它是否在页面上
    global $bm_table;
    $bm_table = true;
?>
    <br>
    <form name="bm_table" action="delete_bms.php" method="post">
    <table width="300" cellpadding="2" cellspacing="0">
    <?php
    $color="#cccccc";
    echo "<tr bgcolor=\"".$color."\"><td><strong>Bookmark</strong></td>";
    echo "<td><strong>删除？</strong></td></tr>";
    if ((is_array($url_array)) && (count($url_array)>0 )){
        foreach($url_array as $url){
            if ($color == "cccccc") {
                $color="#ffffff";
            }else{
                $color = "#cccccc";
            }
            //记得在我们显示用户数据时调用htmlspecialchars（）
            echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
            <td><input type=\"checkbox\" name=\"del_me[]\"
                value=\"".$url."\"></td>
            </tr>";
    }
  } else {
    echo "<tr><td>No bookmarks on record</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

function display_user_menu() {
  //显示此页面上的菜单选项
?>
<hr>
<a href="member.php">主页</a> &nbsp;|&nbsp;
<a href="add_bm_form.php">添加书签</a> &nbsp;|&nbsp;
<?php
  //如果此页面上有书签，则仅提供删除选项
  global $bm_table;
  if ($bm_table == true) {
    echo "<a href=\"#\" onClick=\"bm_table.submit();\">删除书签</a> &nbsp;|&nbsp;";
  } else {
    echo "<span style=\"color: #cccccc\">删除书签</span> &nbsp;|&nbsp;";
  }
?>
<a href="change_passwd_form.php">修改密码</a><br>
<a href="recommend.php">推荐网址</a> &nbsp;|&nbsp;
<a href="logout.php">退出</a>
<hr>

<?php
}

function display_add_bm_form() {
  //显示用户输入新书签的表单
?>
<form name="bm_table" action="add_bms.php" method="post">

 <div class="formblock">
    <h2>新书签</h2>

    <p>
    <input type="text" name="new_url" id="new_url" 
      size="40"  maxlength="255" value="http://" required /></p>

    <button type="submit">添加书签</button>

   </div>

</form>
<?php
}

function display_password_form() {
 //显示html更改密码表单
?>
   <br>
   <form action="change_passwd.php" method="post">

 <div class="formblock">
    <h2>更改密码</h2>

    <p><label for="old_passwd">旧密码</label><br/>
    <input type="password" name="old_passwd" id="old_passwd" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd2">新密码:</label><br/>
    <input type="password" name="new_passwd" id="new_passwd" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd2">确认密码:</label><br/>
    <input type="password" name="new_passwd2" id="new_passwd2" 
      size="16" maxlength="16" required /></p>


    <button type="submit">修改密码</button>

   </div>
   <br>
<?php
}

function display_forgot_form() {
 //显示HTML表单以重置和发送电子邮件密码
?>
   <br>
   <form action="forgot_passwd.php" method="post">

 <div class="formblock">
    <h2>忘记密码?</h2>

    <p><label for="username">请输入用户名:</label><br/>
    <input type="text" name="username" id="username" 
      size="16" maxlength="16" required /></p>

    <button type="submit">更改密码</button>

   </div>
   <br>
<?php
}

function display_recommended_urls($url_array) {
    //输出display_user_urls
    //而不是显示用户书签，显示推荐
?>
  <br>
  <table width="300" cellpadding="2" cellspacing="0">
<?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\">
        <td><strong>Recommendations</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array)>0)) {
    foreach ($url_array as $url) {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      echo "<tr bgcolor=\"".$color."\">
            <td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td></tr>";
    }
  } else {
    echo "<tr><td>No recommendations for you today.</td></tr>";
  }
?>
  </table>
<?php
}

?>
