<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #1a1a2e; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #ff6b35; font-size: 28px; margin: 0; }
        .header p { color: #666; margin: 4px 0; }
        .divider { border: 2px solid #ff6b35; margin: 20px 0; }
        .info-box { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .info-left, .info-right { width: 48%; }
        .info-left p, .info-right p { margin: 4px 0; }
        .label { font-weight: bold; color: #666; font-size: 11px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        thead { background: #1a1a2e; color: white; }
        thead th { padding: 10px; text-align: left; }
        tbody tr:nth-child(even) { background: #fff8f0; }
        tbody td { padding: 10px; border-bottom: 1px solid #eee; }
        .total-row { background: #ff6b35 !important; color: white; font-weight: bold; }
        .total-row td { padding: 12px 10px; }
        .footer { text-align: center; margin-top: 40px; color: #999; font-size: 11px; }
        .badge { padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .badge-success { background: #10b981; color: white; }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('images/logo.png') }}" style="width:70px; height:70px; object-fit:contain;">
    <h1 style="color:#ff6b35; margin:8px 0 0;">ISI BURGER</h1>
    <p>Le meilleur burger de Dakar</p>
    <p>Tel: 33 800 80 80 | Email: groupeisiburgera@gmail.com</p>
</div>

<hr class="divider">

<h2 style="color:#ff6b35;">FACTURE #{{ $commande->id }}</h2>

<table style="width:100%; margin-bottom:20px;">
    <tr>
        <td style="width:50%">
            <p class="label">Client</p>
            <p><strong>{{ $commande->user->name }}</strong></p>
            <p>{{ $commande->user->email }}</p>
        </td>
        <td style="width:50%; text-align:right;">
            <p class="label">Date de commande</p>
            <p><strong>{{ $commande->created_at->format('d/m/Y à H:i') }}</strong></p>
            <p class="label">Statut</p>
            <p><span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</span></p>
        </td>
    </tr>
</table>

<hr class="divider">

<table>
    <thead>
    <tr>
        <th>Produit</th>
        <th>Prix unitaire</th>
        <th>Quantité</th>
        <th>Sous-total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commande->ligneCommandes as $ligne)
        <tr>
            <td>{{ $ligne->produit->nom }}</td>
            <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
            <td>{{ $ligne->quantite }}</td>
            <td>{{ number_format($ligne->quantite * $ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
        </tr>
    @endforeach
    <tr class="total-row">
        <td colspan="3" style="text-align:right;">TOTAL</td>
        <td>{{ number_format($commande->ligneCommandes->sum(fn($l) => $l->quantite * $l->prix_unitaire), 0, ',', ' ') }} FCFA</td>
    </tr>
    </tbody>
</table>

@if($commande->paiement)
    <div style="background:#f0fdf4; border:1px solid #10b981; border-radius:8px; padding:12px; margin-top:20px;">
        <strong style="color:#10b981;">Paiement recu</strong>
        <p style="margin:4px 0;">Montant : <strong>{{ number_format($commande->paiement->montant, 0, ',', ' ') }} FCFA</strong></p>
        <p style="margin:4px 0;">Date : {{ $commande->paiement->date_paiement ? \Carbon\Carbon::parse($commande->paiement->date_paiement)->format('d/m/Y à H:i') : 'N/A' }}</p>
    </div>
@endif

<div class="footer">
    <p>Merci pour votre commande chez ISI BURGER !</p>
    <p>Document généré le {{ now()->format('d/m/Y à H:i') }}</p>
</div>

</body>
</html>
