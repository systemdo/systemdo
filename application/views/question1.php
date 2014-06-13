<!-- Contact -->
			<article id="contact" class="container box style3">
				<header>
					<h2><?php echo $question ?></h2>
					<p><?php echo "I am: ".$name ?> | <?php echo "My email is: ".$email ?></p>
				</header>
				<?php echo $form; ?>
					<div class="row half">
						<div class="6u">
						<div class="checkbox">	
							<?php echo $opccions[1]?><?php echo $opccion1 ?></div>
						</div>	
					</div><div class="row half">
						<div class="6u">
							<div class="checkbox">
							<?php echo $opccions[2]?><?php echo $opccion2 ?></div>
							</div>
					</div><div class="row half">
						<div class="6u">
						<div class="checkbox">	
						<?php echo $opccions[3]?><?php echo $opccion3 ?></div>
						</div>
					</div>
				<div class="row">	
						<div class="12u">
							<ul class="actions">
							<button type="submit" class="button form">
								<li>Send Message</li>
							</button>		
							</ul>
						</div>
					
					</div>
				</form>
			</article>	
