var systemdo = new Systemdo();

function Systemdo()
{
	
	this.formAjax = function(url, data, success,datatype , type)
	{
		if(datatype == "" || datatype == undefined  ||  datatype == false)
		{
			datatype = 'json'
		}

		if(type == "" || type == undefined  ||  type == false)
		{
			type = 'post'
		}

		
		$.ajax({
			url:url,
			type:type,
			data: data,
			success: success,
			dataType: datatype
		});
	}
	
	this.catchForm = function()
	{
		
		

		$('form').submit(function(e){
			e.preventDefault();
			var action = $(this).attr('action');
			var name = $(this).attr('name');
			var datas = $(this).serialize();
			
			
				

			var success = function(data)
			{
 				//alert(data.name.value);
 				if(data.validator)
 				{	
	 				if (name == "form-contact")
	 				{
	 					systemdo.htmlMessageContact(data);
	 				}
	 				if (name == "form-service")
	 				{
	 					systemdo.htmlMessageService(data);
	 				}	

	
				}else
					{
						//alert(($('.popover').length));
						if($('.popover').length)
						{
							$('.popover').remove();	
						}

						///$('.popover').popover('destroy');		
						$.each(data,function(k,val){

								
							alert(($('.popover').length));	
							alert(($('.popover').length));	
							if(val.error != false)
							{
								//alert(k);
								//alert(val.error);
								var e = val.error;
								//$('.popover').remove();
								//alert(($('.popover').length));	
								$('#'+k).focus();
								$('#'+k).popover({
      								  		title: k,
        									content: e,
									        placement: 'top',
									        html: true,
									    }).popover('show');

								//k = null;
								//val = null;	
								alert(($('.popover').length));	
								return false;	
							}		
							
						});
						

						//return false;
						/*$('#name').focus();
								$('#name').popover({
      								  		title: 'Test',
        									content: 'Hello Popover',
									        placement: 'input'
									    }).popover('show');*/


					}				
			}
			systemdo.formAjax(action,datas, success);	
			});


		return false;

	}

	this.htmlMessageService = function(data)
	{
 		var html = '<div class="panel panel-default">';

							html+= '<div class="panel-heading">';
							html+= 	'<h3 class="panel-title">'+data.name.value+'</h3>';
							html+= 	'</div>';
								html+= '<div class="panel-body">';
	    						html+= 	data.text.value;
	  							html+= '</div>'
							html+= '</div>';
							
							if($('.panel-default').length)
								$('.message').before(html);
							else	
								$('.message').html(html);

					
	}

	this.htmlMessageContact = function(data)
	{
		var html = '<div class="panel-heading">';
			html+= 	'<header>';
			html+= 	'<h2>'+data.name.value+'</h2>';
			html+='<p>'+data.thank+'</p>';
			html+='</header>';
		
							$('#contact').empty();
							$('#contact').html(html);
					
	}

	this.showBegin = function()
	{
		
		$('.wrapper, #audio, #footer').css('display', 'none');
	}

	 this.showContent = function()
	{
		
		$('#start').click(function(e){
			e.preventDefault();
	
			//	$('#header').slideToggle();
			$('#header').slideUp("slow",function(){
				$('.wrapper, #audio, #footer').css('display', 'block');
			});
			//$('#header').hide();

		});

		return false;
		
	} 

}
