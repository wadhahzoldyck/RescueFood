<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Livraison Affectée</title>
</head>
<body>
    <h1>Bonjour {{ $livreur->nom }},</h1>
    <p>Vous avez une nouvelle livraison affectée :</p>
    <ul>
        <li><strong>Adresse:</strong> {{ $adresse }}</li>
        <li><strong>État:</strong> {{ $etat }}</li>
        <li><strong>Date de livraison:</strong> {{ $date_livraison }}</li>
    </ul>
    <p>Merci de confirmer la réception et de procéder à la livraison.</p>
</body>
</html>
