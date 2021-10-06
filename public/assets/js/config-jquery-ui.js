$(window.document).ready(function(){
	// Configurações da janela de dialogo da página
	$('.modal-ui').dialog({
		autoOpen: false,
		modal: true,
		width: 500,
		height: 400
	})

	$('.btn-modal-open-ui').click(function(){
		$(`#${this.dataset.id}`).dialog('open');
	})

	$('.btn-modal-close-ui').click(function(){
		$(`#${this.dataset.id}`).dialog('close');
	})

	// Configurações do datepicker
	$('.datepicker-ui').datepicker()

	// Configurações do accordion
	$('.accordion-ui').accordion({
    	collapsible: true
    })

	// Configurações do controlgroup
    $('.controlgroup-ui').controlgroup()

    // Configurações do button
    $('.button-ui').button()

    // Configurações do progressbar
    $('.progressbar-ui').progressbar({
    	value: 50
    });

    // Configurações dos tabs
    $('.tabs-ui').tabs()

    // Configurações do tooltip
    $(window.document).tooltip();

    // Configurações do checkboxradio
    $('.checkboxradio-ui').checkboxradio();

	// Configurações do buttonset
    $('.buttonset-ui').buttonset();    
})