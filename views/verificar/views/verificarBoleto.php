<style>
    .container-fluid {
        margin-top: 100px;
    }

    .verificar-form {
        display: flex;
        margin-bottom: 30px;
        justify-content: center;
    }

    .input-boleto {
        width: 20%;
        padding: 8px 12px;
        font-size: 1em;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-right: 8px;
    }

    .btn-verificar {
        padding: 8px 18px;
        font-size: 1em;
        border-radius: 6px;
        border: none;
        background: #2d7a2d;
        color: #fff;
        cursor: pointer;
    }

    .btn-verificar:hover {
        background: #256025;
    }

    @media (max-width: 620px) {
        .input-boleto {
            width: 55%;
            padding: 8px 12px;
            font-size: 1em;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-right: 8px;
        }
    }

    .section-title__title.center {
        margin: 20px;
        display: flex;
        justify-content: center;
    }



    /* boleto  */

    .raffle-ticket-container {
        width: 251px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0px 0px 7px 5px #ddd;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .raffle-ticket-top {
        padding: 15px;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
        /* Importante para el padding */
    }

    .logo-container {
        margin-bottom: 10px;
    }

    .logo-container img {
        max-width: 100px;
        height: auto;
    }

    .raffle-name {
        font-size: 1.8em;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
    }

    .item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eee;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .item:last-of-type {
        border-bottom: none;
    }

    .label {
        font-weight: bold;
        color: #444;
    }

    .value {
        color: #666;
    }

    .reference {
        text-align: center;
        margin: auto;
        margin-top: 10px;
        width: 90%;
    }

    .reference .label {
        display: block;
        font-size: 0.9em;
        color: #777;
    }

    .reference .value {
        font-size: 1em;
        color: #555;
    }

    .raffle-ticket-separator {
        width: 100%;
        height: 3px;
        background: #007bff82;
        border-top: 2px dashed #ccc;
        margin-top: -1px;
        margin-bottom: -1px;
    }

    .raffle-ticket-bottom {
        padding: 15px;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
        background-color: #fff;
    }

    .ticket-number {
        font-size: 1.5em;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .barcode img {
        max-width: 150px;
        height: auto;
    }

    .barcode-text {
        font-size: 0.8em;
        color: #777;
    }

    .subabel {
        margin-bottom: 10px;
        font-weight: bold;
        color: #44444461;
    }
</style>

<div class="container-fluid">
    <div class="section-title__title center">
        Verificar Boletos
    </div>
    <form class="verificar-form" method="post">
        <input class="input-boleto" type="text" name="numero_boleto" placeholder="Ingresa el número de boleto" required>
        <button class="btn-verificar" type="submit">Verificar</button>
    </form>

    <div class="raffle-ticket-container">
        <div class="raffle-ticket-top">
            <div class="logo-container">
                <img src="assets/img/webp/TuRifadigi.webp" alt="Logo de la Rifa">
            </div>
            <h2 class="raffle-name">Tu Rifa Digital</h2>
            <p class="subabel">Detalles de Boleto</p>

            <div class="item">
                <span class="label">Nombre</span>
                <span class="value">victor</span>
            </div>
            <div class="item">
                <span class="label">telefono</span>
                <span class="value">123456</span>
            </div>
            <div class="item">
                <span class="label">Precio del boleto:</span>
                <span class="value">3$</span>
            </div>
            <div class="reference">
                <span class="label">Fecha de compra:</span>
                <span class="value">18/05/2025 13:46</span>
            </div>
        </div>
        <div class="raffle-ticket-separator"></div>
        <div class="raffle-ticket-bottom">
            <p class="ticket-number">Nº 0013</p>
            <div class="barcode">
                <img id="barcode" alt="Código de Barras">
                <p class="barcode-text">ID Boleto: 123456</p>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jsbarcode.js"></script>
<script>
    JsBarcode("#barcode", "123456", {
        format: "CODE128",
        lineColor: "#2962ff",
        width: 5,
        height: 100,
        displayValue: false
    });
</script>

<?php
// Simulación de verificación de boleto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['numero_boleto'])) {
    $numero = htmlspecialchars($_POST['numero_boleto']);
    // Aquí deberías hacer la consulta real a la base de datos
    // Simulación de resultado:
    $boletoValido = ($numero === '12345'); // Cambia esta lógica por la real


    if ($boletoValido) {
        $br = '<div class="ticket-status" style="color:green;">✅ Válido</div>';
    } else {
        $br = '<div class="ticket-status" style="color:red;">❌ No válido</div>';
    }

    echo $br;
}
?>