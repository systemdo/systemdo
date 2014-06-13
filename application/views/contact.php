<div class="container-fluid container-system">
<div class="row-fluid slide-system">			
<!--<article id="contact" class="container box style3">-->
				<header>
					<h2><?php echo lang("contact");?></h2>
				</header>
				<?php echo $form; ?>
					<div class="row half">
						<div class="6u"><?php echo $input ?></div>
						<div class="6u"><?php echo $email ?></div>
					</div>
					<div class="row half">
						<div class="12u">
							<?php echo $textarea ?>
						</div>
					</div>
					<div class="row">
					
						<div class="12u">
							<ul class="actions">
							<button type="submit" class="button form">
								<li><?php echo lang("submit_contact");?></li>
							</button>		
							</ul>
						</div>
					
					</div>
				</form>
			<!--</article>-->
</div>			
</div>			
		<script type="text/javascript">

			systemdo.catchForm();
		</script>	
