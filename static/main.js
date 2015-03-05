$(function () {
	$('textarea.post').wysibb({
		lang: 'ru',
		buttons: 'bold, italic, underline, strike, fontsize, |, bullist, numlist, |, justifyleft, justifycenter, justifyright, |, link, code, img, video'
	});

	$('textarea.comment').wysibb({
		lang: 'ru',
		buttons: 'bold, italic, underline, strike, |, bullist, numlist, |, link, code, img, video'
	});
});