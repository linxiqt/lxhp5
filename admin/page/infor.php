<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
                        <i class="mdi mdi-currency-cny fs-4"></i>
                    </span>
                    <span class="fs-4">
                        <?= DB::count("SELECT COUNT(*) FROM zyyo_project") ?>
                    </span>
                </div>
                <div class="text-end">项目分类</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
                        <i class="mdi mdi-account fs-4"></i>
                    </span>
                    <span class="fs-4">
                        <?= DB::count("SELECT COUNT(*) FROM zyyo_item") ?>
                    </span>
                </div>
                <div class="text-end">项目总数</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
                        <i class="mdi mdi-arrow-down-bold fs-4"></i>
                    </span>
                    <span class="fs-4">
                        <?= DB::count("SELECT COUNT(*) FROM zyyo_icon") ?>
                    </span>
                </div>
                <div class="text-end">图标总数</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card bg-purple text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span class="avatar-md rounded-circle bg-white bg-opacity-25 avatar-box">
                        <i class="mdi mdi-comment-outline fs-4"></i>
                    </span>
                    <span class="fs-4">5.0</span>
                </div>
                <div class="text-end">当前版本</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">表单</div>
            </header>
            <div class="card-body">
               <p>开屏页面内容在基本信息里改</p>
                <p>图片支持本地或者链接</p>
                <p>动态打字部分暂时不支持修改</p>
                <pre>如果可以的话，请前往https://github.com/linxiqt/homepage点个Star🌟</pre>
                <p>背景可以使用本人的API</p>
                <h1>API目录</h1>
                <pre>
电脑端https://api.yilx.net/img/pc
随机端https://api.yilx.net/img/pm
手机端https://api.yilx.net/img/mobi
电脑端https://api.yilx.net/gif/pc
手机端https://api.yilx.net/gif/mobi
更多查看https://api.yilx.net
</pre>
                <h1>更新日志</h1>
                <pre>
2025.5|后台版4.0更新
2025.4|后台版3.2.3更新
2025.4|后台版3.2.2更新
2025.3|后台版3.2更新
2025.3|后台版3.1更新
2025.3|后台版2.1更新
2025.3|后台版2.0更新
2025.3|后台版1.0更新
2025.2|开源版上传Github
2025.2|第一版html版网页出世
</pre>
            </div>