function delay(fn, ms) {
  let timer = 0
  return function(...args) {
    clearTimeout(timer)
    timer = setTimeout(fn.bind(this, ...args), ms || 0)
  }
} 
$(document).ready(function(){ 
$('input[name=checkbox]').change(delay(function (e) {
    if($(this).is(':checked')) {
		 var id = $(this).attr('id'); 
		var check = $('#'+id).val();    
		var arr = check.split(' '); 
		 $.ajax({
		 url:"test.php",  
		  method:"POST",  
		  data: {cid:arr[0],
				sid:arr[1],
				score:1,
				},  
		  success:function(data) {  
		 //  alert(data);   //window.location.reload();
		  }
		});
    } else { 
		 var id = $(this).attr('id'); 
		var check = $('#'+id).val();  
		//console.log('ID: '+id);
		//console.log('VALUE: '+check);
		var arr = check.split(' '); 
			 $.ajax({
			  url:"test.php",
			  method:"POST",  
			  data: {cid:arr[0],
				sid:arr[1],
				score:0,
				},  
			  success:function(data) {  
			   //alert(data);   //window.location.reload();
			  }
			 });
    }
}, 200));
 });