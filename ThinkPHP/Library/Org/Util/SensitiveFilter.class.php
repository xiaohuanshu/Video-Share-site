<?php
namespace Org\Util;
class SensitiveFilter{
 
    public static $wordArr = array();
    public static $content = "";
 
    /**
     * 处理内容
     * @param $content
     *
     * @return bool
     */
    public static function filter($content){
        if($content=="") return false;
        self::$content = $content;
        empty(self::$wordArr)?self::getWord():"";
        foreach ( self::$wordArr as $row){
            if (false !== strstr(self::$content,$row)) return false;
        }
        return true;
    }
 
    public static function getWord(){
		self::$wordArr = array (
		    0 => '阿扁推翻',
		    1 => '挨了一炮',
		    2 => '爱液横流',
		    3 => '安街逆',
		    4 => '安局办公楼',
		    5 => '安局豪华',
		    6 => '安门事',
		    7 => '安眠藥',
		    8 => '案的准确',
		    9 => '八九民',
		    10 => '八九学',
		    11 => '八九政治',
		    12 => '把病人整',
		    13 => '把邓小平',
		    14 => '把学生整',
		    15 => '罢工门',
		    16 => '白黄牙签',
		    17 => '败培训',
		    18 => '办本科',
		    19 => '办理本科',
		    20 => '办理各种',
		    21 => '办理票据',
		    22 => '办理文凭',
		    23 => '办理真实',
		    24 => '办理证书',
		    25 => '办理资格',
		    26 => '办文凭',
		    27 => '办怔',
		    28 => '办证',
		    29 => '半刺刀',
		    30 => '辦毕业',
		    31 => '辦證',
		    32 => '谤罪获刑',
		    33 => '磅解码器',
		    34 => '磅遥控器',
		    35 => '宝在甘肃修',
		    36 => '保过答案',
		    37 => '报复执法',
		    38 => '爆发骚',
		    39 => '北省委门',
		    40 => '被中共',
		    41 => '冰毒',
		    42 => '冰火毒',
		    43 => '冰火佳',
		    44 => '冰火九重',
		    45 => '冰火漫',
		    46 => '冰淫传',
		    47 => '波推龙',
		    48 => '博彩娱',
		    49 => '博园区伪',
		    50 => '不思四化',
		    51 => '布卖淫女',
		    52 => '苍山兰',
		    53 => '苍蝇水',
		    54 => '藏春阁',
		    55 => '藏獨',
		    56 => '操了嫂',
		    57 => '察象蚂',
		    58 => '拆迁灭',
		    59 => '车牌隐',
		    60 => '成人电',
		    61 => '成人卡通',
		    62 => '成人聊',
		    63 => '成人片',
		    64 => '成人视',
		    65 => '成人图',
		    66 => '成人文',
		    67 => '成人小',
		    68 => '城管灭',
		    69 => '惩公安',
		    70 => '惩贪难',
		    71 => '抽着大中',
		    72 => '抽着芙蓉',
		    73 => '出成绩付',
		    74 => '出售发票',
		    75 => '出售军',
		    76 => '穿透仪器',
		    77 => '春水横溢',
		    78 => '纯度白',
		    79 => '纯度黄',
		    80 => '催眠水',
		    81 => '催情粉',
		    82 => '催情药',
		    83 => '催情藥',
		    84 => '挫仑',
		    85 => '打飞机专',
		    86 => '打砸办公',
		    87 => '大鸡巴',
		    88 => '大雞巴',
		    89 => '大肉棒',
		    90 => '代办发票',
		    91 => '代办各',
		    92 => '代办制',
		    93 => '代辦',
		    94 => '代表烦',
		    95 => '代理发票',
		    96 => '代理票据',
		    97 => '代您考',
		    98 => '戴海静',
		    99 => '党后萎',
		    100 => '党前干劲',
		    101 => '邓爷爷转',
		    102 => '邓玉娇',
		    103 => '递纸死',
		    104 => '电狗',
		    105 => '电鸡',
		    106 => '甸果敢',
		    107 => '蝶舞按',
		    108 => '丁香社',
		    109 => '丁子霖',
		    110 => '顶花心',
		    111 => '东北独立',
		    112 => '都当警',
		    113 => '都当小姐',
		    114 => '毒蛇钻',
		    115 => '独立台湾',
		    116 => '短信截',
		    117 => '对日强硬',
		    118 => '多美康',
		    119 => '躲猫猫',
		    120 => '恶势力操',
		    121 => '恶势力插',
		    122 => '恩氟烷',
		    123 => '儿园惨',
		    124 => '儿园砍',
		    125 => '儿园杀',
		    126 => '儿园凶',
		    127 => '发牌绝',
		    128 => '发票出',
		    129 => '发票代',
		    130 => '发票销',
		    131 => '發票',
		    132 => '法车仑',
		    133 => '法伦功',
		    134 => '法轮',
		    135 => '法轮佛',
		    136 => '法维权',
		    137 => '法一轮',
		    138 => '法正乾',
		    139 => '反测速雷',
		    140 => '反雷达测',
		    141 => '反屏蔽',
		    142 => '范燕琼',
		    143 => '方迷香',
		    144 => '防电子眼',
		    145 => '防身药水',
		    146 => '仿真枪',
		    147 => '仿真证',
		    148 => '诽谤罪',
		    149 => '费私服',
		    150 => '佛同修',
		    151 => '福尔马林',
		    152 => '福香巴',
		    153 => '府包庇',
		    154 => '府集中领',
		    155 => '妇销魂',
		    156 => '附送枪',
		    157 => '富民穷',
		    158 => '富婆给废',
		    159 => '改号软件',
		    160 => '感扑克',
		    161 => '冈本真',
		    162 => '岡本真',
		    163 => '钢针狗',
		    164 => '钢珠枪',
		    165 => '港澳博球',
		    166 => '港馬會',
		    167 => '港鑫華',
		    168 => '高考黑',
		    169 => '高莺莺',
		    170 => '跟踪器',
		    171 => '攻官小姐',
		    172 => '共狗',
		    173 => '共王储',
		    174 => '乖乖粉',
		    175 => '官商勾',
		    176 => '官也不容',
		    177 => '官因发帖',
		    178 => '光学真题',
		    179 => '跪真相',
		    180 => '滚圆大乳',
		    181 => '国家妓',
		    182 => '国家软弱',
		    183 => '国家吞得',
		    184 => '国库折',
		    185 => '国一九五七',
		    186 => '國內美',
		    187 => '哈药直销',
		    188 => '海访民',
		    189 => '豪圈钱',
		    190 => '号屏蔽器',
		    191 => '和狗交',
		    192 => '和狗性',
		    193 => '和狗做',
		    194 => '黑火药的',
		    195 => '红色恐怖',
		    196 => '红外透视',
		    197 => '紅色恐',
		    198 => '胡江内斗',
		    199 => '胡紧套',
		    200 => '胡鍧',
		    201 => '胡适眼',
		    202 => '胡耀邦',
		    203 => '湖淫娘',
		    204 => '虎头猎',
		    205 => '华国锋',
		    206 => '华门开',
		    207 => '化学扫盲',
		    208 => '划老公',
		    209 => '还会吹萧',
		    210 => '还看锦涛',
		    211 => '环球证件',
		    212 => '换妻',
		    213 => '皇冠投注',
		    214 => '黄冰',
		    215 => '浑圆豪乳',
		    216 => '活不起',
		    217 => '火车也疯',
		    218 => '机定位器',
		    219 => '机号定',
		    220 => '机号卫',
		    221 => '机卡密',
		    222 => '机屏蔽器',
		    223 => '基本靠吼',
		    224 => '绩过后付',
		    225 => '激情电',
		    226 => '激情短',
		    227 => '激情妹',
		    228 => '激情炮',
		    229 => '级办理',
		    230 => '级答案',
		    231 => '急需嫖',
		    232 => '集体打砸',
		    233 => '集体腐',
		    234 => '挤乳汁',
		    235 => '擠乳汁',
		    236 => '佳静安定',
		    237 => '奸成瘾',
		    238 => '兼职上门',
		    239 => '监听器',
		    240 => '监听王',
		    241 => '简易炸',
		    242 => '江胡内斗',
		    243 => '江太上',
		    244 => '江系人',
		    245 => '江贼民',
		    246 => '疆獨',
		    247 => '蒋彦永',
		    248 => '揭贪难',
		    249 => '姐包夜',
		    250 => '金扎金',
		    251 => '金钟气',
		    252 => '津大地震',
		    253 => '津地震',
		    254 => '进来的罪',
		    255 => '京地震',
		    256 => '京要地震',
		    257 => '警察被',
		    258 => '警察的幌',
		    259 => '警察殴打',
		    260 => '警察说保',
		    261 => '警车雷达',
		    262 => '警方包庇',
		    263 => '警用品',
		    264 => '径步枪',
		    265 => '敬请忍',
		    266 => '九龙论坛',
		    267 => '九评共',
		    268 => '酒象喝汤',
		    269 => '酒像喝汤',
		    270 => '就爱插',
		    271 => '就要色',
		    272 => '举国体',
		    273 => '巨乳',
		    274 => '绝食声',
		    275 => '军长发威',
		    276 => '军刺',
		    277 => '军品特',
		    278 => '军用手',
		    279 => '开邓选',
		    280 => '开锁工具',
		    281 => '開碼',
		    282 => '開票',
		    283 => '砍杀幼',
		    284 => '砍伤儿',
		    285 => '康没有不',
		    286 => '康跳楼',
		    287 => '考答案',
		    288 => '考后付款',
		    289 => '考考邓',
		    290 => '考前答',
		    291 => '考前答案',
		    292 => '考前付',
		    293 => '考设备',
		    294 => '考试包过',
		    295 => '考试保',
		    296 => '考试答案',
		    297 => '考试机构',
		    298 => '考试联盟',
		    299 => '考试枪',
		    300 => '考研考中',
		    301 => '考中答案',
		    302 => '磕彰',
		    303 => '克分析',
		    304 => '克千术',
		    305 => '克透视',
		    306 => '空和雅典',
		    307 => '孔摄像',
		    308 => '控诉世博',
		    309 => '控制媒',
		    310 => '口手枪',
		    311 => '骷髅死',
		    312 => '矿难不公',
		    313 => '拉登说',
		    314 => '拉开水晶',
		    315 => '来福猎',
		    316 => '拦截器',
		    317 => '狼全部跪',
		    318 => '浪穴',
		    319 => '雷人女官',
		    320 => '类准确答',
		    321 => '黎阳平',
		    322 => '李洪志',
		    323 => '李咏曰',
		    324 => '理各种证',
		    325 => '理是影帝',
		    326 => '理证件',
		    327 => '理做帐报',
		    328 => '力骗中央',
		    329 => '力月西',
		    330 => '丽媛离',
		    331 => '利他林',
		    332 => '连发手',
		    333 => '聯繫電',
		    334 => '炼大法',
		    335 => '两岸才子',
		    336 => '两会代',
		    337 => '两会又三',
		    338 => '聊视频',
		    339 => '聊斋艳',
		    340 => '了件渔袍',
		    341 => '猎好帮手',
		    342 => '猎枪销',
		    343 => '猎槍',
		    344 => '獵槍',
		    345 => '领土拿',
		    346 => '流血事',
		    347 => '六合彩',
		    348 => '六死',
		    349 => '六四事',
		    350 => '六月联盟',
		    351 => '龙湾事件',
		    352 => '隆手指',
		    353 => '陆封锁',
		    354 => '陆同修',
		    355 => '氯胺酮',
		    356 => '乱奸',
		    357 => '乱伦类',
		    358 => '乱伦小',
		    359 => '亂倫',
		    360 => '伦理大',
		    361 => '伦理电影',
		    362 => '伦理毛',
		    363 => '伦理片',
		    364 => '轮功',
		    365 => '轮手枪',
		    366 => '论文代',
		    367 => '罗斯小姐',
		    368 => '裸聊网',
		    369 => '裸舞视',
		    370 => '落霞缀',
		    371 => '麻古',
		    372 => '麻果配',
		    373 => '麻果丸',
		    374 => '麻将透',
		    375 => '麻醉狗',
		    376 => '麻醉枪',
		    377 => '麻醉槍',
		    378 => '麻醉藥',
		    379 => '蟆叫专家',
		    380 => '卖地财政',
		    381 => '卖发票',
		    382 => '卖银行卡',
		    383 => '卖自考',
		    384 => '漫步丝',
		    385 => '忙爱国',
		    386 => '猫眼工具',
		    387 => '毛一鲜',
		    388 => '媒体封锁',
		    389 => '每周一死',
		    390 => '美艳少妇',
		    391 => '门按摩',
		    392 => '门保健',
		    393 => '門服務',
		    394 => '氓培训',
		    395 => '蒙汗药',
		    396 => '迷幻型',
		    397 => '迷幻药',
		    398 => '迷幻藥',
		    399 => '迷昏口',
		    400 => '迷昏药',
		    401 => '迷昏藥',
		    402 => '迷魂香',
		    403 => '迷魂药',
		    404 => '迷魂藥',
		    405 => '迷奸药',
		    406 => '迷情水',
		    407 => '迷情药',
		    408 => '迷藥',
		    409 => '谜奸药',
		    410 => '蜜穴',
		    411 => '灭绝罪',
		    412 => '民储害',
		    413 => '民九亿商',
		    414 => '民抗议',
		    415 => '明慧网',
		    416 => '铭记印尼',
		    417 => '摩小姐',
		    418 => '母乳家',
		    419 => '木齐针',
		    420 => '幕没有不',
		    421 => '幕前戲',
		    422 => '内射',
		    423 => '南充针',
		    424 => '嫩穴',
		    425 => '嫩阴',
		    426 => '泥马之歌',
		    427 => '你的西域',
		    428 => '拟涛哥',
		    429 => '娘两腿之间',
		    430 => '浓精',
		    431 => '女激情',
		    432 => '女優',
		    433 => '鸥之歌',
		    434 => '拍肩神药',
		    435 => '拍肩型',
		    436 => '牌分析',
		    437 => '牌技网',
		    438 => '炮的小蜜',
		    439 => '陪考枪',
		    440 => '配有消',
		    441 => '喷尿',
		    442 => '嫖俄罗',
		    443 => '嫖鸡',
		    444 => '平惨案',
		    445 => '平叫到床',
		    446 => '仆不怕饮',
		    447 => '普通嘌',
		    448 => '期货配',
		    449 => '奇迹的黄',
		    450 => '奇淫散',
		    451 => '骑单车出',
		    452 => '气狗',
		    453 => '气枪',
		    454 => '汽狗',
		    455 => '汽枪',
		    456 => '氣槍',
		    457 => '铅弹',
		    458 => '枪出售',
		    459 => '枪的参',
		    460 => '枪的分',
		    461 => '枪的结',
		    462 => '枪的制',
		    463 => '枪货到',
		    464 => '枪决女犯',
		    465 => '枪决现场',
		    466 => '枪模',
		    467 => '枪手队',
		    468 => '枪手网',
		    469 => '枪销售',
		    470 => '枪械制',
		    471 => '枪子弹',
		    472 => '强权政府',
		    473 => '强硬发言',
		    474 => '抢其火炬',
		    475 => '切听器',
		    476 => '窃听器',
		    477 => '禽流感了',
		    478 => '勤捞致',
		    479 => '氢弹手',
		    480 => '清純壆',
		    481 => '情聊天室',
		    482 => '氰化钾',
		    483 => '氰化钠',
		    484 => '请集会',
		    485 => '请示威',
		    486 => '琼花问',
		    487 => '区的雷人',
		    488 => '娶韩国',
		    489 => '全真证',
		    490 => '群奸暴',
		    491 => '群起抗暴',
		    492 => '群体性事',
		    493 => '绕过封锁',
		    494 => '惹的国',
		    495 => '人权律',
		    496 => '人游行',
		    497 => '人在云上',
		    498 => '人真钱',
		    499 => '认牌绝',
		    500 => '任于斯国',
		    501 => '柔胸粉',
		    502 => '肉洞',
		    503 => '肉棍',
		    504 => '如厕死',
		    505 => '乳交',
		    506 => '软弱的国',
		    507 => '赛后骚',
		    508 => '三挫',
		    509 => '三级片',
		    510 => '三秒倒',
		    511 => '三网友',
		    512 => '三唑',
		    513 => '骚浪',
		    514 => '骚穴',
		    515 => '骚嘴',
		    516 => '扫了爷爷',
		    517 => '色电影',
		    518 => '色视频',
		    519 => '杀指南',
		    520 => '山涉黑',
		    521 => '煽动不明',
		    522 => '上门激',
		    523 => '烧公安局',
		    524 => '烧瓶的',
		    525 => '韶关斗',
		    526 => '韶关玩',
		    527 => '韶关旭',
		    528 => '射网枪',
		    529 => '涉嫌抄袭',
		    530 => '深喉冰',
		    531 => '神七假',
		    532 => '神韵艺术',
		    533 => '生被砍',
		    534 => '生踩踏',
		    535 => '生肖中特',
		    536 => '圣战不息',
		    537 => '盛行在舞',
		    538 => '尸博',
		    539 => '失身水',
		    540 => '失意药',
		    541 => '狮子旗',
		    542 => '十八等',
		    543 => '十大谎',
		    544 => '十大禁',
		    545 => '十个预言',
		    546 => '十类人不',
		    547 => '十七大幕',
		    548 => '实毕业证',
		    549 => '实体娃',
		    550 => '实学历文',
		    551 => '士康事件',
		    552 => '式粉推',
		    553 => '视解密',
		    554 => '是躲猫',
		    555 => '手变牌',
		    556 => '手狗',
		    557 => '手机跟',
		    558 => '手机监',
		    559 => '手机窃',
		    560 => '手机追',
		    561 => '手拉鸡',
		    562 => '手木仓',
		    563 => '手槍',
		    564 => '兽交',
		    565 => '售步枪',
		    566 => '售纯度',
		    567 => '售单管',
		    568 => '售弹簧刀',
		    569 => '售防身',
		    570 => '售狗子',
		    571 => '售虎头',
		    572 => '售火药',
		    573 => '售健卫',
		    574 => '售军用',
		    575 => '售猎枪',
		    576 => '售氯胺',
		    577 => '售麻醉',
		    578 => '售冒名',
		    579 => '售枪支',
		    580 => '售热武',
		    581 => '售三棱',
		    582 => '售手枪',
		    583 => '售五四',
		    584 => '售信用',
		    585 => '售一元硬',
		    586 => '售子弹',
		    587 => '售左轮',
		    588 => '熟妇',
		    589 => '术牌具',
		    590 => '双管立',
		    591 => '双管平',
		    592 => '水阎王',
		    593 => '丝护士',
		    594 => '丝情侣',
		    595 => '丝袜保',
		    596 => '丝袜恋',
		    597 => '丝袜美',
		    598 => '丝袜妹',
		    599 => '丝袜网',
		    600 => '丝足按',
		    601 => '司长期有',
		    602 => '司法黑',
		    603 => '私房写真',
		    604 => '死法分布',
		    605 => '死要见毛',
		    606 => '四博会',
		    607 => '四大扯',
		    608 => '四小码',
		    609 => '苏家屯集',
		    610 => '诉讼集团',
		    611 => '素女心',
		    612 => '速代办',
		    613 => '速取证',
		    614 => '酸羟亚胺',
		    615 => '蹋纳税',
		    616 => '太王四神',
		    617 => '泰兴幼',
		    618 => '泰兴镇中',
		    619 => '泰州幼',
		    620 => '贪官也辛',
		    621 => '探测狗',
		    622 => '涛共产',
		    623 => '涛一样胡',
		    624 => '特工资',
		    625 => '特码',
		    626 => '特上门',
		    627 => '体透视镜',
		    628 => '替人体',
		    629 => '天朝特',
		    630 => '天鹅之旅',
		    631 => '天推广歌',
		    632 => '田罢工',
		    633 => '田田桑',
		    634 => '田停工',
		    635 => '庭审直播',
		    636 => '通钢总经',
		    637 => '偷電器',
		    638 => '偷肃贪',
		    639 => '偷听器',
		    640 => '偷偷贪',
		    641 => '头双管',
		    642 => '透视功能',
		    643 => '透视镜',
		    644 => '透视扑',
		    645 => '透视器',
		    646 => '透视眼镜',
		    647 => '透视药',
		    648 => '透视仪',
		    649 => '秃鹰汽',
		    650 => '突破封锁',
		    651 => '突破网路',
		    652 => '脱衣艳',
		    653 => '瓦斯手',
		    654 => '袜按摩',
		    655 => '外透视镜',
		    656 => '外围赌球',
		    657 => '湾版假',
		    658 => '万能钥匙',
		    659 => '万人骚动',
		    660 => '王立军',
		    661 => '王益案',
		    662 => '网民获刑',
		    663 => '网民诬',
		    664 => '微型摄像',
		    665 => '围攻警',
		    666 => '围攻上海',
		    667 => '维汉员',
		    668 => '维权基',
		    669 => '维权人',
		    670 => '维权谈',
		    671 => '委坐船',
		    672 => '谓的和谐',
		    673 => '温家堡',
		    674 => '温切斯特',
		    675 => '温影帝',
		    676 => '溫家寶',
		    677 => '瘟加饱',
		    678 => '瘟假饱',
		    679 => '文强',
		    680 => '纹了毛',
		    681 => '闻被控制',
		    682 => '瓮安',
		    683 => '我的西域',
		    684 => '我搞台独',
		    685 => '乌蝇水',
		    686 => '无码专',
		    687 => '五套功',
		    688 => '五月天',
		    689 => '午夜电',
		    690 => '午夜极',
		    691 => '武警暴',
		    692 => '武警殴',
		    693 => '武警已增',
		    694 => '务员答案',
		    695 => '务员考试',
		    696 => '雾型迷',
		    697 => '西藏限',
		    698 => '西服进去',
		    699 => '希脏',
		    700 => '习进平',
		    701 => '习晋平',
		    702 => '席复活',
		    703 => '席临终前',
		    704 => '席指着护',
		    705 => '洗澡死',
		    706 => '喜贪赃',
		    707 => '先烈纷纷',
		    708 => '现大地震',
		    709 => '现金投注',
		    710 => '线透视镜',
		    711 => '限制言',
		    712 => '陷害案',
		    713 => '陷害罪',
		    714 => '相自首',
		    715 => '香港论坛',
		    716 => '香港马会',
		    717 => '香港一类',
		    718 => '香港总彩',
		    719 => '硝化甘',
		    720 => '小穴',
		    721 => '校骚乱',
		    722 => '协晃悠',
		    723 => '写两会',
		    724 => '泄漏的内',
		    725 => '新建户',
		    726 => '新疆叛',
		    727 => '新疆限',
		    728 => '新金瓶',
		    729 => '新唐人',
		    730 => '信访专班',
		    731 => '信接收器',
		    732 => '兴中心幼',
		    733 => '星上门',
		    734 => '行长王益',
		    735 => '形透视镜',
		    736 => '型手枪',
		    737 => '姓忽悠',
		    738 => '幸运码',
		    739 => '性爱日',
		    740 => '性福情',
		    741 => '性感少',
		    742 => '性推广歌',
		    743 => '胸主席',
		    744 => '徐玉元',
		    745 => '学骚乱',
		    746 => '学位證',
		    747 => '學生妹',
		    748 => '丫与王益',
		    749 => '烟感器',
		    750 => '严晓玲',
		    751 => '言被劳教',
		    752 => '言论罪',
		    753 => '盐酸曲',
		    754 => '颜射',
		    755 => '恙虫病',
		    756 => '姚明进去',
		    757 => '要人权',
		    758 => '要射精了',
		    759 => '要射了',
		    760 => '要泄了',
		    761 => '夜激情',
		    762 => '液体炸',
		    763 => '一小撮别',
		    764 => '遗情书',
		    765 => '蚁力神',
		    766 => '益关注组',
		    767 => '益受贿',
		    768 => '阴间来电',
		    769 => '陰唇',
		    770 => '陰道',
		    771 => '陰戶',
		    772 => '淫魔舞',
		    773 => '淫情女',
		    774 => '淫肉',
		    775 => '淫騷妹',
		    776 => '淫兽',
		    777 => '淫兽学',
		    778 => '淫水',
		    779 => '淫穴',
		    780 => '隐形耳',
		    781 => '隐形喷剂',
		    782 => '应子弹',
		    783 => '婴儿命',
		    784 => '咏妓',
		    785 => '用手枪',
		    786 => '幽谷三',
		    787 => '游精佑',
		    788 => '有奶不一',
		    789 => '右转是政',
		    790 => '幼齿类',
		    791 => '愚民同',
		    792 => '愚民政',
		    793 => '与狗性',
		    794 => '玉蒲团',
		    795 => '育部女官',
		    796 => '冤民大',
		    797 => '鸳鸯洗',
		    798 => '园惨案',
		    799 => '园发生砍',
		    800 => '园砍杀',
		    801 => '园凶杀',
		    802 => '园血案',
		    803 => '原一九五七',
		    804 => '原装弹',
		    805 => '袁腾飞',
		    806 => '晕倒型',
		    807 => '韵徐娘',
		    808 => '遭便衣',
		    809 => '遭到警',
		    810 => '遭警察',
		    811 => '遭武警',
		    812 => '择油录',
		    813 => '曾道人',
		    814 => '炸弹教',
		    815 => '炸弹遥控',
		    816 => '炸广州',
		    817 => '炸立交',
		    818 => '炸药的制',
		    819 => '炸药配',
		    820 => '炸药制',
		    821 => '张春桥',
		    822 => '找枪手',
		    823 => '找援交',
		    824 => '找政法委副',
		    825 => '赵紫阳',
		    826 => '针刺案',
		    827 => '针刺伤',
		    828 => '针刺死',
		    829 => '侦探设备',
		    830 => '真钱斗地',
		    831 => '真善忍',
		    832 => '震惊一个民',
		    833 => '震其国土',
		    834 => '证到付款',
		    835 => '证件办',
		    836 => '证件集团',
		    837 => '证生成器',
		    838 => '证书办',
		    839 => '证一次性',
		    840 => '政府操',
		    841 => '政论区',
		    842 => '證件',
		    843 => '植物冰',
		    844 => '殖器护',
		    845 => '指纹考勤',
		    846 => '指纹膜',
		    847 => '指纹套',
		    848 => '至国家高',
		    849 => '志不愿跟',
		    850 => '制服诱',
		    851 => '制手枪',
		    852 => '制证定金',
		    853 => '制作证件',
		    854 => '中的班禅',
		    855 => '中共黑',
		    856 => '中国不强',
		    857 => '众像羔',
		    858 => '州大批贪',
		    859 => '州三箭',
		    860 => '宙最高法',
		    861 => '昼将近',
		    862 => '助考网',
		    863 => '装弹甲',
		    864 => '装枪套',
		    865 => '装消音',
		    866 => '着护士的胸',
		    867 => '着涛哥',
		    868 => '姿不对死',
		    869 => '资格證',
		    870 => '梓健特药',
		    871 => '字牌汽',
		    872 => '自己找枪',
		    873 => '自慰用',
		    874 => '足球玩法',
		    875 => '醉钢枪',
		    876 => '醉迷药',
		    877 => '醉乙醚',
		    878 => '尊爵粉',
		    879 => '左转是政',
		    880 => '作弊器',
		    881 => '作各种证',
		    882 => '作硝化甘',
		    883 => '唑仑',
		    884 => '做爱小',
		    885 => '做原子弹',
		);
    }
 
}