<form action="{{ route('sign_up') }}" method="POST">
    <input type="text" name="email" required>
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="password" name="repeat_password">
    <input type="submit" value="Sign Up">
</form>