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
</style>

<div class="container-fluid">
    <div class="section-title__title center">
        Verificar Boletos
    </div>
    <form class="verificar-form" method="post" id="verificarForm">
        <input class="input-boleto" type="text" name="numero_boleto" placeholder="Ingresa el número de boleto" required>
        <button class="btn-verificar" type="submit">Verificar</button>
    </form>

    <div id="boletoContainer"></div>
</div>

<script>
    // Ejemplo de uso (puedes quitar esto y llamar renderBoleto con tus datos reales)
    renderBoleto({
        items: {
            nombre: "victor carrillo fernadez tercero",
            telefono: "04243191605",
            "Precio del boleto": "3$"
        },
        fecha_compra: "18/05/2025 13:46",
        numero: "0013",
        id_boleto: "123456"
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