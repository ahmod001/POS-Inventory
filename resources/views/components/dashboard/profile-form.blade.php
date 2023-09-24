<div class="container">
    <div class="row ">
        <div class="col-md-10 col-lg-10 ">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control"
                                    type="email" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="number" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="handleUpdate()" class="btn mt-3 w-100  btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const email = document.getElementById('email');
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const mobile = document.getElementById('mobile');
    const password = document.getElementById('password');

    const getProfileDetails = async () => {
        showLoader();
        try {
            const res = await axios.get('/user-profile-details');
            const user = res['data']['data'];
            email.value = user['email'];
            firstName.value = user['first_name'];
            lastName.value = user['last_name'];
            mobile.value = user['mobile'];
            password.value = user['password'];
            hideLoader();
        } catch (error) {
            hideLoader();
            errorToast('Something went wrong');
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 1000);

        }

    }
    getProfileDetails();

    const handleUpdate = async () => {
        const isEmailValid = FormValidation.checkEmail(email);
        const isPasswordValid = FormValidation.checkPassword(password);
        const isFirstNameValid = FormValidation.checkFirstName(firstName);
        const isLastNameValid = FormValidation.checkLastName(lastName);
        const isMobileNumberValid = FormValidation.checkMobileNumber(mobile);

        if (isEmailValid && isPasswordValid && isFirstNameValid && isLastNameValid && isMobileNumberValid) {
            showLoader();
            try {
                const res = await axios.post('/user-update', {
                    first_name: firstName.value.trim(),
                    last_name: lastName.value.trim(),
                    email: email.value.trim(),
                    mobile: mobile.value.trim(),
                    password: password.value.trim(),
                });
                successToast(res['data']['message']);
                hideLoader();

            } catch (error) {
                errorToast('Profile update failed');
                hideLoader();
            }
        }
    }
</script>
