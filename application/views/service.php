<link rel="stylesheet" type="text/css" href="/plugins/cleditor/jquery.cleditor.css" />

<div class="container-fluid container-system">
<div class="row-fluid slide-system">
<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#php" data-toggle="tab"><?php echo lang("services");?></a></li>
  <li><a href="#tool" data-toggle="tab"><?php echo lang("tool");?></a></li>
  <li><a href="#framework" data-toggle="tab"><?php echo lang("frameworks");?></a></li>
  <li><a href="#cms" data-toggle="tab"><?php echo lang("cms");?></a></li>
  <li><a href="#exemple" data-toggle="tab"><?php echo lang("example");?></a></li>
  <li>
    <a href="<?php echo site_url().$lang.'/service/questions' ?>">
      <button type="button" class="btn btn-inverse"><?php echo lang("more");?></button>
    </a> 
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="php">
  	<?php echo lang("services2");?>
  </div>
  <div class="tab-pane" id="tool">
  	<?php echo lang("tool2");?>
  </div>
  
  <div class="tab-pane" id="framework">
    <?php echo lang("frameworks2");?>
  </div>
  
  <div class="tab-pane" id="cms">
  	<?php echo lang("cms2");?>
  </div>
  
  <div class="tab-pane" id="exemple">
	<h2><?php echo lang("tittle")?></h2>
					<div class="message">	
						
					</div>	
					
					<?php echo $form;
					?>
					<div class="form-group">
    					<label for="name"><?php echo lang("name");?></label>
    					<?php echo $input;?>
    					<?php //echo form_error('name'); ?>
	  					</div>
  					<div class="form-group">
    					<label for="Email"><?php echo lang("email");?></label>
    					<?php echo $email;?>
  					</div>
  					<div class="form-group">
    					<label for="Text"><?php echo lang("text");?></label>
    					<?php echo $textarea;?>
  					</div>

  					<button type="submit" id="submit" class="btn btn-primary"><?php echo lang("submit");?></button>
  					</form>  	
  	</div>
</div><!--tab-->
</div><!--end row-fluid-->
</div>

<script type="text/javascript">

systemdo.catchForm();

$(document).ready(function () { 
	    
	$("#text").cleditor(); 
});	

</script>

	<script src="/plugins/cleditor/jquery.cleditor.js"></script>
	<script src="/plugins/cleditor/jquery.cleditor.min.js"></script>
	
