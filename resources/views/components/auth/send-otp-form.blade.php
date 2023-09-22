<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br />
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br />
                    <button onclick="handleVerifyEmail()" class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const email = document.getElementById('email');

    const handleVerifyEmail = async () => {
        const isEmailValid = FormValidation.checkEmail(email);

        if (isEmailValid) {
            showLoader();
            try {
                const res = await axios.post('/send-otp', {
                    email: email.value.trim(),
                });
                // Save email in Session
                sessionStorage.setItem('email', email.value.trim())

                successToast(res['data']['message']);
                hideLoader();

                // Redirect to Verify-OTP
                setTimeout(() => {
                    window.location.href = '/verify-otp'
                }, 1000)

            } catch (error) {
                errorToast('OTP code sending failed');
                hideLoader();
            }
        }
    }
</script>
