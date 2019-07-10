/**
 * 役者ライブラリ
 * 
 * @date 2014-5-12 | 2017-9-19
 * @version 1.1
 */
class ActorLib {

	/**
	 * IDで指定した役者を生成する。
	 * @param id 役者ID
	 * @return 役者
	 */
	get(id){
		var act=new Actor();
		switch (id){
		case 1:
			act.width=30;
			act.height=40;

		case 2:
			act.width=10;
			act.height=30;

		}

		return act;

	}
};