<form action="/verifyAuth">
@csrf
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="submit" value="Submit">
</form>
