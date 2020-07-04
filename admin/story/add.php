<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm Bài viết</h2>
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
                                    if(isset($_POST['submit'])){
                                        $name = $_POST['name'];
                                        $pictureName = "";
                                        $picture = $_FILES['picture'];
                                        if(isset($picture['name']) && $picture['name'] != ''){
                                            //xử lý up hình ảnh 
                                            $fileName = $picture['name'];
                                            $arFileName = explode('.', $fileName);
                                            $fileType = strtolower(end($arFileName));
                                            $pictureName = "story-". time(). ".". rand(1,100).  $fileType;
                                            $tmpName = $picture['tmp_name'];
                                            $pathUpload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $pictureName;
                                            $resultUpload = move_uploaded_file($tmpName, $pathUpload);
                                        }
                                        $preview_text = $_POST['preview_text'];
                                        $detail_text = $_POST['detail_text'];
                                        $cat_id = $_POST['cat_id'];
                                        $counter = 0;
                                        $query = "INSERT INTO story (name, preview_text, detail_text, cat_id, picture, counter) VALUE ('{$name}','{$preview_text}','{$detail_text}',{$cat_id},'{$pictureName}',{$counter})";
                                        $result = $mysqli->query($query);
                                        if($result){
                                            header("location:index.php?msg=Thêm dữ liệu thành công");
                                            die();

                                        }else {
                                            echo "Thêm không thành công";
                                            die();
                                        }                               
                                    }
                                ?>
                                <form role="form" action= "" method = "POST" enctype = "multipart/form-data">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="cat_id"> 
                                                <option value = "">---Chọn danh mục---</option>
                                                <?php
                                                    $sql = "SELECT * FROM cat";
                                                    $resultSql =$mysqli->query($sql);
                                                    while($arCat = mysqli_fetch_assoc($resultSql)){
                                                ?>  
                                                <option value = "<?php echo $arCat['cat_id']?>"><?php echo $arCat['name']?></option>
                                                <?php
                                                   }
                                                ?>                                                
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class=" ckeditor form-control" rows="5" name="detail_text"></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
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