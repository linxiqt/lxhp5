/*
 Navicat Premium Dump SQL
 Source Server         : bbb
 Source Server Type    : SQLite
 Source Server Version : 3045000 (3.45.0)
 Source Schema         : main
 Target Server Type    : SQLite
 Target Server Version : 3045000 (3.45.0)
 File Encoding         : 65001
 Date: 01/11/2024 13:25:20
*/
PRAGMA foreign_keys = false;
-- ----------------------------
-- Table structure for sqlite_sequence
-- ----------------------------
-- ----------------------------
-- Records of sqlite_sequence
-- ----------------------------
-- ----------------------------
-- Table structure for zyyo_data
-- ----------------------------
DROP TABLE IF EXISTS "zyyo_data";
CREATE TABLE "zyyo_data" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "user" TEXT(255),
  "pwd" INTEGER,
  "sitename" TEXT(255),
  "keywords" TEXT(255),
  "description" TEXT(255),
  "ico" TEXT(255),
  "logo" TEXT(255),
  "author" TEXT(255),
  "title1" TEXT(255),
  "title2" TEXT(255),
  "beian" TEXT(255),
  "header" TEXT(255),
  "footer" TEXT(255),
  "bgurl" TEXT(255),
  "mobbgurl" TEXT(255),
  "footurl" TEXT(255),
  "icon" TEXT(255),
  "blog1" TEXT(255),
  "blog2" TEXT(255),
  "blog3" TEXT(255),
  "blog4" TEXT(255),
  "bili1" TEXT(255),
  "bili2" TEXT(255),
  "bili3" TEXT(255),
  "bili4" TEXT(255),
  "bili5" TEXT(255),
  "qq1" TEXT(255),
  "qq2" TEXT(255),
  "qq3" TEXT(255),
  "qq4" TEXT(255),
  "music" TEXT(255),
  "musiccover" TEXT(255),
  "musicurl" TEXT(255),
  "yiyan" TEXT(255),
  "smtp" TEXT(255),
  "mail" TEXT(255),
  "mailuser" TEXT(255),
  "mailpwd" TEXT(255),
  "yourmail" TEXT(255),
  "aside_url" TEXT(255),
  "aside_gonggao" TEXT(255),
  "aside_stats" TEXT(255),
  "blog" TEXT(255),
  "lazyload" TEXT(255),
  "login_button" TEXT(255),
 "today_count" INTEGER DEFAULT 0,
"last_date" TEXT(255),
"total_count" INTEGER DEFAULT 0
);
-- ----------------------------
-- Records of zyyo_data
-- ----------------------------
INSERT INTO "zyyo_data" VALUES (
1, 
'admin',
123456, 
'YILXIY', 
'YILXIY,伊linxiyy个人主页', 
'风带来种子，时间使之发芽',
'./static/img/favicon.ico', 
'./static/img/favicon.ico',
'./static/img/tx.jpg', 
'标题1',
'标题2',
'备案码', 
'<!--这里只能放link之类的-->', 
'<!--这里是随意的底部html-->',
'../img/lxbg.jpeg',
'../img/lxbg.jpeg',
'./static/img/lxbg.jpeg', 
'1,2,3,4,5',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'./static/img/tx.jpg',
'../img/lxbg.jpeg',
'',
'',
''
);
-- ----------------------------
-- Table structure for zyyo_icon
-- ----------------------------
DROP TABLE IF EXISTS "zyyo_icon";
CREATE TABLE "zyyo_icon" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "tip" TEXT(255),
  "icon" TEXT(255),
  "href" TEXT(255),
  "onclick" TEXT(255),
  "power" TEXT(255) DEFAULT 0
);
-- ----------------------------
-- Records of zyyo_icon
-- ----------------------------

