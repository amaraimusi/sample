

$(()=>{
    $('.js-modal-open').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });
});

function closeModal(){
	$('.js-modal').fadeOut();
}

function openModal(){
	$('.js-modal').fadeIn();
}
