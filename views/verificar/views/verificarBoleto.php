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
        Verificar Boletos xd
    </div>
    <form class="verificar-form" method="post" id="verificarForm">
        <input class="input-boleto" type="text" name="id_rifa" placeholder="Ingresa el ID de la rifa" required>
        <input class="input-boleto" type="text" name="numero_boleto" placeholder="Ingresa el número de boleto (opcional)">
        <button class="btn-verificar" type="submit">Verificar</button>
    </form>

    <div id="boletoContainer"></div>
</div>

<script src="/assets/js/boletosTicket.js"></script>
<script>
    // Mostrar el boleto de ejemplo al cargar la página
    window.addEventListener('DOMContentLoaded', function() {
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
    });

    document.getElementById('verificarForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const idRifa = document.querySelector('input[name="id_rifa"]').value.trim();
        const numeroBoleto = document.querySelector('input[name="numero_boleto"]').value.trim();
        const container = document.getElementById('boletoContainer');
        container.innerHTML = "Buscando...";

        let url = `/api/get_tickets?id_rifa=${encodeURIComponent(idRifa)}`;
        if (numeroBoleto) url += `&numero_boleto=${encodeURIComponent(numeroBoleto)}`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            // Log para depuración
            console.log("Respuesta de la API:", data);

            // Si no hay datos reales, muestra el boleto de ejemplo y un mensaje
            if (!data.success || !data.data || data.data.length === 0) {
                console.log("No llegaron datos reales desde la API, mostrando boleto de ejemplo.");
                container.innerHTML = `
                    <div style="color:red; margin-bottom:10px;">
                        No se encontraron datos reales.<br>
                        <b>Mostrando un boleto de ejemplo.</b>
                    </div>
                `;
                // Generar datos aleatorios de ejemplo
                const ejemplos = [{
                        items: {
                            nombre: "Eiker Rodriguez Monzon",
                            telefono: "04135454355",
                            "Precio del boleto": "3$"
                        },
                        fecha_compra: "20/05/2025 14:30",
                        numero: "0013",
                        id_boleto: "987654"
                    },
                    {
                        items: {
                            nombre: "Victor Barreto",
                            telefono: "04243191605",
                            "Precio del boleto": "3$"
                        },
                        fecha_compra: "21/05/2025 09:15",
                        numero: "0025",
                        id_boleto: "654321"
                    }
                ];
                // Elegir uno aleatorio
                const ejemplo = ejemplos[Math.floor(Math.random() * ejemplos.length)];
                renderBoleto(ejemplo);

                // Mensaje adicional debajo del boleto
                const aviso = document.createElement('span');
                aviso.style.color = 'orange';
                aviso.style.display = 'block';
                aviso.style.textAlign = 'center';
                aviso.style.marginTop = '10px';
                aviso.innerHTML = '⚠️ Este boleto es solo un ejemplo. No se recibieron datos reales del servidor.';
                container.appendChild(aviso);
                return;
            }

            // Si buscas un boleto específico, muestra solo el primero
            const boleto = numeroBoleto ? data.data[0] : null;

            if (boleto) {
                const datosBoleto = {
                    items: {
                        nombre: (boleto.nombre || '') + ' ' + (boleto.apellido || ''),
                        telefono: boleto.telefono || '',
                        "Precio del boleto": boleto.precio_boleto ? boleto.precio_boleto + '$' : ''
                    },
                    fecha_compra: boleto.fecha_compra || 'No disponible',
                    numero: boleto.numero_boleto,
                    id_boleto: boleto.id_boleto
                };
                container.innerHTML = "";
                renderBoleto(datosBoleto);
            } else if (data.data && data.data.length > 0) {
                // Si buscas todos los boletos de la rifa, puedes listarlos aquí
                container.innerHTML = data.data.map(boleto => `
                    <div>${boleto.numero_boleto} - ${boleto.estado_boleto}</div>
                `).join('');
            }
        } catch (err) {
            container.innerHTML = '<div style="color:red;">Error de conexión con el servidor.</div>';
        }
    });
</script>