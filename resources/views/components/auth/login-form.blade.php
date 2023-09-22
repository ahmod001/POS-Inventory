<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>LOG IN</h4>
                    <br />
                    <input id="email" placeholder="Enter email" class="form-control" type="email" />
                    <br />
                    <input id="password" placeholder="Enter password" class="form-control" type="password" />
                    <br />
                    <button onclick="handleLogin()" class="btn w-100 btn-primary">Next</button>
                    <hr />
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{ url('/register') }}">Register </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{ url('/send-otp') }}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    const handleLogin = async () => {
        const isEmailValid = FormValidation.checkEmail(email);
        const isPasswordValid = FormValidation.checkPassword(password);

        if (isEmailValid && isPasswordValid) {
            showLoader();
            try {
                const res = await axios.post('/user-login', {
                    email: email.value.trim(),
                    password: password.value.trim()
                });
                successToast(res['data']['message']);
                hideLoader();

                // Redirect to Dashboard
                setTimeout(() => {
                    window.location.href = '/dashboard'
                }, 1000)
            } catch (error) {
                errorToast('The provided email or password is invalid');
                hideLoader();
            }
        }
    }
</script>
