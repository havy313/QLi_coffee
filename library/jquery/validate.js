$(document).ready(function() {
    var whitelist = ['png', 'jpeg', 'gif'];
    // Validate cat
    $("#form-cat").validate({
        rules: {
            "name": {
                required: true,
            }
        },
        messages: {
            "name": {
                required: "Nhập tên danh mục",
            }
        }
    });
    // Validate user
    $("#form-user").validate({
        rules: {
            "username": {
                required: true,
            },
            "password": {
                required: true,
                minlength: 6,
            },
            "fullname": {
                required: true,
            },
        },
        messages: {
            "username": {
                required: "Nhập username",
            },
            "password": {
                required: "Nhập password",
                minlength: "Password tối thiểu 6 ký tự",
            },
            "fullname": {
                required: "Nhập fullname",
            },
        }
    });
    $("#form-edit-user").validate({
        rules: {
            "username": {
                required: true,
            },
            "password": {
                minlength: 6,
            },
            "fullname": {
                required: true,
            },
        },
        messages: {
            "username": {
                required: "Nhập username",
            },
            "password": {
                minlength: "Password tối thiểu 6 ký tự",
            },
            "fullname": {
                required: "Nhập fullname",
            },
        }
    });
    //Validate story
    $("#form-story").validate({
        rules: {
            "name": {
                required: true,
            },
            "cat_id": {
                required: true,
            },
            "preview_text": {
                required: true,
            },
        },
        messages: {
            "name": {
                required: "Nhập tên sản phẩm",
            },
            "cat_id": {
                required: "Chọn danh mục",
            },
            "preview_text": {
                required: "Nhập mô tả",
            },
        }
    });
});