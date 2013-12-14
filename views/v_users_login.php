<form id="loginFrm" method="POST" action="/users/p_login">
    <input class="loginfield" name='user_name' id="user_name" type='text' value="user name" size='25' />
    <input class="loginfield" name='password' id="password" type='password' value="password" size='25' />
    <input type='submit' class="submitBtn" id="logidnBtn" value='Go' />   
</form>
<div id="message"><?php if(isset($message)) echo $message; ?></div>





