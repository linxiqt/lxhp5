<?php



function getPostContent($id)
{
    $Parsedown = new Parsedown();
    $Parsedown->setSafeMode(true);

    $mdDir = __DIR__ . '/../../articles/';

    $mdFile = $mdDir . $id . '.md';

    if (file_exists($mdFile)) {
        $mdtext = file_get_contents($mdFile);
        $content = $Parsedown->text($mdtext);
        $content = addCodeBlockHeader($content);
        return $content;
    } else {
        return '暂无内容';
    }

}
function addCodeBlockHeader($content)
{
    $content = preg_replace_callback('/<pre><code(.*?)>(.*?)<\/code><\/pre>/s', function ($matches) {
        $attributes = $matches[1];
        $codeContent = $matches[2];

        return '
        <div class="code-container">
            <div class="code-header">
                <div class="window-buttons">
                    <span class="btn red"></span>
                    <span class="btn yellow"></span>
                    <span class="btn green"></span>
                </div>
                <button class="copy-btn">复制</button>
            </div>
            <pre><code' . $attributes . '>' . $codeContent . '</code></pre>
        </div>';
    }, $content);

    return $content;
}


function updateStatistics()
{
    global $data;
    try {
        $today = date('Y-m-d');
        $result = $data;

        // 显式转换为整数
        $currentTodayCount = (int)($result['today_count'] ?? 0);
        $currentTotalCount = (int)($result['total_count'] ?? 0);

        if ($result['last_date'] != $today) {
            $newTodayCount = 1;
            $updateDate = $today;
        } else {
            $newTodayCount = $currentTodayCount + 1; 
            $updateDate = $result['last_date'];
        }

        $newTotalCount = $currentTotalCount + 1; 

        DB::query("
            UPDATE zyyo_data 
            SET 
                today_count = {$newTodayCount},
                last_date = '{$updateDate}',
                total_count = {$newTotalCount}
            WHERE id = 1
        ");
    } catch (Exception $e) {
       
    }
}


function echoNav()
{
    global $data, $page;
    $sql = "SELECT * FROM zyyo_nav ORDER BY power DESC";
    $result = DB::query($sql);

    if ($result) {
        $navItems = [];
        // 按父级ID分组导航项
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $parentId = $row['parent'];
            $navItems[$parentId][] = $row;
        }

        // 生成导航菜单
        if (isset($navItems[0])) {
            foreach ($navItems[0] as $parentItem) {
                $parentId = $parentItem['id'];
                $hasChildren = isset($navItems[$parentId]);

                if ($hasChildren) {
                    // 下拉菜单结构
                    echo '<div class="dropdown">';
                    echo '<a class="nav-item dropdown-toggle" href="' . htmlspecialchars($parentItem['href']) . '">';
                    if (!empty($parentItem['icon'])) {
                        echo '<i class="menu-icon">' . htmlspecialchars($parentItem['icon']) . '</i>';
                    }
                    echo '<span>' . htmlspecialchars($parentItem['name']) . '</span>';
                    echo '<i class="arrow">▼</i></a>';

                    echo '<div class="dropdown-menu">';
                    foreach ($navItems[$parentId] as $childItem) {
                        echo '<a href="' . htmlspecialchars($childItem['href']) . '" class="dropdown-item" target="_blank">'
                            . htmlspecialchars($childItem['name']) . '</a>';
                    }
                    echo '</div></div>';
                } else {
                    // 普通导航项
                    echo '<a class="nav-item" '
                        . 'href="' . htmlspecialchars($parentItem['href']) . '" target="_blank">';
                    if (!empty($parentItem['icon'])) {
                        echo '<i class="menu-icon">' . htmlspecialchars($parentItem['icon']) . '</i>';
                    }
                    echo '<span>' . htmlspecialchars($parentItem['name']) . '</span></a>';
                }
            }
        }
    }
}
function echoMobileNav()
{
    global $data;
    $sql = "SELECT * FROM zyyo_nav ORDER BY power DESC";
    $result = DB::query($sql);

    if ($result) {
        $navItems = [];
        // 按父级ID分组导航项
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $parentId = $row['parent'];
            $navItems[$parentId][] = $row;
        }

        // 生成一级菜单
        if (isset($navItems[0])) {
            foreach ($navItems[0] as $parentItem) {
                $parentId = $parentItem['id'];
                $hasChildren = isset($navItems[$parentId]);

                if ($hasChildren) {
                    // 带子菜单的项
                    echo '<div class="menu-item has-submenu">';
                    echo '<div class="submenu-header">'; // 添加点击事件
                    echo '<span>' . htmlspecialchars($parentItem['name']) . '</span>';
                    echo '<i class="arrow">▶</i>';
                    echo '</div>';
                    echo '<div class="submenu">';
                    foreach ($navItems[$parentId] as $childItem) {
                        echo '<a class="submenu-item" href="' . htmlspecialchars($childItem['href']) . '" target="_blank">'
                            . '<span>' . htmlspecialchars($childItem['name']) . '</span></a>';
                    }
                    echo '</div></div>';
                } else {
                    // 普通菜单项
                    echo '<a class="menu-item" href="' . htmlspecialchars($parentItem['href']) . '" target="_blank">';
                    echo '<span>' . htmlspecialchars($parentItem['name']) . '</span></a>';
                }
            }
        }
    }
}

