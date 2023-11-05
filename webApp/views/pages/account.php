<div class="profile">
    <p class="title">Edit Your Profile</p>
    <form class="form">
        <div class="horizontal">
            <div class="form__field">
                <label for="name" class="form__label">First Name</label>
                <input class="form__input" type="text" id="firstName" placeholder="Your name" name="firstName">
            </div>
            <div class="form__field">
                <label for="name" class="form__label">Last Name</label>
                <input class="form__input" type="text" id="surname" placeholder="Your Last Name" name="surname">
            </div>
        </div>

        <div class="horizontal">
            <div class="form__field">
                <label for="email" class="form__label">Email</label>
                <input class="form__input" type="email" id="email" placeholder="Your email" name="email">
            </div>
            <div class="form__field">
                <label for="address" class="form__label">Address</label>
                <input class="form__input" type="text" id="address" placeholder="Your Address" name="Address">
            </div>
        </div>

        <label for="name" class="form__label">Password Changes</label>
        <div class="form__field">
            <input class="form__input" type="password" id="current_pass" placeholder="Current Password" name="currentPassword">
            <input class="form__input" type="password" id="pass_1" placeholder="New Password" name="password1">
            <input class="form__input" type="text" id="pass_2" placeholder="Confirm New Password" name="password2">
        </div>
        <div class="save-changes">
            <a href="/account">Cancel</a>
            <input class="form__submit" type="submit" value="Save Changes">
        </div>
    </form>
</div>