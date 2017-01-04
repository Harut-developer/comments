function debounce(fn, duration) {
  var timer;
  return function(){
    clearTimeout(timer);
    timer = setTimeout(fn, duration);
  }
}

$(function() {
	$('#comment').keypress(debounce(function(){
    	$.post( base_url + 'index.php/main/isTyping' );
  	}, 300));

  	setInterval(
  		function() {
  			$.get( base_url + 'index.php/main/getTypingUsers', function(data) {
  				list = '';
  				$.each(data, function(i, v) {
  					list += v.username + " is typing <br>";
  				});
  				if (list) {
  					$('.typing').removeClass('hide');
  					$('.typing').html(list);
  				} else {
  					$('.typing').addClass('hide');
  				}
  			});
  		},
  		300
  	);
});