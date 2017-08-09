/*
Navicat MySQL Data Transfer

Source Server         : iuan
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-03-06 18:13:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hd_access`
-- ----------------------------
DROP TABLE IF EXISTS `hd_access`;
CREATE TABLE `hd_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_access
-- ----------------------------
INSERT INTO `hd_access` VALUES ('1', '6', '1', null);
INSERT INTO `hd_access` VALUES ('1', '21', '2', null);
INSERT INTO `hd_access` VALUES ('1', '22', '3', null);
INSERT INTO `hd_access` VALUES ('1', '23', '3', null);
INSERT INTO `hd_access` VALUES ('1', '24', '2', null);
INSERT INTO `hd_access` VALUES ('1', '25', '3', null);
INSERT INTO `hd_access` VALUES ('1', '7', '2', null);
INSERT INTO `hd_access` VALUES ('1', '8', '3', null);
INSERT INTO `hd_access` VALUES ('1', '9', '3', null);
INSERT INTO `hd_access` VALUES ('1', '10', '3', null);
INSERT INTO `hd_access` VALUES ('1', '11', '3', null);
INSERT INTO `hd_access` VALUES ('1', '12', '3', null);
INSERT INTO `hd_access` VALUES ('1', '13', '3', null);
INSERT INTO `hd_access` VALUES ('1', '14', '2', null);
INSERT INTO `hd_access` VALUES ('1', '17', '3', null);
INSERT INTO `hd_access` VALUES ('1', '16', '3', null);
INSERT INTO `hd_access` VALUES ('1', '15', '3', null);
INSERT INTO `hd_access` VALUES ('2', '14', '2', null);
INSERT INTO `hd_access` VALUES ('2', '26', '3', null);
INSERT INTO `hd_access` VALUES ('2', '25', '3', null);
INSERT INTO `hd_access` VALUES ('2', '24', '2', null);
INSERT INTO `hd_access` VALUES ('3', '16', '3', null);
INSERT INTO `hd_access` VALUES ('3', '17', '3', null);
INSERT INTO `hd_access` VALUES ('3', '14', '2', null);
INSERT INTO `hd_access` VALUES ('3', '26', '3', null);
INSERT INTO `hd_access` VALUES ('3', '25', '3', null);
INSERT INTO `hd_access` VALUES ('3', '24', '2', null);
INSERT INTO `hd_access` VALUES ('2', '6', '1', null);
INSERT INTO `hd_access` VALUES ('3', '6', '1', null);
INSERT INTO `hd_access` VALUES ('2', '17', '3', null);
INSERT INTO `hd_access` VALUES ('2', '16', '3', null);
INSERT INTO `hd_access` VALUES ('2', '15', '3', null);
INSERT INTO `hd_access` VALUES ('3', '15', '3', null);

-- ----------------------------
-- Table structure for `hd_blog`
-- ----------------------------
DROP TABLE IF EXISTS `hd_blog`;
CREATE TABLE `hd_blog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `typeid` int(10) NOT NULL,
  `flag` varchar(20) DEFAULT NULL,
  `title` varchar(30) NOT NULL,
  `content` text,
  `createtime` varchar(10) NOT NULL,
  `click` smallint(6) NOT NULL DEFAULT '0',
  `write` varchar(20) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `litpic` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `ispass` mediumint(2) NOT NULL,
  `arcrank` tinyint(1) NOT NULL DEFAULT '1',
  `voteid` tinyint(2) DEFAULT NULL,
  `mid` tinyint(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `hd_cate`
-- ----------------------------
DROP TABLE IF EXISTS `hd_cate`;
CREATE TABLE `hd_cate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `modelid` int(10) NOT NULL DEFAULT '1',
  `modeltype` int(2) NOT NULL DEFAULT '0',
  `linkurl` varchar(255) NOT NULL,
  `name` char(15) NOT NULL,
  `fid` int(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `tpllist` varchar(255) NOT NULL DEFAULT 'index',
  `tplshow` varchar(255) NOT NULL DEFAULT 'index',
  `sort` smallint(6) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `hd_node`
-- ----------------------------
DROP TABLE IF EXISTS `hd_node`;
CREATE TABLE `hd_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_node
-- ----------------------------
INSERT INTO `hd_node` VALUES ('6', 'Admin', '后台管理', '1', null, '1', '0', '1');
INSERT INTO `hd_node` VALUES ('7', 'Rbac', 'RBAC权限控制', null, null, '6', '6', '2');
INSERT INTO `hd_node` VALUES ('8', 'index', '用户列表', '1', null, '1', '7', '3');
INSERT INTO `hd_node` VALUES ('9', 'role', '角色列表', '1', null, '1', '7', '3');
INSERT INTO `hd_node` VALUES ('10', 'node', '节点列表', '1', null, '1', '7', '3');
INSERT INTO `hd_node` VALUES ('11', 'addUser', '添加用户', '1', null, '1', '7', '3');
INSERT INTO `hd_node` VALUES ('12', 'addRole', '添加角色', '1', null, '1', '7', '3');
INSERT INTO `hd_node` VALUES ('13', 'addNode', '添加节点', '1', null, '1', '7', '3');
INSERT INTO `hd_node` VALUES ('14', 'Blog', '文章管理', null, null, '1', '6', '2');
INSERT INTO `hd_node` VALUES ('15', 'index', '文章列表', null, null, '1', '14', '3');
INSERT INTO `hd_node` VALUES ('16', 'blog', '添加文章', null, null, '1', '14', '3');
INSERT INTO `hd_node` VALUES ('17', 'trach', '回收站', '1', null, '1', '14', '3');
INSERT INTO `hd_node` VALUES ('21', 'Category', '分类管理', null, null, '2', '6', '2');
INSERT INTO `hd_node` VALUES ('22', 'index', '分类列表', '1', null, '1', '21', '3');
INSERT INTO `hd_node` VALUES ('23', 'addCate', '添加分类', '1', null, '1', '21', '3');
INSERT INTO `hd_node` VALUES ('24', 'System', '系统设置', null, null, '5', '6', '2');
INSERT INTO `hd_node` VALUES ('25', 'verify', '验证码设置', '1', null, '1', '24', '3');
INSERT INTO `hd_node` VALUES ('26', 'modifyPass', '修改密码', null, null, '3', '24', '3');
INSERT INTO `hd_node` VALUES ('27', 'webset', '站点设置', null, null, '2', '24', '3');
INSERT INTO `hd_node` VALUES ('28', 'FileManage', '文件管理', null, null, '7', '6', '2');
INSERT INTO `hd_node` VALUES ('29', 'index', '文件目录', '1', null, '1', '28', '3');
INSERT INTO `hd_node` VALUES ('30', 'Database', '数据备份', null, null, '4', '6', '2');
INSERT INTO `hd_node` VALUES ('31', 'index', '数据列表', '1', null, '1', '30', '3');
INSERT INTO `hd_node` VALUES ('32', 'importdata', '还原数据', '1', null, '1', '30', '3');
INSERT INTO `hd_node` VALUES ('33', 'Tpl', '模版主题', null, null, '3', '6', '2');
INSERT INTO `hd_node` VALUES ('34', 'index', '主题设置', '1', null, '1', '33', '3');
INSERT INTO `hd_node` VALUES ('35', 'import', '导入主题', '1', null, '1', '33', '3');

-- ----------------------------
-- Table structure for `hd_role`
-- ----------------------------
DROP TABLE IF EXISTS `hd_role`;
CREATE TABLE `hd_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_role
-- ----------------------------
INSERT INTO `hd_role` VALUES ('1', '管理员', null, '1', '管理整个网站');
-- INSERT INTO `hd_role` VALUES ('2', '网站编辑', null, '1', '编辑文章');
-- INSERT INTO `hd_role` VALUES ('3', '网站编辑', null, '1', '网站编辑');

-- ----------------------------
-- Table structure for `hd_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `hd_role_user`;
CREATE TABLE `hd_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_role_user
-- ----------------------------

-- ----------------------------
-- Table structure for `hd_session`
-- ----------------------------
DROP TABLE IF EXISTS `hd_session`;
CREATE TABLE `hd_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hd_session
-- ----------------------------
INSERT INTO `hd_session` VALUES ('iultb3u78i4qkpmg01nicheki0', '1385947826', 0x7665726966797C733A323A223966223B);

-- ----------------------------
-- Table structure for `hd_user`
-- ----------------------------
DROP TABLE IF EXISTS `hd_user`;
CREATE TABLE `hd_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `logintime` varchar(50) NOT NULL,
  `loginip` varchar(20) NOT NULL,
  `createtime` varchar(50) NOT NULL,
  `loginnum` int(10) NOT NULL DEFAULT '0',
  `modifytime` varchar(50) NOT NULL,
  `lock` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;