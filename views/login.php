<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'views/templates/head.php'; ?>
    <title>Informatics Admission | Log In</title>
</head>

<body style="height: 100vh;">
    <div class="d-flex row justify-content-center pt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <div class="container d-flex align-items-center">
                        <h1 class="card-title">Log in</h1>
                        <a class="btn btn-secondary ms-auto" href="/" role="button">Home</a>
                    </div>

                    <div class="container">
                        <form method="post" action="actions/login_action.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label class="form-check-label" for="showPassword">Show password</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div>
                            <p class="text-muted text-center">Don't have an account?
                                <em><a href="/signup">Sign up</em><br>
                                <a class="btn btn-secondary" href="/" role="button">Home</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include 'views/templates/body_scripts.php'; ?>
</body>

</html>