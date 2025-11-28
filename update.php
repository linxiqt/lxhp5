<?php

include("./usr/inc.php");


$update_sql = <<<SQL
ALTER TABLE zyyo_data ADD COLUMN "blog1" TEXT(255);
ALTER TABLE zyyo_data ADD COLUMN "blog2" TEXT(255);
ALTER TABLE zyyo_data ADD COLUMN "blog3" TEXT(255);
ALTER TABLE zyyo_data ADD COLUMN "blog4" TEXT(255);
SQL;

// 分割SQL语句（按分号分割并过滤空语句）
$queries = array_filter(
    array_map('trim', explode(';', $update_sql)),
    function($query) { return !empty($query); }
);

// 逐条执行SQL语句
foreach ($queries as $sql) {
    try {
        DB::query($sql);
        // 可选：记录执行日志或输出结果
        // echo "Executed: " . substr($sql, 0, 50) . "...\n";
    } catch (Exception $e) {
        // 异常处理（如记录日志、回滚事务等）
        die("SQL执行失败: " . $e->getMessage());
    }
}