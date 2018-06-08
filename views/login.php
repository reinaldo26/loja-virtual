<form method="POST" action="<?php echo BASE_URL; ?>login/signIn" align="center" 
	style="background-color: #2E8B57; width: 70%; margin-left: 15%; padding: 1%; font-size: 18px;">
	<strong>E-mail</strong>
	<input type="text" name="email"/><br/><br/>

	<strong>Senha</strong>
	<input type="text" name="password"/><br/><br/>

	<input type="submit" value="Sing in"/>

	<a class="register" href="<?php echo BASE_URL; ?>login/register">Sign Up</a>
</form>

