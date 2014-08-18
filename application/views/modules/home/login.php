<p>
	<div class="container">

    <!-- Three columns of text below the carousel -->
	    <div class="jumbotron">
			<p></p>
			<div class="row">
				<?php if(!isset($msg_success)): ?>

				<?php if(isset($msg_error)): ?>
				<div class="error">
					<?=$msg_error;?>	
				</div>
				<?php endif; ?>
				<form role="form" action="<?=site_url('/home/login')?>" method="post">
				  
				  <div class="form-group">
				    <label for="">Login:</label>
				    <input type="text" class="form-control" name="login" placeholder="Enter your login">
				  </div>
				  
				  <div class="form-group">
				    <label for="">Password:</label>
				    <input type="password" class="form-control" name="password" placeholder="Enter your password">
				  </div>

				  <button type="submit" class="btn btn-default">Login</button>
				</form>
				<?php else: ?>
					<div class="msg_sucess">
						<?=$msg_success;?>
					</div>
				<?php endif; ?>
			</div>
	    </div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
	    <div class="space"></div>
