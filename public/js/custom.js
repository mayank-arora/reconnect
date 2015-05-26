/*
------------------
Login Form
------------------
*/
$(document).ready(function(){
	var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
	$(".login-form").one(animationEnd, function(){
		$("#login-email-input").focus();	
	});
	$("#register-init").on("click", function(){
		$(".login-form").addClass("fadeOutLeft").removeClass("fadeInLeft");
		$(".login-form").one(animationEnd, function(){
			$(".login-form").addClass("hidden");
			$(".login-register-form").removeClass("hidden").addClass("animated fadeInLeft");
			$(".login-register-form").one(animationEnd, function(){
				$("#login-fname-input").focus();
			});
		});
		$(".login-forgot-password").addClass("animated fadeOut")
	});
	$(".login-forgot-password").on("click", function(){
		$(".login-forgot-password").addClass("fadeOut").removeClass("fadeIn");
		$(".login-form").addClass("fadeOutLeft").removeClass("fadeInLeft");
		$(".login-form").one(animationEnd, function(){
			$(".login-form").addClass("hidden");
			$(".login-forgot-password").addClass("hidden");
			$(".login-forgot-form").removeClass("hidden").addClass("animated fadeInLeft");
			$(".login-forgot-form").one(animationEnd, function(){
				$("#forgot-form-email").focus();
			});
		});
	});
	$(".login-send-again").on("click", function(){
		// $(".login-send-again").addClass("fadeOut").removeClass("fadeIn");
		$(".login-form").addClass("fadeOutLeft").removeClass("fadeInLeft");
		$(".login-form").one(animationEnd, function(){
			$(".login-form").addClass("hidden");
			$(".login-send-again").addClass("hidden");
			$(".login-send-again-form").removeClass("hidden").addClass("animated fadeInLeft");
			$(".login-send-again-form").one(animationEnd, function(){
				$("#send-again-email").focus();
			});
		});
	});
});



/*
------------------
Search tab
------------------
*/


$(document).ready(function(){
	$(".batch-tab").on("click", function(){
		$("#search-batch-tab").addClass("active");
		$("#search-branch-tab").removeClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#map-canvas").addClass("hidden");
		$(".profession-container").addClass("hidden");
		$(".branch-container").addClass("hidden");
		$(".batch-container").removeClass("hidden");
		$(".domain-container").addClass("hidden");
	});
	$(".branch-tab").on("click", function(){
		$("#search-branch-tab").addClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#map-canvas").addClass("hidden");
		$(".profession-container").addClass("hidden");
		$(".batch-container").addClass("hidden");
		$(".branch-container").removeClass("hidden");
		$(".domain-container").addClass("hidden");
	});
	$(".profession-tab").on("click", function(){
		$("#search-profession-tab").addClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#search-branch-tab").removeClass("active");
		$(".branch-container").addClass("hidden");
		$("#map-canvas").addClass("hidden");
		$(".profession-container").removeClass("hidden");
		$(".batch-container").addClass("hidden");
		$(".domain-container").addClass("hidden");
	});
	$(".domain-tab").on("click", function(){
		$("#search-domain-tab").addClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#search-branch-tab").removeClass("active");
		$(".branch-container").addClass("hidden");
		$("#map-canvas").addClass("hidden");
		$(".profession-container").addClass("hidden");
		$(".batch-container").addClass("hidden");
		$(".domain-container").removeClass("hidden");
	});
	$(".location-tab").on("click", function(){
		$("#search-location-tab").addClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#search-branch-tab").removeClass("active");
		$(".branch-container").addClass("hidden");
		$("#map-canvas").removeClass("hidden");
		$(".profession-container").addClass("hidden");
		$(".batch-container").addClass("hidden");
		$(".domain-container").addClass("hidden");
	});
});



/*
------------------
Profile page
------------------
*/


