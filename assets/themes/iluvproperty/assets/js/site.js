$(".open-btn").click(function(){
	$(".sign-in").animate({
		right:'0px',
	});
	$(".open-btn").hide();
	$(".close-btn").show();
});

$(".close-btn").click(function(){
	$(".sign-in").animate({
		right:'-200px',
	});
	$(".open-btn").show();
	$(".close-btn").hide();
});