$(window.document).ready(function(){
	// Configurações da janela de dialogo da página
	$('.dialog-ui').dialog({
		autoOpen: false,
		modal: true,
		width: 700,
		height: 'auto',
        maxWidth: 700,
        maxHeight: 500
	})

	$('.btn-dialog-open-ui').click(function(){
		$(`#${this.dataset.id}`).dialog('open');
	})

	$('.btn-dialog-close-ui').click(function(){
		$(`#${this.dataset.id}`).dialog('close');
	})

	// Configurações do datepicker
	$('*').delegate('.datepicker-ui', 'focus', function(){
		$(this).attr('readonly', 'readonly')
		$(this).datepicker({
			closeText: 'Fechar',
            prevText: '&#x3C;Anterior',
            nextText: 'Próximo&#x3E;',
            currentText: 'Hoje',
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            dayNames: ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
            dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
		})

        return
	})

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

    // Configurações do form validade
    $('*').delegate('.form-validate', 'focus', function(){
        $(this).validate({
            errorElement: 'span',
            messages: {
                required: 'Este campo é obrigatório',
                email: 'Por favor entre com um email válido'
            }
        })

        return
    })
})