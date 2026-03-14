<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WhatsApp Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>WhatsApp Manager</h1>
        <form action="scanner.php" method="POST">
            <label>Nom du fichier (ex: Client):</label>
            <input type="text" name="nomFichier" placeholder="Ex: Boutique_Janvier" required>
            
            <label>Collez les numéros (un par ligne) :</label>
            <textarea name="numeros" rows="10" placeholder="2250102030405&#10;2250708091011" required></textarea>
            
            <button type="submit">Gérer et Générer VCF</button>
        </form>
    </div>
</body>
</html>

