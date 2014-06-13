<!-- Contact --><?php //echo validation_errors(); ?>
			<article id="contact" class="container box style3">
				<header>
					<h2><?php echo lang("title_questions");?></h2>
				</header>
				<?php echo $form; ?>
					<div class="row half">
						<div class="6u">
							<?php echo $input ?>
							<?php echo form_error('name'); ?>
						</div>

						<div class="6u">
							<?php echo $email ?>
							<?php echo form_error('email'); ?>
						</div>
					</div>
				<div class="row">	
						<div class="12u">
							<ul class="actions">
							<button type="submit" class="button form">
								<li><?php echo lang("submit_participate");?></li>
							</button>		
							</ul>
						</div>
					
					</div>
				</form>
			</article>
