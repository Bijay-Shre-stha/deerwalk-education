$(function(){
	$("#loginMe").validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true
			}
		},
		messages:{
			email:{
				required:"*This field is required!!",
				email:"**Please enter a valid email address."
			},
			password:{
				required:"*This field is required!!"
			}
		}
	})
});