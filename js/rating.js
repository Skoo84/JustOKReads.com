$(function() {
	$('#loginForm').on('submit', function(e){
		$.ajax({
			type: 'POST',
			url : "action.php",
			dataType: "json",			
			data:$(this).serialize(),
			success: function (response) {
				if(response.success == 1) {
					// $('#loginModal').modal('hide');
					// $('#loggedPanel').removeClass('hidden');
					// $('#loggedUser').text(response.username);
					// $( "#rateProduct" ).addClass('login');
					// // rating section
					// $("#ratingDetails").hide();
					// $("#ratingSection").show();
					location.reload();		
				} else {
					$('#loginError').show();
				}				
			}
		});
		return false;
	});
	
	// rating form hide/show
 	$( "#rateProduct, #editRate" ).click(function() {
		if(!$(this).hasClass('login')) {
			$('#loginModal').modal('show');
		} else {
		document.getElementById('action').value = "saveRating";		
		document.getElementById('title').value = "";
	document.getElementById('comment').value = "";
			$("#ratingDetails").hide();
			$("#ratingSection").show();
		}
	});	
	$( "#cancelReview" ).click(function() {
		$("#ratingSection").hide();
		$("#ratingDetails").show();		
	});	
	// implement start rating select/deselect
	$( ".rateButton" ).click(function() {
		if($(this).hasClass('btn-grey')) {			
			$(this).removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).prevAll('.rateButton').removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');			
		} else {						
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');
		}
		$("#rating").val($('.star-selected').length);		
	});
	// save review using Ajax
	$('#ratingForm').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			type : 'POST',
			dataType: "json",	
			url : 'action.php',					
			data : formData,
			success:function(response){
				if(response.success == 1) {
					$("#ratingForm")[0].reset();
					window.location.reload();
				}
			}
		});		
	});
});
function editReviewForAdmin(userid, rating){
	var title = document.getElementById(userid+'title').value;
	var desp = document.getElementById(userid).value;
	var userID = userid;
	document.getElementById('userID').value = userID;
	document.getElementById('action').value = "AdminEdit";
	document.getElementById('title').value = title.slice(1, -1);
	document.getElementById('comment').value = desp.slice(1, -1);
	$("#ratingDetails").hide();
			$("#ratingSection").show();

}