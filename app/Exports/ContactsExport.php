<?php
namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Select only the columns you want to include in the export
        return Contact::select('name', 'subject', 'handphone', 'email', 'message', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Subject',
            'Handphone',
            'Email',
            'Message',
            'Created At',
            'Updated At'
        ];
    }
}
