<?php include_once $_SERVER['DOCUMENT_ROOT']. '/templates/bstory/inc/header.php'; ?>
<div class="content_resize">
  <div class="mainbar">
    <?php 
      $query = "SELECT * FROM story ORDER BY story_id DESC";
      $result = $mysqli->query($query);
      while($arItem = mysqli_fetch_assoc($result)){
      ?>
    <div class="article">
      <h2><?php echo $arItem['name']?></h2>
      <p class="infopost">Ngày đăng: <?php echo $arItem['created_at']?>. Lượt đọc: <?php echo $arItem['counter']?></p>
      <div class="clr"></div>
      <div class="img"><img src="/files/<?php echo $arItem['picture']?>" width="161" height="192" alt="" class="fl" /></div>
      <div class="post_content">
        <p><?php echo $arItem['preview_text']?></p>
        <p class="spec"><a href="detail.php?story_id=<?php echo $arItem['story_id']?>" class="rm">Chi tiết</a></p>
      </div>
      <div class="clr"></div>
    </div>
    <?php
      }
    ?>
    <p class="pages"><small>Trang 1 / 2</small> <span>1</span> <a href="#">2</a> <a href="#">&raquo;</a></p>
  </div>
  <div class="sidebar">
  <?php include_once $_SERVER['DOCUMENT_ROOT']. '/templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT']. '/templates/bstory/inc/footer.php'; ?>
