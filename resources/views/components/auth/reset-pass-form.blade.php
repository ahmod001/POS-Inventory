<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    <br />
                    <label>New Password</label>
                    <input id="newPassword" placeholder="New Password" class="form-control" type="password" />
                    <br />
                    <label>Confirm Password</label>
                    <input id="confirmPassword" placeholder="Confirm Password" class="form-control" type="password" />
                    <br />
                    <button onclick="handleResetPassword()" class="btn w-100  btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');

    const handleResetPassword = async () => {
        const isNewPasswordValid = FormValidation.checkPassword(newPassword);

        if (!isNewPasswordValid) {
            return
        }
        if (isNewPasswordValid && newPassword.value !== confirmPassword.value) {
            errorToast('Confirm password didn\'t matched');
        } else {
            showLoader();
            try {
                const res = await axios.post('/reset-password', {
                    password: newPassword.value.trim()
                });

                successToast(res['data']['message']);
                hideLoader();

                // Redirect to Login
                setTimeout(() => {
                    window.location.href = '/login'
                }, 1000)

            } catch (error) {
                errorToast('Something went wrong');
                hideLoader();
            }
        }
    }
</script>
