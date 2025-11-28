<?php
require(__DIR__ . '/../../usr/tool/mail.php');
if (isset($_GET['id']) && isset($_GET['what'])) {
    $id = $_GET['id'];
    $what = $_GET['what'];
    $sql = "SELECT * FROM zyyo_friends WHERE id='$id'";
    $friend = DB::query($sql)->fetch(PDO::FETCH_ASSOC);
    if ($friend['status'] == $what) {
        exit(alert('请勿重复操作', 'index.php', 'success'));
    }
    $sql = "UPDATE zyyo_friends SET status=" . $what . " WHERE id='$id'";
    DB::query($sql);
    if ($what) {
        $sql = "SELECT * FROM zyyo_friends WHERE id='$id'";
        $friend = DB::query($sql)->fetch(PDO::FETCH_ASSOC);
        $reason = $_GET["reason"];
        $statusMap = [
            '1' => [
                'subject' => '友情链接审核通过通知',
                'action' => '已通过审核',
                'color' => '#52c41a'
            ],
            '-1' => [
                'subject' => '友情链接审核驳回通知',
                'action' => '已被驳回',
                'color' => '#f5222d',
                'reason' => $reason
            ]
        ];
        $mailData = $statusMap[$what] ?? null;
        if ($mailData) {
            // HTML邮件模板
            $content = '<html>
    <head><meta charset="UTF-8"> <!-- 放在<head>标签内 --><style>
        .container {max-width: 600px; margin: 20px auto; padding: 24px;}
        .title {font-size: 18px; margin-bottom: 16px;}
        .info-table {width: 100%; border-collapse: collapse;}
        .info-table td {padding: 8px 12px; border: 1px solid #e8e8e8;}
        .status {color: ' . $mailData['color'] . '; font-weight: bold;}
    </style></head>
    <body>
    <div class="container">
        <div class="title">' . htmlspecialchars($friend['name']) . ' ，您好：</div>
        <table class="info-table">
            <tr><td width="100">审核状态</td>
                <td><span class="status">' . $mailData['action'] . '</span></td></tr>
            <tr><td>网站名称</td>
                <td>' . htmlspecialchars($friend['name']) . '</td></tr>
            <tr><td>网站链接</td>
                <td><a href="' . htmlspecialchars($friend['href']) . '">'
                . htmlspecialchars($friend['href']) . '</a></td></tr>
                  ' . ($what == -1 ?
                ' <tr><td width="100">驳回原因</td>
                <td><span class="status">' . $mailData['reason'] . '</span></td></tr>' :
                '') . '
        </table>
        <div style="margin-top:24px;color:#666;">
            ' . ($what == 1 ?
                '您的链接将在24小时内生效，请注意检查本站链接情况' :
                '如有疑问请联系管理员') . '
        </div>
    </div>
    </body>
    </html>';
            // 发送邮件
            sendmail(
                $friend['mail'],
                $content,
                $mailData['subject'],
                true // 假设第三个参数表示HTML格式
            );
        }
    }
}
if (isset($_GET['page']) && $_GET['page'] == 'delay') {
    $status = 0;
    $friends_title = '待审核';
} else if (isset($_GET['page']) && $_GET['page'] == 'laji') {
    $status = -1;
    $friends_title = '垃圾箱';
} else {
    $status = 1;
    $friends_title = '已通过';
}
?>
<div class="card">
    <header class="card-header">
        <div class="card-title"><?= $friends_title ?></div>
    </header>
    <div class="card-body">
        <div class="card-search mb-2-5">
        </div>
        <div class="new-friends card-btns mb-2-5">
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
                        <th>描述</th>
                        <th>图标</th>
                        <th>链接</th>
                        <th>邮箱</th>
                        <th>状态</th>
                        <th>权重</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM zyyo_friends WHERE status=" . $status . " ORDER BY  power DESC";
                    $result = DB::query($sql);
                    if ($result) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $type1 = ($row["status"] == 0) ? " 点击通过" : (($row["status"] == -1) ? "点击恢复待审核" : "点击待审核");
                            $passurl = './index.php?do=friends&page=delay&what=1&id=' . $row["id"];
                            $delay1 = './index.php?do=friends&what=0&id=' . $row["id"];
                            $delay2 = './index.php?do=friends&page=laji&what=0&id=' . $row["id"];
                            if ($status == 0) {
                                $btntext = ' <a class="btn btn-default" href="' . $passurl . '" data-bs-toggle="tooltip" title="应用">点击通过</a>
                                <a class="lajibtn btn btn-default" id="' . $row["id"] . '" href="#" data-bs-toggle="tooltip" title="应用">点击垃圾箱</a>';
                            } else if ($status == 1) {
                                $btntext = ' <a class="btn btn-default" href="' . $delay1 . '" data-bs-toggle="tooltip" title="应用">点击待审核</a>';
                            } else if ($status == -1) {
                                $btntext = ' <a class=" btn btn-default" href="' . $delay2 . '" data-bs-toggle="tooltip" title="应用">点击待审核</a>';
                            }
                            echo '<tr>
                        <td>' . $row["id"] . '</td>
                        <td>' . $row["name"] . '</td>
                        <td>' . $row["des"] . '</td>
                        <td>' . $row["ico"] . '</td>
                        <td>' . $row["href"] . '</td>
                        <td>' . $row["mail"] . '</td>
                        <td>' . $friends_title . '</td>
                        <td>' . $row['power'] . '  <div class="btn-group btn-group-sm">
                        <a class="btn btn-default" onclick="totop(\'zyyo_friends\', \'' . $row["id"] . '\')" data-bs-toggle="tooltip" title="上移"><i class="mdi mdi-arrow-up"></i></a>
                        <a class="btn btn-default" onclick="tobottom(\'zyyo_friends\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="下移"><i class="mdi mdi-arrow-down"></i></a>
                        </div></td>
                        <td>
                        <div class="btn-group btn-group-sm">' . $btntext . '<a class="btn btn-default" href="./index.php?do=edit-friends&id=' . $row["id"] . '" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
                        <a class="btn btn-default" onclick="del(\'zyyo_friends\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="删除"><i class="mdi mdi-window-close"></i></a>
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
    $('.new-friends').on('click', function () {
        $.confirm({
            title: '添加分类',
            content: '<div class="form-group p-1 mb-0">' +
                '  <label class="control-label">名称</label>' +
                '  <input autofocus="" type="text" id="input-name" placeholder="请输入您的名字" class="form-control">' +
                '  <label class="control-label">描述</label>' +
                '  <input autofocus="" type="text" id="input-des" placeholder="请输入您的描述" class="form-control">' +
                '  <label class="control-label">图标</label>' +
                '  <input autofocus="" type="text" id="input-ico" placeholder="请输入您的图标" class="form-control">' +
                '  <label class="control-label">链接</label>' +
                '  <input autofocus="" type="text" id="input-href" placeholder="请输入您的链接" class="form-control">' +
                '  <label class="control-label">邮件</label>' +
                '  <input autofocus="" type="text" id="input-mail" placeholder="请输入您的邮件" class="form-control">' +
                '</div>',
            buttons: {
                sayMyName: {
                    text: '添加',
                    btnClass: 'btn-orange',
                    action: function () {
                        var input1 = this.$content.find('input#input-name');
                        var input2 = this.$content.find('input#input-des');
                        var input3 = this.$content.find('input#input-ico');
                        var input4 = this.$content.find('input#input-href');
                        var input5 = this.$content.find('input#input-mail');
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
                                    do: 'newfriends',
                                    name: input1.val(),
                                    des: input2.val(),
                                    ico: input3.val(),
                                    href: input4.val(),
                                    mail: input5.val(),
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
                                            location.reload()
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
    $('.lajibtn').on('click', function () {
        // 保存当前点击按钮的id到变量btnId
        var btnId = this.id;
        $.confirm({
            title: '驳回理由',
            content: '<input autofocus type="text" id="input-reason" placeholder="请输入您的理由" class="form-control">',
            buttons: {
                sayMyName: {
                    text: '驳回',
                    btnClass: 'btn-orange',
                    action: function () {
                        var input1 = this.$content.find('#input-reason');
                        var reason = $.trim(input1.val());
                        if (!reason) {
                            $.alert({
                                content: "不能为空。",
                                type: 'red'
                            });
                            return false;
                        } else {
                            // 使用btnId变量和编码后的输入值构造URL
                            const url = `./index.php?do=friends&page=delay&what=-1&id=${btnId}&reason=${encodeURIComponent(reason)}`;
                            window.location.href = url;
                        }
                    }
                },
                '取消': function () { }
            }
        });
    });
</script>