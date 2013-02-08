<!DOCTYPE html>
<base href="<?php echo @\Utils::getBaseUrl(); ?>" />
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bootstrap, from Twitter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">	
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

	<link href="ui/css/theme.css" rel="stylesheet">
	<link href="ui/css/jquery.terminal.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-114x114.png">
	<script src="ui/js/json2.js"></script>
	<script src="ui/js/underscore-min.js"></script>

</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#">README <span class="byline"> a blog platform for developers</span></a>		
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
						<li><a href="#">Archive</a></li>
						<!-- page list -->
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<div class="span10" id="content">
				<article >
						<h1>Example Post</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis fermentum accumsan dui sit amet porttitor. Quisque tincidunt nisi ac nibh lacinia id pulvinar diam blandit. Donec lacus augue, rutrum ut adipiscing ac, tempor ac justo. Mauris ac lacus id mi ultricies malesuada. Quisque id malesuada eros. Duis ac metus purus. Vestibulum et lorem in odio commodo pellentesque. Etiam tempus leo sit amet mi venenatis dignissim. Phasellus cursus massa sit amet lectus sagittis nec venenatis odio consectetur. Donec gravida tincidunt congue.
						</p>
				 </article>
				<?php foreach (($latestPosts?:array()) as $post): ?>
					<article >
						<h1><?php echo $post['title']; ?></h1>
						<p><?php echo $post['body']; ?></p>
				  	</article>
			  	<?php endforeach; ?>
			</div><!--/span-->
		</div><!--/row-->
	  	<hr>
		<footer>
			<p>&copy; Company 2012</p>
		</footer>
	</div><!--/.fluid-container-->

	<div class="hide container-fluid span12" id="readme-editor">
		<div class="row-fluid">
			<textarea id="entry" class="span6">entry window</textarea>
			<textarea id="preview" class="span6">preview window</textarea>
		</div>
	</div>
	<div id="readme-console"></div>

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-transition.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-alert.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-modal.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-dropdown.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-scrollspy.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-tab.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-tooltip.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-popover.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-button.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-collapse.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-carousel.js"></script>
	<script src="https://raw.github.com/twitter/bootstrap/master/js/bootstrap-typeahead.js"></script>
	<script src="ui/js/jquery.terminal-0.4.22.js"></script>
	<script>

	String.prototype.strip = function(char) {
	    return this.replace(new RegExp("^" + char + "*"), '').
	        replace(new RegExp(char + "*$"), '');
	}


	$.extend_if_has = function(desc, source, array) {
	    for (var i=array.length;i--;) {
	        if (typeof source[array[i]] != 'undefined') {
	            desc[array[i]] = source[array[i]];
	        }
	    }
	    return desc;
	};


	(function($) {
	    $.fn.readmeConsole = function(eval, loginFunction, options) {
	        if ($('body').data('readmeConsole')) {
	            return $('body').data('readmeConsole').terminal;
	        }
	        this.addClass('readme-console');
	        options = options || {};
	        var settings = {
	            prompt: '$ ',
	            name: 'readme',
	            height: 100,
	            enabled: false,
	            greetings: 'README Console',
	            login: loginFunction
	        };
	        if (options) {
	            $.extend(settings, options);
	        }
	        this.append('<div class="td"></div>');
	        var self = this;
	        self.terminal = this.find('.td').terminal(eval, settings);
	        var focus = false;
	        $(document.documentElement).keypress(function(e) {
	            if (e.which == 96) {
	                self.slideToggle('fast');
	                self.terminal.set_command('');
	                self.terminal.focus(focus = !focus);
	                self.terminal.attr({
	                    scrollBottom: self.terminal.attr("scrollHeight")
	                });
	            }
	        });
	        $('body').data('readmeConsole', this);
	        this.hide();
	        return self;
	    };
	})(jQuery);

	//--------------------------------------------------------------------------


	

	var ReadmeConsole = function() {
		this.terminal = null;
	}
	
	ReadmeConsole.prototype.touch = function (title) {
		console.log("title: " + title);
		if (title != "") 
			console.log("creating post: "  + title);
		else 
			console.log("creating empty post");
		this.createTouch();
	}

	ReadmeConsole.prototype.login = function(username, password, terminalCallback) {
		var url = "rpc";
		var request = $.json_stringify({
           'jsonrpc': '2.0', 
           'method': "login",
           'params': new Array(username,password), 
           'id': 1
       });
		var rpcCallback = function(response) {
			if (response.result != null) {
				console.log("%o", tilda);
				this.terminal.set_prompt(response.result + "@fond $ ");
			}
			terminalCallback(response.result);			
		};
		$.ajax({
  			type: "POST",
  			url: url,
  			data: request,
  			success: rpcCallback,
  			contentType: 'application/json',
            dataType: 'json',
		});
		//callback(username);
	}

	ReadmeConsole.prototype.help = function() {
		var rpcCallback = function(response) {
			this.terminal.echo(response.result);
		};
		sendrpc('help',rpcCallback);
	}

	ReadmeConsole.prototype.whoami= function() {
		var callback = function (response) {
			var results = response.result;
			for(result in results)
			this.terminal.echo(result + " : " + results[result]);
		};
		sendrpc('whoami', callback);
	}



	ReadmeConsole.prototype.sendrpc = function(method, callback, params) {
		if (params == null) {
			params = [];
		}
		var url = "rpc";
		var request = $.json_stringify({
           'jsonrpc': '2.0', 
           'method': method,
           'params': params, 
           'id': 1
       });

		$.ajax({
  			type: "POST",
  			url: url,
  			data: request,
  			success: callback,
  			contentType: 'application/json',
            dataType: 'json',
		});
	}


	ReadmeConsole.prototype.createTouch = function() {
		this.editor();
	}

	ReadmeConsole.prototype.editor = function(args) {
		var editor = $('#readme-editor');
		var bodyheight = $(document).height();
    	$("#readme-editor").height(bodyheight-$('#tilda').height);
		if (args[0] == "-h") 
			$(editor).slideUp();
		else {
			$(editor).slideDown();
		}

	} 

	var myConsole = new ReadmeConsole();

	jQuery(document).ready(function($) {
		$(window).resize(function() {
    		var bodyheight = $(document).height();
    		$("#readme-editor").height(bodyheight-$('#readme-console').height);
    		    	console.log($('#readme-editor').height());

    	});

	    myConsole.terminal = $('#readme-console').readmeConsole(function(input, terminal) {
	    	//extract the command from the input
	    	//and create an args string
	    	var args = input.match(/\S+/g);
	    	console.log("%o", terminal);
	    	var command = args.shift();
	    	switch(command) {
	    		case 'login': 
	    			myConsole.terminal.logout();
	    			break;
	    		case 'touch':
	    			myConsole.touch(args.join(" "));
	    			break;
	    		case 'help':
	    			myConsole.help();
	    			break;
	    		case 'whoami':
	    			myConsole.whoami();
	    			break;
	    		case 'editor':
	    			myConsole.editor(args);
	    			break;
	    		default:
	    			terminal.error("Command not recognized");
	    			break;
	    	}
	   	});
	});

	</script>

</body>
</html>