<?php
/**
 * 安装程序调用,天干表数据
 **/

$table = DB::table('bazi_dict_tiangan');
$cols = '(`name`,`num`,`yy`,`wuxing`,`zhangsheng`)';
$sql = "INSERT IGNORE INTO $table $cols VALUES ".<<<EOF
('甲',0,'阳','木','亥'),
('乙',1,'阴','木','午'),
('丙',2,'阳','火','寅'),
('丁',3,'阴','火','酉'),
('戊',4,'阳','土','寅'),
('己',5,'阴','土','酉'),
('庚',6,'阳','金','巳'),
('辛',7,'阴','金','子'),
('壬',8,'阳','水','申'),
('癸',9,'阴','水','卯')
EOF;
runquery($sql);

