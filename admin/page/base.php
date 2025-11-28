<div class="card">
    <header class="card-header">
        <div class="card-title">网站配置</div>
    </header>
    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active" id="basic-config" data-bs-toggle="tab" data-bs-target="#config"
                    type="button">基本</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="index-config" data-bs-toggle="tab" data-bs-target="#index"
                    type="button">主页</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="mail-config" data-bs-toggle="tab" data-bs-target="#mail"
                    type="button">邮件</button>
            </li>
        </ul>
        <form action="" method="post" name="edit-form" class="base-form edit-form">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="config" aria-labelledby="basic-config">
                    <div class="mb-3">
                        <label for="sitename" class="form-label">网站标题</label>
                        <input class="form-control" type="text" id="sitename" name="sitename"
                            value="<?= $data['sitename'] ?>" placeholder="请输入站点标题">
                    </div>
                    <div class="mb-3">
                        <label for="keywords" class="form-label">站点关键词</label>
                        <input class="form-control" type="text" id="keywords" name="keywords"
                            value="<?= $data['keywords'] ?>" placeholder="请输入站点关键词">
                        <small class="form-text">网站搜索引擎关键字</small>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">站点描述</label>
                        <textarea class="form-control" id="description" rows="5" name="description"
                            placeholder="请输入站点描述"><?= $data['description'] ?></textarea>
                        <small class="form-text">网站描述，有利于搜索引擎抓取相关信息</small>
                    </div>
                    <div class="mb-3">
                        <label for="header" class="form-label">自定义头部</label>
                        <textarea class="form-control" id="header" rows="5" name="header" placeholder="请输入"><?= $data['header'] ?>
</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="footer" class="form-label">自定义底部</label>
                        <textarea class="form-control" id="footer" rows="5" name="footer" placeholder="请输入"><?= $data['footer'] ?>
</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="beian" class="form-label">备案信息</label>
                        <input class="form-control" type="text" id="beian" name="beian" value="<?= $data['beian'] ?>"
                            placeholder="请输入备案信息">
                    </div>
                    <div class="mb-3">
                        <label for="ico" class="form-label">ico</label>
                        <input class="form-control" type="text" id="ico" name="ico" value="<?= $data['ico'] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">头像</label>
                        <input class="form-control" type="text" id="author" name="author" value="<?= $data['author'] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">logo</label>
                        <input class="form-control" type="text" id="logo" name="logo" value="<?= $data['logo'] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="lazyload" class="form-label">懒加载图</label>
                        <input class="form-control" type="text" id="lazyload" name="lazyload"
                            value="<?= $data['lazyload'] ?>" placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="login_button" class="form-label">登录按钮链接</label>
                        <input class="form-control" type="text" id="login_button" name="login_button"
                            value="<?= $data['login_button'] ?>" placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="beian" class="form-label">用户名</label>
                        <input class="form-control" type="text" id="user" name="user" value="<?= $data['user'] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="beian" class="form-label">密码</label>
                        <input class="form-control" type="text" id="pwd" name="pwd" value="<?= $data['pwd'] ?>"
                            placeholder="请输入">
                    </div>
                    <div class="mb-3">
                        <label for="title1" class="form-label">标题1</label>
                        <textarea class="form-control" id="title1" rows="5" name="title1" placeholder="请输入"><?= $data['title1'] ?>
