<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * 八字论断-神煞篇
 * C::m('#bazi#bazi_case')->func()
 **/
class model_bazi_shensha
{
	// 看神煞
	public function check_all(&$bazi)
	{
		$shamap = array();
		$shaall = array (
			'tianyiguiren',		//天乙贵人
			'tiandeguiren',     //天德贵人
			'yuedeguiren',      //月德贵人
			'taijiguiren',      //太极贵人
			'sanqiguiren',      //三奇贵人
			'lushen',           //禄神
			'jinyu',			//金舆
			'yangren',          //羊刃
			'yima',				//驿马
			'huagai',			//华盖
			'jiangxing',		//将星
			'wenchangguiren',	//文昌贵人
			'kuigang',			//魁罡
			'muyutaohua',		//沐浴桃花
			'taohua',			//桃花
			'yinyangchacuo',	//阴阳差错煞
			'jiesha',			//劫煞
			'zaisha',			//灾煞(白虎煞)
			'tianluodiwang',    //天罗地网
			'kongwang',			//空亡
			'guchen',			//孤辰
			'guasu',			//寡宿
		);
		foreach ($shaall as $sha) {
			$fun = "check_$sha";
			$res = $this->$fun($bazi);
			if (!empty($res)) {
				foreach ($res as $im) {
					$jx = $im['jixiong'];	//!< jisha, zhongsha, xiongsha
					if (!isset($shamap[$jx])) $shamap[$jx] = array();
					unset($im['jixiong']);
					$shamap[$jx][] = $im;
				}
			}
		}
		return $shamap;
	}

