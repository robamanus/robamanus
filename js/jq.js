function ModalWindow(data) {
	$('#overlay_noclose').css('display', 'none');
	$('#overlay').fadeIn(400,
		function(){
			$('#modal_form') 
				.css('display', 'block')
				.animate({opacity: 1, top: '50%'}, 200)
				.empty()
				.append(data);
			$('#modal_close, #overlay').click( function(){
				$('#modal_form')
					.animate({opacity: 0, top: '45%'}, 200,
						function(){
							$(this).css('display', 'none');
							$('#overlay').fadeOut(400);
						}
					);
			});
			$('#ok').click(OK);
		}
	);
}
function ModalWindowNoClose(data) {
	$('#overlay_noclose').fadeIn(400,
		function(){
			$('#modal_form') 
				.css('display', 'block')
				.animate({opacity: 1, top: '50%'}, 200)
				.empty()
				.append(data);
			$('#user_digit').click(SendUserDigit);
		}
	);
}
function OK() {
	$.ajax({
		type: "POST",
		url: "http://ck35313.tmweb.ru/handlers/ok.php",
		dataType: "html",
		cache: false,
		success: function(data){
			ModalWindowNoClose(data);
		}
	});
}
function SendUserDigit() {
	var user_digit = $("input[name='user_digit']").val();
	$.ajax({
		type: "POST",
		url: "http://ck35313.tmweb.ru/handlers/senduserdigit.php",
		dataType: "html",
		data: {user_digit:user_digit},
		cache: false,
		success: function(data){
			if(data!=false){
				alert(data);
			}
			else location.reload();
		}
	});
}
function Load() {
	$.ajax({
		type: "POST",
		url: "http://ck35313.tmweb.ru/handlers/message.php",
		dataType: "html",
		cache: false,
		success: function(data){
			ModalWindow(data);
		}
	});
}