/*
------------------
Login Form
------------------
*/
$(document).ready(function(){
	$("#new-btn").on("click", function(){
		$("#login-form").addClass("hide");
		$("#register-form").removeClass("hide");
	});
	$("#reg-btn").on("click", function(){
		if($(".register-text-fname").val()==/ +/ || $(".register-text-lname").val()==/ +/ || 
			$(".register-text-email").val()==/ +/ || $(".register-text-pass").val()==/ +/ ||
			$(".register-text-confirm").val()==/ +/ ){
			alert("hi");
		}
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
		$(".detail-profession").removeClass("hide");
		$(".detail-domain").removeClass("hide");
		$(".detail-fb_link").removeClass("hide");
		$(".detail-linkedin_link").removeClass("hide");
		$(".detail-view").addClass("hide");
	});
});

/* Edit Profile */

$(document).ready(function(){
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