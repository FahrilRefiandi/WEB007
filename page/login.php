<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page - Kasipaham</title>
    <link rel="icon" type="icon" href="./assets/Kasipaham ico.svg">
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            background: var(--light, #F8F7FF);
            font-family: "Nunito", sans-serif;
            color: #FFF;
            margin: 0;
        }
        .container {
            display: flex;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        button {
            display: flex;
            max-width: 280px;
            max-height: 36px;
            padding: 10px 128px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background-color: #0096C7;
            color: #FAFAFA;
            border: 0px;
        }
        input {
            display: flex;
            max-width: 280px;
            max-height: 36px;
            padding: 10px 128px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background-color: #FAFAFA;
            border: 1px solid #D9D9D9;
        }
        
        button:hover {
            color: #fafafa;
            background: #0077b6;
            box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.20);
        }
        .login-form {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .login-form h1 {
            color: #0096C7;
            font-size: 23px;
            font-weight: 900;
            margin-bottom: 24px;
        }
        .form-control {
            margin-bottom: 16px;
        }
        .login-form p {
            margin-top: 32px;
            color: #737373;
        }
        .image-container {
            position: relative;
            width: 50%;
            background-repeat: no-repeat;
            background: url(./assets/Title-Header.png);
            flex: 1;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h1>Selamat datang di Kasipaham</h1>
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="checkbox">
                    <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault" style="color: #737373;">
                        Remember me
                    </label>
                </div>
                <button type="submit">Masuk</button>
            </form>
            <p>Belum punya akun? <a href="signup.html">Daftar</a></p>
        </div>
        <div class="image-container"></div>
    </div>
</body>
</html>
