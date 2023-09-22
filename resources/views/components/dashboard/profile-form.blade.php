<div class="container">
    <div class="row ">
        <div class="col-md-10 col-lg-10 ">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="number"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getProfileDetails();
 async function getProfileDetails() {
    showLoader();

    let res = await axios.get('/user-profile')

     hideLoader();

     if(res.status===200 && res.data['status']==='success'){
        let userData = res.data['userdata'];

        document.getElementById('email').value=userData['email'];
        document.getElementById('firstName').value=userData['firstName'];
        document.getElementById('lastName').value=userData['lastName'];
        document.getElementById('mobile').value=userData['mobile'];
        document.getElementById('password').value=userData['password'];
     }else{
       errorToast("failure");
     }

 }



  async  function onUpdate() {
 
    let firstName = document.getElementById('firstName').value;
    let lastName = document.getElementById('lastName').value;
    let mobile = document.getElementById('mobile').value;
    let password = document.getElementById('password').value;

    if(firstName.length===0){
        errorToast("First name required");
    }
    else if(lastName.length===0){
        errorToast("last name required");
    }
    else if(mobile.length===0){
        errorToast("Mobile number required");
    }
    else if(password.length===0){
        errorToast("Password requred")
    }else{
        showLoader();
        let res = await axios.post('/user-update',{
            fristName:firstName,
            lastName:lastName,
            mobile:mobile,
            password:password
        })
        hideLoader();
        if(res.status===200 && res.data['status']==='success'){
            successToast(res.data['message']);
         await getProfileDetails();
        }else{
            errorToast(res.data['message']);
        }

    }

    }
</script>
