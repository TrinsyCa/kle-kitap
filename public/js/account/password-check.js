const password = document.getElementById("password");
const password_verify = document.getElementById("password_verify");
const password_check = document.getElementById("password_check");

function checkPassword()
{
    if(password_verify.value.length > 0 && password.value.length > 0)
    {
        if(password.value == password_verify.value)
        {
            if(password.value.length < 6 && password_verify.value.length < 6)
            {
                password_check.innerHTML = '<p class="alert alert-danger"><i class="fa-solid fa-circle-xmark"></i> Minimum 6 Karakterlik Bir Şifre Girin</p>';
            }
            else
            {
                password_check.innerHTML = '<p class="alert alert-success"><i class="fa-solid fa-circle-check"></i> Şifreler Eşleşti</p>';
            }
        }
        else
        {
            if(password.value.length < 6 && password_verify.value.length < 6)
            {
                password_check.innerHTML = '<p class="alert alert-danger"><i class="fa-solid fa-circle-xmark"></i> Şifrelerin Aynı Olduğundan Emin Olun ve Minimum 6 Karakterlik Bir Şifre Girin</p>';
            }
            else
            {
                password_check.innerHTML = '<p class="alert alert-danger"><i class="fa-solid fa-circle-xmark"></i> Şifrelerin Aynı Olduğundan Emin Olun</p>';
            }
        }

        password_check.classList.add("active");
    }
    else if(password_verify.value.length <= 0)
    {
        password_check.classList.remove("active");
    }
}

password.addEventListener("input", checkPassword);
password_verify.addEventListener("input", checkPassword);