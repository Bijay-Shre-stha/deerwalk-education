$( document ).ready(function(){

	$.validator.addMethod("nameonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

	$("#register-ohs").validate({
		rules: {
			fullname:{
				required:true,
				nameonly:true,
				maxlength:100
			},
			email:{
				required: true,
				email:true,
				maxlength: 255
			},
			phone:{
				required:true,
				digits:true,
				minlength:9,
				maxlength:15
			},
			high_school:{
				required:true,
				maxlength: 255
			},
			other:{
				required:'#otherS:checked',
				maxlength: 255
			},
			interest:{
				required:true,
				digits:true
			}
		},
		messages:{
			fullname:{
				nameonly:"Please use alphabets only"
			},
			email:{
				email:"Please enter valid email address"
			}
		}		
	});

//	$("#register-ohs").validate({});

	
});