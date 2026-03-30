@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h2>


    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#1a3a6b,#2563eb)">
                <div class="opacity-75 small mb-1"><i class="bi bi-receipt"></i> Commandes aujourd'hui</div>
                <div class="fs-2 fw-bold">{{ \App\Models\Commande::whereDate('created_at',today())->count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#065f46,#10b981)">
                <div class="opacity-75 small mb-1"><i class="bi bi-check-circle"></i> Validées aujourd'hui</div>
                <div class="fs-2 fw-bold">{{ \App\Models\Commande::whereDate('created_at',today())->where('statut','payee')->count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#92400e,#f59e0b)">
                <div class="opacity-75 small mb-1"><i class="bi bi-cash-coin"></i> Recettes aujourd'hui</div>
                <div class="fs-2 fw-bold">{{ number_format(\App\Models\Paiement::whereDate('created_at',today())->sum('montant'),0,',',' ') }} F</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#6b21a8,#a855f7)">
                <div class="opacity-75 small mb-1"><i class="bi bi-box-seam"></i> Produits actifs</div>
                <div class="fs-2 fw-bold">{{ \App\Models\Produit::where('archive',false)->count() }}</div>
            </div>
        </div>
    </div>


    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h6 class="fw-bold mb-3"><i class="bi bi-bar-chart"></i> Commandes par mois</h6>
                <canvas id="commandesChart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h6 class="fw-bold mb-3"><i class="bi bi-pie-chart"></i> Produits par catégorie</h6>
                <canvas id="categoriesChart" height="200"></canvas>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-3"><i class="bi bi-clock-history"></i> Commandes récentes</h5>
            <table class="table table-hover">
                <thead class="table-light">
                <tr><th>#</th><th>Client</th><th>Statut</th><th>Total</th><th>Heure</th></tr>
                </thead>
                <tbody>
                @forelse(\App\Models\Commande::with('user','ligneCommandes')->latest()->take(5)->get() as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->user->name }}</td>
                        <td>
                        <span class="badge bg-{{ $c->statut=='payee'?'success':($c->statut=='prete'?'primary':($c->statut=='en_preparation'?'info':'warning')) }}">
                            {{ ucfirst(str_replace('_',' ',$c->statut)) }}
                        </span>
                        </td>
                        <td>{{ number_format($c->ligneCommandes->sum(fn($l)=>$l->quantite*$l->prix_unitaire),0,',',' ') }} FCFA</td>
                        <td>{{ $c->created_at->format('H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Aucune commande</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @php
        $commandesParMois = \App\Models\Commande::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->map(fn($c) => ['mois' => $c->mois, 'total' => $c->total]);

        $categoriesStats = \App\Models\Categorie::withCount('produits')->get()
            ->map(fn($c) => ['nom' => $c->nom, 'total' => $c->produits_count]);
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const commandesData = @json($commandesParMois);
        const categoriesData = @json($categoriesStats);
        const moisLabels = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];

        const commandesMois = Array(12).fill(0);
        commandesData.forEach(d => { commandesMois[d.mois - 1] = d.total; });

        new Chart(document.getElementById('commandesChart'), {
            type: 'bar',
            data: {
                labels: moisLabels,
                datasets: [{
                    label: 'Commandes',
                    data: commandesMois,
                    backgroundColor: 'rgba(255,107,53,0.7)',
                    borderColor: '#ff6b35',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });

        new Chart(document.getElementById('categoriesChart'), {
            type: 'doughnut',
            data: {
                labels: categoriesData.map(c => c.nom),
                datasets: [{
                    data: categoriesData.map(c => c.total),
                    backgroundColor: ['#ff6b35','#1a1a2e','#f7931e','#a855f7','#10b981'],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>

@endsection