	// 天乙贵人
	public function check_tianyiguiren(&$bazi)
	{/*{{{*/
		$map = array (
			'甲'=>'丑未', '丙'=>'亥酉', '戊'=>'丑未', '庚'=>'丑未', '壬'=>'巳卯',
			'乙'=>'子申', '丁'=>'亥酉', '己'=>'子申', '辛'=>'寅午', '癸'=>'巳卯',
		);
		$rigan = $bazi['ri_gan'];  //!< 日干
		$hitzhi = $map[$rigan];	   //!< 日干对应的天乙贵人地支
		$hitzhi1 = mb_substr($hitzhi,0,1,'utf-8');
		$hitzhi2 = mb_substr($hitzhi,1,1,'utf-8');
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi1==$zhi || $hitzhi2==$zhi) {
				$jue = '天乙贵人，最为尊贵，出入近贵，逢凶化吉，名主得之聪明，遇事有人帮助。然女性临此贵人，一位为佳，超过三位会影响自身婚姻。俗称：“两个贵人活动家，三个贵人交际花。”';
				$res[] = array (
					'name' => '天乙贵人（贵神首位）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 天德贵人
	public function check_tiandeguiren(&$bazi)
	{/*{{{*/
		$map = array (
			'寅'=>'丁', '巳'=>'辛', '申'=>'癸', '亥'=>'乙',
			'卯'=>'申', '午'=>'亥', '酉'=>'寅', '子'=>'巳',
			'辰'=>'壬', '未'=>'甲', '戌'=>'丙', '丑'=>'庚',
		);
		$yuezhi = $bazi['yue_zhi'];  //!< 月令
		$hitgan = $map[$yuezhi];	 //!< 月令对应的天德贵人天干
		// 日干对四柱地支
		$arr = array(
			array('nian_gan','年干'),
			array('yue_gan','月干'),
			array('ri_gan','日干'),
			array('hour_gan','时干'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitgan==$zhi) {
				$jue = '凡有天德扶持，能解众凶，主贵显，仁慈，敏惠，大慈善，逢凶化吉，性情温顺，修养高深，重视贞节，福利荣厚。——《三车一览》';
				$res[] = array (
					'name' => '天德贵人（仁慈祥和）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 月德贵人
	public function check_yuedeguiren(&$bazi)
	{/*{{{*/
		$map = array (
			'寅'=>'丙', '巳'=>'庚', '申'=>'壬', '亥'=>'甲',
			'卯'=>'甲', '午'=>'丙', '酉'=>'庚', '子'=>'壬',
			'辰'=>'壬', '未'=>'甲', '戌'=>'丙', '丑'=>'庚',
		);
		$yuezhi = $bazi['yue_zhi'];  //!< 月令
		$hitgan = $map[$yuezhi];	 //!< 月令对应的月德贵人天干
		// 日干对四柱地支
		$arr = array(
			array('nian_gan','年干'),
			array('yue_gan','月干'),
			array('ri_gan','日干'),
			array('hour_gan','时干'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitgan==$zhi) {
				$jue = '月德贵人所临之地，主福寿，女性逢此，性情温顺贤良，且为有贞操之人，亦有逢凶化吉之妙用。人命值天月二德所临，必福祉长寿。';
				$res[] = array (
					'name' => '月德贵人（善良勤朴）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 太极贵人
	public function check_taijiguiren(&$bazi)
	{/*{{{*/
		$map = array (
			'甲'=>'子,午', '丙'=>'卯,酉', '戊'=>'辰,戌,丑,未', '庚'=>'寅,亥', '壬'=>'巳,申',
			'乙'=>'子,午', '丁'=>'卯,酉', '己'=>'辰,戌,丑,未', '辛'=>'寅,亥', '癸'=>'巳,申',
		);
		$niangan = $bazi['nian_gan']; //!< 年干
		$rigan = $bazi['ri_gan'];     //!< 日干
		//$str = $map[$niangan].','.$map[$rigan];   //!< 以年干或日干对照地支
		$str = $map[$rigan];   //!< 以日干对照地支
		$hitarr = explode(',',$str);
		$res = array();

		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if (in_array($zhi,$hitarr)) {
				$jue = '太极贵人又名科名星，命带太极贵人者，聪明好学，喜神秘学术，文史宗教，为人公正禀直，做事善始善终，有契而不舍的执着精神。日坐太极贵人，灵性最强。';
				$res[] = array (
					'name' => '太极贵人（异质聪慧）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 三奇贵人
	public function check_sanqiguiren(&$bazi)
	{/*{{{*/
		$map = array (
			'乙丙丁' => '（天上）三奇贵人', 
			'甲戊庚' => '（地上）三奇贵人', 
			'辛壬癸' => '（人间）三奇贵人', 
		);
		$res = array();
		$nyr = $bazi['nian_gan'].$bazi['yue_gan'].$bazi['ri_gan'];  //!< 年月日
		$yrs = $bazi['yue_gan'].$bazi['ri_gan'].$bazi['hour_gan'];	//!< 月日时
		$arr = array($nyr,$yrs);
		foreach ($arr as $str) {
			if (isset($map[$str])) {
				$jue = '命遇三奇，主人襟怀卓越，博学多能，容易取得富贵，非凡类之人。带天乙贵人者，勋业超群；带天月二德者，凶灾消散；带三合入局者，国家栋梁；带空亡生旺者，山林隐士，富贵不淫，威武不屈。诚上格也。';
				$res[] = array (
					'name' => $map[$str],
					'position' => "四柱天干",
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 禄神
	public function check_lushen(&$bazi)
	{/*{{{*/
		$map = array (
			'甲'=>'寅', '丙'=>'巳', '戊'=>'巳', '庚'=>'申', '壬'=>'亥',
			'乙'=>'卯', '丁'=>'午', '己'=>'午', '辛'=>'酉', '癸'=>'子',
		);
		$rigan = $bazi['ri_gan'];  //!< 日干
		$hitzhi = $map[$rigan];	   //!< 日干对应的禄神地支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi==$zhi) {

				$jue = '禄神乃福气之星，主享俸禄，衣食无忧，丰盈一生。';
				if ($im[0]=='ri_zhi' && $bazi['gender']=='男') {
					$jue.= "日主坐禄，男命因妻得贵。";
				}

				$res[] = array (
					'name' => '禄神（爵禄也，主衣食无忧）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 金舆
	public function check_jinyu(&$bazi)
	{/*{{{*/
		$map = array (
			'甲'=>'辰', '丙'=>'未', '戊'=>'未', '庚'=>'戌', '壬'=>'丑',
			'乙'=>'巳', '丁'=>'申', '己'=>'申', '辛'=>'亥', '癸'=>'寅',
		);
		$rigan = $bazi['ri_gan'];  //!< 日干
		$hitzhi = $map[$rigan];	   //!< 日干对应的金舆地支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi==$zhi) {
				$jue = '舆者，车也；金者，贵之之义。譬之君子居官得禄，须坐车载之。此煞乃禄命之旌旗，三才之节钺，主人性柔貌愿，举止温克。妇人逢之，不富即贵；男子得之，多妻妾，阴福相扶持。生日，生时逢之为佳，骨肉平生安泰，得贤妻妾，子孙茂盛。皇族多带此煞，常格得之，身在无气中生，主入赘。——《三命通会》';
				$res[] = array (
					'name' => '金舆（居官得禄，坐车载之）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 羊刃
	public function check_yangren(&$bazi)
	{/*{{{*/
		$map = array (
			'甲'=>'卯', '丙'=>'午', '戊'=>'午', '庚'=>'酉', '壬'=>'子',
			'乙'=>'寅', '丁'=>'巳', '己'=>'巳', '辛'=>'申', '癸'=>'亥',
		);
		$rigan = $bazi['ri_gan'];  //!< 日干
		$hitzhi = $map[$rigan];	   //!< 日干对应的羊刃地支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi==$zhi) {

				$jue = '物极必反生羊刃，禄过则刃生。羊刃带禄，又有官印等吉神相助，吉；羊刃遇死绝衰败之时，多有恶病刀兵之害，一生忙碌，凶。';

				$res[] = array (
					'name' => '羊刃',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 驿马
	public function check_yima(&$bazi)
	{/*{{{*/
		$map = array(
			'寅'=>'申', '巳'=>'亥', '申'=>'寅', '亥'=>'巳',
			'卯'=>'巳', '午'=>'申', '酉'=>'亥', '子'=>'寅',
			'辰'=>'寅', '未'=>'巳', '戌'=>'申', '丑'=>'亥',
		);
		$rizhi = $bazi['ri_zhi'];   //!< 日支
		$hitzhi = $map[$rizhi];		//!< 日支对应的驿马支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi==$zhi) {
				$res[] = array (
					'name' => '驿马（动态奔走）',
					'position' => $im[1],
					'jue' => '贵人驿马多升擢，常人驿马主奔波。驿马落空亡，常迁居或更换职业；驿马处死绝之地或遭刑冲，四处漂泊身不安。',
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 华盖
	public function check_huagai(&$bazi)
	{/*{{{*/
		$map = array(
			'寅'=>'戌', '巳'=>'丑', '申'=>'辰', '亥'=>'未',
			'卯'=>'未', '午'=>'戌', '酉'=>'丑', '子'=>'辰',
			'辰'=>'辰', '未'=>'未', '戌'=>'戌', '丑'=>'丑',
		);
		$rizhi = $bazi['ri_zhi'];   //!< 日支
		$hitzhi = $map[$rizhi];		//!< 日支对应的华盖支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi==$zhi) {
				$res[] = array (
					'name' => '华盖（聪明灵感）',
					'position' => $im[1],
					'jue' => '命带华盖，必为聪明勤学，清静寡欲，但不免较为孤僻。若华盖逢印绶而临旺相，在官场有相当的地位；若华盖遇空亡，或遭破坏，则不免为僧道或孤或寡。',
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 将星
	public function check_jiangxing(&$bazi)
	{/*{{{*/
		$map = array(
			'寅'=>'午', '巳'=>'酉', '申'=>'子', '亥'=>'卯',
			'卯'=>'卯', '午'=>'午', '酉'=>'酉', '子'=>'子',
			'辰'=>'子', '未'=>'卯', '戌'=>'午', '丑'=>'酉',
		);
		$rizhi = $bazi['ri_zhi'];     //!< 日支
		$nianzhi = $bazi['nian_zhi']; //!< 年支
		$hitzhi1 = $map[$rizhi];		  //!< 日支对应的将星支
		$hitzhi2 = $map[$nianzhi];		  //!< 年支对应的将星支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			//if ($hitzhi1==$zhi || $hitzhi2==$zhi) {
			if ($hitzhi1==$zhi) {
				$res[] = array (
					'name' => '将星（管理潜质）',
					'position' => $im[1],
					'jue' => '将星者，如大将驻扎中军也。将星与官杀同柱，掌军政大权；与羊刃同柱，掌生杀大权；与财星同住，掌财政大权。该星与吉神相临愈增其威；与凶星会聚亦增凶星之力。',
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 阴阳差错煞(不吉)
	public function check_yinyangchacuo(&$bazi)
	{/*{{{*/
		$arr = array('丙子','丙午','丁丑','丁未','戊寅','戊申','辛卯','辛酉','壬辰','壬戌','癸巳','癸亥');
		$rigz = $bazi['ri_gan'].$bazi['ri_zhi'];
		if (in_array($rigz,$arr)) {
			$item = array (
				'name' => '阴阳差错煞',
				'position' => '日柱',
				'jue' => '主婚姻波折。女子逢之，公姑寡合，妯娌不足，夫家冷退；男子逢之，主退外家，亦与妻家是非寡合。——《三命通会》',
				'jixiong' => 'xiongsha',
			);
			return array($item);
		}
		return false;
	}/*}}}*/

	// 文昌贵人(吉)
	public function check_wenchangguiren(&$bazi)
	{/*{{{*/
		$name = '文昌贵人（聪资博学）';
		$map = array(
			'甲'=>'巳','乙'=>'午','丙'=>'申','丁'=>'酉','戊'=>'申',
			'己'=>'酉','庚'=>'亥','辛'=>'子','壬'=>'寅','癸'=>'卯'
		);
		$rigan = $bazi['ri_gan'];
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支','文昌入命，主聪明过人，又主逢凶化吉。气质雅秀，举止温文，男命逢着内涵，女命逢着仪容。好学新知，具上进心。一生近官利贵，不与粗俗之辈乱交。'),
			array('yue_zhi','月支','文昌入命，主聪明过人，又主逢凶化吉。气质雅秀，举止温文，男命逢着内涵，女命逢着仪容。好学新知，具上进心。一生近官利贵，不与粗俗之辈乱交。'),
			array('ri_zhi','日支','文昌入命，主聪明过人，又主逢凶化吉。气质雅秀，举止温文，男命逢着内涵，女命逢着仪容。好学新知，具上进心。一生近官利贵，不与粗俗之辈乱交。'),
			array('hour_zhi','时支','文昌入命，主聪明过人，又主逢凶化吉。气质雅秀，举止温文，男命逢着内涵，女命逢着仪容。好学新知，具上进心。一生近官利贵，不与粗俗之辈乱交。'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($map[$rigan]==$zhi) {
				$res[] = array (
					'name' => $name,
					'position' => $im[1],
					'jue' => $im[2],
					'jixiong' => 'jisha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 魁罡
	public function check_kuigang(&$bazi)
	{/*{{{*/
		$name = '魁罡（刚烈果敢）';
		$map = array('壬辰','戊戌','庚辰','庚戌');
		$res = array();
		// 主看日柱
		$rizhu = $bazi['ri_gan'].$bazi['ri_zhi'];
		if (in_array($rizhu,$map)) {
			// 日柱为魁罡,其他柱为魁罡才有意义	
			$arr = array(
				array('nian','年柱'),
				array('yue','月柱'),
				array('ri','日柱'),
				array('hour','时柱'),
			);
			foreach ($arr as $im) {
				$ganzhi = $bazi[$im[0].'_gan'].$bazi[$im[0].'_zhi'];
				if (in_array($ganzhi,$map)) {
					$res[] = array (
						'name' => $name,
						'position' => $im[1],
						'jue' => '魁罡者，制伏群凶及众人之星。有强烈之性情，临事果断，秉权好杀。运行身旺，发福百端。一见财官祸患立至。若日柱魁罡遇刑冲，乃贫寒之士。女逢此星，心性过度刚强，大多克夫，变为寡妇或离婚。',
						'jixiong' => $bazi['gender']=='女' ? 'xiongsha' : 'zhongsha',
					);
				}
			}
		}
		return $res;
	}/*}}}*/

	// 沐浴桃花(日干桃花)
	public function check_muyutaohua(&$bazi)
	{/*{{{*/
		$name = '沐浴桃花（风流多情，性欲旺盛）';
		$map = array('甲子','乙巳','丙卯','丁申','戊卯','己申','庚午','辛亥','壬酉','癸寅');
		$res = array();
		// 主看日柱
		$rizhu = $bazi['ri_gan'].$bazi['ri_zhi'];
		if (in_array($rizhu,$map)) {
			$res[] = array (
				'name' => $name,
				'position' => '日柱',
				'jue' => '日坐沐浴桃花，生性风流多情，性欲旺盛，追求男欢女爱，一生多艳遇。',
				'jixiong' => 'zhongsha',
			);
		}
		return $res;
	}/*}}}*/

	// (日支)桃花
	public function check_taohua(&$bazi)
	{/*{{{*/
		$map = array(
			'寅'=>'卯','午'=>'卯','戌'=>'卯',
			'巳'=>'午','酉'=>'午','丑'=>'午',
			'申'=>'酉','子'=>'酉','辰'=>'酉',
			'亥'=>'子','卯'=>'子','未'=>'子',
		);
		$rizhi = $bazi['ri_zhi'];   //!< 日支
		$taohua_zhi = $map[$rizhi];	//!< 日支对应的桃花支
		// 桃花分类
		$taohua_map = array (
			'neitaohua' => array (
				'name' => '内桃花（婚内异性缘）',
				'jue' => '墙内桃花，主夫妻恩爱，如胶似膝，形影不离，相敬如宾。',
				'jixiong' => 'jisha',
			),
			'waitaohua' => array (
				'name' => '外桃花（婚外异性缘）',
				'jue' => '墙外桃花，多外遇情人，为人风流浪漫。',
				'jixiong' => 'zhongsha',
			),
		);
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支','neitaohua'),
			array('yue_zhi','月支','neitaohua'),
			array('hour_zhi','时支','waitaohua'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			$th = $taohua_map[$im[2]];
			if ($taohua_zhi==$zhi) {
				$res[] = array (
					'name' => $th['name'],
					'position' => $im[1],
					'jue' => $th['jue'],
					'jixiong' => $th['jixiong'],
				);
			}
		}
		return $res;
	}/*}}}*/

	// 劫煞
	public function check_jiesha(&$bazi)
	{/*{{{*/
		$map = array(
			'寅'=>'亥','午'=>'亥','戌'=>'亥',
			'巳'=>'寅','酉'=>'寅','丑'=>'寅',
			'申'=>'巳','子'=>'巳','辰'=>'巳',
			'亥'=>'申','卯'=>'申','未'=>'申',
		);
		$jue = "劫煞为五行之绝处，命中犯之多破财，惹是非。月时见之最重，年较轻。";
		$rizhi = $bazi['ri_zhi'];   //!< 日支
		$hitzhi = $map[$rizhi];		//!< 日支对应的劫煞支
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if ($hitzhi==$zhi) {
				$res[] = array (
					'name' => '劫煞（破财灾劫）',
					'position' => $im[1],
					'jue' => $jue,
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 灾煞(白虎煞)
	public function check_zaisha(&$bazi)
	{/*{{{*/
		$shainfo = array (
			'name' => '灾煞（白虎煞）',
			'map' => array (
				'寅'=>'子', '巳'=>'卯', '申'=>'午', '亥'=>'酉',
				'卯'=>'酉', '午'=>'子', '酉'=>'卯', '子'=>'午',
				'辰'=>'午', '未'=>'酉', '戌'=>'子', '丑'=>'卯',
			),
			'jue' => '灾煞居于冲将星之位，其性勇猛，喜见官星印绶，以生旺为吉。',
		);
		$hitzhi = array (
			$shainfo['map'][$bazi['ri_zhi']],   //!< 日支查
			$shainfo['map'][$bazi['nian_zhi']], //!< 年支查
		);
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if (in_array($zhi,$hitzhi)) {
				$res[] = array (
					'name' => $shainfo['name'],
					'position' => $im[1],
					'jue' => $shainfo['jue'],
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 天罗地网
	public function check_tianluodiwang(&$bazi)
	{/*{{{*/
		$shainfo = array (
			'name' => '天罗地网（坎坷不顺）',
			'map' => array (
				'戌'=>'亥', '亥'=>'戌', '辰'=>'巳', '巳'=>'辰',
			),
			'jue' => '一般有天罗地网煞的人，性格刚烈，容易触犯刑法。',
		);
		$hitzhi = array (
			$shainfo['map'][$bazi['ri_zhi']],   //!< 日支查
			$shainfo['map'][$bazi['nian_zhi']], //!< 年支查
		);
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if (in_array($zhi,$hitzhi)) {
				$res[] = array (
					'name' => $shainfo['name'],
					'position' => $im[1],
					'jue' => $shainfo['jue'],
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 空亡
	public function check_kongwang(&$bazi)
	{/*{{{*/
		$shainfo = array (
			'name' => '空亡（天中煞）',
			'map' => array (
				'甲子'=>'戌,亥', '甲戌'=>'申,酉', '甲申'=>'午,未', '甲午'=>'辰,巳', '甲辰'=>'寅,卯', '甲寅'=>'子,丑',
				'乙丑'=>'戌,亥', '乙亥'=>'申,酉', '乙酉'=>'午,未', '乙未'=>'辰,巳', '乙巳'=>'寅,卯', '乙卯'=>'子,丑',
				'丙寅'=>'戌,亥', '丙子'=>'申,酉', '丙戌'=>'午,未', '丙申'=>'辰,巳', '丙午'=>'寅,卯', '丙辰'=>'子,丑',
				'丁卯'=>'戌,亥', '丁丑'=>'申,酉', '丁亥'=>'午,未', '丁酉'=>'辰,巳', '丁未'=>'寅,卯', '丁巳'=>'子,丑',
				'戊辰'=>'戌,亥', '戊寅'=>'申,酉', '戊子'=>'午,未', '戊戌'=>'辰,巳', '戊申'=>'寅,卯', '戊午'=>'子,丑',
				'己巳'=>'戌,亥', '己卯'=>'申,酉', '己丑'=>'午,未', '己亥'=>'辰,巳', '己酉'=>'寅,卯', '己未'=>'子,丑',
				'庚午'=>'戌,亥', '庚辰'=>'申,酉', '庚寅'=>'午,未', '庚子'=>'辰,巳', '庚戌'=>'寅,卯', '庚申'=>'子,丑',
				'辛未'=>'戌,亥', '辛巳'=>'申,酉', '辛卯'=>'午,未', '辛丑'=>'辰,巳', '辛亥'=>'寅,卯', '辛酉'=>'子,丑',
				'壬申'=>'戌,亥', '壬午'=>'申,酉', '壬辰'=>'午,未', '壬寅'=>'辰,巳', '壬子'=>'寅,卯', '壬戌'=>'子,丑',
				'癸酉'=>'戌,亥', '癸未'=>'申,酉', '癸巳'=>'午,未', '癸卯'=>'辰,巳', '癸丑'=>'寅,卯', '癸亥'=>'子,丑',
			),
			'jue' => '空亡即空无，缺失。用神吉神逢之，灭喜少吉祥；忌神凶煞逢之，却煞灭凶。',
		);
		$nianzhu = $bazi['nian_gan'].$bazi['nian_zhi'];
		$rizhu = $bazi['ri_gan'].$bazi['ri_zhi'];
		$hitzhi = explode(',',$shainfo['map'][$nianzhu].','.$shainfo['map'][$rizhu]);
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if (in_array($zhi,$hitzhi)) {
				$res[] = array (
					'name' => $shainfo['name'],
					'position' => $im[1],
					'jue' => $shainfo['jue'],
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 孤辰
	public function check_guchen(&$bazi)
	{/*{{{*/
		$shainfo = array (
			'name' => '孤辰',
			'map' => array (
				'寅'=>'巳', '巳'=>'申', '申'=>'亥', '亥'=>'寅',
				'卯'=>'巳', '午'=>'申', '酉'=>'亥', '子'=>'寅',
				'辰'=>'巳', '未'=>'申', '戌'=>'亥', '丑'=>'寅',
			),
			'jue' => '孤寡主个性独立，不易接近，婚姻不顺。',
		);
		$hitzhi = array (
//			$shainfo['map'][$bazi['ri_zhi']],   //!< 日支查
			$shainfo['map'][$bazi['nian_zhi']], //!< 年支查
		);
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if (in_array($zhi,$hitzhi)) {
				$res[] = array (
					'name' => $shainfo['name'],
					'position' => $im[1],
					'jue' => $shainfo['jue'],
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/

	// 寡宿
	public function check_guasu(&$bazi)
	{/*{{{*/
		$shainfo = array (
			'name' => '寡宿',
			'map' => array (
				'寅'=>'丑', '巳'=>'辰', '申'=>'未', '亥'=>'戌',
				'卯'=>'丑', '午'=>'辰', '酉'=>'未', '子'=>'戌',
				'辰'=>'丑', '未'=>'辰', '戌'=>'未', '丑'=>'戌',
			),
			'jue' => '孤寡主个性独立，不易接近，婚姻不顺。',
		);
		$hitzhi = array (
//			$shainfo['map'][$bazi['ri_zhi']],   //!< 日支查
			$shainfo['map'][$bazi['nian_zhi']], //!< 年支查
		);
		// 日干对四柱地支
		$arr = array(
			array('nian_zhi','年支'),
			array('yue_zhi','月支'),
			array('ri_zhi','日支'),
			array('hour_zhi','时支'),
		);
		$res = array();
		foreach ($arr as $im) {
			$zhi = $bazi[$im[0]];
			if (in_array($zhi,$hitzhi)) {
				$res[] = array (
					'name' => $shainfo['name'],
					'position' => $im[1],
					'jue' => $shainfo['jue'],
					'jixiong' => 'xiongsha',
				);
			}
		}
		return $res;
	}/*}}}*/
	
}
// vim600: sw=4 ts=4 fdm=marker syn=php
?>
