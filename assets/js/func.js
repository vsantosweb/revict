/**
 * ------------------------------------------------------------------------------
 *| Arquivo principal de scripts, controla query string, posts, gets, do sistema |
 *-------------------------------------------------------------------------------
 */

$(function(){
	$('.notify_container').hide();

/**
 * ------------------------------------------------------------------------------
 *| LOGIN 
 *-------------------------------------------------------------------------------
 */
 $('#form_login').submit(function(e){
 	var data = $(this).serialize();
 	$('button[type=submit]').attr('disabled', true).html('Conectando...');
 	$.ajax({
 		method:'POST',
 		data: data,
 		url:'/mecanicashow/app/?task=login&_action=auth_validation',
 		success: function(resp){
 			setTimeout(function(){

 				$('button[type=submit]').attr('disabled', false).html('Acessar');
 				$('#form_login').find('input').val('');
 				
 				if(resp==1){
 					window.location = "http://"+location.hostname+"/mecanicashow/app/";
 				}else
 				{
 					$('#form_login').find('.helper-text').css('color','red').html(resp);
 				}

 			}, 1200);
 		}
 	});
 	e.preventDefault();
 });
 /**
 * ------------------------------------------------------------------------------
 *| FORMLARIO DE CADASTRO DE NOVOS CLIENTES
 *-------------------------------------------------------------------------------
 */
 $('#form_add_cliente').submit(function(e){
 	var data = $(this).serialize();
 	$.ajax({
 		method:'POST',
 		data: data,
 		url:'/mecanicashow/app/?task=cliente&_action=save&method=create',
 		success: function(resp){
 			$('.notify_container').fadeIn();
 			$('#form_add_cliente').find('input').val('');
 			if(resp)
 			{	
 				$('.notify_container').html(resp);

 				setTimeout(function(){
 					$('.notify_container').fadeOut();
 				},2000);
 			}else{
 				return false;
 			}

 		}
 	});
 	e.preventDefault();
 });
  /**
 * ------------------------------------------------------------------------------
 *| FORMLARIO DE CADASTRO DE NOVAS PEÇAS
 *-------------------------------------------------------------------------------
 */
 $('#form_add_peca').submit(function(e){
 	var data = $(this).serialize();
 	$.ajax({
 		method:'POST',
 		data: data,
 		url:'/mecanicashow/app/?task=estoque&_action=save&method=create',
 		success: function(resp){
 			$('.notify_container').fadeIn();
 			$('#form_add_peca').find('input').val('');
 			if(resp)
 			{	
 				$('.notify_container').html(resp);
 				return true;
 				setTimeout(function(){
 					$('.notify_container').fadeOut();
 				},2000);
 			}else{
 				return false;
 			}

 		}
 	});
 	e.preventDefault();
 });
   /**
 * ------------------------------------------------------------------------------
 *| FORMLARIO DE ALTERAÇÃO DE CLIENTES
 *-------------------------------------------------------------------------------
 */
 $('#form_alter_cliente').submit(function(e){
 	var data = $(this).serialize();
 	$.ajax({
 		method:'POST',
 		data: data,
 		url:'/mecanicashow/app/?task=cliente&_action=save&method=alter',
 		success: function(resp){
 			$('.notify_container').fadeIn();
 			$('#form_alter_cliente').find('input').val('');
 			if(resp)
 			{	
 				$('.notify_container').html(resp);
 				return true;
 				setTimeout(function(){
 					$('.notify_container').fadeOut();
 				},2000);
 			}else{
 				console.log('err');
 			}

 		}
 	});
 	e.preventDefault();
 });
 $('.toggle_nav').click(function(e){

 	$('.vs_sidebar').toggleClass('show');
 	$('body').css({'overflow': 'hidden'});
 });

 $('.vs_sidebar .nav-item .nav-link').click(function(){

 	$('.vs_sidebar .nav-item .nav-link').removeClass('active');
 	$(this).addClass('active');

 });

});
  /**
 * ------------------------------------------------------------------------------
 *  __TASK() FUNÇÃO APLICADA COM ONCLICK, MANIPULA OS EVENTOS DO SISTEMA
 * action - recebe o controller da pagina
 * data - recebe o tipo de ação
 * el - recebe this como parametro 
 * controller - recebe o destino do evento
 * status - recebe um valor para o controller
 * value - se conter pode receber qualquer outro valor
 *-------------------------------------------------------------------------------
 */
