<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Balance;
    use App\Models\Transaction;
    use Srmklive\PayPal\Services\PayPal as PayPalClient;

    class DepositController extends Controller
    {
        public function showFiatDepositForm()
        {
            return view('deposit.fiat');
        }

        public function processFiatDeposit(Request $request)
        {
            $request->validate(['amount' => 'required|numeric|min:1']);
            $amount = $request->input('amount');
            $user = Auth::user();

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $order = $provider->createOrder([
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($amount, 2, '.', '')
                        ]
                    ]
                ],
                "application_context" => [
                    "return_url" => route('deposit.fiat.success'),
                    "cancel_url" => route('deposit.fiat.cancel')
                ]
            ]);

            if (isset($order['id'])) {
                $redirectUrl = collect($order['links'])->firstWhere('rel', 'approve')['href'];
                return redirect()->away($redirectUrl);
            }

            return redirect()->back()->with('error', 'PayPal payment creation failed.');
        }

        public function successFiatDeposit(Request $request)
        {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                $user = Auth::user();

                Balance::updateOrCreate(
                    ['user_id' => $user->id, 'asset_id' => 1], // 1 = USD
                    ['amount' => \DB::raw("amount + $amount")]
                );
                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'deposit',
                    'asset_id' => 1,
                    'amount' => $amount,
                    'status' => 'completed',
                ]);

                return redirect()->route('deposit.fiat.form')->with('success', 'Fiat deposit completed!');
            }

            return redirect()->route('deposit.fiat.form')->with('error', 'Payment failed.');
        }

        public function cancelFiatDeposit()
        {
            return redirect()->route('deposit.fiat.form')->with('error', 'Payment cancelled.');
        }
    }