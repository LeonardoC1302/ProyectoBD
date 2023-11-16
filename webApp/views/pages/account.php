<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>
<div class="profile">
    <p class="title">Edit Your Profile</p>
    <form method="POST" class="form">
        <div class="horizontal">
            <div class="form__field">
                <label for="name" class="form__label">First Name</label>
                <input class="form__input" type="text" id="name" placeholder="Your name" name="name" value="<?php echo $user->name; ?>">
            </div>
            <div class="form__field">
                <label for="name" class="form__label">Last Name</label>
                <input class="form__input" type="text" id="surname" placeholder="Your Last Name" name="surname" value="<?php echo $user->surname;?>">
            </div>
        </div>

        <div class="horizontal">
            <div class="form__field">
                <label for="email" class="form__label">Email</label>
                <input class="form__input" type="email" id="email" placeholder="Your email" name="email" value="<?php echo $user->email;?>">
            </div>
            <div class="form__field">
                <label for="phone" class="form__label">Phone</label>
                <input class="form__input" type="tel" id="phone" placeholder="Your Phone" name="phone" value="<?php echo $user->phone;?>">
            </div>
        </div>

        <label for="name" class="form__label">Password Changes</label>
        <div class="form__field">
            <input class="form__input" type="password" id="current_pass" placeholder="Current Password" name="currentPassword">
            <input class="form__input" type="password" id="pass_1" placeholder="New Password" name="password1">
            <input class="form__input" type="password" id="pass_2" placeholder="Confirm New Password" name="password2">
        </div>
        <div class="save-changes">
            <a href="/account">Cancel</a>
            <input class="form__submit" type="submit" value="Save Changes">
        </div>
    </form>
</div>