function __TASK(action, data, el, controller, status, value = null)
{

	var xhttp = new XMLHttpRequest();
	var url = '/mecanicashow/app/?task='+controller+'&_action='+ action;
	switch (action) 
	{
		case 'add':
		$('#search').modal('hide');
		xhttp.onreadystatechange = function()
		{
			$(el).attr('data-target','#add');
			var data_modal = $('#add_m').html(this.responseText);
			__TASK.validate_task = function (resp)
			{
				if(resp == true)
				{
					var url = '/mecanicashow/app/?task='+controller+'&_action=save&method='+action+'&'+status+'='+value;
					var data_form = $('#add_m form').serialize();
					xhttp.open('POST',url, true);
					xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhttp.send(data_form);
					$('.btn-act').attr('disabled', true);

					setTimeout(function(){
						location.reload();
					},1500);
				}
			}
		}
		xhttp.open('POST',url, true);
		xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.send('&'+action+'='+data+'&'+status+'='+value);

		break;

		case 'alter':
		xhttp.onreadystatechange = function()
		{
			$(el).attr('data-target','#alter');
			var data_modal = $('#alter_m').html(this.responseText);
			__TASK.validate_task = function (resp)
			{
				if(resp == true)
				{
					var url = '/mecanicashow/app/?task='+controller+'&_action=save&method='+action+'&'+status+'='+value;
					var data_form = $('#alter_m form').serialize();
					xhttp.open('POST',url, true);
					xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhttp.send(data_form);
					$('.btn-act').attr('disabled', true);

					setTimeout(function(){
						location.reload();
					},1500);
				}
			}
		}
		xhttp.open('POST',url, true);
		xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.send('&'+action+'='+data+'&'+status+'='+value);

		break;

		case 'del':

		xhttp.onreadystatechange = function()
		{
			
			var data_resp = $('#del_m').html(this.responseText);
		}
		$(el).attr('data-target','#del');
		
		__TASK.validate_task = function (resp)
		{	
			if(resp == true)
			{
				var url = '/mecanicashow/app/?task='+controller+'&_action='+ action;
				$('.btn-act').attr('disabled', true);

				setTimeout(function(){
					location.reload();
				},1500);
				xhttp.open('POST',url, true);
				xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhttp.send('&'+action+'='+data);
			}
			
		}
		break;
		case 'search':
		xhttp.onreadystatechange = function()
		{

			__TASK.validate_task = function (resp)
			{
				if(resp == true)
				{

					var url = '/mecanicashow/app/?task='+controller+'&_action=query_search';
					var data_form = $('#search_m form').serialize();
					xhttp.open('POST',url, true);
					xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhttp.send(data_form);
					$('.btn-act').attr('disabled', true);

					setTimeout(function(){
						$('.btn-act').attr('disabled', false);
 					},500);
				}
			}
		}
		xhttp.open('POST',url, true);
		xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.send('&'+action+'='+data+'&'+status+'='+value);
	}
}


  /**
 * ------------------------------------------------------------------------------
 * create_budget classe que compõe a criação de novos serviços
 *-------------------------------------------------------------------------------
 */

function create_budget(str)
{
	

	xhttp.onreadystatechange = function()
	{
		
	}
	xhttp.open('POST', '?task=servico&_action=query_search', true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send(string);
}


var budget = function(obj){

	var xhttp = new XMLHttpRequest();

	$(obj).attr('data-target','#search');
	var data_modal = $('#search_m');

	budget.checkout = function (obj)
	{
		var query = ($(obj).serialize());
		xhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{

				if(this.responseText == 0)
				{
					$('#search_m').html('Usuário não cadastrado, cadastre-o para continuar!');
					setTimeout(function(){
						location.reload();
					},1500);

				}
				else if(this.responseText)
				{
					$('#search').modal('hide');

					budget.open(this.responseText);
				}
			}
		}
		xhttp.open('POST', '?task=servico&_action=query_search', true);
		xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.send(query);
	}
	budget.open = function(obj)
	{
		$('#orcamento_form').modal('show');
		$('#orcamento_m').html(obj);

		var form_data = $(obj).serialize();
	}


	budget.send = function(form)
	{
		var data_form = $('#orcamento_m form').serialize();
		xhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				$('#orcamento_m').html('<h4 class="text-center">Ordem enviada para apuração<h4>');
				$('.modal-footer').html('');
				setTimeout(function(){
					location.reload();
				},600);
				
			}
		}
		xhttp.open('POST','?task=servico&_action=create_orcamento');
		xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhttp.send(data_form);
	}
	this.action = function()
	{
		alert('oi');
	}
}

