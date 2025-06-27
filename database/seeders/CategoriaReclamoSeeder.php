<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaReclamo;
use App\Models\TipoReclamo;

class CategoriaReclamoSeeder extends Seeder
{
    public function run(): void
    {
        $datos = [
            'Producto' => [
                'Producto defectuoso',
                'Producto dañado en la entrega',
                'Producto diferente al solicitado',
                'Faltante en el pedido',
                'Error en las especificaciones del producto',
                'Garantía no válida o rechazada',
            ],
            'Envío / Entrega' => [
                'Demora en la entrega',
                'Envío a dirección incorrecta',
                'Pedido no entregado',
                'Mal embalaje',
            ],
            'Pagos' => [
                'Cobro duplicado',
                'Error al procesar el pago',
                'No se refleja el pago',
                'Problema con el reintegro',
                'Problema con la factura',
            ],
            'Devoluciones / Cambios' => [
                'Solicitud de devolución no procesada',
                'Producto devuelto y no reembolsado',
                'Cambio no aceptado sin motivo válido',
            ],
            'Carrito / Compra' => [
                'Problemas al añadir productos al carrito',
                'Error al finalizar la compra',
                'No se genera el comprobante',
                'Cupones o descuentos no aplican',
            ],
            'Atención al cliente' => [
                'Mala atención',
                'No responden consultas',
                'Tiempo de espera excesivo',
                'Respuestas no satisfactorias',
            ],
            'Otros' => [
                'Sugerencias de mejora',
                'Quejas generales',
                'Reclamos sin categoría específica',
            ]
        ];

        foreach ($datos as $categoria => $tipos) {
            $cat = CategoriaReclamo::create(['nombre' => $categoria]);
            foreach ($tipos as $tipo) {
                TipoReclamo::create([
                    'nombre' => $tipo,
                    'categoria_reclamo_id' => $cat->id
                ]);
            }
        }
    }
}
