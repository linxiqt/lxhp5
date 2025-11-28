<?php if (!isset($_GET['id'])) {
    $url = "/admin";
    echo "
<meta http-equiv='refresh' content='1;url=$url'>";
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM zyyo_nav WHERE id='$id'";
$result = DB::get_row($sql);
$type1 = ($result["type"] == 0) ? "checked" : "";
$type2 = ($result["type"] == 0) ? "" : "checked";
?>
<!--页面主要内容-->
<div class="card">
    <header class="card-header">
        <div class="card-title">分类编辑</div>
    </header>
    <div class="card-body">
        <form action="" method="post" name="edit-form" class="edit-nav-form edit-form">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="config" aria-labelledby="basic-config">
                    <div style="display:none" class="mb-3">
                        <input class="form-control" type="text" id="id" name="id" value="<?= $id ?>" placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="sitename" class="form-label">分类名称</label>
                        <input class="form-control" type="text" id="name" name="name" value="<?= $result["name"] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">链接</label>
                        <textarea class="form-control" id="href" rows="5" name="href"
                            placeholder="请输入"><?= $result["href"] ?></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary me-1">确 定</button>
                    <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返
                        回</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('.edit-nav-form').on('submit', function (event) {
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
            data: $data + "&" + "do=editnav",
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