budget.start = function(id)
{	
	
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			location.reload();
		}
	}
	xhttp.open('POST', '?task=servico&_action=service_start', true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send('&id='+id);

}

budget.remove = function(id)
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			if(budget.confirma(this.responseText))
			{
				
			}
		}
	}
	xhttp.open('POST', '?task=servico&_action=service_remove', true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send('&id='+id+'&resp=0');

	budget.confirma = function(el)
	{
		$("#del").modal('show');
		__TASK.validate_task = function(resp)
		{
			if(resp == true){
				xhttp.onreadystatechange = function()
				{
					if(this.readyState == 4 && this.status == 200)
					{
						location.reload();					
					}
				}
				xhttp.open('POST', '?task=servico&_action=service_remove', true);
				xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhttp.send('&id='+id+'&resp=1');
			}
		}
	}
}

budget.cancel = function(id)
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			if(budget.confirma(this.responseText))
			{
				
			}
		}
	}
	xhttp.open('POST', '?task=servico&_action=service_cancel', true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send('&id='+id+'&resp=0');

	budget.confirma = function(el)
	{
		var modal = $("#del").modal('show');
		$(".modal-header").html('Cancelamento de Serviço');
		$('.btn-act').html("Sim");
		$("#del_m").html('<h4 class="text-center">Deseja cancelar este serviço?<h4>');

		__TASK.validate_task = function(resp)
		{
			if(resp == true){
				xhttp.onreadystatechange = function()
				{
					if(this.readyState == 4 && this.status == 200)
					{
						location.reload();					
					}
				}
				xhttp.open('POST', '?task=servico&_action=service_cancel', true);
				xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhttp.send('&id='+id+'&resp=1');
			}
		}
	}
}

budget.finish = function(id)
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			if(budget.confirma(this.responseText))
			{
				
			}
		}
	}
	xhttp.open('POST', '?task=servico&_action=service_finish', true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send('&id='+id+'&resp=0');

	budget.confirma = function(el)
	{
		var modal = $("#del").modal('show');
		$(".modal-header").html('Finalizar Serviço');
		$('.btn-act').html("Sim");
		$("#del_m").html('<h4 class="text-center">Deseja concluir este serviço?<h4>');
		__TASK.validate_task = function(resp)
		{
			if(resp == true){
				xhttp.onreadystatechange = function()
				{
					if(this.readyState == 4 && this.status == 200)
					{
						location.reload();					
					}
				}
				xhttp.open('POST', '?task=servico&_action=service_finish', true);
				xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhttp.send('&id='+id+'&resp=1');
			}
		}
	}
}

budget.closure = function(id)
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			if(budget.confirma(this.responseText))
			{
				
			}
		}
	}
	xhttp.open('POST', '?task=servico&_action=service_closure', true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send('&id='+id+'&resp=0');

	budget.confirma = function(el)
	{
		var form_data = $(el).serialize();

		var modal = $("#del").modal('show');
		$('.modal-dialog').addClass('modal-lg');
		$(".modal-header").html('<h5>Registrar Pagamento</h5>');
		$('.btn-act').html("Enviar Pgto");
		$("#del_m").html(el);

		__TASK.validate_task = function(resp)
		{
			if(resp == true){
				xhttp.onreadystatechange = function()
				{	
					$('.btn-act').attr('disabled', 'true');
					$('.btn-act').html('Registrando...');
					if(this.readyState == 4 && this.status == 200)
					{
						$("#del_m").html('Aguarde...');
						setTimeout(function(){
							location.reload();
						},1500);
						
					}
				}
				xhttp.open('POST', '?task=servico&_action=service_closure', true);
				xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhttp.send('&id='+id+'&resp=1'+'&'+form_data);
			}
		}
	}
}

