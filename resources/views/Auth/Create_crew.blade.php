<body>
    <div>
        <h1>Create Crew</h1>
        <form action="/createcrew" method="POST">
            @csrf
            <input type="text" name="name" class="input-field" placeholder="Name" required>
            <input type="text" name="color" class="input-field" placeholder="Color" required>
            <input type="text" name="slogan" class="input-field" placeholder="Slogan" required>
            <input type="text" name="capacity" class="input-field" placeholder="Capacity" required>
            <input type="date" name="foundation_date" class="input-field" placeholder="Foundation date">
            <input type="submit" class="submit-btn" value="Register">
        </form>
        <div class="form-footer">
            <p>¿Ya tienes cuenta? <a href="/login">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
