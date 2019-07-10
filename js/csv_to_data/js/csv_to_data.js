
/**
 * ＣＳＶファイルから配列に変換するモジュール
 * ★参照
 * common.js
 * jquery.js
 * 
 * ★履歴
 * 2012/2/3	新規作成
 */

/*
 * CSVテキストをデータ（2次元配列）に変換する。
 * ダブルクォートで括られた値が存在するCSVテキストにも対応。
 * 2012/2/3	新規作成
 * @param	csvText			CSVテキスト
 * */
function convertCsvToData(csvText){
	return convertCsvToData0(',',null,csvText,true);
}

/*
 * CSVテキストをデータ（2次元配列）に変換する。
 * ダブルクォートで括られた値が存在するCSVテキストにも対応。
 * 2012/2/3	新規作成
 * @param	 col_sep	区切り文字
 * @param	 col_sep	行区切り文字
 * @param	oj			CSVテキスト
 * @param	removeDoubleQuote	ダブルクォートを削除する場合はtrue;
 * */
function convertCsvToData0(col_sep,row_sep,oj,removeDoubleQuote){
			var rdq=(removeDoubleQuote)?'':'"';

			//mk dmy for comma in "
			var dmy =['-###','###-'],cnt=0,r;
			cnt=(function mkdmy(cnt){
				if(!(
					oj.indexOf((dmy[0]+'comma'+cnt+dmy[1]))==-1 ||
					oj.indexOf((dmy[0]+'rn'+cnt+dmy[1]))==-1 ||
					oj.indexOf((dmy[0]+'wDquote'+cnt+dmy[1]))==-1 
				))mkdmy( ++cnt )
				else void(0)
				return cnt;
			})(cnt)

			//var reg='(["](.|(\r\n))*?(["]$|["][,('+op.row_sep_reg+')]))',
			var reg='(["](.|(\r\n))*?(["]$|["][,(\r\n)]))',
				dmystr_comma=''+(dmy[0]+'comma'+cnt+dmy[1]) ,
				dmystr_rn=''+(dmy[0]+'rn'+cnt+dmy[1]) ,
				dmystr_wDquote=''+(dmy[0]+'wDquote'+cnt+dmy[1]) ;

			escape= oj.replace('""',dmystr_wDquote);
			escape= escape.replace(
				new RegExp(reg,"g"),
				function (after,before,index) {
					after= after
							.replace(/(\r\n)(?!$)/g,dmystr_rn)
							.replace(/,(?!$)/g,dmystr_comma)
					return after
					
				}
			)

			//if(op.select == '*'||op.select == ['*'])
					//r=$.csv2table._rowsAry[id]=mkArray(escape,op.col_sep,op.row_sep);
			//r=mkArray(escape,op.col_sep,op.row_sep);

			r=mkArray(escape,',', '\n');
			//else	r=$.csv2table._rowsAry[id]=mkSelectedArray(escape,op.col_sep,op.row_sep,op.select)

			var b=[],rowlen=r.length,collen=r[0].length;
			for(var i=0;i<rowlen;i++){
				if(r[i]=='')continue; 
				b[i]=r[i];
				for(var j=0;j<collen;j++){
					try{
						b[i][j]=$.trim(r[i][j])
							.replace(/^"|"$/g,rdq)
							.replace(new RegExp(dmystr_comma,"g"),",")
							.replace(new RegExp(dmystr_rn,"g"),"\r\n")
							.replace(new RegExp(dmystr_wDquote,'g'),'""');
					} catch(e){}
				}
			}
			return b
		}
		
		
		
		function mkArray(data,col_sep,row_sep){
			var rows=data.split(row_sep),rc=[]
			    rowlen=rows.length ;
			for(var i=0;i<rowlen;i++){
				if($.trim(rows[i])=='') continue; 
				try{
					rc[i]=rows[i].split(col_sep);
				} catch(e){ }
			}
			return rc
	}
		
		
		function mkSelectedArray(data,col_sep,row_sep,select){
			var rows=data.split(row_sep),rc=[],c=[],
			    rowlen=rows.length ;
			for(var i=0;i<rowlen;i++){
				if($.trim(rows[i])=='') continue; 
				try{
					rc[i]=rows[i].split(col_sep);
					c[i]=[];
					for(var j=0;j<select.length;j++){
						c[i].push(rc[i][select[j]])
					}
				} catch(e){ }
			}
			return c||rc
	}