//const passwordRegex = new RegExp( /^(?=.*[A-Z])(?=.*[a-z])(?=.*[@$!%*#?&])[A-Za-z@$!%*#?&]{8}$/ );
const passwordRegex = new RegExp(/^(?=.*[A-Z])(?=.*[a-z])(?=.*[@$!%*#?&])[\w@$!%*#?&]{8,}$/);

//const mailRegex = new RegExp( /^[a-zA-Z0-9.]{1,}[@][a-zA-Z0-9.]{1,}[.][a-zA-Z0-9.]{1,}$/);
const mailRegex = new RegExp(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/);

/**
 * Check username
 */
$('#user_username').blur(function() {
    const nomError = document.getElementById('nomError');
    const submitButton = document.getElementById('formUserSubmit');
    const username = document.getElementById('user_username');
    let usernameValue = $('#user_username').val();

    if (usernameValue !== '') {
        $.ajax({
            type: 'POST',
            url: 'check',
            data: { username: usernameValue },
            async: true,
            dataType: 'json',
            success: function(data) {
                let user = data;

                console.log('console de user');
                console.log(user);
                debugger;

            },
            error: function(data) {
                let user = JSON.parse(data);
            }
        });
    }
});


/**
 * disabled or enabled field error
 * @param button
 * @param error
 * @param enable
 * @param noErrorsFormUser
 * @param noErrorsFormPassword
 */
function disabledEnableButtonAndError(button,error,enable,noErrorsFormUser,noErrorsFormPassword)
{

    if(enable) {
        error . hidden = true;
        if (noErrorsFormPassword && noErrorsFormUser)
            button . disabled = false;
    }else
    {
        button.disabled = true;
        error.hidden = false;

    }


}


/**
 * add, remove valid and invalid class or removeAll
 * @param input
 * @param isValid
 * @param removeALl
 */
function validInvalidCss(input,isValid,removeALl=false) {
    if (removeALl)
    {
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');

    }else  if (isValid)
    {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');

    }
    else
    {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');

    }

}

/**
 * keyup on password
 */
$('#user_password').on('keyup',function (e)
    {
        checkPassword(passwordRegex,noErrorsFormUser,noErrorsFormPassword)
    }

    )

/**
 * keyup on repeatPassword
 */
$('#repeatPassword').on('keyup',function (e)
    {
        checkPassword(passwordRegex,noErrorsFormUser,noErrorsFormPassword)
    }

)


/**
 * check matching password and repeatpassword
 * @param passwordRegex
 * @param noErrorsFormUser
 * @param noErrorsFormPassword
 */
function checkPassword(passwordRegex,noErrorsFormUser,noErrorsFormPassword)
{
    const password=document.getElementById('user_password');
    const repeatPassword = document.getElementById('repeatPassword');
    const passwordError = document.getElementById('passwordError');
    const passwordMatches =  document.getElementById('passwordMatches');
    const submitButton = document.getElementById('formUserSubmit');
    let passwordValue = $('#user_password').val();
    let repeatPasswordValue = $('#repeatPassword').val();
    if(repeatPasswordValue !== '' && passwordValue!== repeatPasswordValue)
    {
        console.log("pas vide et différent ");
        disabledEnableButtonAndError(submitButton,passwordError,false)
        validInvalidCss(password,false);
        validInvalidCss(repeatPassword,false);


    }else if(repeatPasswordValue !== '')
    {
        console.log('Pas vide et match');
        if(! passwordRegex.test(passwordValue))
        {
            passwordError.hidden = true;
            passwordMatches.hidden = false;

        }else
        {
            validInvalidCss(password,true);
            validInvalidCss(password,true);
            noErrorsFormPassword = true;
            disabledEnableButtonAndError(submitButton,passwordError,true,noErrorsFormUser,noErrorsFormPassword);

        }


    }else
    {
        console.log('pas vide et pas match');
        validInvalidCss(password,true);
        validInvalidCss(repeatPassword,true);
        noErrorsFormPassword = false;

    }

    if(repeatPasswordValue === '' && passwordValue === '')
    {
        disabledEnableButtonAndError(submitButton,passwordError,true,noErrorsFormUser,true)
        validInvalidCss(password,null,true)
        validInvalidCss(repeatPassword,null,true)
        noErrorsFormPassword =true;

    }

    if(repeatPasswordValue === '' && passwordValue !== '')
    {
        if(passwordRegex.test(passwordValue))
        {
                validInvalidCss(password,true);
        }

    }
}

/**
 * on blur on mail
 */
$('#user_mail').blur(
    function ()
    {
        const mail = document.getElementById('user_mail');
        let mailValue = $('#user_mail').val();
        if(mailValue !== '' && mailRegex.test(mailValue))
        {
            validInvalidCss(mail,true);

        }else
        {
            if(mailValue === '')
            {
                validInvalidCss(mail,true);

            }else
            {
                validInvalidCss(mail,false);
            }

        }
    }
)


