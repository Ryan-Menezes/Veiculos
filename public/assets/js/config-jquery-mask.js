$(window.document).ready(function(){
	$('*').delegate('.date-mask', 'focus', function(){
        $(this).mask('99/99/9999')
        return
    })

    $('*').delegate('.cpf-mask', 'focus', function(){
        $(this).mask('999.999.999-99')
        return
    })

    $('*').delegate('.phone-mask', 'focus', function(){
        $(this).mask('(99)9999-9999')
        return
    })

    $('*').delegate('.cardnumber-mask', 'focus', function(){
        $(this).mask('9999 9999 9999 9999')
        return
    })
})