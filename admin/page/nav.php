<div class="card">
    <header class="card-header">
        <div class="card-title">导航列表</div>
    </header>
    <div class="card-body">
        <div class="card-search mb-2-5">
        </div>
        <div class="new-nav card-btns mb-2-5">
            <a class="btn btn-primary me-1" href="#!">
                <i class="mdi mdi-plus"></i> 新增
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>名称</th>
                        <th>链接</th>
                        <th>权重</th>
                        <th>父级</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM zyyo_nav ORDER BY  power DESC";
                    $result = DB::query($sql);
                    if ($result) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $nav_id = $row["parent"];
                            if ($nav_id == 0) {
                                $type = "最顶层分类";
                            } else {
                                $type_query = "SELECT * FROM zyyo_nav WHERE id = " . $nav_id;
                                $type_result = DB::query($type_query);
                                $type_row = $type_result->fetch(PDO::FETCH_ASSOC);
                                $type = $type_row["name"];
                            }
                            echo '<tr>
                        <td>' . $row["id"] . '</td>
                        <td>' . $row["name"] . '</td>
                        <td>' . $row["href"] . '</td>
                        <td>' . $row['power'] . '  <div class="btn-group btn-group-sm">
                        <a class="btn btn-default" onclick="totop(\'zyyo_nav\', \'' . $row["id"] . '\')" data-bs-toggle="tooltip" title="上移"><i class="mdi mdi-arrow-up"></i></a>
                        <a class="btn btn-default" onclick="tobottom(\'zyyo_nav\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="下移"><i class="mdi mdi-arrow-down"></i></a>
                        </div></td>
                         <td>' . $type . '</td>
                        <td>
                        <div class="btn-group btn-group-sm">
                        <a class="btn btn-default" href="./index.php?do=edit-nav&id=' . $row["id"] . '" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                        <a class="btn btn-default" onclick="del(\'zyyo_nav\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="删除"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        </td>
                        </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('.new-nav').on('click', function () {
        $.confirm({
            title: '添加分类',
            content: '<div class="form-group p-1 mb-0">' +
                '  <label class="control-label">名称</label>' +
                '  <input autofocus="" type="text" id="input-name" placeholder="请输入您的名字" class="form-control">' +
                '  <label class="control-label">链接</label>' +
                '  <input autofocus="" type="text" id="input-nav" placeholder="请输入您的链接" class="form-control">' +
                '<?php
                $sql = "SELECT * FROM zyyo_nav ORDER BY id ";
                $result = DB::query($sql);
                if ($result) {
                    echo '<div class="mb-3"><label for="app_trace" class="form-label">父级分类</label><div class="controls-box clearfix">';
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo ' <div class="form-check form-check-inline"><input type="radio" id="app_trace_1" name="parent" class="form-check-input" value="';
                        echo $row["id"];
                        echo '" checked="">';
                        echo '<label class="form-check-label" for="app_trace_1">';
                        echo $row["name"];
                        echo '</label></div>';
                    }
                    echo ' <div class="form-check form-check-inline"><input type="radio" id="app_trace_1" name="parent" class="form-check-input" value="0" checked="">';
                    echo '<label class="form-check-label" for="app_trace_1">最顶层</label></div>';
                    echo '</label></div></div>';
                } else {
                    echo "没有一个项目";
                } ?> ',
            buttons: {
        sayMyName: {
            text: '添加',
            btnClass: 'btn-orange',
            action: function () {
                var input1 = this.$content.find('input#input-name');
                var input2 = this.$content.find('input#input-nav');
                var parent = this.$content.find('input[name="parent"]:checked').val();
                var errorText = this.$content.find('.text-danger');
                if (!$.trim(input1.val())) {
                    $.alert({
                        content: "不能为空。",
                        type: 'red'
                    });
                    return false;
                } else {
                    $.ajax({
                        url: './api.php',
                        method: 'POST',
                        data: {
                            do: 'newnav',
                            name: input1.val(),
                            href: input2.val(),
                            parent: parent,
                        },
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
                                    location.href = 'index.php?do=nav';
                                }, 500);
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
                }
            }
        },
        '取消': function () { }
    }
        });
    });
</script>