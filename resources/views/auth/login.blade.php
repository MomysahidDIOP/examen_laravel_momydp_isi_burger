<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISI BURGER — Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { min-height: 100vh; background: #1a1a2e; display: flex; margin: 0; }

        /* Côté Gauche (Sombre avec Logo) */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 40px; position: relative; overflow: hidden;
        }
        .left-title { color: white; font-size: 2.5rem; font-weight: 700; text-align: center; line-height: 1.2; z-index: 1; }
        .left-title span { color: #ff6b35; }
        .left-sub { color: rgba(255,255,255,0.5); text-align: center; margin-top: 16px; font-size: 1rem; z-index: 1; }

        /* Côté Droit (Formulaire Clair) */
        .right-side {
            width: 480px; background: #fff8f0;
            display: flex; align-items: center; justify-content: center; padding: 40px;
        }
        .login-form { width: 100%; }
        .login-title { font-size: 1.8rem; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
        .login-sub { color: #999; font-size: 0.9rem; margin-bottom: 24px; }

        /* Champs et Boutons */
        .form-label { font-weight: 600; color: #1a1a2e; font-size: 0.9rem; }
        .form-control { border: 2px solid #e8e0d8; border-radius: 12px; padding: 10px 14px; background: white; }
        .form-control:focus { border-color: #ff6b35; box-shadow: 0 0 0 3px rgba(255,107,53,0.12); }

        .btn-connect {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white; border: none; border-radius: 12px;
            padding: 14px; width: 100%; font-weight: 700; font-size: 1rem;
            box-shadow: 0 6px 20px rgba(255,107,53,0.35); transition: all 0.2s;
            cursor: pointer;
        }
        .btn-connect:hover { transform: translateY(-2px); opacity: 0.9; }

        .register-link { color: #ff6b35; font-weight: 600; text-decoration: none; }
        .register-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="left-side d-none d-lg-flex">
    {{-- Utilisation de ton logo personnalisé --}}
    <img src="{{ asset('images/logo.png') }}" alt="Logo ISI BURGER"
         style="width:140px; height:auto; margin-bottom:20px; z-index:1; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
    <div class="left-title">Bon de vous revoir sur<br><span>ISI BURGER</span></div>
    <div class="left-sub">Connectez-vous pour retrouver vos burgers préférés !</div>
</div>

<div class="right-side">
    <div class="login-form">
        <div class="login-title">Connexion</div>
        <div class="login-sub">Accédez à votre espace client</div>

        {{-- Gestion des erreurs --}}
        @if($errors->any())
            <div class="alert alert-danger border-0 mb-4" style="border-radius:12px; background:#ffe8e8; color:#c0392b; font-size:0.85rem;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="form-label">Mot de passe</label>
                    @if (Route::has('password.request'))
                        <a class="small text-muted text-decoration-none" href="{{ route('password.request') }}">
                            Oublié ?
                        </a>
                    @endif
                </div>
                <input type="password" name="password" class="form-control"
                       placeholder="Votre mot de passe" required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember_me" style="accent-color: #ff6b35;">
                <label class="form-check-label small text-muted" for="remember_me">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn-connect mb-3">
                Se connecter →
            </button>

            <p class="text-center text-muted small mb-0">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="register-link">Créer un compte</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
