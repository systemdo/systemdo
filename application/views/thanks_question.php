<!-- Contact --><?php //echo validation_errors(); ?>
			<article id="contact" class="container box style3">
				<header>
					<h2><?php echo $thanks?></h2>
				</header>
				<div class="12u">
						<?php foreach ($played as $key => $val) {
								foreach ($val as $question => $answer) {
						
									echo '<p>' .$message. $question . '<br/>' . $message1. $answer.'</p>';
								}
							}
						?>
						
				</div>
							<footer>
						
							<a href="<?php echo site_url().$lang.'/service/questions'?>"  class="button form">
								go back
							</a>		
				
							</footer>
				
			</article>
