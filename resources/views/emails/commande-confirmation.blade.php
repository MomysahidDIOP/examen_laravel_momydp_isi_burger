<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; }
        .header { background: linear-gradient(135deg, #1a1a2e, #2d1810); padding: 30px; text-align: center; }
        .header h1 { color: #ff6b35; margin: 0; font-size: 24px; }
        .header p { color: rgba(255,255,255,0.7); margin: 8px 0 0; }
        .body { padding: 30px; }
        .greeting { font-size: 18px; font-weight: bold; color: #1a1a2e; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th { background: #1a1a2e; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .total { background: #ff6b35; color: white; font-weight: bold; }
        .total td { padding: 12px 10px; }
        .footer { background: #f8f8f8; padding: 20px; text-align: center; color: #999; font-size: 12px; }
        .btn { background: #ff6b35; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-block; margin: 16px 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" style="width:70px; height:70px; object-fit:contain; margin-bottom:8px;">
        <h1 style="color:#ff6b35; margin:0;">ISI BURGER</h1>
        <p>Confirmation de commande</p>
    </div>
    <div class="body">
        <p class="greeting">Bonjour {{ $commande->user->name }} !</p>
        <p>Votre commande <strong>#{{ $commande->id }}</strong> a bien été reçue. Nous la préparons avec soin ! 🍟</p>

        <table>
            <thead>
            <tr><th>Produit</th><th>Qté</th><th>Prix</th></tr>
            </thead>
            <tbody>
            @foreach($commande->ligneCommandes as $ligne)
                <tr>
                    <td>{{ $ligne->produit->nom }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="2">TOTAL</td>
                <td>{{ number_format($commande->ligneCommandes->sum(fn($l) => $l->quantite * $l->prix_unitaire), 0, ',', ' ') }} FCFA</td>
            </tr>
            </tbody>
        </table>

        <p>Vous pouvez suivre votre commande en cliquant ci-dessous :</p>
        <a href="{{ url('/mes_commandes') }}" class="btn">Suivre ma commande →</a>
    </div>
    <div class="footer">
        <p>Merci de faire confiance à ISI BURGER 🍔</p>
        <p>Dakar, Sénégal | contact@isiburger.com</p>
    </div>
</div>
</body>
</html>
