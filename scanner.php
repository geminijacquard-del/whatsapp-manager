<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw_numeros = explode("\n", $_POST['numeros']);
    $numeros = array_filter(array_map('trim', $raw_numeros));
    $nomFichierBase = preg_replace("/[^A-Za-z0-9]/", "", $_POST['nomFichier']);

    // --- CONFIGURATION RENDER ---
    // On mettra ici l'URL que Render te donnera plus tard
    $url_render = 'https://TON-PROJET-RENDER.onrender.com/scan'; 

    $data = json_encode(['numbers' => array_values($numeros)]);

    $ch = curl_init($url_render);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    curl_close($ch);

    if ($response && $response['success']) {
        // Génération du fichier VCF
        header('Content-Type: text/vcard');
        header('Content-Disposition: attachment; filename="'.$nomFichierBase.'.vcf"');

        foreach ($response['validNumbers'] as $index => $num) {
            echo "BEGIN:VCARD\n";
            echo "VERSION:3.0\n";
            echo "FN:" . $nomFichierBase . ($index + 1) . "\n";
            echo "TEL;TYPE=CELL:" . $num . "\n";
            echo "END:VCARD\n";
        }
        exit;
    } else {
        echo "Erreur : Le serveur de scan ne répond pas. Vérifie ton lien Render.";
    }
}
?>

