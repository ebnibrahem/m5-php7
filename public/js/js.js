console.log("%cCrafted BY  by MIC <mezooo> http://khamsat.com/user/mezooo", "color: green");

$(document).ready(function ($) {

	const mode = $("#MIC_MODE").css('display');
	const page = $('body').data('pageflag');
	const sh = screen.height;

	console.log("%c" + mode, "color: green");


	/* Scroll Up */
	$("#scroll_up").click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 700)
	});


	/*Scroll to top*/
	$(window).scroll(function () {
		var pin = $(this).scrollTop();
		if (pin > 600) {
			$("#scroll_up").css('right', '10px');
		} else {
			$("#scroll_up").css('right', '-100px');
		}
	});

	/*Optimization*/
	$(".form-control").after('<span class="after"></span>');

	$(".form-control").focus(function (event) {
		/* Act on the event */
		$(this).parent('.form-group').children('.after').addClass('after_focus');
	});

	$(".form-control").focusout(function (event) {
		/* Act on the event */
		if (!$(this).val())
			$(this).parent('.form-group').children('.after').removeClass('after_focus');
	});

	/*placeholder floating-up when typing or focusin*/
	$(".f_up").bind("focusin keyup", function (event) {
		$(this).children('._label').addClass('_float_up');
	});

	/*placeholder floating-down when not typing text*/
	$(".f_up").focusout(function (event) {
		var val = $(this).children('input').val();
		if (!val) {
			$(this).children('._label').removeClass('_float_up');
		}
	});

	$('.f_up').each(function () {
		var val = $(this).children('input').val();
		if (val) {
			$(this).children('._label').addClass('_float_up');
		}
	});

	/*moreActions*/
	$("#nav_menu_flag").click(function () {
		$(this).toggleClass("opened");
		$("#nav-bar").toggleClass('nav-bar-open');
		$("#typed-element").toggleClass('te-back');
	});

	/**/
	$("#nav_menu_flag").click(function (e) {
		e.stopPropagation();
	});


	/*content bar in mobile view*/
	$("#right_menu_btn").click(function (event) {
		$("#inner-body").toggleClass('inner-body-full');
		$("#right_menu").toggleClass('right_menu_full');
	});

	$("#right_menu_btn_media").click(function (event) {
		$("#right_menu_content").slideToggle()
	});

	$(".dropdownClickable").on('click', function (event) {
		let zs = $(this);
		let value = zs.data("value");
		let text = zs.data("text");
		let input = zs.data("input");

		$(text).text(value);
		$(input).val(value);
	});


	//are you sure
	$(document).on('click', '#areYouSureNo', function (e) {
		$('#user_join [type=submit]').attr('disabled', false);
		$("#areYouSure").addClass("d-none");
		$("body").removeClass("itsareyousured");
	});

	/*optimize images */
	$(".optimize img").each(function () {
		this.src = this.getAttribute("data-src");
	});

	$(window).scroll(function () {
		var pin = $(this).scrollTop();
		if (pin > 1) {
			$("#bird").css({ "visibility": "show" });
			for (var i = 0; i < 3; i++) {
				$("#bird .fa").fadeOut().fadeIn();
			}
		}

		if (pin > 1000) {
			$("#scroll_up").css('right', '10px');
		} else {
			$("#scroll_up").css('right', '-100px');
		}

	});

	$("#scroll_up").click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 700)
	});

	$(".read-more-toggle").click(function () {
		let target = $(this).data('target');

		$(target).toggleClass('d-none');

	});



	$("#preloader").remove();

});
