<?php
if (!isset($_GET['id'])) {
    $url = "/admin";
    echo "
<meta http-equiv='refresh' content='1;url=$url'>";
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM zyyo_item WHERE id='$id'";
$result = DB::get_row($sql);
?>
<div class="card">
    <!--页面主要内容-->
    <header class="card-header">
        <div class="card-title">项目编辑</div>
    </header>
    <div class="card-body">
        <form action="" method="post" name="edit-form" class="edit-item-form edit-form">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="config" aria-labelledby="basic-config">
                    <div style="display:none" class="mb-3">
                        <input class="form-control" type="text" id="id" name="id" value="<?= $id ?>" placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="sitename" class="form-label">名称</label>
                        <input class="form-control" type="text" id="name" name="name" value="<?= $result["name"] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="href" class="form-label">链接</label>
                        <input class="form-control" type="text" id="href" name="href" value="<?= $result["href"] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">图标</label>
                        <textarea class="form-control" id="icon" rows="5" name="icon"
                            placeholder="请输入"><?= $result["icon"] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="des" class="form-label">描述</label>
                        <textarea class="form-control" id="des" rows="5" name="des"
                            placeholder="请输入"><?= $result["des"] ?></textarea>
                    </div>
                    <?php
                    $sql1 = "SELECT * FROM zyyo_project ORDER BY id ";
                    $result1 = DB::query($sql1);
                    echo '<div class="mb-3"><label for="app_trace" class="form-label">显示分类</label><div class="controls-box clearfix">';
                    while ($row1 = $result1->fetch(PDO::FETCH_ASSOC)) {
                        $type = ($result["project"] == $row1["id"]) ? "checked" : "";
                        echo ' <div class="form-check form-check-inline"><input type="radio" id="app_trace_1" name="project" class="form-check-input" value="';
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
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            $(this).addClass('was-validated');
            return false;
        }
        var $data = $(this).serialize();
        $.ajax({
            url: './api.php',
            method: 'POST',
            data: $data + "&" + "do=edititem",
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