<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre compte SSPIA a été créé</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4a7c59;
            padding: 24px;
            text-align: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .tagline {
            color: #e2e8f0;
            font-size: 14px;
            margin-top: 4px;
        }

        .content {
            padding: 32px 24px;
        }

        h1 {
            color: #1f2937;
            font-size: 20px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 16px;
        }

        p {
            margin-bottom: 16px;
            font-size: 16px;
        }

        .credentials {
            background-color: #f3f7f4;
            border-radius: 6px;
            padding: 16px 24px;
            margin-bottom: 24px;
            border-left: 4px solid #4a7c59;
        }

        .credentials-item {
            margin-bottom: 8px;
            display: flex;
        }

        .credentials-label {
            font-weight: 600;
            width: 250px;
            color: #4a7c59;
        }

        .credentials-value {
            flex: 1;
        }

        .warning {
            background-color: #fef2f2;
            border-radius: 6px;
            padding: 12px 16px;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .cta {
            text-align: center;
            margin: 24px 0;
        }

        .button {
            background-color: #4a7c59;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            display: inline-block;
        }

        .footer {
            text-align: center;
            padding: 24px;
            background-color: #f3f7f4;
            color: #6b7280;
            font-size: 14px;
        }

        .footer p {
            margin: 8px 0;
            font-size: 14px;
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
                    <div class="credentials-label">Mot de passe :</div>
                    <div class="credentials-value">{{ $password }}</div>
                </div>
            </div>

            <div class="warning">
                Pour des raisons de sécurité, veuillez vous connecter et changer votre mot de passe dès que possible.
            </div>

            <p>Grâce à SSPIA, vous pourrez :</p>
            <ul>
                <li>Gérer vos parcelles agricoles</li>
                <li>Enregistrer et suivre vos interventions</li>
                <li>Optimiser la traçabilité de vos cultures</li>
                <li>Visualiser l'historique de vos activités</li>
            </ul>

            <div class="cta">
                <a href="{{ url('/login') }}" class="button">Se connecter maintenant</a>
            </div>

            <p>Si vous avez des questions ou besoin d'assistance, n'hésitez pas à nous contacter.</p>

            <p>Cordialement,</p>
            <p><strong>L'équipe SSPIA</strong></p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} SSPIA - Tous droits réservés</p>
            <p>Pour une agriculture responsable et traçable</p>
        </div>
    </div>
</body>

</html>
