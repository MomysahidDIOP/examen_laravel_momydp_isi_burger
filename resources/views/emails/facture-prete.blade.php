<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; }
        .header { background: linear-gradient(135deg, #1a1a2e, #2d1810); padding: 30px; text-align: center; }
        .header h1 { color: #ff6b35; margin: 0; font-size: 24px; }
        .body { padding: 30px; }
        .status-badge { background: #10b981; color: white; padding: 8px 20px; border-radius: 20px; font-weight: bold; display: inline-block; margin: 16px 0; }
        .footer { background: #f8f8f8; padding: 20px; text-align: center; color: #999; font-size: 12px; }
        .btn { background: #ff6b35; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-block; margin: 16px 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>ISI BURGER</h1>
        <p style="color:rgba(255,255,255,0.7); margin:8px 0 0;">Votre commande est prête !</p>
    </div>
    <div class="body">
        <p style="font-size:18px; font-weight:bold; color:#1a1a2e;">
            Bonjour {{ $commande->user->name }} !
        </p>
        <p>Bonne nouvelle ! Votre commande <strong>#{{ $commande->id }}</strong> est prête.</p>
        <div class="status-badge">Commande prête</div>
        <p>Votre facture est jointe à cet email en PDF.</p>
        <p><strong>Récapitulatif :</strong></p>
        <ul>
            @foreach($commande->ligneCommandes as $ligne)
                <li>{{ $ligne->produit->nom }} x{{ $ligne->quantite }} — {{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</li>
            @endforeach
        </ul>
        <p style="font-size:1.2rem; font-weight:bold; color:#ff6b35;">
            Total : {{ number_format($commande->ligneCommandes->sum(fn($l) => $l->quantite * $l->prix_unitaire), 0, ',', ' ') }} FCFA
        </p>
    </div>
    <div class="footer">
        <p>Merci de faire confiance à ISI BURGER</p>
        <p>Dakar, Sénégal | contact@isiburger.com</p>
    </div>
</div>
</body>
</html>