function echoFriends()
{
    global $data;
    $sql = "SELECT * FROM zyyo_friends WHERE status=1 ORDER BY power DESC";
    $result = DB::query($sql);
    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<a class="friend-link" href="' . $row["href"] . '" target="_blank"><div class="link-logo"><img class="lazy" data-original="'
                . $row["ico"] . '"></div>
                <div class="link-info"><h3>' . $row["name"] . '</h3><p>' . $row["des"] . '</p></div>
            </a>';
        }
    }
}
function echoList()
{
    global $data;
    // 直接查询所有项目并关联分类表
    $sql = "SELECT zyyo_item.*, zyyo_project.name AS project_name 
            FROM zyyo_item 
            LEFT JOIN zyyo_project ON zyyo_item.project = zyyo_project.id 
            ORDER BY zyyo_item.power DESC";
    $result = DB::query($sql);
    if ($result) {
        echo '<div class="api-cards">';
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<a class="api-card" target="_blank" href="' . $row["href"] . '">
                  <img class="lazy" data-original="' . $row["icon"] . '" alt="">
                <div class="overlay">
                      <h3>' . $row["name"] . '</h3><p>' . $row["des"] . '</p>
                      <p>' . $row["project_name"] . '</p>
                </div>
                </a>';
        }
        echo "</div>";
    }
}


function echoPostList($page = 1, $perpage = 10)
{
    // 参数安全处理
    $page = max(1, intval($page));
    $perpage = max(1, intval($perpage));
    $offset = ($page - 1) * $perpage;

    // 获取总记录数
    $countSql = "SELECT COUNT(*) AS total FROM zyyo_article";
    $totalResult = DB::query($countSql);
    $totalRow = $totalResult->fetch(PDO::FETCH_ASSOC);
    $totalPosts = $totalRow['total'];
    $totalPages = ceil($totalPosts / $perpage);

    // 数据查询
    $sql = "SELECT zyyo_article.*, zyyo_category.name AS category_name 
            FROM zyyo_article 
            LEFT JOIN zyyo_category ON zyyo_article.category_id = zyyo_category.id 
            ORDER BY zyyo_article.power DESC
            LIMIT :offset, :perpage";

    $result = DB::query($sql, [
        ':offset' => $offset,
        ':perpage' => $perpage
    ]);

    // 输出文章列表
    echo '<div class="api-cards">';
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<a class="api-card api-card1" href="./post.php?id=' . $row["id"] . '">
                  <img class="lazy" data-original="' . $row["cover"] . '" alt="">
                <div class="overlay">
                      <h3>' . $row["title"] . '</h3><p>' . $row["description"] . '</p>
                      <p>' . $row["category_name"] . '</p>
                </div>
                </a>';
        }
   
    echo "</div>";

    // 生成分页导航
    generatePagination($page, $totalPages);
}
   
function generatePagination($currentPage, $totalPages) {
    if ($totalPages <= 1) return;

    echo '<ul class="pagination">';
    
    // 上一页按钮
    if ($currentPage > 1) {
        echo '<li><a href="?page='.($currentPage - 1).'">«</a></li>';
    }

    // 计算页码范围（显示当前页前后各2页）
    $startPage = max(1, $currentPage - 2);
    $endPage = min($totalPages, $currentPage + 2);
    
    // 确保显示5个页码（如果可能）
    if ($endPage - $startPage < 4) {
        if ($currentPage < 3) {
            $endPage = min($totalPages, 5);
        } else {
            $startPage = max(1, $totalPages - 4);
        }
    }
    
    // 显示页码
    for ($i = $startPage; $i <= $endPage; $i++) {
        $activeClass = ($i == $currentPage) ? ' class="active"' : '';
        echo '<li'.$activeClass.'><a href="?page='.$i.'">'.$i.'</a></li>';
    }
    
    // 下一页按钮
    if ($currentPage < $totalPages) {
        echo '<li><a href="?page='.($currentPage + 1).'">»</a></li>';
    }
    
    echo '</ul>';
}