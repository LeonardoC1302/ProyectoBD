<?php include_once __DIR__ .  '/../templates/alerts.php'; ?>

<div class="login-container">
    <div class="image-login">
        <img loading="lazy" src="/images/forgot.png" alt="forgot image">
    </div>
    <div class="login-form">
        <p class="form-title">Forgot Password?</p>
        <p class="form-description">Enter your email and we'll send you a link to reset your password.</p>
        <form method="POST" class="form">
            <div class="form__field">
                <input class="form__input-login" type="email" id="email" placeholder="Enter your email" name="email">
            </div>

            <input class="form__submit-100" type="submit" value="Send Link">
            <div class="actions">
                <a href="/login" class="action">Back to <span>Login</span></a>
            </div>  

        </form>
    </div>
</div>