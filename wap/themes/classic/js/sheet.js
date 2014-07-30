$(function(){
	var a = new Date(),b=new Date();
	var year,month,day,s;
	
	function getday(){
		year=a.getFullYear();
		month=(a.getMonth()+1)<10?"0"+(a.getMonth()+1):(a.getMonth()+1);
		day=a.getDate()<10?"0"+a.getDate():a.getDate();	
	    s=year+ "-" +month+ "-" +day;
   	    $(".d_date").text(s);
		
	}
    getday();//初始化日期
	
	  var op; //判断是否支持mouseup;
	  var ua = navigator.userAgent.toLowerCase();
      var isAndroid = ua.indexOf("android") > -1; 
	  var ver=ua.indexOf("android 2")>-1;
      if(isAndroid){
		  if(!ver){
			  op="mouseup";
		   }else{
			 op="click";
		   };  
	  }else{
		  op="click";
	 };	
	  
	$(".add").bind(op,function(){ //日期增加一天，获取日期ajax报表。
	   if(parseInt(a.getTime()+24*60*60*1000)==parseInt(b.getTime())){  //当天的时候按钮变灰
		   $(this).addClass("plus_disabled");
		    a.setTime(a.getTime()+24*60*60*1000);
            getday();
	   }else if(parseInt(a.getTime()+24*60*60*1000)<parseInt(b.getTime())){ 
		    a.setTime(a.getTime()+24*60*60*1000);
            getday();	
	   }else{ //超过当天的没有报表
		   alert("暂无该日报表!");
	   }
	});
	
	$(".sub").bind(op,function(){ //日期减少一天，获取日期ajax报表
	   $(".add").removeClass("plus_disabled");
        a.setTime(a.getTime()-24*60*60*1000);
        getday();
	});
});