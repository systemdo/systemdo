<div class="container-fluid ">
<div class="row-fluid slide-system">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
     	
			<div class="col-xs-4 col-md-5">
        <div class="img-slide">
          <img src="/images/slydes/php.png" alt="" />
        </div>
      </div>
			 <div class="col-xs-6 col-md-5">
					<h2><?php echo lang("aboutus");?></h2>		
				<p><?php echo lang("aboutus2");?></p>
			</div>
		
      <!--<div class="carousel-caption">
        ...
      </div>-->
    </div>
    
    <div class="item">
		<div class="col-xs-4 col-md-5">
        <div class="img-slide">
          <img src="/images/slydes/js.png" alt="" />
         </div>
    </div>
			 <div class="col-xs-6 col-md-5">
				
					<h2><?php echo lang("why");?></h2>   
        <p><?php echo lang("why2");?></p>
			</div>
		
	
      <!--<div class="carousel-caption">
        ...
      </div>-->
    </div>
    
    <div class="item">
    <div class="col-xs-4 col-md-5">
        <div class="img-slide">
          <img src="/images/slydes/jquery.png" alt="" />
         </div>
    </div>
       <div class="col-xs-6 col-md-5">
        
         <h2><?php echo lang("tool");?></h2>   
        <p><?php echo lang("tool2");?></p>
      </div>
    
     					
    </div>
    
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
</div>
</div><!--row-->
</div>

<script type="text/javascript">
	$('.carousel').carousel({
		interval:false,
    //wrap:false,
	});	
</script>