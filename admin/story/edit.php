<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php';
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa bài viết</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                //Lấy thông tin story
                                $story_id = $_GET['story_id'];
                                $querySR = "SELECT * FROM story WHERE story_id = {$story_id}";
                                $resultSR = $mysqli->query($querySR);
                                $arStory = mysqli_fetch_assoc($resultSR);
                                $pictureName = $arStory['picture'];

                                if (isset($_POST['submit'])) {
                                    $name = $_POST['name'];
                                    $picture = $_FILES['picture'];
                                    if (isset($picture['name']) && $picture['name'] != '') {
                                        unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $pictureName);
                                        //Xử lý up hình ảnh
                                        $fileName = $picture['name'];
                                        $arFileName = explode('.', $fileName);
                                        $fileType = strtolower(end($arFileName));
                                        $pictureName = "story-" . time() . "." . $fileType;
                                        $tmpName = $picture['tmp_name'];
                                        $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $pictureName;
                                        $resultUpload = move_uploaded_file($tmpName, $pathUpload);
                                    }
                                    $preview_text = $_POST['preview_text'];
                                    $detail_text = $_POST['detail_text'];
                                    $cat_id = $_POST['cat_id'];
                                    $query = "UPDATE story SET name = '{$name}', preview_text = '{$preview_text}', detail_text = '{$detail_text}', cat_id = {$cat_id}, picture = '{$pictureName}' WHERE story_id = '{$story_id}'";
                                    $result = $mysqli->query($query);
                                    if ($result) {
                                        header("Location: index.php?msg=Sửa dữ liệu thành công!");
                                        die();
                                    } else {
                                        echo "Sửa dữ liệu không thành công";
                                        die();
                                    }
                                }
                                ?>
                                <form role="form" action="" method="POST" id="form-story" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" value="<?php echo $arStory['name'] ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="cat_id">
                                            <option value="">--Chọn danh mục--</option>
                                            <?php
                                            $sql = "SELECT * FROM cat";
                                            $resultSql = $mysqli->query($sql);
                                            while ($arCat = mysqli_fetch_assoc($resultSql)) {
                                                $selected = "";
                                                if ($arStory['cat_id'] == $arCat['cat_id']) {
                                                    $selected = "selected='selected'";
                                                }
                                            ?>
                                                <option <?php echo $selected ?> value="<?php echo $arCat['cat_id'] ?>"><?php echo $arCat['name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                        <?php
                                        if ($arStory['picture'] != '') {
                                            echo "<img src='/files/{$arStory['picture']}' style='width: 100px;margin-top: 10px'></img>";
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text"><?php echo $arStory['preview_text'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class="ckeditor form-control" rows="5" name="detail_text"><?php echo $arStory['detail_text'] ?></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>