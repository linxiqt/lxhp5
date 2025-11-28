<div class="card">
    <header class="card-header">
        <div class="card-title">项目列表</div>
    </header>
    <div class="card-body">
        <div class="card-search mb-2-5">
        </div>
        <div class="new-item card-btns mb-2-5">
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
                        <th>图标</th>
                        <th>描述</th>
                        <th>链接</th>
                        <th>所属</th>
                        <th>权重</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM zyyo_item ORDER BY power DESC";
                    $result = DB::query($sql);
                    if ($result) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $type_id = $row["project"];
                            $type_query = "SELECT * FROM zyyo_project WHERE id = " . $type_id;
                            $type_result = DB::query($type_query);
                            $type_row = $type_result->fetch(PDO::FETCH_ASSOC);
                            $type = $type_row["name"];
                            echo '<tr>
<td>' . $row["id"] . '</td>
<td>' . $row["name"] . '</td>
<td>' . $row["icon"] . '</td>
<td>' . $row["des"] . '</td>
<td>' . $row["href"] . '</td>
<td>' . $type . '</td>
<td>' . $row['power'] . '  <div class="btn-group btn-group-sm">
<a class="btn btn-default" onclick="totop(\'zyyo_item\', \'' . $row["id"] . '\')" data-bs-toggle="tooltip" title="上移"><i class="mdi mdi-arrow-up"></i></a>
<a class="btn btn-default" onclick="tobottom(\'zyyo_item\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="下移"><i class="mdi mdi-arrow-down"></i></a>
</div></td>
<td>
<div class="btn-group btn-group-sm">
<a class="btn btn-default" href="./index.php?do=edit-item&id=' . $row["id"] . '" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
<a class="btn btn-default" onclick="del(\'zyyo_item\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="删除"><i class="mdi mdi-window-close"></i></a>
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
    $('.new-item').on('click', function () {
        $.confirm({
            title: '添加分类',
            content: '<div class="form-group p-1 mb-0">' +
                '  <label class="control-label">名称</label>' +
                '  <input autofocus="" type="text" id="input-name" placeholder="请输入您的名字" class="form-control">' +
                '  <label class="control-label">图标</label>' +
                '  <input autofocus="" type="text" id="input-icon" placeholder="请输入您的链接图标(必填)" class="form-control">' +
                '  <label class="control-label">描述</label>' +
                '  <input autofocus="" type="text" id="input-des" placeholder="请输入您的描述" class="form-control">' +
                '  <label class="control-label">链接</label>' +
                '  <input autofocus="" type="text" id="input-href" placeholder="请输入您的链接" class="form-control">' +
                '<?php
                $sql = "SELECT * FROM zyyo_project ORDER BY id ";
                $result = DB::query($sql);
                if ($result) {
                    echo '<div class="mb-3"><label for="app_trace" class="form-label">显示分类</label><div class="controls-box clearfix">';
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo ' <div class="form-check form-check-inline"><input type="radio" id="app_trace_1" name="project" class="form-check-input" value="';
                        echo $row["id"];
                        echo '" checked="">';
                        echo '<label class="form-check-label" for="app_trace_1">';
                        echo $row["name"];
                        echo '</label></div>';
                    }
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
                var input2 = this.$content.find('input#input-icon');
                var input3 = this.$content.find('input#input-des');
                var input4 = this.$content.find('input#input-href');
                var project = this.$content.find('input[name="project"]:checked').val();
                var errorText = this.$content.find('.text-danger');
                if (!$.trim(input1.val()) || !$.trim(input2.val()) || !$.trim(input3.val()) || !$.trim(input4.val())) {
                    $.alert({
                        content: "不能为空。",
                        type: 'red'
                    });
                    return false;
                } else if (!$.trim(project)) {
                    $.alert({
                        content: "请先添加一个分类。",
                        type: 'red'
                    });
                    return false;
                } {
                    $.ajax({
                        url: './api.php',
                        method: 'POST',
                        data: {
                            do: 'newitem',
                            name: input1.val(),
                            icon: input2.val(),
                            des: input3.val(),
                            href: input4.val(),
                            project: project
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
                                    location.href = 'index.php?do=item';
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