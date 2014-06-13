<?php 
	//echo current_url();
	$home = "";  $service= "" ; $aboutus = ""; $jobs = ""; $contact = "";

	switch ($this->uri->segment(2)) {
		case 'home':
			$home = "active";
		break;
		case 'service':
			$service = "active";
		break;
		case 'aboutus':
			$aboutus = "active";
		break;
		case 'jobs':
			$jobs = "active";
		break;
		case 'contact':
			$contact = "active";
		break;
		default:
			$home = "active";
		break;
	}

?>
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container">
      <ul class="nav navbar-nav">
        <li class="<?php echo $home ?>"><a href="<?php echo site_url()?>"><?php echo lang("home");?></a></li>
        <li class="<?php echo $aboutus ?>"><a href="<?php echo site_url('aboutus')?>"><?php echo lang("aboutus");?></a></li>
        <li class="<?php echo $service ?>"><a href="<?php echo site_url('service')?>"><?php echo lang("sevices");?></a></li>
        
        <li class="<?php echo $jobs?>"><a href="<?php echo site_url('jobs')?>"><?php echo lang("jobs");?></a></li>
        <li class="<?php echo $contact ?>"><a href="<?php echo site_url('contact')?>"><?php echo lang("contact");?></a></li>
     </ul>
  </div>
</nav>