$(document).ready(function(){
	$(".edit-pen").hover(function(){
		$(this).removeClass("edit-pen");
		$(this).addClass("edit-pen-highlight");
	},
	function(){
		$(this).removeClass("edit-pen-highlight");
		$(this).addClass("edit-pen");
	});
	$(".profile-view-more").on("click", function(){
		$(".detail-hobbies").removeClass("hide");
		$(".detail-designation").removeClass("hide");
		$(".detail-company").removeClass("hide");
		$(".detail-profession").removeClass("hide");
		$(".detail-domain").removeClass("hide");
		$(".detail-fb_link").removeClass("hide");
		$(".detail-linkedin_link").removeClass("hide");
		$(".detail-view").addClass("hide");
	});
	$(".award-container #data-add-btn").on("click", function(){
		$(".award-container #data-add-btn").addClass("hidden");
		$("#award-add-form").removeClass("hidden");
	})
	$(".role-container #data-add-btn").on("click", function(){
		$(".role-container #data-add-btn").addClass("hidden");
		$("#role-add-form").removeClass("hidden");
	})
	$(".achieve-container #data-add-btn").on("click", function(){
		$(".achieve-container #data-add-btn").addClass("hidden");
		$("#achieve-add-form").removeClass("hidden");
	})
	$(".study-container #data-add-btn").on("click", function(){
		$(".study-container #data-add-btn").addClass("hidden");
		$("#study-add-form").removeClass("hidden");
	})
	$(".csr-container #data-add-btn").on("click", function(){
		$(".csr-container #data-add-btn").addClass("hidden");
		$("#csr-add-form").removeClass("hidden");
	})
	$(".contact-container #data-add-btn").on("click", function(){
		$(".csr-container #data-add-btn").addClass("hidden");
		$("#contact-add-form").removeClass("hidden");
	})

	$(".award-container #data-cancel-btn").on("click", function(){
		$(".award-container #data-add-btn").removeClass("hidden");
		$("#award-add-form").addClass("hidden");
	})
	$(".role-container #data-cancel-btn").on("click", function(){
		$(".role-container #data-add-btn").removeClass("hidden");
		$("#role-add-form").addClass("hidden");
	})
	$(".achieve-container #data-cancel-btn").on("click", function(){
		$(".achieve-container #data-add-btn").removeClass("hidden");
		$("#achieve-add-form").addClass("hidden");
	})
	$(".study-container #data-cancel-btn").on("click", function(){
		$(".study-container #data-add-btn").removeClass("hidden");
		$("#study-add-form").addClass("hidden");
	})
	$(".csr-container #data-cancel-btn").on("click", function(){
		$(".csr-container #data-add-btn").removeClass("hidden");
		$("#csr-add-form").addClass("hidden");
	})

});

/* Edit Profile */

$(document).ready(function(){
	// $("#batch").on("change", function(){
	// 	var batch_val = $("#batch").val();
	// 	if (batch_val == 20) {
	// 		$("#form-degree").addClass("hidden");
	// 		$("#form-branch").addClass("hidden");
	// 	}
	// 	else{
	// 		$("#form-degree").removeClass("hidden");
	// 		$("#form-branch").removeClass("hidden");
	// 	};
	// });
	$("#degree").on("change", function(){
		var degree_val = $("#degree").val();
		if (degree_val == 4) {
			$("#form-branch").addClass("hidden");
			$("#branch").val(8);
		}
		else{
			$("#form-branch").removeClass("hidden");
		};
	});
	$("#company").on("change", function(){
		var company_val = $("#company").val();
		if (company_val == 6) {
			$(".new-company-div").removeClass("hidden");
		}
		else{
			$(".new-company-div").addClass("hidden");
		};
	});
	$('.selectpicker').selectpicker({
		size: 6
	});
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy'
	});
});


/*
------------------
Jobs page
------------------
*/



$(document).ready(function(){
	$("#job-jobs-tab").on("click", function(){
		$("#job-jobs-tab").addClass("active");
		$("#job-company-tab").removeClass("active");
		$("#job-job-location-tab").removeClass("active");
		$("#job-applied-tab").removeClass("active");
		$(".jobs-container").removeClass("hide");
		$(".job-location-container").addClass("hide");
		$(".company-container").addClass("hide");
		$(".applied-container").addClass("hide");
	});
	$("#job-company-tab").on("click", function(){
		$("#job-company-tab").addClass("active");
		$("#job-jobs-tab").removeClass("active");
		$("#job-job-location-tab").removeClass("active");
		$("#job-applied-tab").removeClass("active");
		$(".company-container").removeClass("hide");
		$(".jobs-container").addClass("hide");
		$(".job-location-container").addClass("hide");
		$(".applied-container").addClass("hide");
	});
	$("#job-job-location-tab").on("click", function(){
		$("#job-job-location-tab").addClass("active");
		$("#job-company-tab").removeClass("active");
		$("#job-jobs-tab").removeClass("active");
		$("#job-applied-tab").removeClass("active");
		$(".job-location-container").removeClass("hide");
		$(".jobs-container").addClass("hide");
		$(".company-container").addClass("hide");
		$(".applied-container").addClass("hide");
	});
	$("#job-applied-tab").on("click", function(){
		$("#job-applied-tab").addClass("active");
		$("#job-jobs-tab").removeClass("active");
		$("#job-job-location-tab").removeClass("active");
		$("#job-company-tab").removeClass("active");
		$(".applied-container").removeClass("hide");
		$(".jobs-container").addClass("hide");
		$(".job-location-container").addClass("hide");
		$(".company-container").addClass("hide");
	});
});


/*
------------------
Mesages
------------------
*/


$(document).ready(function(){
	$("#contact-all-button").on("click", function(){
		$("#contact-form").removeClass("hidden");
		$("#contact-all-button").addClass("hidden");
	});
});