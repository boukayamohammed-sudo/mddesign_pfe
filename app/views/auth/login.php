<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administration - MD Design</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #FF7A00;
            --primary-hover: #E86800;
            --dark: #1A1A1A;
            --dark-card: #2C2C2C;
            --light: #E5E5E5;
            --white: #FFFFFF;
            --error: #FF3B30;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: radial-gradient(circle at center, #3d3d3d 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Decorative background glow elements */
        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 122, 0, 0.15);
            border-radius: 50%;
            filter: blur(80px);
            top: 10%;
            left: 10%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 122, 0, 0.1);
            border-radius: 50%;
            filter: blur(100px);
            bottom: 5%;
            right: 5%;
            pointer-events: none;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            background: rgba(44, 44, 44, 0.65);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 122, 0, 0.25);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            z-index: 10;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .logo {
            font-size: 32px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .login-header .logo span {
            color: var(--primary);
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .error-banner {
            background: rgba(255, 59, 48, 0.15);
            border: 1px solid var(--error);
            border-radius: 8px;
            color: #FF7066;
            padding: 12px 15px;
            font-size: 14px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.4s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            transition: color 0.3s;
        }

        .form-control {
            width: 100%;
            background: rgba(20, 20, 20, 0.5);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 14px 15px 14px 45px;
            color: var(--white);
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(255, 122, 0, 0.2);
            background: rgba(20, 20, 20, 0.7);
        }

        .form-control:focus + i {
            color: var(--primary);
        }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 122, 0, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .back-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <div class="logo">MD <span>Design</span></div>
            <p>Espace Administration</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-banner">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span><?= e($error) ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= url('login') ?>" method="POST">
            <div class="form-group">
                <label for="username">Identifiant</label>
                <div class="input-wrapper">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Entrez votre identifiant" required autocomplete="username">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required autocomplete="current-password">
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                Se connecter <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <a href="<?= url('/') ?>" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Retour au site
        </a>
    </div>

</body>
</html>
