			$( function() {
				
				var urls=new Array();
				urls.push("http://user_name99:pass_word99@www.example.com:8080/animals/neko?id=99&xx=88#kani");
				urls.push("http://www.example.com:8080/animals/neko?id=99&xx=88#kani");
				urls.push("http://example.com:8080/animals/neko?id=99&xx=88#kani");
				urls.push("https://example.com:8080/animals/neko?id=99&xx=88#kani");
				urls.push("ws://example.com:8080/animals/neko?id=99&xx=88#kani");
				urls.push("http://example.com/animals/neko?id=99&xx=88#kani");
				urls.push("http://example.com");
				urls.push("");
				//■■■□□□■■■□□□■■■□□□
				/*
				var url1="http://www.example.com:8080/animals/neko?id=99&xx=88#kani";
				var domain = url1.match(/^[httpsfile]+:\/{2,3}([0-9a-z\.\-:]+?):？[0-9]*?\//i)[1];
				alert(domain);
				*/
				
				//▽方法1
				for(var i=0;i<urls.length;i++){
					var url='';
					var host_domain=false;
					try {
						url=urls[i];
						host_domain = url.match(/^[httpsfile]+:\/{2,3}([0-9a-z\.\-:]+?):?[0-9]*?\//i)[1];
					}catch (e) {
					   console.log(e);
					}
					
					var tr="<tr><td>" + url + "</td><td>" + host_domain + "</td></tr>";
					$('#res_tbl1 tbody').append(tr);
	
				}
				
				
				//▽方法2
				for(var i=0;i<urls.length;i++){
					var url='';
					var host_domain=false;
					try {
						url=urls[i];
						host_domain = extractHostDomain(url);
						
					}catch (e) {
					   console.log(e);
					}
					
					var tr="<tr><td>" + url + "</td><td>" + host_domain + "</td></tr>";
					$('#res_tbl2 tbody').append(tr);
	
				}
				
				
	
			});
			
			
			/**
			 * URLからホスト・ドメインを取得する。
			 * @param url URL
			 * @returns ホスト・ドメイン（例：www.example.com）
			 * @link http://stackoverflow.com/questions/8498592/extract-root-domain-name-from-string
			 */
			function extractHostDomain(url) {
			    var host_domain;
			    
			    if (url.indexOf("://") > -1) {
			        host_domain = url.split('/')[2];
			    }
			    else {
			        host_domain = url.split('/')[0];
			    }

			    host_domain = host_domain.split(':')[0];

			    return host_domain;
			}