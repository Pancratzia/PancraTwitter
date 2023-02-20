'use strict';

function showPassword(){
    let pass = document.getElementById('pass');
    let cpass = document.getElementById('cpass');
    if(pass.type === 'password' && cpass.type === 'password'){
        pass.type = 'text';
        cpass.type = 'text';
    }else{
        pass.type = 'password';
        cpass.type = 'password';
    }
}

function showLoginPass(){
    let pass = document.getElementById('pass');

    if(pass.type === 'password'){
        pass.type = 'text';
    }else{
        pass.type = 'password';
    }
}