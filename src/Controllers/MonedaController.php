<?php

namespace App\Controllers;

use App\Models\MonedaModel;
use Exception;

class MonedaController
{
    private $monedaModel;

    public function __construct()
    {
        $this->monedaModel = new MonedaModel();
    }

    public function mostrarPrecioActual(string $moneda = '')
    {

        if ($moneda == '') {
            $precioDataCOP = $this->monedaModel->getPrecioActual('COP');
            $precioDataVES = $this->monedaModel->getPrecioActual('VES');
            if ($precioDataVES && $precioDataCOP) {
                // Formatear la salida como necesites (HTML, JSON, etc.)
                echo json_encode([
                    "success" => true,
                    "data" => [
                       "COP" => $precioDataCOP["data"],
                       "VES" => $precioDataVES["data"]
                    ]
                ]);
            } else {
                echo "No se pudo obtener el precio actual para {$moneda}.";
            }
            exit;
        }

        $precioData = $this->monedaModel->getPrecioActual($moneda);

        if ($precioData) {
            // Formatear la salida como necesites (HTML, JSON, etc.)
            echo json_encode([
                "success" => true,
                "moneda" => $precioData["data"]['moneda'],
                "precio" => number_format($precioData["data"]['precio'], 2),
                "Última actualización" => $precioData["data"]['ultima_actualizacion']
            ]);
        } else {
            echo "No se pudo obtener el precio actual para {$moneda}.";
        }
    }

    public function actualizarPrecio(array $moneda, array $monto)
    {

        try {
            foreach ($moneda as $key => $value) {
                $this->monedaModel->actualizarPrecio($value, $monto[$key]);
            }
            return [
                "success" => true,
                "msj" => "precio actualizado correctamente"
            ];
        } catch (Exception $e) {
            throw new Exception("Error al actualizar los datos de moneda: " . $e->getMessage());
        }
    }

    // Puedes agregar un método para la actualización desde la API aquí o en otro controlador
}
