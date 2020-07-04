<?php include_once $_SERVER['DOCUMENT_ROOT']. '/templates/bstory/inc/header.php'; ?>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h2><span>Liên hệ</span></h2>
      <div class="clr"></div>
      <?php
        if(isset($_GET['msg'])){
            echo  $_GET['msg'];
        }
      ?>
      <p>Nếu có thắc mắc hoặc góp ý, vui lòng liên hệ với chúng tôi theo thông tin dưới đây.</p>
     
    </div>
    <div class="article">
      <h2>Form liên hệ</h2>
      <div class="clr"></div>
      <?php
            if(isset($_POST['imageField'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $website = $_POST['website'];
                $content = $_POST['content'];
              $query = "INSERT INTO contact (name, email, website, content) VALUE ('{$name}','{$email}','{$website}','{$content}', )";
              $result = $mysqli->query($query);
              if($result){
                header("location:contact.php?msg=Gửi liên hệ thành công");
                die();
              }else{
                echo "gửi liên hệ không thành công";
                die();
              }
            }
      ?>
      <form action="#" method="POST" id="sendemail">
        <ol>
          <li>
            <label for="name">Họ tên (required)</label>
            <input id="name" name="name" class="text" />
          </li>
          <li>
            <label for="email">Email (required)</label>
            <input id="email" name="email" class="text" />
          </li>
          <li>
            <label for="website">Website</label>
            <input id="website" name="website" class="text" />
          </li>
          <li>
            <label for="message">Nội dung</label>
            <textarea id="message" name="content" rows="8" cols="50"></textarea>
          </li>
          <li>
            <input type="image" name="imageField" id="imageField" src="/templates/bstory/images/submit.gif"  value ="Submit" class="send" />
            <div class="clr"></div>
          </li>
        </ol>
      </form>
    </div>
  </div>
  <div class="sidebar">
  <?php include_once $_SERVER['DOCUMENT_ROOT']. '/templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<style type = "text/css">
  label.error{
    color: red;
    font-style: italic;
  }
</style>
<script type = "text/javascript">
      $(document).ready(function(){
        $("#sendemail").validate({
          rules: {
            "name": {
              required: true,
            },
            "email": {
              required: true,
              email: true,
            },  
          },
          message: {
            "name": {
              required: "Nhập họ tên liên hệ",
            },
            "email": {
              required: "Nhập email liên hệ",
              email: "Định dạng email không hợp lệ",
            },  
          }
        });
      });
</script>
<?php include_once $_SERVER['DOCUMENT_ROOT']. '/templates/bstory/inc/footer.php'; ?>
