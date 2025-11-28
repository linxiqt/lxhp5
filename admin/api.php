<?php
include_once '../usr/inc.php';
$do = isset($_POST['do']) ? $_POST['do'] : '0';
header('Content-Type: application/json');
if ($adminlogin != 1) {
    json(['code' => 0, 'msg' => '未登录！']);
    exit();
}
function escape_POST_params()
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = str_replace("'", "''", $value);
    }
}
escape_POST_params();
if ($do == "base") {
    if (isset($_POST['user']) && isset($_POST['pwd'])) {
        // 定义允许更新的字段列表
        $allowedFields = [
            'sitename',
            'keywords',
            'user',
            'pwd',
            'description',
            'ico',
            'logo',
            'author',
            'beian',
            'title1',
            'title2',
            'header',
            'footer',
            'icon',
            'bgurl',
            'mobbgurl',
            'footurl',
            'music',
            'musicurl',
            'musiccover',
            'yiyan',
            'blog1',
            'blog2',
            'blog3',
            'blog4',

            'bili1',
            'bili2',
            'bili3',
            'bili4',
            'bili5',
            'qq1',
            'qq2',
            'qq3',
            'qq4',
            'smtp',
            'mailuser',
            'mail',
            'mailpwd',
            'aside_url',
            'aside_gonggao',
            'aside_stats',
            'blog',
            'lazyload',
            'login_button'
        ];

        $updates = [];
        foreach ($allowedFields as $field) {
            if (isset($_POST[$field])) {
                $value = $_POST[$field]; // 假设有转义函数
                $updates[] = "$field='$value'";
            }
        }

        if (!empty($updates)) {
            $sql = "UPDATE zyyo_data SET " . implode(', ', $updates) . " WHERE id=1";
            if (DB::query($sql)) {
                json(['code' => 1, 'msg' => '更新成功！']);
            } else {
                json(['code' => 0, 'msg' => '数据库错误：' . DB::error()]);
            }
        } else {
            json(['code' => 0, 'msg' => '没有可更新的字段']);
        }
    } else {
        json(['code' => 0, 'msg' => '缺少必要参数']);
    }
} else if ($do == "newproject") {
    if (isset($_POST['name']) && isset($_POST['icon'])) {
        $name = $_POST['name'];
        $icon = $_POST['icon'];
        $sql = "INSERT INTO zyyo_project (name, icon) VALUES ('$name', '$icon')";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "newcategory") {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $sql = "INSERT INTO zyyo_category (name) VALUES ('$name')";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "newnav") {
    if (isset($_POST['name']) && isset($_POST['href'])) {
        $name = $_POST['name'];
        $href = $_POST['href'];
        $parent = $_POST['parent'];
        $sql = "INSERT INTO zyyo_nav (name, href,parent) VALUES ('$name', '$href','$parent')";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "newfriends") {
    if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['des']) && isset($_POST['ico']) && isset($_POST['href'])) {
        $name = $_POST['name'];
        $des = $_POST['des'];
        $ico = $_POST['ico'];
        $href = $_POST['href'];
        $mail = $_POST['mail'];
        $sql = "INSERT INTO zyyo_friends (name,des,ico ,href,mail) VALUES ('$name', '$des', '$ico', '$href','$mail')";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "newitem") {
    if (isset($_POST['name']) && isset($_POST['icon']) && isset($_POST['des']) && isset($_POST['href']) && isset($_POST['project'])) {
        $name = $_POST['name'];
        $icon = $_POST['icon'];
        $des = $_POST['des'];
        $href = $_POST['href'];
        $project = $_POST['project'];
        $sql = "INSERT INTO zyyo_item (name, icon, des, href, project) VALUES ('$name', '$icon', '$des', '$href', '$project')";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "del") {
    if (isset($_POST['c']) && isset($_POST['id'])) {
        $class = $_POST['c'];
        $id = $_POST['id'];
        $sql = "DELETE FROM `$class` WHERE `id` = $id";
        if (@DB::query($sql) == TRUE) {
            if ($class === 'zyyo_project') {
                $sql1 = "DELETE FROM `zyyo_item` WHERE `project` = $id";
                if (@DB::query($sql1) == FALSE) {
                    json(['code' => 0, 'msg' => '删除zyyo_item表失败！' . DB::error()]);
                } else {
                    json(['code' => 1, 'msg' => '成功！']);
                }
            } else {
                json(['code' => 1, 'msg' => '成功！']);
            }
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "totop") {
    if (isset($_POST['c']) && isset($_POST['id'])) {
        $class = $_POST['c'];
        $id = $_POST['id'];
        $sql = "UPDATE `$class` SET `power` = `power` + 1 WHERE `id` = $id";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "tobottom") {
    if (isset($_POST['c']) && isset($_POST['id'])) {
        $class = $_POST['c'];
        $id = $_POST['id'];
        $sql = "UPDATE `$class` SET `power` = `power` - 1 WHERE `id` = $id";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "edititem") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['icon']) && isset($_POST['des']) && isset($_POST['href']) && isset($_POST['project'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $icon = $_POST['icon'];
        $des = $_POST['des'];
        $href = $_POST['href'];
        $project = $_POST['project'];
        $sql = "UPDATE zyyo_item SET name='$name', icon='$icon', des='$des', href='$href', project='$project' WHERE id='$id'";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "editproject") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['icon'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $icon = $_POST['icon'];
        $sql = "UPDATE zyyo_project SET name='$name', icon='$icon', WHERE id='$id'";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "editnav") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['href'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $href = $_POST['href'];
        $sql = "UPDATE zyyo_nav SET name='$name', href='$href' WHERE id='$id'";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "editfriends") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['des']) && isset($_POST['ico']) && isset($_POST['href'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $des = $_POST['des'];
        $ico = $_POST['ico'];
        $href = $_POST['href'];
        $sql = "UPDATE zyyo_friends SET name='$name', des='$des', ico='$ico', href='$href' WHERE id='$id'";
        if (@DB::query($sql) == TRUE) {
            json(['code' => 1, 'msg' => '成功！']);
        } else {
            json(['code' => 0, 'msg' => '错误！' . DB::error()]);
        }
    } else {
        json(['code' => 0, 'msg' => '参数不足！']);
    }
} else if ($do == "editarticle") {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['cover']) && isset($_POST['category_id'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $cover = $_POST['cover'];
        $status = isset($_POST['status']) ? 1 : 0;
        $category_id = $_POST['category_id'];
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        // 定义MD文件存储目录
        $mdDir = '../articles/';
        if (!file_exists($mdDir)) {
            mkdir($mdDir, 0755, true);
        }

        // 处理MD文件上传的函数
        function handleMdFile($id, $mdDir)
        {
            if (isset($_FILES['md_file']) && $_FILES['md_file']['error'] === UPLOAD_ERR_OK) {
                $fileInfo = $_FILES['md_file'];

                // 检查文件类型
               // $allowedTypes = ['text/markdown', 'text/x-markdown', 'text/plain'];
             //   $fileType = mime_content_type($fileInfo['tmp_name']);
             //   if (!in_array($fileType, $allowedTypes)) {
             //       return ['success' => false, 'msg' => '只允许上传MD文件'];
//}

                // 检查文件大小（5MB）
                if ($fileInfo['size'] > 5 * 1024 * 1024) {
                    return ['success' => false, 'msg' => '文件大小不能超过5MB'];
                }

                $filename = $id . '.md';
                $destination = $mdDir . $filename;
                if (!move_uploaded_file($fileInfo['tmp_name'], $destination)) {
                    return ['success' => false, 'msg' => '文件保存失败'];
                }
            }
            return ['success' => true];
        }

        if ($id) {
            // 更新现有文章
            $sql = "UPDATE zyyo_article SET title='$title', description='$description', cover='$cover', status='$status', category_id='$category_id' WHERE id='$id'";
            $result = DB::query($sql);
            if ($result) {
                $fileResult = handleMdFile($id, $mdDir);
                if (!$fileResult['success']) {
                    json(['code' => 0, 'msg' => $fileResult['msg']]);
                    exit;
                }
                json(['code' => 1, 'msg' => '更新成功！']);
            } else {
                json(['code' => 0, 'msg' => '更新失败：' . DB::error()]);
            }
        } else {
            // 新增文章
            $sql = "INSERT INTO zyyo_article (title, description, cover, status, category_id) VALUES ('$title', '$description', '$cover', '$status', '$category_id')";
            $result = DB::query($sql);
            if ($result) {

                $newId = DB::lastInsertId(); // 直接调用新方法获取ID

                $fileResult = handleMdFile($newId, $mdDir);
                if (!$fileResult['success']) {
                    json(['code' => 0, 'msg' => $fileResult['msg']]);
                    exit;
                }
                json(['code' => 1, 'msg' => '新增成功！']);
            } else {
                json(['code' => 0, 'msg' => '新增失败：' . DB::error()]);
            }
        }
    } else {
        json(['code' => 0, 'msg' => '缺少必要参数！']);
    }
}