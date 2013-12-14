<p>Please complete all fields to create your account.  Usernames and passwords must be 5-16 characters long and contain only alphanumeric characters.  A valid e-mail address is required.</p>

<form id="signupFrm" method="POST">
    <div class="reqField">
        <p class="fieldName">Username:</p>
        <input class="reqTextField" name='user_name' id="user_name" type='text' value="" />
        <img class="tooltipIcon" src="/images/tooltip.png">
        <p id="usrReqs" class="tooltip">Must be 6 to 15 characters long, and may contain only letters and numbers.</p>
        <br class="clearfloat">
    </div>
    <div class="reqField">
        <p class="fieldName">Email:</p>
        <input class="reqTextField" name='email' id="email" type='text' value="" />
        <img class="tooltipIcon" src="/images/tooltip.png">
        <p id="emailReqs" class="tooltip">Please use a valid e-mail address.</p>
        <br class="clearfloat">
    </div>
    <div class="reqField">
        <p class="fieldName">Password:</p>
        <input class="reqTextField" name='password' id="password" type='password' value="" />
        <img class="tooltipIcon" src="/images/tooltip.png">
        <p id="pwReqs" class="tooltip">Must be 6 to 15 characters long and contain at least one number and one letter.</p>
        <br class="clearfloat">
    </div>
    <input type='submit' class="submitBtn" id="signupBtn" value='Sign Up' />   
</form>




<br class="clearfloat" />
<div id="message"></div>
<script type="text/javascript" src="/js/form.js"></script>
