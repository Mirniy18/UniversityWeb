<div id="modal_sign_in" class="modal">
	<form action="sign_in.php" method="POST">
		<div class="modal-content">
			<div class="input-field col s3">
				<input id="login" name="login" type="text" class="validate" required>
				<label for="login">Login</label>
			</div>
			<div class="input-field col s3">
				<input id="password" name="password" type="password" class="validate" minlength="6" required>
				<label for="password">Password</label>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" value="Sign In" class="btn">
		</div>
	</form>
</div>