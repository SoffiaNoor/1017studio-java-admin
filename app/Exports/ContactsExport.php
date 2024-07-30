<?php
namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ContactsExport implements FromCollection, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        // Select only the columns you want to include in the export
        return Contact::select('name', 'subject', 'handphone', 'email', 'message', 'created_at', 'updated_at')
            ->get()
            ->map(function ($contact) {
                return [
                    'name' => $contact->name,
                    'subject' => $contact->subject,
                    'handphone' => $contact->handphone,
                    'email' => $contact->email,
                    'message' => $contact->message,
                    'created_at' => $contact->created_at->format('Y-m-d'),
                    'updated_at' => $contact->updated_at->format('Y-m-d'),
                ];
            });
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