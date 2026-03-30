<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISI BURGER — Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { min-height: 100vh; background: #1a1a2e; display: flex; }
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 40px; position: relative; overflow: hidden;
        }
        .left-side::before {
            content: ''; position: absolute;
            font-size: 20rem; opacity: 0.04;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }
        .left-title { color: white; font-size: 2.5rem; font-weight: 700; text-align: center; line-height: 1.2; z-index: 1; }
        .left-title span { color: #ff6b35; }
        .left-sub { color: rgba(255,255,255,0.5); text-align: center; margin-top: 16px; font-size: 1rem; z-index: 1; }
        .burger-emoji { font-size: 5rem; margin-bottom: 20px; z-index: 1; }
        .right-side {
            width: 480px; background: #fff8f0;
            display: flex; align-items: center; justify-content: center; padding: 40px;
        }
        .register-form { width: 100%; }
        .register-title { font-size: 1.8rem; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
        .register-sub { color: #999; font-size: 0.9rem; margin-bottom: 24px; }
        .form-label { font-weight: 600; color: #1a1a2e; font-size: 0.9rem; }
        .form-control { border: 2px solid #e8e0d8; border-radius: 12px; padding: 10px 14px; background: white; }
        .form-control:focus { border-color: #ff6b35; box-shadow: 0 0 0 3px rgba(255,107,53,0.12); }
        .btn-connect {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white; border: none; border-radius: 12px;
            padding: 14px; width: 100%; font-weight: 700; font-size: 1rem;
            box-shadow: 0 6px 20px rgba(255,107,53,0.35); transition: all 0.2s;
        }
        .btn-connect:hover { opacity: 0.9; }
        .login-link { color: #ff6b35; font-weight: 600; text-decoration: none; }
        .login-link:hover { text-decoration: underline; }
        .text-danger { font-size: 0.8rem; }
    </style>
</head>
<body>
<div class="left-side d-none d-lg-flex">
    <img src="{{ asset('images/logo.png') }}" style="width:120px; height:120px; object-fit:contain; margin-bottom:20px; z-index:1;">
    <div class="left-title">Rejoignez<br><span>ISI BURGER</span></div>
    <div class="left-sub">Créez votre compte et commandez<br>les meilleurs burgers de Dakar !</div>
</div>

<div class="right-side">
    <div class="register-form">
        <div class="register-title">Inscription</div>
        <div class="register-sub">Créez votre compte client</div>

        @if($errors->any())
            <div class="alert alert-danger" style="border-radius:12px; border:none; background:#ffe8e8; color:#c0392b; font-size:0.85rem;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom complet</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}" placeholder="Votre nom" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="votre@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Minimum 8 caractères" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Répétez le mot de passe" required>
            </div>
            <button type="submit" class="btn-connect mb-3">
                Créer mon compte →
            </button>
            <p class="text-center text-muted small mb-0">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="login-link">Se connecter</a>
            </p>
        </form>
    </div>
</div>
</body>
</html>
