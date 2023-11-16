<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>the-dream</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <h1 class="title">Welcome! <br> Convert your currency</h1>
    </header>
    <main>
        <form method="post">
            <label class="importo" for="importo">Amount:</label>
            <br>
            <input class="label1" type="number" name="amount" placeholder="Enter amount" required>
            <br>

            <div class="premiere">
                <label class="value1" for="valutaOrigine">From:</label>
                <select name="fromCurrency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
            <br>

            <div class="duxieme">
                <label class="value2" for="valutaDestinazione">To:</label>
                <select name="toCurrency">
                    <option value="EUR">EUR</option>
                    <option value="USD">USD</option>
                </select>
            </div>

            <button class="conversion" type="submit">Convert</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupera i dati dal form
            $amount = $_POST["amount"];
            $fromCurrency = $_POST["fromCurrency"];
            $toCurrency = $_POST["toCurrency"];

            // Esegui la richiesta API per ottenere i tassi di cambio
            $api_key = '034a84fdf7d9cdca3306273f';
            $api_url = "https://v6.exchangerate-api.com/v6/{$api_key}/latest/{$fromCurrency}";
            $response = file_get_contents($api_url);

            if ($response === false) {
                echo 'Errore durante la richiesta API';
            } else {
                // Decodifica la risposta JSON
                $data = json_decode($response, true);

                if ($data === null || $data['result'] !== 'success') {
                    echo 'Errore nei dati ricevuti dall\'API';
                } else {
                    // Calcola il risultato della conversione
                    $exchangeRate = $data['conversion_rates'][$toCurrency];
                    $result = $amount * $exchangeRate;

                    // Visualizza il risultato
                    echo '<p class="result">Result: ' . number_format($result, 2) . '</p>';
                }
            }
        }
        ?>
    </main>
</body>
</html>
