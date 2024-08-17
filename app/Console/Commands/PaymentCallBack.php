<?php

namespace App\Console\Commands;

use Paypack\Paypack;
use App\Models\MutualPayment;
use Illuminate\Console\Command;
use App\Events\AdmissionPayment;
use App\Models\PaypackTransaction;

class PaymentCallBack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-call-back';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Payment Call back';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paypack = new Paypack();
        $paypack->config([
            'client_id' => env('PAYPACK_CLIENT_ID'),
            'client_secret' => env('PAYPACK_CLIENT_SECRET'),
        ]);

        $transactions = PaypackTransaction::where('status', 'pending')->get();

        foreach ($transactions as $item) {

            # code...
            $transaction = $paypack->Events(['ref' => $item->ref]);
            $status = $transaction['transactions'][0]['data']['status'];
            if ($status == 'successful') {

                if ($item->type == 'mutual') {
                    MutualPayment::create([
                        'family_header_id' => $item->family_id,
                        'year' => '2024 - 2025',
                        'amount' => $item->amount,
                    ]);

                } else {
                    broadcast(new AdmissionPayment($item->patient));
                }
                $item->update(['status' => 'complete']);
            }


        }
        $this->info('Payment checked');
    }
}
