<h1>Reset Your Password</h1>

<?php 
    include_once __DIR__ . "/../templates/alerts.php"; 
    if($error) return;
?>

<div class="recover-container">
    <form class="form" method='POST'>
        <div class="form__field">
            <label class="form__label" for="password">Password</label>
            <input class="form__input-login" type="password" id="password" name="password" placeholder="Your New Password">
        </div>
    
        <input class="form__submit" type="submit" class="button" value="Change Password">
    </form>
    
    <div class="actions">
        <a class="action" href="/">Already have an account? <span>Log In</span></a>
        <a class="action" href="/register">Don't have an account? <span>Register</span></a>
    </div>
</div>
