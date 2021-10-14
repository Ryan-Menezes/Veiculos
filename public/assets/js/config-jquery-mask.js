$(window.document).ready(function(){
	$('*').delegate('.date-mask', 'focus', function(){
        $(this).mask('99/99/9999')
    })

    $('*').delegate('.cpf-mask', 'focus', function(){
        $(this).mask('999.999.999-99')
    })

    $('*').delegate('.phone-mask', 'focus', function(){
        $(this).mask('(99)99999-9999')
    })
})