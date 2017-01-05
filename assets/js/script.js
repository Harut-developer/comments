function debounce(fn, duration) {
  var timer;
  return function(){
    clearTimeout(timer);
    timer = setTimeout(fn, duration);
  }
}

function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes";
    }
    return Math.floor(seconds) + " seconds";
}

function js_yyyy_mm_dd_hh_mm_ss () {
  now = new Date();
  year = "" + now.getFullYear();
  month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
  day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
  hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
  minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
  second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
  return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
}

function goToByScroll(id){
      // Scroll
    $('html,body').animate({
        scrollTop: $(id).offset().top},
        'slow');
}

$(function() {
	$('#comment').keypress(debounce(function(){
    	$.post( base_url + 'index.php/main/isTyping' );
  	}, 300));
	$('#show_new_comments').on('click', function(event){
		event.preventDefault();
		$.get( base_url + 'index.php/main/getNewComments', { time: time, item_id: item_id }).done( function(data) {
			var list = '';
			var now = new Date();
			var scroll = now.getTime();
			$.each(data, function(i, v) {
				list += '<div ' + (i==0 ? 'id="' + scroll + '"' : '') + ' class="row"> \
							<div class="col-sm-1"> \
								<div class="thumbnail"> \
									<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"> \
								</div> \
							</div> \
							<div class="col-sm-5"> \
								<div class="panel panel-default"> \
									<div class="panel-heading"> \
										<strong>' + v.username + '</strong> \
										<span class="text-muted"> \
											commented  \
											' + timeSince(Date.parse(v.date)) + ' \
											ago \
										</span> \
									</div> \
									<div class="panel-body"> \
										' + v.description + ' \
									</div> \
								</div> \
							</div> \
						</div>';
			});
			$('#comments').append(list);
			time = js_yyyy_mm_dd_hh_mm_ss();
			$('#message_comments').addClass('hide');
			goToByScroll("#" + scroll);
		});
	});
  	setInterval(
  		function() {
  			$.get( base_url + 'index.php/main/getNewComments', { count: "count", time: time, item_id: item_id }).done( function(data) {
  				if (data.count) {
  					$('#message_comments').removeClass('hide');
  					$('#new_comments_count').html(data.count);
  				} else {
  					$('#message_comments').addClass('hide');
  				}
  			});
  			$.get( base_url + 'index.php/main/getTypingUsers', function(data) {
  				var list = '';
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