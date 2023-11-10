<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>
<div class="login-container">
    <div class="image-login">
        <img loading="lazy" src="/images/register.jpg" alt="login image">
    </div>
    <div class="login-form">
        <p class="form-title">Create an account</p>
        <p class="form-description">Enter your details below</p>
        <form method="POST" class="form">
            <div class="form__field">
                <input class="form__input-login" type="text" id="name" placeholder="Enter your fist name" name="name" value="<?php echo s($user->name) ?>">
            </div>
            <div class="form__field">
                <input class="form__input-login" type="text" id="surname" placeholder="Enter your last name" name="surname" value="<?php echo s($user->surname) ?>">
            </div>
            <div class="form__field">
                <input class="form__input-login" type="tel" id="phone" placeholder="Enter your phone number" name="phone" value="<?php echo s($user->phone) ?>">
            </div>
            <div class="form__field">
                <input class="form__input-login" type="email" id="email" placeholder="Enter your email" name="email" value="<?php echo s($user->email) ?>">
            </div>
            <div class="form__field">
                <input class="form__input-login" type="password" id="password" placeholder="Enter your password" name="password">
            </div>

            <input class="form__submit-100" type="submit" value="Create Account">
            <a class="action" href="/login">Already have an account? <span>Log in</span></a>
        </form>
    </div>
</div>