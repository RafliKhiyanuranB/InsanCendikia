@include('partials.head')

<body @@bodySetup>
  <div class="auth-main">
    <div class="auth-wrapper v1">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <h4 class="text-center f-w-500 mb-3">Sign up with your work email.</h4>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="First Name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Last Name">
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <input type="email" class="form-control" placeholder="Email Address">
            </div>
            <div class="form-group mb-3">
              <input type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group mb-3">
              <input type="password" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="d-flex mt-1 justify-content-between">
              <div class="form-check">
                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                <label class="form-check-label text-muted" for="customCheckc1">I agree to all the Terms & Condition</label>
              </div>
            </div>
            <div class="d-grid mt-4">
              <button type="button" class="btn btn-primary">Sign up</button>
            </div>
            <div class="d-flex justify-content-between align-items-end mt-4">
              <h6 class="f-w-500 mb-0">Don't have an Account?</h6>
              <a href="#" class="link-primary">Create Account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
</body>
<!-- [Body] end -->

</html>