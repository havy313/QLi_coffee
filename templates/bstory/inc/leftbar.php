<div class="gadget">
  <h2 class="star">Danh mục truyện</h2>
  <div class="clr"></div>
  <ul class="sb_menu">
  <?php 
    $queryCat = "SELECT * FROM cat";
    $resultCat =$mysqli->query($queryCat);
    while($arCat = mysqli_fetch_assoc($resultCat)){
  ?>  
    <li><a href="cat.php?cat_id=<?php echo $arCat['cat_id']?>"><?php echo $arCat['name']?></a></li>
    <?php
      }
    ?>
  </ul>
</div>

<div class="gadget">
  <h2 class="star"><span>Truyện mới</span></h2>
  <div class="clr"></div>
  <ul class="ex_menu">
  <?php 
    $queryStory = "SELECT * FROM story ORDER BY story_id DESC ";
    $resultStory = $mysqli->query($queryStory);
    while($arStory = mysqli_fetch_assoc($resultStory)){
    ?>
    
    <li><a href="detail.php?story_id=<?php echo $arStory['story_id']?>"><?php echo $arStory['name']?></a><br />
      <?php echo $arStory['preview_text']?></li>
    <?php
     }
    ?>
  </ul>
</div>