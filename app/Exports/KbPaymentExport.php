<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class KbPaymentExport implements FromCollection, ShouldAutoSize, WithColumnFormatting // WithHeadings,
{
    private $payment_id = null;

    // private $headings =
    // [
    //     'Client_Code',
    //     'Product_Code',
    //     'Payment_Type',
    //     'Payment_Ref_No.',
    //     'Payment_Date',
    //     'Instrument Date',
    //     'Dr_Ac_No',
    //     'Amount',
    //     'Bank_Code_Indicator',
    //     'Beneficiary_Code',
    //     'Beneficiary_Name',
    //     'Beneficiary_Bank',
    //     'Beneficiary_Branch / IFSC Code',
    //     'Beneficiary_Acc_No',
    //     'Location',
    //     'Print_Location',
    //     'Instrument_Number',
    //     'Ben_Add1',
    //     'Ben_Add2',
    //     'Ben_Add3',
    //     'Ben_Add4',
    //     'Beneficiary_Email',
    //     'Beneficiary_Mobile',
    //     'Debit_Narration',
    //     'Credit_Narration',
    //     'Payment Details 1',
    //     'Payment Details 2',
    //     'Payment Details 3',
    //     'Payment Details 4',
    //     'Enrichment_1',
    //     'Enrichment_2',
    //     'Enrichment_3',
    //     'Enrichment_4',
    //     'Enrichment_5',
    //     'Enrichment_6',
    //     'Enrichment_7',
    //     'Enrichment_8',
    //     'Enrichment_9',
    //     'Enrichment_10',
    //     'Enrichment_11',
    //     'Enrichment_12',
    //     'Enrichment_13',
    //     'Enrichment_14',
    //     'Enrichment_15',
    //     'Enrichment_16',
    //     'Enrichment_17',
    //     'Enrichment_18',
    //     'Enrichment_19',
    //     'Enrichment_20',
    // ];


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
        $dr_ac_no = '';
        if ($payment->status == 'paid_kb') {
            $dr_ac_no = "2448808057";
        } elseif ($payment->status == 'paid_kb_main') {
            $dr_ac_no = "8100370005";
        }

        foreach ($payment->transactions as $transaction) {

            $payment_type = 'NEFT';
            $ifsc_code = $transaction->account->ifsc_code;

            if (Str::startsWith(Str::lower($transaction->account->bank_name), 'kotak')) {
                $payment_type = 'IFT';
                $ifsc_code = 'KKBK0000958';
            }

            $temp_array[0] = "ARIMACMS";        // 'Client_Code',	Client_Code',
            $temp_array[1] = "VPAY";            //	Product_Code',
            $temp_array[2] = $payment_type;     //	Payment_Type',
            $temp_array[3] = "";                //	Payment_Ref_No.',
            $temp_array[4] = $payment_date;     //	Payment_Date',
            $temp_array[5] = '';                //	Instrument Date',
            $temp_array[6] = $dr_ac_no;      //	Dr_Ac_No',
            $temp_array[7] = $transaction->amount;  //	Amount',
            $temp_array[8] = 'M';               //	Bank_Code_Indicator',
            $temp_array[9] = '';                //	Beneficiary_Code',
            $temp_array[10] = $transaction->account->account_name;           //	Beneficiary_Name',
            $temp_array[11] = '';               //	Beneficiary_Bank',
            $temp_array[12] = $ifsc_code;       //	Beneficiary_Branch / IFSC Code',
            $temp_array[13] = $transaction->account->account_number;    //	Beneficiary_Acc_No',
            $temp_array[14] = '';           //	Location',
            $temp_array[15] = '';           //	Print_Location',
            $temp_array[16] = '';           //	Instrument_Number',
            $temp_array[17] = '';           //	Ben_Add1',
            $temp_array[18] = '';           //	Ben_Add2',
            $temp_array[19] = '';           //	Ben_Add3',
            $temp_array[20] = '';           //	Ben_Add4',
            $temp_array[21] = '';           //	Beneficiary_Email',
            $temp_array[22] = '';           //	Beneficiary_Mobile',
            $temp_array[23] = '';           //	Debit_Narration',
            $temp_array[24] = '';           //	Credit_Narration',
            $temp_array[25] = '';           //	Payment Details 1',
            $temp_array[26] = '';           //	Payment Details 2',
            $temp_array[27] = '';           //	Payment Details 3',
            $temp_array[28] = '';           //	Payment Details 4',
            $temp_array[29] = '';           //	Enrichment_1',
            $temp_array[30] = '';           //	Enrichment_2',
            $temp_array[31] = '';           //	Enrichment_3',
            $temp_array[32] = '';           //	Enrichment_4',
            $temp_array[33] = '';           //	Enrichment_5',
            $temp_array[34] = '';           //	Enrichment_6',
            $temp_array[35] = '';           //	Enrichment_7',
            $temp_array[36] = '';           //	Enrichment_8',
            $temp_array[37] = '';           //	Enrichment_9',
            $temp_array[38] = '';           //	Enrichment_10',
            $temp_array[39] = '';           //	Enrichment_11',
            $temp_array[40] = '';           //	Enrichment_12',
            $temp_array[41] = '';           //	Enrichment_13',
            $temp_array[42] = '';           //	Enrichment_14',
            $temp_array[43] = '';           //	Enrichment_15',
            $temp_array[44] = '';           //	Enrichment_16',
            $temp_array[45] = '';           //	Enrichment_17',
            $temp_array[46] = '';           //	Enrichment_18',
            $temp_array[47] = '';           //	Enrichment_19',
            $temp_array[48] = '';           //	Enrichment_20',

            $data_array[] = $temp_array;
        }

        return collect($data_array);
    }

    public function columnFormats(): array
    {
        return [
            'N' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
