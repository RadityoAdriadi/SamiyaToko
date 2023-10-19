$(document).ready(function(){
	$(".slider-utama").owlCarousel({
		items:1,
		loop:true,
		nav:false,
	});
	$(".slider-produk").owlCarousel();
	
	$(".slider-blog").owlCarousel({
		items:2,
		margin:10,
		nav:true,
		navContainer:"#letaknavblog",
		// navText:["<a class='btn btn-default'>Prev</a>","<a class='btn btn-default'>Next</a>"],
		// dots:true,
	});
	$(".slider-terlaris").owlCarousel({
		items:1,		
		nav:true,
		navContainer:"#letaknavterlaris",
		// navText:["<a class='btn btn-default'>Prev</a>","<a class='btn btn-default'>Next</a>"],
		// dots:true,
	});
	$(".slider-testimoni").owlCarousel({
		items:1,		
		// nav:true,
		// navContainer:"#letaknavterlaris",
		// navText:["<a class='btn btn-default'>Prev</a>","<a class='btn btn-default'>Next</a>"],
		dots:true,
	});
});
