<div class="card">
    <header class="card-header">
        <div class="card-title">项目列表</div>
    </header>
    <div class="card-body">
        <div class="card-search mb-2-5">
        </div>
        <div class="new-item card-btns mb-2-5">
            <a class="btn btn-primary me-1" href="./index.php?do=edit-article">
                <i class="mdi mdi-plus"></i> 新增
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>标题</th>
                        <th>分类</th>
                        <th>浏览量</th>
                        <th>状态</th>
                        <th>发布时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM zyyo_article ORDER BY power DESC";
                    $result = DB::query($sql);
                    if ($result) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $type_id = $row["category_id"];
                            $type_query = "SELECT * FROM zyyo_category WHERE id = " . $type_id;
                            $type_result = DB::query($type_query);
                            $type_row = $type_result->fetch(PDO::FETCH_ASSOC);
                            $type = $type_row["name"];
                            $status =($row["status"] == 1) ? "正常" : "隐藏";
                            echo '<tr>
<td>' . $row["id"] . '</td>
<td>' . $row["title"] . '</td>
<td>' . $type . '</td>
<td>' . $row["views"] . '</td>
<td>' . $status . '</td>
<td>' . $row["created_time"] . '</td>
<td>' . $row["updated_time"] . '</td>
<td>
<div class="btn-group btn-group-sm">
<a class="btn btn-default" href="./index.php?do=edit-article&id=' . $row["id"] . '" data-bs-toggle="tooltip" title="编辑"><i class="mdi mdi-pencil"></i></a>
<a class="btn btn-default" onclick="del(\'zyyo_article\', \'' . $row["id"] . '\')" href="#!" data-bs-toggle="tooltip" title="删除"><i class="mdi mdi-window-close"></i></a>
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
  
</script>