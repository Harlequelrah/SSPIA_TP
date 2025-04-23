<!DOCTYPE html>
<html>
<head>
    <title>Votre compte a été créé</title>
</head>
<body>
    <h1>Bonjour {{ $user->name }},</h1>
    <p>Votre compte a été créé avec succès. Voici vos informations de connexion :</p>
    <ul>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Mot de passe :</strong> {{ $password }}</li>
    </ul>
    <p>Veuillez vous connecter et changer votre mot de passe dès que possible.</p>
    <p>Merci,</p>
    <p>L'équipe SSPIA</p>
</body>
</html>
