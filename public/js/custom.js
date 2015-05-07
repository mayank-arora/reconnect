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
});



/*
------------------
Search tab
------------------
*/


$(document).ready(function(){
	$(".location-tab").on("click", function(){
		$("#search-location-tab").addClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#map-canvas").removeClass("hide");
		$(".profession-container").addClass("hide");
		$(".batch-container").addClass("hide");
		$(".domain-container").addClass("hide");
	});
	$(".profession-tab").on("click", function(){
		$("#search-profession-tab").addClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#map-canvas").addClass("hide");
		$(".profession-container").removeClass("hide");
		$(".batch-container").addClass("hide");
		$(".domain-container").addClass("hide");
	});
	$(".batch-tab").on("click", function(){
		$("#search-batch-tab").addClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-domain-tab").removeClass("active");
		$("#map-canvas").addClass("hide");
		$(".profession-container").addClass("hide");
		$(".batch-container").removeClass("hide");
		$(".domain-container").addClass("hide");
	});
	$(".domain-tab").on("click", function(){
		$("#search-domain-tab").addClass("active");
		$("#search-location-tab").removeClass("active");
		$("#search-profession-tab").removeClass("active");
		$("#search-batch-tab").removeClass("active");
		$("#map-canvas").addClass("hide");
		$(".profession-container").addClass("hide");
		$(".batch-container").addClass("hide");
		$(".domain-container").removeClass("hide");
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
	$("#award-add-btn").on("click", function(){
		$("#award-add-btn").addClass("hidden");
		$("#award-add-form").removeClass("hidden");
	})
	$("#role-add-btn").on("click", function(){
		$("#role-add-btn").addClass("hidden");
		$("#role-add-form").removeClass("hidden");
	})
	$("#achieve-add-btn").on("click", function(){
		$("#achieve-add-btn").addClass("hidden");
		$("#achieve-add-form").removeClass("hidden");
	})
	$("#study-add-btn").on("click", function(){
		$("#study-add-btn").addClass("hidden");
		$("#study-add-form").removeClass("hidden");
	})
	$("#csr-add-btn").on("click", function(){
		$("#csr-add-btn").addClass("hidden");
		$("#csr-add-form").removeClass("hidden");
	})
});

/* Edit Profile */

$(document).ready(function(){
	$("#batch").on("change", function(){
		var branch_val = $("#batch").val();
		if (branch_val == 20) {
			$("#form-degree").addClass("hidden");
			$("#form-branch").addClass("hidden");
		}
		else{
			$("#form-degree").removeClass("hidden");
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
});


/*
------------------
Tabs page
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