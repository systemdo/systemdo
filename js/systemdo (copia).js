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

							$('.panel-body').focus();
				}else
					{
						if($('.popover').length)
						{
							$('.popover').remove();	
						}

						///$('.popover').popover('destroy');		
						$.each(data,function(k,val){

								
							
							if(val.error != false)
							{
								//alert(k);
								//alert(val.error);
								$('.popover').remove();
								$('#'+k).focus();
								$('#'+k).popover({
      								  		title: k,
        									content: val.error,
									        placement: 'top',
									        html: true,
									    }).popover('show');

								//k = null;
								//val = null;		
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

	this.htmlMessage = function(data)
	{
 		alert(data);
 		var html = '<div class="panel panel-default">';

						html+= '<div class="panel-heading">';
						html+= 	'<h3 class="panel-title">Panel title</h3>';
						html+= 	'</div>';
							html+= '<div class="panel-body">';
    						html+= 	'Basic panel example';
  							html+= '</div>'
						html+= '</div>';
						
 		 $('.message').html(html);
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