-- ----------------------------
-- Table structure for zyyo_item
-- ----------------------------
DROP TABLE IF EXISTS "zyyo_item";
CREATE TABLE "zyyo_item" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" TEXT(255),
  "des" TEXT(255),
  "icon" TEXT(255),
  "project" INTEGER,
  "href" TEXT(255),
  "power" TEXT(255) DEFAULT 0
);
-- ----------------------------
-- Records of zyyo_item
-- ----------------------------
INSERT INTO "zyyo_item" VALUES (1, '博客', '记录摆烂日常', './static/img/tx.jpg', 1, 'https://yilx.net',0);
INSERT INTO "zyyo_item" VALUES (2, '文档站', '记录学习笔记', './static/img/tx.jpg', 1, 'https://yilx.net',0);
INSERT INTO "zyyo_item" VALUES (3, '测试', '测试', './static/img/tx.jpg', 1, 'https://yilx.cc',0);
INSERT INTO "zyyo_item" VALUES (4, '测试', '测试', './static/img/tx.jpg', 1, 'https://yilx.cc',0);
INSERT INTO "zyyo_item" VALUES (5, 'YILXIY主页', '本站同款', './static/img/tx.jpg', 2, 'https://github.com/linxiqt/homepage',0);
INSERT INTO "zyyo_item" VALUES (6, 'API', 'API站', './static/img/tx.jpg', 2, 'https://api.yilx.net',0);
-- ----------------------------
-- Table structure for zyyo_project
-- ----------------------------
DROP TABLE IF EXISTS "zyyo_project";
CREATE TABLE "zyyo_project" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" TEXT(255),
  "icon" TEXT(255),
  "power" TEXT(255) DEFAULT 0
);
-- ----------------------------
-- Records of zyyo_project
-- ----------------------------
INSERT INTO "zyyo_project" VALUES (1, 'site', '<svg t="1705257422086" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1891">
                        <path d="M629.333333 202.666667v213.333333h277.333334v448h-512v-213.333333h-277.333334v-448h512z m213.333334 277.333333h-213.333334v170.666667h-170.666666v149.333333h384v-320z m-277.333334-213.333333h-384v320h213.333334v-170.666667h170.666666v-149.333333z m0 213.333333h-106.666666v106.666667h106.666666v-106.666667z" p-id="1892"></path>
                    </svg>', 0);
INSERT INTO "zyyo_project" VALUES (2, 'project', '<svg t="1705257422086" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1891">
                        <path d="M629.333333 202.666667v213.333333h277.333334v448h-512v-213.333333h-277.333334v-448h512z m213.333334 277.333333h-213.333334v170.666667h-170.666666v149.333333h384v-320z m-277.333334-213.333333h-384v320h213.333334v-170.666667h170.666666v-149.333333z m0 213.333333h-106.666666v106.666667h106.666666v-106.666667z" p-id="1892"></path>
                    </svg>', 0);




DROP TABLE IF EXISTS "zyyo_nav";
CREATE TABLE "zyyo_nav" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" TEXT(255),
  "href" TEXT(255),
  "power" TEXT(255) DEFAULT 0,
  "parent" TEXT(255) DEFAULT 0
);
-- ----------------------------
-- Records of zyyo_project
-- ----------------------------
INSERT INTO "zyyo_nav" VALUES (1, '链接1', 'http://yilx.net',0,0);
INSERT INTO "zyyo_nav" VALUES (2, '链接2', 'http://yilx.net',0,0);






DROP TABLE IF EXISTS "zyyo_friends";
CREATE TABLE "zyyo_friends" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" TEXT(255),
  "des" TEXT(255),
  "mail" TEXT(255),
  "ico" TEXT(255),
  "href" TEXT(255),
  "status" TEXT(255) DEFAULT 1,
  "power" TEXT(255) DEFAULT 0
);
-- ----------------------------
-- Records of zyyo_project
-- ----------------------------

-- Auto increment value for zyyo_data
-- ----------------------------






-- ----------------------------
-- Table structure for zyyo_category
-- ----------------------------
DROP TABLE IF EXISTS "zyyo_category";
CREATE TABLE "zyyo_category" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "icon" TEXT(255), 
  "name" TEXT(255),                              
  "power" TEXT(255) DEFAULT 0             
);

-- ----------------------------
-- Table structure for zyyo_article
-- ----------------------------
DROP TABLE IF EXISTS "zyyo_article";
CREATE TABLE "zyyo_article" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "title" TEXT(255) NOT NULL,              
  "cover" TEXT(255),                       
  "description" TEXT(255),                 
  "content" TEXT,                         
  "category_id" INTEGER NOT NULL,          
  "views" INTEGER DEFAULT 0,              
  "created_time" DATETIME DEFAULT (datetime('now','localtime')),
  "updated_time" DATETIME DEFAULT (datetime('now','localtime')), 
  "status" INTEGER DEFAULT 1,             
  "power" TEXT(255) DEFAULT 0,             
  
  FOREIGN KEY ("category_id") REFERENCES "zyyo_category"("id") 
);




-- 添加默认分类
INSERT INTO zyyo_category (icon, name, power) VALUES
  ('icon_tech.png', '技术', '0'),
  ('icon_life.png', '生活', '0'),
  ('icon_other.png', '其他', '0');

-- 添加默认文章（假设新添加分类的id为1、2、3）
INSERT INTO zyyo_article (title, cover, description, content, category_id) VALUES
  ('欢迎使用内容管理系统', './static/img/tx.jpg', '系统使用指南', '本文介绍系统的基本功能和使用方法...', 1),
  ('健康饮食指南', './static/img/tx.jpg', '营养均衡小贴士', '每日膳食搭配建议...', 2),
  ('高效工作技巧', './static/img/tx.jpg', '提升工作效率', '时间管理方法与工具推荐...', 1),
  ('城市旅行攻略', './static/img/tx.jpg', '探索城市之美', '热门城市景点路线规划...', 2),
  ('编程入门教程', 'code_cover.jpg', 'Python基础教学', '变量、循环和函数的使用...', 1);




PRAGMA foreign_keys = true;
