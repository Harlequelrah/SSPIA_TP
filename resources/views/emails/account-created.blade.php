<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre compte SSPIA a été créé</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(to right, #2dd4bf, #14b8a6, #0d9488);
            padding: 30px 24px;
            text-align: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .tagline {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-top: 6px;
            font-weight: 300;
        }

        .content {
            padding: 36px 28px;
        }

        h1 {
            color: #0f766e;
            font-size: 22px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 16px;
            font-size: 16px;
            color: #334155;
        }

        .credentials {
            background-color: #f0fdfa;
            border-radius: 8px;
            padding: 20px 24px;
            margin-bottom: 28px;
            border-left: 4px solid #0d9488;
        }

        .credentials-item {
            margin-bottom: 12px;
            display: flex;
        }

        .credentials-label {
            font-weight: 600;
            width: 250px;
            color: #0f766e;
        }

        .credentials-value {
            flex: 1;
            font-weight: 500;
        }

        .warning {
            background-color: #fff1f2;
            border-radius: 8px;
            padding: 14px 18px;
            color: #be123c;
            border-left: 4px solid #f43f5e;
            font-size: 14px;
            margin-bottom: 28px;
            font-weight: 500;
        }

        ul {
            color: #334155;
            padding-left: 20px;
        }

        li {
            margin-bottom: 8px;
        }

        .cta {
            text-align: center;
            margin: 32px 0;
        }

        .button {
            background: linear-gradient(to right, #0d9488, #14b8a6);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-block;
            box-shadow: 0 2px 6px rgba(20, 184, 166, 0.3);
            transition: all 0.2s ease;
        }

        .button:hover {
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.5);
            transform: translateY(-1px);
        }

        .footer {
            text-align: center;
            padding: 24px;
            background-color: #f0fdfa;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }

        .footer p {
            margin: 8px 0;
            font-size: 14px;
            color: #64748b;
        }

        .signature {
            font-weight: 600;
            color: #0f766e;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1 class="logo">SSPIA</h1>
        <p class="tagline">Système de Suivi des Parcelles et Interventions Agricoles</p>
    </div>

    <div class="content">
        <h1>Bienvenue, {{ $user->name }} !</h1>

        <p>Votre compte SSPIA a été créé avec succès. Vous pouvez désormais accéder à notre plateforme pour gérer
            vos parcelles et interventions agricoles.</p>

        <div class="credentials">
            <div class="credentials-item">
                <div class="credentials-label">Email :</div>
                <div class="credentials-value">{{ $user->email }}</div>
            </div>
            <div class="credentials-item">
                <div class="credentials-label">Identifiant :</div>
                <div class="credentials-value">{{ $user->username }}</div>
            </div>
            <div class="credentials-item">
                <div class="credentials-label">Mot de passe temporaire :</div>
                <div class="credentials-value">{{ $password }}</div>
            </div>
        </div>

        <div class="warning">
            ⚠️ Pour des raisons de sécurité, veuillez vous connecter et changer votre mot de passe dès que possible.
        </div>

        <p>Grâce à SSPIA, vous pourrez :</p>
        <ul>
            <li>Gérer vos parcelles agricoles avec précision</li>
            <li>Enregistrer et suivre l'historique de vos interventions</li>
            <li>Optimiser la traçabilité et la gestion de vos cultures</li>
            <li>Visualiser des statistiques et rapports détaillés de vos activités</li>
        </ul>

        <div class="cta">
            <a href="{{ url('/login') }}" class="button">Se connecter maintenant</a>
        </div>

        <p>Si vous avez des questions ou besoin d'assistance, notre équipe de support est disponible pour vous aider.</p>

        <p>Cordialement,</p>
        <p class="signature">L'équipe SSPIA</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} SSPIA - Tous droits réservés</p>
        <p>Pour une agriculture responsable et traçable</p>
    </div>
</div>
</body>

</html>
