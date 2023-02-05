
function onSubmit1(){
    
    let err_msg = onsubmitValidation('form1');
    if(err_msg){
        $('#err_msg').html(err_msg);
        return false;
    }
    
    return true;

}

/**
 * onsubmitイベントのバリデーション
 * @param string form_xid フォームID
 * @return string エラーメッセージ
 */
function onsubmitValidation(form_xid){
    let inputs = $('#' + form_xid + ' input');
    let err_msg = '';
    
    inputs.each((i,elm) => {
        let valid_res = elm.checkValidity();
        
        if(valid_res == false){
            let title = $(elm).attr('title');
            err_msg += `<div>${title}</div>`;
        }
        
    });

    if(err_msg != '') return err_msg;
    
    return false;
}