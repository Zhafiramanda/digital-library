<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $category_id;

    public function __construct($category_id)
    {
        $this->category_id = $category_id;
    }

    public function query()
    {
        $query = Book::query();

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Author',
            'Description',
            'Category ID',
            'Quantity',
            'Created At',
            'Updated At',
        ];
    }
}

