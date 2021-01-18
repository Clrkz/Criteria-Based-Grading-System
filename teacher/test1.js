function delay(fn, ms) {
  let timer = 0
  return function(...args) {
    clearTimeout(timer)
    timer = setTimeout(fn.bind(this, ...args), ms || 0)
  }
} 

$(document).ready(function(){ 
$('input[name=score]').keyup(function() {
	 var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        } 
	 
});
$('input[name=score]').keyup(delay(function (e) {
  //console.log('Time elapsed!', this.value);
		var id = $(this).attr('id'); 
		var score = $('#'+id).val();   
		var arr = id.split('_');    
		 $.ajax({
		 url:"test.php",  
		  method:"POST",  
		  data: {cid:arr[0],
				sid:arr[1],
				score:score,
				},  
		  success:function(data) {  
		 //  alert(data);   //window.location.reload();
		  }
		});
}, 250));
 });