<?php
require './db.php'; // 確保路徑正確，指向您的 db.php 文件

// 測試連線是否成功
if ($conn) {
    echo "Connected to the database.";
} else {
    echo "Failed to connect to the database.";
}
?>
