<body>
    <div class="register-container">
        <h1>Register</h1>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" class="input-field" placeholder="First Name" required>
            <input type="text" name="surname" class="input-field" placeholder="Last Name" required>
            <input type="date" name="birth_date" class="input-field" required>
            <input type="email" name="email" class="input-field" placeholder="Email" required>
            <input type="password" name="password" class="input-field" placeholder="Password" required>
            <input type="submit" class="submit-btn" value="Register">
        </form>
    </div>
</body>