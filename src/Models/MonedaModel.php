<?php

namespace App\Models;

use App\config\Conexion;
use Exception;

class MonedaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Conexion();
    }

    public function getPrecioActual(string $moneda)
    {
        try {
            $sql = "SELECT * FROM moneda_actual WHERE moneda = :moneda";
            $stmt = $this->db->consultar(
                $sql,
                [':moneda' => $moneda]
            );

            return [
                "data" => [
                    "moneda" => $stmt[0]['moneda'],
                    "precio" => $stmt[0]['precio'],
                    "ultima_actualizacion" => $stmt[0]['ultima_actualizacion'],
                            ],
                "message" => "Precios actuales obtenidos exitosamente."
            ];
        } catch (Exception $e) {
            // Log del error (opcional)
            throw new Exception("Error al obtener los datos de moneda: " . $e->getMessage());
        }
    }

    public function actualizarPrecio(string $moneda, float $precio): bool
    {
        try {

            $sql1 = "UPDATE moneda_actual SET precio = :precio, ultima_actualizacion = NOW() WHERE moneda_actual.moneda = :moneda";
            $this->db->ejecutar(
                $sql1,
                [
                    ':moneda' => $moneda,
                    ':precio' => $precio
                ]
            );

            $sql = "INSERT INTO historico_precio_moneda (moneda, precio) VALUES (:moneda, :precio) ON DUPLICATE KEY UPDATE precio = VALUES(precio), fecha_hora = NOW()";
            $this->db->ejecutar(
                $sql,
                [
                    ':moneda' => $moneda,
                    ':precio' => $precio
                ]
            );

            return true;
        } catch (Exception $e) {
            // Log del error (opcional)
            throw new Exception("Error al actualizar montos: " . $e->getMessage());
        }
    }

    // Puedes agregar más métodos si necesitas interactuar con la tabla de otras formas
}
