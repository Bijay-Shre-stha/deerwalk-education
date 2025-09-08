$(function(){

	$.validator.addMethod('strongPassword', function(value, element){
		return value.length >=6 && /\d/.test(value) && /[a-z]/i.test(value);
	}, 'Password Must Contain at least 6 Characters long and contain at least one number and one character\'.');

	$.validator.addMethod("nameonly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

	$.validator.addMethod("alphanumopt", function(value, element) {
        return /^(?![0-9]*$)[a-zA-Z0-9]+$/.test(value);
	});    
	
	$.validator.addMethod("greaterThan", function (value, element, params) {
		console.log("here");
		return this.optional(element) || new Date(value) >= new Date($(params).val());
	},'Must be greater than {0}.');


	$("#add-user").validate({
		rules: {
			fullname:{
				required:true,
				nameonly:true
			},
			email:{
				required: true,
				email:true
			},
			password:{
				required:true,
				strongPassword:true
			},
			repassword:{
				required:true,
				equalTo: "#password"
			},
			type:{
				required:true
			}
		},
		messages:{
			fullname:{
				nameonly:"*Please use alphabets only"
			},
			email:{
				email:"*Please enter valid email address"
			},
			password:{
				strongPassword:"*Password Must Be greater than 6 letter and contain at least 1 number and 1 character"
			},
			repassword:{
				required:"*Please Enter Your password again",
				equalTo:"*Please re-enter same password"
			}
		}		
	});

	$("#change-password").validate({
		rules: {
			oldPass:{
				required:true
			},
			newPass:{
				required:true,
				strongPassword:true
			},
			rePass:{
				required:true,
				equalTo:"#newPass"
			}
		},
		messages:{
			newPass:{
				strongPassword:"*Password Must Be greater than 6 letter and contain at least 1 number and 1 character"
			},
			rePass:{
				required:"*Please Enter Your password again",
				equalTo:"*Please re-enter same password"
			}
		}

	});

	$("#add-department").validate({
		rules: {
			departmentName:{
				required:true,
				alphanumopt:true
			},
			description:{
				required:true,
			}
		},
		messages:{
			departmentName:{
				alphanumopt:"Department name cannot contain number only"
			}
		}
	})

	$("#add-session").validate({
		rules: {
			sessionYear:{
				required:true,
				digits:true,
				minlength:4,
				maxlength:4
			},
			sessionNum:{
				required:true,
				digits:true
			},
			sessionDate1: {
				required:true
			},
			maxParticipants1: {
				required:true,
				digits:true
			},
			sessionTime1: {
				required:true
			},
			sessionTime2: {
				required: function () {
                	return $("#sessionDate2").val().length > 0
            	}
			},
			maxParticipants2: {
				required: function () {
                	return $("#sessionDate2").val().length > 0
            	},
				digits:true
			},
		},
		messages: {
			sessionNum:{
				digits:"Please enter digits only"
			},
			maxParticipants:{
				digits:"Please enter valid number"
			}
		}
	})

	$("#add-article").validate({
		rules:{
			title:{
				required:true
			},
			content:{
				required:true,
				minlength:50
			}
		}
	})

	$("#add-faculty").validate({
		rules:{
			name:{
				required:true,
				nameonly:true
			},
			email:{
				required:true,
				email:true
			},
			phone:{
				required:false,
				digits:true,
				maxlength:15
			},
			department:{
				required:true
			},
			status:{
				required:true
			},
			description:{
				required:true,
				minlength:20
			},
			priority:{
				required:true,
			}
		},
		messages:{
			name:{
				nameonly:"Please use alphabets only"
			}
		}
	})

	$("#add-course").validate({
		rules:{
			code:{
				required:true
			},
			subject:{
				required:true
			},
			teacher:{
				required:true
			},
			semester:{
				required:true
			},
			stream:{
				required: true
			}
		}
	})

	$("#add-merchandise").validate({
		rules:{
			product:{
				required:true,
			},
			rate:{
				required:true,
				number:true
			},
		}
	})

	$("#add-document").validate({
		rules:{
			docTitle:{
				required:true
			},
			docCategory:{
				required:true
			},
		}
	})

	$("#add-person").validate({
		rules:{
			name:{
				required:true,
				nameonly:true
			},
			email:{
				required:true,
				email:true
			},
			phone:{
				required:true,
				digits:true
			}
		},
		messages:{
			name:{
				nameonly:"Please use alphabets only"
			}
		}
	})

	$("#add-video").validate({
		rules:{
			title:{
				required:true
			},
			urlAddress:{
				required:true,
				url:true
			}
		}
	})

	$("#add-background").validate({
		rules:{
			image:{
				required:true
			}
		}
	})

	$("#add-prospectus").validate({
		rules:{
			name:{
				required:true
			},
			year:{
				required: true,
				digits: true,
				minlength:4,
				maxlength:4,
				min:2000,
				max:2100
			},
			file:{
				required: true
			}
		}
	})


	$("#add-student").validate({
		rules:{
			fullname:{
				required: true,
				nameonly: true
			},
			email:{
				required: true,
				email: true
			},
			batch:{
				required: true,
				digits: true
			},
			school:{
				required: true
			},
			high_school:{
				required: true
			},
			district: {
				required: true,
				nameonly: true
			},
			image:{
				required: true,
				url: true
			}
		},
		messages:{
			fullname:{
				nameonly:"Please use alphabets only"
			},
			district:{
				nameonly:"Please use alphabets only"
			}
		}
	})

	$("#add-healthDiploma").validate({
		rules: {
			title:{
				required:true
			},
			priority:{
				required:true,
				digits:true,
				min:1
			},
			description:{
				required:true
			}
		},
		messages:{
			title:{
				required:"Title is required"
			},
			priority:{
				min:"Priority should be at least 1"
			}
		}
	});

	$("#add-subTopicHealth").validate({
		rules: {
			title:{
				required:true
			},
			priority:{
				required:true,
				digits:true,
				min:1
			},
			description:{
				required:true
			}
		},
		messages:{
			title:{
				required:"Title is required"
			},
			priority:{
				min:"Priority should be at least 1"
			}
		}
	});

	$("#add-creditCourse").validate({
		rules: {
			code:{
				required:true
			},
			subject:{
				required:true,
			},
			description:{
				required:true
			}
		},
		messages:{
			code:{
				required:"Code is required"
			},
			subject:{
				required:"Subject is required"
			},
			description:{
				required:"Subject's Description is required"
			}
		}
	});

	$("#add-workshop").validate({
		rules: {
			name:{
				required: true,
			},
			title:{
				required:true,
			},
			start_date:{
				required: true,
			},
			end_date:{
				required:true,
				greaterThan: "#start_date"
			},
			trainer_id: {
				required:true,
			}
		},
		messages:{
			start_date:{
				required:"*Start Date is required"
			},
			end_date: {
				required:"*End Date is required",
				greaterThan: "*End Date should be greater than Start Date"
			},
			name: {
				required: "*Name is required"
			},
			trainer_id: {
				required: "*Trainer is required"
			}
			
		}

	});

	$("#add-workshopStudent").validate({
		rules: {
			name:{
				required: true,
			},
			email: {
				required: true,
				email: true,
			},
			// image_name:{
			// 	required: true,
			// },
			workshop_id:{
				required:true,
			},
			grade: {
				required:true,
			}
		},
		messages:{
			name:{
				required:"*Name is required"
			},
			email:{
				email: "*Please enter valid email address",
				required: "*Email is Required",
			},
			image_name: {
				required:"*Student's Photo is required",
			},
			workshop_id: {
				required: "*Workshop is required"
			},
			grade: {
				required: "*Grade is required"
			}
			
		}

	});

	$("#add-trainer").validate({
		rules: {
			name:{
				required: true,
			},
			// signature:{
			// 	required: true,
			// },
		},
		messages:{
			name:{
				required:"*Name is required"
			},
			signature: {
				required:"*Trainer's Signature File is required",
			},			
		}

	});

});