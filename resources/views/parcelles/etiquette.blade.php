<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>SSPIA - Étiquette d'Interventions Agricoles</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            padding: 20px;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #4a7c59;
            padding-bottom: 15px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4a7c59;
            margin-bottom: 5px;
        }

        h2 {
            text-align: center;
            font-size: 18px;
            margin: 10px 0;
            color: #4a7c59;
        }

        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f3f7f4;
            border-radius: 5px;
        }

        .intervention {
            margin-bottom: 15px;
            padding: 10px;
            border-left: 3px solid #4a7c59;
            background-color: #fff;
        }

        .label {
            font-weight: bold;
            color: #4a7c59;
        }

        hr {
            margin: 15px 0;
            border: none;
            border-top: 1px dashed #ccc;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">SSPIA</div>
            <div>Système de Suivi des Parcelles et Interventions Agricoles</div>
        </div>

        <h2>Interventions de la Parcelle</h2>

        <div class="section">
            <p><span class="label">Nom de la parcelle :</span> {{ $nom_parcelle }}</p>
            <p><span class="label">Superficie :</span> {{ $superficie }} ha</p>
            <p><span class="label">Type de culture :</span> {{ $type_culture }}</p>
            <p><span class="label">Agriculteur :</span> {{ $agriculteur }}</p>
            <p><span class="label">Nombre d'interventions :</span> {{ $interventions->count() }}</p>
        </div>

        <h3 style="color: #4a7c59;">Liste des interventions</h3>

        <div class="section">
            @foreach ($interventions as $intervention)
                <div class="intervention">
                    <p><span class="label">ID :</span> {{ $intervention->id }}</p>

                    <p><span class="label">Type :</span> {{ $intervention->intervention_type }}</p>
                    <p><span class="label">Date :</span>
                        {{ \Carbon\Carbon::parse($intervention->intervention_date)->format('d/m/Y H:i') }}</p>
                    @if ($intervention->product_used_quantity)
                        <p><span class="label">Produit utilisé :</span> {{ $intervention->product_used_quantity }}
                            {{ $intervention->unit ?? 'kg' }}</p>
                    @endif
                    @if ($intervention->description)
                        <p><span class="label">Description :</span> {{ $intervention->description }}</p>
                    @endif
                </div>
                @if (!$loop->last)
                    <hr style="margin: 10px 0; border-top: 1px dotted #ddd;">
                @endif
            @endforeach
        </div>

        <div class="footer">
            <p>Document généré le {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            <p>SSPIA - Pour une agriculture responsable et traçable</p>
            <p>© {{ date('Y') }} SSPIA - Tous droits réservés</p>
        </div>
    </div>
</body>

</html>
