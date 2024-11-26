<form action="/register" method='POST' >
    @csrf
        <input type="text" name="name">
        <input type="text" name="surname">
        <input type="date" name="birth_date">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="submit" value="Submit">
</form>



