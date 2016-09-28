-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-04 11:21:01
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `films_tickets_manager`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `username` varchar(50) NOT NULL COMMENT '管理员名称、唯一',
  `password` varchar(45) NOT NULL COMMENT '管理员密码',
  `email` varchar(30) NOT NULL COMMENT '管理员邮箱',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'Guess', '70b9ccb63d6f7de8f2222cd03707a1c5', '923@qq.com'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '电影id',
  `fName` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '电影名称',
  `fType` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '电影类型',
  `fArea` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '地区',
  `fLanguage` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '语言',
  `fDuration` int(40) NOT NULL COMMENT '上映时期',
  `fActors` text CHARACTER SET utf8 NOT NULL COMMENT '主演',
  `fDirector` varchar(99) CHARACTER SET utf8 NOT NULL COMMENT '导演',
  `fCounts` int(4) NOT NULL DEFAULT '0' COMMENT '当前票数',
  `playStation` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '影院名称',
  `description` text CHARACTER SET utf8 NOT NULL COMMENT '电影剧情',
  `imgPath` varchar(120) CHARACTER SET utf8 NOT NULL COMMENT '电影封面',
  `playTime` int(20) unsigned NOT NULL COMMENT '上映时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fName` (`fName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `films`
--

INSERT INTO `films` (`id`, `fName`, `fType`, `fArea`, `fLanguage`, `fDuration`, `fActors`, `fDirector`, `fCounts`, `playStation`, `description`, `imgPath`, `playTime`) VALUES
(9, '美国队长3', '剧情,科幻,动作', '美国', '英语', 129, '克里斯．埃文斯 /小罗伯特．唐尼 /斯嘉丽．约翰逊 / 塞巴斯蒂安', '乔·卢素   安东尼·卢素', 999, '新远下沙', '奥创纪元之后，全球政府联合颁布法令，管控超能力活动。对这条法令的不同态度，使复仇者阵营一分为二，钢铁侠和美国队长各据一方，其他复仇者则不得不做出自己的选择，最终引发前任盟友间的史诗大战。', '../uploads/28dd157044b259f3ab160e3c371f4076.jpg', 0),
(10, 'X战警：天启', '动作/科幻/奇幻/冒险', '美国', '英语', 144, '詹妮弗．劳伦斯 /迈克尔．法斯宾德 /詹姆斯．麦卡沃伊 /奥斯卡', '布莱恩．辛格', 999, '新远下沙', '“天启”是漫威X战警世界里，能力最强大并且是史上首位变种人，自人类文明开始以来，便为世人当作天神来膜拜，他汲取多位变种人的超能力，演变成一位永生不死且无人能敌的超级变种人，历经数千年后，他再度觉醒，集结了多位强大的变种人意欲毁灭一切，重建世界秩序，当中包含失志的万磁王（迈克尔法斯宾德 饰）。当地球面临未知的巨大危机之际，瑞雯（詹妮弗劳伦斯 饰）在X教授（詹姆斯麦卡沃伊 饰）的协助之下，必须领导年轻的X战警们力抗这史上最强大的敌人，并扭转人类命运。', '../uploads/5e1340703e1be48ae98709ef7150c467.jpg', 0),
(11, '魔兽', '动作/战争/奇幻/冒险', '美国', '英语', 124, '崔维斯．费米尔 /本．福斯特 /托比．凯贝尔 /宝拉．巴顿 /多米尼', '邓肯．琼斯', 999, '新远下沙', '平静祥和的艾泽拉斯大陆陷入战争即将爆发的边缘，它的文明遭到令人畏惧的种族的侵略：兽人战士逃离濒临灭亡的家园，意欲占领新的土地。黑暗之门开启，两个世界连接在了一起。一方阵营面临着毁灭，一方阵营面临着消亡。敌对的两位英雄不得不展开生死较量，他们各自的家人、人民和家园的命运悬于一线。', '../uploads/f2b14784fcc5eddde6d065dfc5c142af.jpg', 0),
(12, '爱丽丝梦游仙境2：镜中奇遇记', '冒险/家庭/奇幻', '美国', '英语', 115, '米娅．华希科沃斯卡 /约翰尼．德普 /海伦娜．伯翰．卡特 /安妮．', '詹姆斯．波宾', 999, '新远下沙', '爱丽丝（米娅·华希科沃斯卡 饰）在过去的几年里跟随父亲去海上航行，返回伦敦后她遇到了一面神奇的镜子，穿过镜子她再一次回到了奇幻仙境，并且遇到了昔日的朋友白兔、毛毛虫、疯帽匠（约翰尼·德普 饰）等，但此时疯帽匠已不是原来的他了，白皇后（安妮·海瑟薇 饰）帮助爱丽丝通过大时钟内部的时空传送仪回到过去，在不同的点她遇到了之前的朋友和敌人，在那里她必须与时间对抗，在时间耗尽之前拯救疯帽匠。而此前海报中每位主演手中都有的闪闪发光的神秘球体便是帮助爱丽丝回到过去的关键所在。', '../uploads/f3197067423193f7894d7a5524797aa7.jpg', 0),
(13, '记忆碎片', '喜剧/悬疑', '中国/韩国', '国语', 94, '雷佳音 /夏梓桐 /李菁 /孙宁 /何云伟', '朴裕焕', 999, '新远下沙', '繁华都市的边缘地带有一栋老旧而神秘的公寓，里面居住着形形色色奇怪的人，有“高帅穷”的落魄小律师（雷佳音 饰）、有倔强的90后年轻漂亮女孩（夏梓桐 饰）、有惯于溜门撬锁的蠢贼（李菁 饰），更有黑社会老大（李彧 饰）和他的美艳性感情妇（孙宁 饰）以及假药小贩（何云伟 饰）等。\r\n　　一个山雨欲来的夜里，就在这样的公寓里，突如其来多出了一具尸体……到底是谁杀了这个被所有人恨之入骨的男人？是被骗去万贯家财的他？还是被欺骗强暴了的她？抑或一直被人踩在头上的他？围绕着这具让所有人都惊慌不已的尸体，有人惊慌失措准备逃之夭夭，有人面色镇定承认杀人罪行，有人偷梁换柱企图制造自杀现场，有人咬牙切齿主动提出埋尸……在一天一夜之间各色人等都历经了一场终身难忘的记忆。而当谁是凶手的真相貌似“盖棺定论”时，意外的结局反转，让所有人都瞠目结舌。', '../uploads/120ff484c58bdd3df9f49ab2ff147f7e.jpg', 0),
(14, '百鸟朝凤', '剧情/历史/音乐', '中国', '国语', 108, '陶泽如 /李岷城', '吴天明', 997, '新远下沙', '老一代唢呐艺人焦三爷是个外冷内热的老人，看起来严肃古板，其实心怀热血。影片表现了在社会变革、民心浮躁的年代里，新老两代唢呐艺人为了信念的坚守所产生的真挚的师徒情、父子情、兄弟情。', '../uploads/b69b634f81c5e8a01b96da7d1dd7fb8f.jpg', 0),
(15, '斗龙战士之星印罗盘', '动画/奇幻', '中国', '国语', 75, '动画明星', '黎东泰', 999, '新远下沙', '远古魔物星印罗盘降临到龙武族六越山，罗盘的主人恶魔天魁即将复活祸害人类及星龙两界。神秘的宝贝龙阿迪也莫名其妙地来到了人类世界与斗龙战士小熠、百诺相遇。因为宝贝龙阿迪身上蕴藏星印罗盘的暗黑力量是复活天魁的关键，所以遭到天魁的爪牙灰骨龙和狐尾战龙的追捕。不知道其中原因的斗龙战士为了阻止天魁的复活，就带着宝贝龙阿迪一起来到复活的地点暗黑古城，不料中了天魁的阴谋诡计。天魁不仅把阿迪身上的暗黑力量吸收回去成为强大的恶魔天魁，还把阿迪打入万劫不复的‘暗黑深渊’。但万没想到胆小懦弱的阿迪在‘暗黑深渊’振作了起来，把体内沉睡的星达拉力量唤醒了，变身成为星达拉，冲出了‘暗黑深渊’，再次与天魁展开一场生死大战。', '../uploads/ab7541835573bf82f49fc95f2e73978e.jpg', 0),
(16, '动植物大战', '动画', '中国', '国语', 79, '动画明星', '未知', 999, '新远下沙', '影片主要讲述了松松和乐乐两个环保小少年，进入到充满法力的金橡果之门后，神奇地变成了两只小松鼠，保卫松松小镇的故事。在这里，他们开起了大南瓜坦克，联合小动物们一起对抗污染魔怪，更有神奇的金橡果出现，帮助大家一起保卫了松松小镇。', '../uploads/f83a643c10f98bf95981ea75c565556b.jpg', 0),
(17, '夜孔雀', '剧情/爱情', '中国/法国', '国语', 84, '刘亦菲 /刘烨 /余少群 /黎明', '戴思杰', 999, '新远下沙', '法国女留学生埃尔莎在成都爱上了丝绸研究员、吹箫高手马荣，后又在巴黎与马的兄弟、纹身师建民之间产生情感。前者找到了一种符合他理想的蚕——夜孔雀，后者把蝶化的夜孔雀永远铭刻在艾尔莎的肌肤上。', '../uploads/7eb6bd43a6835daf1d11a1250b4a4907.jpg', 0),
(18, '愤怒的小鸟', '喜剧/动作/动画', '芬兰/美国', '英语', 97, '杰森．苏戴奇斯 /乔什．加德 /丹尼．麦克布耐德 /玛娅．鲁道夫', '克莱．凯蒂', 999, '新远下沙', '一群不会飞的小鸟，挤在一座热带小岛上，和睦宁静。游戏中的几个经典形象成了影片的主角，分别是易怒的小鸟大红（杰森·苏戴奇斯配音），速度小鸟恰克（乔什·盖德配音）、炸弹（丹尼·麦克布耐德配音）。当神秘的绿色小猪登陆岛屿时，小鸟们平静的生活被打破了。', '../uploads/5866ae7fc7a3d647216798809c84d5ee.jpg', 0),
(19, '钢刀 ', '动作/战争/爱情', '中国', '国语', 94, '何润东 /李东学 /夏梓桐 /田原 /杨奇鸣', '阿甘', 999, '新远下沙', '　　哥哥王炳生（何润东 饰），弟弟陈铁金（李东学 饰），他们曾是相依为命、甘苦与共的兄弟。甚至哥哥炳生为弟弟铁金顶罪入狱十年，满身的伤疤与玩世不恭的态度是这十年的烙印，不变的却是兄弟之间的感情。不料在命运的捉弄下，两人在兵荒马乱的世界里失散，走上了不同的人生道路……\r\n　　再度相逢时，曾经的患难兄弟已经势不两立。手足情深与家国信仰的冲突，令昔日兄弟成为生死之敌，最终展开了一场生死较量……', '../uploads/2274934ed4643c20f3bc1dd18abf2199.jpg', 0),
(20, '北京遇上西雅图之不二情书', '喜剧/爱情', '中国', '国语', 129, '汤唯 /吴秀波 /秦沛 /惠英红 /王志文 /陆毅 /祖峰 /刘志宏', '薛晓路', 999, '新远下沙', '自2013年创下华语爱情片票房神迹后，《北京遇上西雅图》至今仍是该类型的票房纪录保持者，许多影迷对《北京遇上西雅图之不二情书》亦翘首以盼。此次《北京遇上西雅图之不二情书》力促原班人马再聚首，导演薛晓路耗时两年打磨剧本，国民CP吴秀波和汤唯再度谈情，力求突破前作再创华语爱情片票房新纪录。相较前作，《北京遇上西雅图之不二情书》可谓全面升级。影片跨越多国取景，仍延续爱情主题，而这一部的主题则是格局更为宏大的“世界爱情故事”。', '../uploads/5ffab980af5850c5108f9e230ce10b25.jpg', 0),
(21, '分歧者3：忠诚世界', '动作/爱情/科幻/冒险', '美国', '英语', 120, '谢琳．伍德蕾 /提奥．詹姆斯 /杰夫．丹尼尔斯 /奥克塔维亚．斯', '罗伯特．斯文克', 999, '新远下沙', '在推翻了派系制度之后，翠丝（谢琳·伍德蕾 Shailene Woodley 饰）与老四（提奥·詹姆斯 Theo James 饰）带领众人翻越了芝加哥的围墙来到全新世界。然而看似美好的新世界却隐藏着更大的杀机，翠丝与老四之间的信任也遭受到前所未有的考验。二人能否从阴谋中脱身并守住彼此？', '../uploads/62728aaae369e13f8c0be76be4c7c5f3.jpg', 0),
(22, '梦想合伙人', '爱情/剧情', '中国', '国语', 101, '姚晨 /郝蕾 /唐嫣 /郭富城 /李晨 /王一博 /金圣柱 /汤镇业 /罗嘉良', '张太维', 999, '新远下沙', '　　这是一个讲述三个阶层不同性格不同的女人为金钱、家庭、地位共同淘金的故事。\r\n　　留学生卢珍溪（姚晨 饰）在美国卖假包被驱逐回国，商场精英文清（郝蕾 饰）遭遇小三插足，灰姑娘顾巧音（唐嫣 饰）家庭贫寒只想嫁个有钱人。她们从一开始的死对头变成好闺蜜，并在事业导师孟晓骏（郭富城 饰）和卢珍溪的发小俊成(李晨 饰)的支持下，成为追求财富、爱情和地位的合伙人。她们短时间内取得巨大成功。不过好景不长，公司在市场激烈竞争下出现严重问题，陷入困局，同时三人的关系也出现破裂。面对困境，卢珍溪承受严峻考验的同时，为梦想和合伙人走出了坚定的一步。', '../uploads/72b5b5e690ec9dcd1810dd7ef0449f5f.jpg', 0),
(23, '蜜月酒店杀人事件 ', '爱情/惊悚', '中国/韩国', '国语', 97, '张静初 /何润东 /金英民 /倪虹洁 /吴维', '张哲洙 /李光浩 /千丙哲', 999, '新远下沙', '朴实勤劳的吴大志（金英民 饰）是豪华大酒店的一名门童，这天是他和心爱的妻子结婚的日子。吴大志用婚假向经理换取了总统套房两天的使用权，以满足妻子的新婚愿望：在总统套过一个短暂但甜蜜温馨的蜜月。 \r\n　　哪知，吴大志发现经理临时改变主意，将总统套房让给了炙手可热的大明星佩儿（张静初 饰）。吴大志很爱自己的妻子，不忍违背对妻子的承诺，想尽办法从佩儿那里要回总统套。奇怪的事情发生了。 　　大明星佩儿行踪古怪，举止反常，并卷进了一件连环敲诈勒索事件中。善良的吴大志对佩儿心生怜悯，帮助她摆脱危机。\r\n　　而就在同一天，整容师崔医生（何润东 饰）与其女友雯雯（倪虹洁 饰）住进了酒店。雯雯还带来了神秘的男人钟皓。原来，雯雯和钟皓有一个针对崔医生的秘密计划，正在悄无声息地进行着......\r\n　　连续阴差阳错的巧合，将吴大志彻底卷进了这个奇妙的误会中。他渐渐发现了佩儿身上隐藏的惊天秘密。', '../uploads/fd4d2cde6477281535dcbe58b0480706.jpg', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ticketsorders`
--

CREATE TABLE IF NOT EXISTS `ticketsorders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单',
  `userId` int(10) unsigned NOT NULL COMMENT '用户id',
  `filmId` int(10) unsigned NOT NULL COMMENT '电影id',
  `tickets` int(4) NOT NULL COMMENT '订票数',
  `timestamps` int(45) NOT NULL COMMENT '订票时间',
  `deadline` int(45) NOT NULL COMMENT '有效期(j截止使用时间)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `ticketsorders`
--

INSERT INTO `ticketsorders` (`id`, `userId`, `filmId`, `tickets`, `timestamps`, `deadline`) VALUES
(9, 4, 14, 2, 1465537821, 1466142621);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '用户密码',
  `email` varchar(30) NOT NULL COMMENT '用户邮箱',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, '你猜', '5f64c6d642806f35cc5b2de3e0814038', '923019454@gmail.com'),
(3, '测试', '098f6bcd4621d373cade4e832627b4f6', 'test@qq.com'),
(4, '测试2', 'ad0234829205b9033196ba818f7a872b', 'test2@qq.com'),
(5, 'YGuess', '8bc050789ee2851bcb59ed9771955881', '522028604@qq.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
