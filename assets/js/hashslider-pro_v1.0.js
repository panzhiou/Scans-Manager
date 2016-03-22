// JavaScript Document
// crafted with ♥ by m.hügel

$(document).ready(function(){

//set stuff up
var sliderWidth = $("#slider").width();
var doubles = sliderWidth*10;
var sliderLocation = $("#slider").data('source');
var speed = $("#slider").data('speed');
var easing = $("#slider").data('easing');
$("#slider ul").css('width', doubles);

//load content on start
if ( window.location.hash != '') {

	//var hasID = '#' + window.location.hash.substr(1);
	var hasID = '.hslide[data-id|="'+ window.location.hash.substr(1) +'"]';
	$.get(sliderLocation,function(data) {
	    var first = $(data).find(hasID);
	    //var second = $(data).find(hasID).next();
	    $('#slider ul').html(first);
	    current();
	    loadIt();
	});	
}
else {
	$.get(sliderLocation,function(data) {
	    var first = $(data).find('.hslide:first-child');
	    $('#slider ul').append(first);
	    current();
	    loadIt();
	});	
}

//set up my little numbers
$.get(sliderLocation,function(data) {
    var first = $(data).find(hasID);
	$(data).find('.hslide').each(function() {
		var count = $(this).index() +1;
		var link = $(this).data('id');
	  	$("#numbers").append('<a href="#" data-id="'+link+'">'+count+'</a>')
	});
	navigateTo();
});	

//make nav working
function navigateTo() {
	$("#numbers a").click(function() { 
		var navigate = $(this).html();
		$.get(sliderLocation,function(data) {
			var next = $(data).find('.hslide:nth-child('+navigate+')')
			$('#slider ul').append(next);
			showNext();
			stopHammtertime();
		});

		$("#numbers a").removeClass('active');
		$(this).addClass('active');	   
	});	
}

				//magic man do slide change every x seconds
				var duration = $("#slider").data('duration');
				var a = function() {	getNext();	killIt(); };
				var intervalId = setInterval(a,duration);

				//loadingbar
				function loadIt() {
					$('#load').animate({
						width: sliderWidth
					}, duration, 'linear', function() {
						//killIt();
					});
				}
				function killIt() {
					$('#load').animate({
						width: '0'
					}, 10, 'linear', function() {	loadIt(); });
				}

				//stops the magic man
				function stopHammtertime() {
					clearInterval(intervalId);
					$('#load').stop().fadeOut();

				}	


//trigger it
$("#next").click(function() { 
	getNext();		
	stopHammtertime();										   
});	
$("#back").click(function() { 
	getPrev();		
	stopHammtertime();									   
});	


				//trigger mousewheel and arrowkeys
				bind();
				function unbind() {
					$("#slider").unmousewheel();
					//$(document).unbind('keyup', function(e) {});
				}

				function bind() {
					$("#slider").bind('mousewheel', function(event, delta, deltaX, deltaY) {
					    if (delta < 0) {unbind();  	stopHammtertime(); getNext(); 	  event.stopPropagation();event.preventDefault(); }
						if (delta > 0) {unbind();	getPrev();	stopHammtertime();	event.stopPropagation();event.preventDefault(); }
					});
				}
						   

//get current id & set hash
function current() {
	var currentID = $('#slider .hslide:first-child').data('id');
	//alert(currentID);
	//$("#current").html(currentID);
	window.location.hash = currentID;

	//set navmarker
	$("#numbers a").removeClass('active');
	$('a[data-id|="'+currentID+'"]').addClass('active');

}



//set nav-marker 
function setNav() {

}


//show me the next slide
function showNext() {
	$('#slider .hslide:first-child').animate({
		marginLeft: -1 * sliderWidth
	}, speed, easing, function() {
		$(this).remove();
		current();
		bind();
	});
}

//load next slide
function getNext() {
	$.get(sliderLocation,function(data) {

		var currentSlide = $("#slider .hslide:first-child").data('id');
		var counter = $(data).find('.hslide[data-id|="'+ currentSlide +'"]').index();

		var size = $(data).find('.hslide').size() - 1;

		if (counter < size) {
			var nextElement = counter + 2;
		    var next = $(data).find('.hslide:nth-child('+nextElement+')');
		    $('#slider ul').append(next);
		   	$("#counter").html(counter);
		   	
		   	showNext();
		   	//current();
		}
		else {
		    var first = $(data).find('.hslide:first-child');
		    $('#slider ul').append(first);
		    $("#counter").html(counter);
		    
		    showNext();
		    //current();
		}
	});
}


//show me the prev slide 
function back() {
	$('#slider .hslide:first-child').animate({
		marginLeft: 0
	}, speed, easing, function() {
		$('#slider .hslide:nth-child(2)').remove();
	});	
	bind();
}

function getPrev() {
	$.get(sliderLocation,function(data) {
		var currentSlide = $("#slider .hslide:first-child").data('id');
		var counter = $(data).find('.hslide[data-id|="'+ currentSlide +'"]').index();
		var prev = counter;
		
		if (prev > 0) {		
			var next = $(data).find('.hslide:nth-child('+prev+')').css('marginLeft', '-940px');
			$('#slider ul .hslide:first-child').before(next);
			back();
			$("#counter").html(counter);
			current();
		}
		else {
			var next = $(data).find('.hslide:last-child').css('marginLeft', '-940px');
			$('#slider ul .hslide:first-child').before(next);
			back();
			$("#counter").html(counter);
			current();
		}

	});
}



//end doc ready
});