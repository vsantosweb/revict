class Quasar_modal
{
	constructor(data)
	{
		this.modal = document.createElement('div');
		this.modal_content =  document.createElement('div');
		this.modal_header =  document.createElement('div');
		this.modal_title =  document.createElement('h3');
		this.modal_close =  document.createElement('a');
		this.modal_close_ico =  document.createElement('i');
		this.modal_body =  document.createElement('div');
		this.modal_footer =  document.createElement('div');
		this.act_btn =  document.createElement('input');

		this.content_loaded = document.createElement('div');
		this.close();
		
	}
	open(){
		this.init();
	}
	close(){
		this.modal_close.addEventListener('click', function(){
			$('.quasar_modal').remove();
		});
	}
	init(){

		document.body.appendChild(this.modal);
		this.modal.appendChild(this.modal_content);
		this.modal_content.appendChild(this.modal_header);
		this.modal_content.appendChild(this.modal_body);
		this.modal_content.appendChild(this.modal_footer);

		this.modal_header.appendChild(this.modal_title);
		this.modal_header.appendChild(this.modal_close);
		this.modal_close.appendChild(this.modal_close_ico);

		this.modal_body.appendChild(this.content_loaded);

		this.modal_footer.appendChild(this.act_btn);

		this.modal.setAttribute('class','quasar_modal');
		this.modal_content.setAttribute('class','quasar_modal_content');
		this.modal_header.setAttribute('class','quasar_modal_header');

		this.modal_close.setAttribute('class', 'quasar_modal_close');
		this.modal_close_ico.setAttribute('class', 'fa fa-close');


		this.modal_title.innerHTML = "";
		var form = $('#add_prod_form');


		this.modal_body.setAttribute('class','quasar_modal_body');
		this.modal_footer.setAttribute('class','quasar_modal_footer');
		this.act_btn.setAttribute('class', 'eg_btn_primary');
		this.act_btn.setAttribute('id', 'eg_btn_form');
		this.act_btn.setAttribute('value', 'Cadastrar');
		this.act_btn.setAttribute('type', 'button');
		this.content_loaded.setAttribute('id', 'modal_loaded');
	}
}