</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="title2" class="form-label">标题2</label>
                        <textarea class="form-control" id="title2" rows="5" name="title2"
                            placeholder="请输入"><?= $data['title2'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bgurl" class="form-label">背景图片</label>
                        <textarea class="form-control" id="bgurl" rows="5" name="bgurl"
                            placeholder="请输入"><?= $data['bgurl'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mobbgurl" class="form-label">移动端背景图片</label>
                        <textarea class="form-control" id="mobbgurl" rows="5" name="mobbgurl"
                            placeholder="请输入"><?= $data['mobbgurl'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="footurl" class="form-label">底部图片</label>
                        <textarea class="form-control" id="footurl" rows="5" name="footurl"
                            placeholder="请输入"><?= $data['footurl'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">图标链接（按先后顺序，英文逗号隔开）</label>
                        <textarea class="form-control" id="icon" rows="5" name="icon"
                            placeholder="请输入"><?= $data['icon'] ?></textarea>
                    </div>
                </div>
                <div class="tab-pane fade show " id="index" aria-labelledby="index-config">
                    <div class="mb-3">
                        <label for="blog" class="form-label">博客轮播图（一行一个，每行,分割）</label>
                        <textarea class="form-control" id="blog" rows="5" name="blog"
                            placeholder="请输入"><?= $data['blog'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="music" class="form-label">音乐名称</label>
                        <textarea class="form-control" id="music" rows="5" name="music"
                            placeholder="请输入"><?= $data['music'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="musiccover" class="form-label">音乐封面</label>
                        <textarea class="form-control" id="musiccover" rows="5" name="musiccover"
                            placeholder="请输入"><?= $data['musiccover'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="musicurl" class="form-label">音乐URL</label>
                        <textarea class="form-control" id="musicurl" rows="5" name="musicurl"
                            placeholder="请输入"><?= $data['musicurl'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aside_url" class="form-label">侧栏跳转链接</label>
                        <textarea class="form-control" id="aside_url" rows="5" name="aside_url"
                            placeholder="请输入"><?= $data['aside_url'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aside_stats" class="form-label">侧栏统计（,分割）</label>
                        <textarea class="form-control" id="aside_stats" rows="5" name="aside_stats"
                            placeholder="请输入"><?= $data['aside_stats'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aside_gonggao" class="form-label">侧栏公告（html）</label>
                        <textarea class="form-control" id="aside_gonggao" rows="5" name="aside_gonggao"
                            placeholder="请输入"><?= $data['aside_gonggao'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="yiyan" class="form-label">一言，一行一个</label>
                        <textarea class="form-control" id="yiyan" rows="5" name="yiyan"
                            placeholder="请输入"><?= $data['yiyan'] ?></textarea>
                    </div>



 <div class="mb-3">
                        <label for="blog1" class="form-label">博客图标</label>
                        <textarea class="form-control" id="blog1" rows="5" name="blog1"
                            placeholder="请输入"><?= $data['blog1'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="blog2" class="form-label">博客标题</label>
                        <textarea class="form-control" id="blog2" rows="5" name="blog2"
                            placeholder="请输入"><?= $data['blog2'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="blog3" class="form-label">博客描述</label>
                        <textarea class="form-control" id="blog3" rows="5" name="blog3"
                            placeholder="请输入"><?= $data['blog3'] ?></textarea>
                    </div>
                   
                    <div class="mb-3">
                        <label for="blog4" class="form-label">博客链接</label>
                        <textarea class="form-control" id="blog4" rows="5" name="blog4"
                            placeholder="请输入"><?= $data['blog4'] ?></textarea>
                    </div>


                    --
                    <div class="mb-3">
                        <label for="bili1" class="form-label">b站图标</label>
                        <textarea class="form-control" id="bili1" rows="5" name="bili1"
                            placeholder="请输入"><?= $data['bili1'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bili2" class="form-label">b站标题</label>
                        <textarea class="form-control" id="bili2" rows="5" name="bili2"
                            placeholder="请输入"><?= $data['bili2'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bili3" class="form-label">b站描述</label>
                        <textarea class="form-control" id="bili3" rows="5" name="bili3"
                            placeholder="请输入"><?= $data['bili3'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bili4" class="form-label">b站图片</label>
                        <textarea class="form-control" id="bili4" rows="5" name="bili4"
                            placeholder="请输入"><?= $data['bili4'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bili5" class="form-label">b站链接</label>
                        <textarea class="form-control" id="bili5" rows="5" name="bili5"
                            placeholder="请输入"><?= $data['bili5'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="qq1" class="form-label">QQ图标</label>
                        <textarea class="form-control" id="qq1" rows="5" name="qq1"
                            placeholder="请输入"><?= $data['qq1'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="qq2" class="form-label">QQ标题</label>
                        <textarea class="form-control" id="qq2" rows="5" name="qq2"
                            placeholder="请输入"><?= $data['qq2'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="qq3" class="form-label">QQ描述</label>
                        <textarea class="form-control" id="qq3" rows="5" name="qq3"
                            placeholder="请输入"><?= $data['qq3'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="qq4" class="form-label">QQ地址</label>
                        <textarea class="form-control" id="qq4" rows="5" name="qq4"
                            placeholder="请输入"><?= $data['qq4'] ?></textarea>
                    </div>
                </div>
                <div class="tab-pane fade show " id="mail" aria-labelledby="mail-config">
                    使用smtp发信，默认启用ssl机密，使用465端口
                    <div class="mb-3">
                        <label for="smtp" class="form-label">smtp服务器</label>
                        <textarea class="form-control" id="smtp" rows="5" name="smtp"
                            placeholder="请输入"><?= $data['smtp'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">站长收信邮箱</label>
                        <textarea class="form-control" id="mail" rows="5" name="mail"
                            placeholder="请输入"><?= $data['mail'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mailuser" class="form-label">邮件地址</label>
                        <textarea class="form-control" id="mailuser" rows="5" name="mailuser"
                            placeholder="请输入"><?= $data['mailuser'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="mailpwd" class="form-label">邮件密码</label>
                        <textarea class="form-control" id="mailpwd" rows="5" name="mailpwd"
                            placeholder="请输入"><?= $data['mailpwd'] ?></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary me-1">确 定</button>
            <button type="button" class="btn btn-default"
                onclick="javascript:history.back(-1);return false;">返回</button>
        </form>
    </div>
</div>
<script>
    $('.base-form').on('submit', function (event) {
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
            data: $data + "&" + "do=base",
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