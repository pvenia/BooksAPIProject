


<?php include 'header.php';
include 'footer.php';
 include 'menu.php';?>

<p>
<div align="center">
<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='username' >Όνομα χρήστη:</label>
<input type='text' name='username' id='username'  maxlength="50" />

<label for='password' >Κωδικός:</label>

<input type='password' name='password' id='password' maxlength="50" />
<input type='submit' name='Submit' value='Είσοδος' />

</fieldset>
</form>

</p>
</div>