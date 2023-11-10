<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>
<div class="login-container">
    <div class="image-login">
        <img loading="lazy" src="/images/login.jpg" alt="login image">
    </div>
    <div class="login-form">
        <p class="form-title">Log in to LabProSource</p>
        <p class="form-description">Enter your details below</p>
        <form method="POST" class="form">
            <div class="form__field">
                <input class="form__input-login" type="email" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form__field">
                <input class="form__input-login" type="password" id="password" placeholder="Enter your password" name="password">
            </div>

            <input class="form__submit-100" type="submit" value="Log In">
            <div class="actions">
                <a href="/register" class="action">Don't have an account? <span>Register</span></a>
                <a href="/forgot" class="action-accent">Forget Password?</a>
            </div>  

        </form>
    </div>
</div>