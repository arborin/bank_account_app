<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Str;

class IbPaymentExport implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithHeadings
{
    private $payment_id = null;

    private $headings =
    [
        'beneficiary name',
        'beneficiary account number',
        'IFSC code',
        'payment type: IFT/NEFT',
        'debit account number',
        'date',
        'amount',
        'transaction currency',
        'beneficiary email',
        'remarks',
    ];


    public function __construct($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $payment = Payment::findOrFail($this->payment_id);
        $payment_date = \Carbon\Carbon::parse($payment->date)->format('d/m/Y');
        $data_array = [];
        $data_array[] = array_fill(0, 9, '');
        foreach ($payment->transactions as $transaction) {

            $payment_type = 'NEFT';
            $ifsc_code = $transaction->account->ifsc_code;

            if (Str::startsWith(Str::lower($transaction->account->bank_name), 'idfc')) {
                $payment_type = 'IFT';
                $ifsc_code = '';
            }

            $temp_array[0] = $transaction->account->account_name;           // 'beneficiary name',
            $temp_array[1] = $transaction->account->account_number;         //	beneficiary account number',
            $temp_array[2] = $ifsc_code;            //	IFSC code',
            $temp_array[3] = $payment_type;         //	payment type: IFT/NEFT',
            $temp_array[4] = '10075410788';                    //	debit account number,
            $temp_array[5] = $payment_date;;        //	Instrument Date',
            $temp_array[6] = $transaction->amount;  //	Amount',
            $temp_array[7] = 'INR';                 //	transaction currency',
            $temp_array[8] = '';                    //	beneficiary email',
            $temp_array[9] = '';                    //	remarks',

            $data_array[] = $temp_array;
        }

        return collect($data_array);
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
