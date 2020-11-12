<?php

namespace App\Exports;


use App\Entities\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, ShouldQueue
{

    use Exportable;

    /**
    * @return Collection
    */
    public function collection()
    {
        return Product::all();
    }

    /**
     * @var $product
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->ean,
            $product->name,
            $product->branch,
            $product->description,
            $product->category_id,
            $product->price,
            $product->stock,
            Date::dateTimeToExcel($product->published_at)
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'EAN',
            'NOMBRE',
            'MARCA',
            'DESCRIPCION',
            'ID_CATEGORIA',
            'PRECIO',
            'STOCK',
            'FECHA_PUBLICACION',
        ];
    }
}