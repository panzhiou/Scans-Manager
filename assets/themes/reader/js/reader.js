var images=[];
var display;
var curPanel=1;
var number_of_images;
var numThin=0;
var portrait=false;
var goofy_enabled=false;



	$.fn.focusWithoutScrolling=function(){
		var x=window.scrollX,y=window.scrollY;
		this.focus();window.scrollTo(x,y);
	};function eachWord(str){
		return str.replace(/\w\S*/g,function(txt){
			return txt.charAt(0).toUpperCase()+ txt.substr(1).toLowerCase();
		});
	}

	function disable(elem){
		elem.parent().addClass("disabled");
		elem.children().removeClass("icon-white");
	}

	function enable(elem){
		elem.parent().removeClass("disabled");
		elem.children().addClass("icon-white");
	}

	function hashChanged(){
		if(goofy_enabled)
			return;
		var hash=window.location.hash;
		if(hash){
			hash=hash.replace("#","");
			var re=/^(\d+)-\d*$/;
			var ok=re.exec(hash);
			if(ok&&ok[1]<=number_of_images&&ok[1]>0){
				curPanel=ok[1];fullSpread();
			}else if(!isNaN(hash)&&hash<=number_of_images&&hash>0){
				curPanel=hash;singleSpread();
			}else{
				fullSpread();
			}
		}else{
			fullSpread();
		}
		if(curPanel==1){
			disable($("#prevPanel"));
		}
		if(curPanel>=number_of_images){
			disable($("#nextPanel"));
		}
	}

	function init(){
		title=$("title").html();$("title").html(eachWord(title));
		$(".img-url").each(function(){
			var url=$(this).html();
			images.push({path:url,loaded:true});});
		number_of_images=images.length;
		createDropdown(1);
		createDropdown(2);
		for(var i=0;i<2;++i){
			var image=document.createElement("img");
			$("#preload").append(image);
		}
		$(".navbar ul li").show();
		$('#fullSpread').hide();
		$('#singlePage').hide();
		$("#prevPanel").on("click",prevPanel);
		$(document).bind('keydown','right',prevPanel);
		$(document).bind('keydown','k',prevPanel);
		$("#nextPanel").on("click",nextPanel);
		$(document).bind('keydown','left',nextPanel);
		$(document).bind('keydown','j',nextPanel);
		$("#fitVertical").on("click",fitVertical);
		$(document).bind('keydown','v',fitVertical);
		$("#fitHorizontal").on("click",fitHorizontal);$(document).bind('keydown','h',fitHorizontal);
		$("#fullscreen").on("click",fullscreen);$("#fullSpread").on("click",fullSpread);
		$(document).bind('keydown','f',fullSpread);$("#singlePage").on("click",singleSpread);
		$(document).bind('keydown','s',singleSpread);
		window.onhashchange=hashChanged;hashChanged();
		fitHorizontal();
		var docElm=document.documentElement;
		if(!docElm.requestFullscreen&&!docElm.mozRequestFullScreen&&!docElm.webkitRequestFullScreen&&!docElm.msRequestFullscreen){
			$("#fullscreen").parent().hide();
		}
	}
	
	function createDropdown(n){
		switch(n){
			case 1:for(i=1;i<=number_of_images;i++){var option=$('<option>',{html:"Página "+ i,value:i});$("#single-page-select").append(option);}break;
			case 2:var i=1;while(i<=number_of_images){var htm;var val;if(i==1||i>=number_of_images||galleryinfo[i].width>galleryinfo[i].height||galleryinfo[i-1].width>galleryinfo[i-1].height){htm="Página "+ i;val=i+"-";i+=1;}else{htm="Páginas "+ i+"-"+(i+1);val=i+"-"+(i+1);i+=2;numThin+=2;}var option=$('<option>',{html:htm,value:val});$("#two-page-select").append(option);}if(numThin/number_of_images<0.1){portrait=true;}break;}
	}

	function fullSpread(){
		$("#singlePage").parent().show();
		$("#fullSpread").parent().hide();
		$("#single-page-select").parent().hide();
		$("#two-page-select").parent().show();
		$('#singlePage').show();updateDropdown(2);
		spread(2);
	}

	function singleSpread(){
		$("#singlePage").parent().hide();
		$("#fullSpread").parent().show();
		$("#two-page-select").parent().hide();
		$("#single-page-select").parent().show();
		$('#fullSpread').show();updateDropdown(1);
		spread(1);
	}

	function updateDropdown(num){
		switch(num){
			case 1:$("#single-page-select option:selected").prop("selected",false);$("#single-page-select option").each(function(){if($(this).val()==curPanel){$(this).prop("selected",true);goofy_enabled=true;window.location.hash=curPanel;goofy_enabled=false;$(this).parent().trigger("change");}});break;
			case 2:var re=/^(\d+)-(\d*)$/;$("#two-page-select option:selected").prop("selected",false);$("#two-page-select option").each(function(){var ok=re.exec($(this).val());if(ok[1]==curPanel||ok[2]==curPanel){$(this).prop("selected",true);goofy_enabled=true;window.location.hash=ok[0];goofy_enabled=false;$(this).parent().trigger("change");}});break;
		}
	}

	function spread(num){
		$('body').removeClass('spread'+display);
		display=num;$('body').addClass('spread'+display);
		if(display==2){
			var found=false;
			var pattern=curPanel+"-";
			$("#two-page-select option").each(function(){
				if($(this).val().search(pattern)>-1){
					found=true;
				}
			});
			if(!found){--curPanel;
			}
		}
		drawPanel();
	}

	function drawPanel(){
		$("#preload").empty();
		$("#comicImages").empty();
		$('body').removeClass();
		$('body').addClass("spread1");
		if(display==2){
			if(curPanel>1&&curPanel<number_of_images&&galleryinfo[curPanel].width<=galleryinfo[curPanel].height&&galleryinfo[curPanel-1].width<=galleryinfo[curPanel-1].height){
				var image=$('<img />',{src:images[curPanel].path,onclick:"nextPanel()"});
				$("#comicImages").append(image);
				image=$('<img />',{src:images[curPanel-1].path,onclick:"prevPanel()"});
				$("#comicImages").append(image);
				$('body').removeClass();
				$('body').addClass("spread2");
				if(parseInt(curPanel)+1<number_of_images){
					var image=$('<img />',{src:images[parseInt(curPanel)+1].path});
					$("#preload").append(image);
				}
				if(parseInt(curPanel)+2<number_of_images){
					var image=$('<img />',{src:images[parseInt(curPanel)+2].path});
					$("#preload").append(image);
				}
			}
			else if(curPanel<=number_of_images){
				if(curPanel<number_of_images){
					var image=$('<img />',{src:images[curPanel].path});
					$("#preload").append(image);
				}
				if(curPanel+1<number_of_images){
					image=$('<img />',{src:images[parseInt(curPanel)+1].path});
					$("#preload").append(image);
				}
				image=$('<img />',{src:images[curPanel-1].path,onclick:"nextPanel()"});
				$("#comicImages").append(image);
			}

		}else{
			if(curPanel<number_of_images){
				image=$('<img />',{src:images[curPanel].path});
				$("#preload").append(image);
			}
			if(parseInt(curPanel)+1<number_of_images){
				image=$('<img />',{src:images[parseInt(curPanel)+1].path});
				$("#preload").append(image);
			}
			var image=$('<img />',{src:images[curPanel-1].path,onclick:"nextPanel()"});
			$("#comicImages").append(image);
		}
		if(portrait){
			$("#fullSpread").parent().hide();
			$("#singlePage").parent().hide();
		}
		$("#comicImages").scrollTop(0);
		$("body").scrollTop(0);
		$("#comicImages").focusWithoutScrolling();
	}

	$(function(){
      // bind change event to select
      $('#chapters-list').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
	
	function singlePageChange(sel){
		var val=sel.value;
		enable($("#prevPanel"));
		enable($("#nextPanel"));
		if(val==1){
			disable($("#prevPanel"));
		}
		else if(val==number_of_images){
			disable($("#nextPanel"));
		}
		curPanel=val;
		goofy_enabled=true;
		window.location.hash=val;
		goofy_enabled=false;drawPanel();
		$("#single-page-select").trigger("blur");
	}

	function twoPageChange(sel){
		var val=sel.value;
		enable($("#prevPanel"));
		enable($("#nextPanel"));
		var re=/^(\d+)-(\d*)$/;var ok=re.exec(val);
		if(ok[1]==1){
			disable($("#prevPanel"));
		}
		if(ok[1]>=number_of_images||ok[2]>=number_of_images){
			disable($("#nextPanel"));
		}
		curPanel=ok[1];
		goofy_enabled=true;
		window.location.hash=val;
		goofy_enabled=false;
		drawPanel();
		$("#two-page-select").trigger("blur");
	}
	
	function prevPanel(){
		if(display==1){
			var dropdown=$("#single-page-select option:selected");
		}else{
			var dropdown=$("#two-page-select option:selected");
		}
		if(dropdown.prev().length){
			dropdown.prop("selected",false).prev().prop("selected",true);
			dropdown.parent().trigger("change");
		}
		$("#comicImages").focusWithoutScrolling();
		$("body").scrollTop(0);
	}
	
	function nextPanel(){
		if(display==1){
			var dropdown=$("#single-page-select option:selected");
		}else{
			var dropdown=$("#two-page-select option:selected");
		}
		if(dropdown.next().length){
			dropdown.prop("selected",false).next().prop("selected",true);
			dropdown.parent().trigger("change");
		}
		$("#comicImages").focusWithoutScrolling();
		$("body").scrollTop(0);
	}

	function fitHorizontal(){
		$("#comicImages").removeClass();
		$("#comicImages").addClass('fitHorizontal');
		$("li").removeClass("active");
		$("#fitHorizontal").parent().addClass("active");
		$("#comicImages").focusWithoutScrolling();
		$("body").scrollTop(0);
	}
	
	function fitVertical(){
		$("#comicImages").removeClass();
		$("#comicImages").addClass('fitVertical');
		$("li").removeClass("active");
		$("#fitVertical").parent().addClass("active");
		$("#comicImages").focusWithoutScrolling();
		$("body").scrollTop(0);
	}
	
	function fullscreen(){
		var elem=document.getElementById("comicImages");
		if(elem.requestFullscreen){
			elem.requestFullscreen();
		}else if(elem.msRequestFullscreen){
			elem.msRequestFullscreen();
		}else if(elem.mozRequestFullScreen){
			elem.mozRequestFullScreen();
		}else if(elem.webkitRequestFullscreen){
			elem.webkitRequestFullscreen();
		}
	$("#comicImages").focusWithoutScrolling();
	}

