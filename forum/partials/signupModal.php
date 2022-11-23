<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign-up to iForum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/partials/handleSignup.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter your name</label>
                        <input type="text" maxlength="10" class="form-control" id="signupName" name="signupName" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputMobile" class="form-label">Mobile No.</label>
                        <input type="text" maxlength="10" class="form-control" id="signupMobile" name="signupMobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signuPassword" name="signupPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="signupcPassword" name="signupcPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">sign up</button>
                </div>
            </form>
        </div>
    </div>
</div>