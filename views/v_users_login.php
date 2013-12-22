<form id="loginFrm" method="POST">
    <input class="loginfield placeholderTxt" name='user_name' id="user_name" type='text' value="username" size='25' />
    <input class="loginfield placeholderTxt" name='password' id="password" type='text' value="password" size='25' />
    <input type='submit' class="submitBtn" id="loginBtn" value='Go' /><a class="ajaxLink smallLink signUplink" href="/users/signup">Need an account?</a>

</form>
<div id="loginMessage"><?php if(isset($message)) echo $message; ?></div>





