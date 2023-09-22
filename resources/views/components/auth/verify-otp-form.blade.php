<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>ENTER OTP CODE</h4>
                    <br />
                    <label>4 Digit Code Here</label>
                    <input id="otp" placeholder="Code" class="form-control" type="text" />
                    <br />
                    <button onclick="handleVerifyOtp()" class="btn w-100 float-end btn-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const otp = document.getElementById('otp');

    const handleVerifyOtp = async () => {
        const isOtpValid = FormValidation.checkOtp(otp);

        if (isOtpValid) {
            showLoader();
            
            try {
                const res = await axios.post('/verify-otp', {
                    email: sessionStorage.getItem('email'),
                    otp: otp.value.trim(),
                });
                // Remove email from Session
                sessionStorage.removeItem('email');

                successToast(res['data']['message']);
                hideLoader();

                // Redirect to Verify-OTP
                setTimeout(() => {
                    window.location.href = '/reset-password'
                }, 1000)

            } catch (error) {
                errorToast('Provided OTP code is invalid');
                hideLoader();
            }
        }
    }
</script>
