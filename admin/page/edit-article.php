<?php

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$sql = "SELECT * FROM zyyo_article WHERE id='$id'";
$result = DB::get_row($sql);
?>
<div class="card">
    <!--页面主要内容-->
    <header class="card-header">
        <div class="card-title">文章编辑</div>
    </header>
    <div class="card-body">
        <form action="" method="post" name="edit-form" class="edit-item-form edit-form">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="config" aria-labelledby="basic-config">
                    <div style="display:none" class="mb-3">
                        <input class="form-control" type="text" id="id" name="id" value="<?= (isset($id)) ? $id : "" ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">名称</label>
                        <input class="form-control" type="text" id="title" name="title"
                            value="<?= (isset($result["title"])) ? $result["title"] : "" ?>" placeholder="请输入">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">描述</label>
                        <textarea class="form-control" id="description" rows="5" name="description"
                            placeholder="请输入"><?= (isset($result["description"])) ? $result["description"] : "" ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cover" class="form-label">封面</label>
                        <textarea class="form-control" id="cover" rows="5" name="cover"
                            placeholder="请输入"><?= (isset($result["cover"])) ? $result["cover"] : "" ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">文章内容md文件</label>
                        <input class="form-control" type="file" id="formFile" name="md_file">

                        <?php

                        if (file_exists(__DIR__ . "/../../articles/" . $id . ".md")) {
                            echo ' <small class="form-text">已上传文件</small>';
                        } else {
                            echo ' <small class="form-text">暂无文件</small>';
                        }

                        ?>
                        <small class="form-text">上传新的MD文件将覆盖原有内容</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">文章开关</label>
                        <div class="form-check form-switch">
                            <input name="status" type="checkbox" class="form-check-input" id="status"
                                <?= (isset($result["status"]) && $result["status"] == 1) ? 'checked=""' : '' ?> <?= ($id) ? '' : 'checked=""' ?>>
                            <label class="form-check-label" for="status"></label>
                        </div>


                        <small class="form-text" 关闭后文章不在前台显示 </small>
                    </div>

                    <?php
                    $sql1 = "SELECT * FROM zyyo_category ORDER BY id ";
                    $result1 = DB::query($sql1);
                    echo '<div class="mb-3"><label for="category" class="form-label">显示分类</label><div class="controls-box clearfix">';
                    while ($row1 = $result1->fetch(PDO::FETCH_ASSOC)) {
                        $type = (isset($result["category_id"]) && $result["category_id"] == $row1["id"]) ? "checked" : "";
                        echo ' <div class="form-check form-check-inline"><input type="radio" id="app_trace_1" name="category_id" class="form-check-input" value="';
                        echo $row1["id"];
                        echo '" ' . $type . '>';
                        echo '<label class="form-check-label" for="app_trace_1">';
                        echo $row1["name"];
                        echo '</label></div>';
                    }
                    echo '</label></div></div>';
                    ?>
                    <button type="submit" class="btn btn-primary me-1">确 定</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返
                        回</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('.edit-item-form').on('submit', function (event) {
        event.preventDefault();
        if ($(this)[0].checkValidity() === false) {
            event.stopPropagation();
            $(this).addClass('was-validated');
            return false;
        }

        // 创建FormData对象
        var formData = new FormData(this);
        formData.append("do", "editarticle");

        // 如果有上传文件
        var fileInput = $('#formFile')[0];
        if (fileInput.files.length > 0) {
            formData.append("md_file", fileInput.files[0]);
        }

        $.ajax({
            url: './api.php',
            method: 'POST',
            data: formData,
            processData: false,  // 必须设为false
            contentType: false,  // 必须设为false
            dataType: 'json',
            success: function (res) {
                if (res.code === 1) {
                    $.notify({
                        message: '修改成功',
                    }, {
                        type: 'success',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        z_index: 10800,
                        delay: 1500,
                        animate: {
                            enter: 'animate__animated animate__fadeInUp',
                            exit: 'animate__animated animate__fadeOutDown'
                        }
                    });
                    setTimeout(function () {
                        document.body.innerHTML = ''; // 清空内容

                        window.location.replace("index.php?do=article");
                    }, 200);
                } else {
                    $.notify({
                        message: '失败，错误原因：' + res.msg,
                    }, {
                        type: 'danger',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        z_index: 10800,
                        delay: 1500,
                        animate: {
                            enter: 'animate__animated animate__shakeX',
                            exit: 'animate__animated animate__fadeOutDown'
                        }
                    });
                }
            },
            error: function () {
                $.notify({
                    message: '服务器错误',
                }, {
                    type: 'danger',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    z_index: 10800,
                    delay: 1500,
                    animate: {
                        enter: 'animate__animated animate__shakeX',
                        exit: 'animate__animated animate__fadeOutDown'
                    }
                });
            }
        });
        return false;
    });
</script>