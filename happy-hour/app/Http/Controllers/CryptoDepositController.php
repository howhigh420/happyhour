<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use App\Models\Asset;
  use App\Models\Transaction;
  use BitWasp\Bitcoin\Key\HierarchicalKeyFactory;
  use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39SeedGenerator;
  use BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
  use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
  use BitWasp\Bitcoin\Network\NetworkFactory;

  class CryptoDepositController extends Controller
  {
      public function showCryptoDepositForm()
      {
          $assets = Asset::where('symbol', '!=', 'USD')->get();
          return view('deposit.crypto', compact('assets'));
      }

      public function generateCryptoAddress(Request $request)
      {
          $request->validate(['asset' => 'required|exists:assets,id']);
          $asset = Asset::find($request->input('asset'));
          $user = Auth::user();

          if ($asset->symbol !== 'BTC') {
              return redirect()->back()->with('error', 'Only BTC deposits are supported.');
          }

          // Generate a new Bitcoin address
          $mnemonic = env('BITCOIN_MNEMONIC');
          $seedGenerator = new Bip39SeedGenerator();
          $seed = $seedGenerator->getSeed($mnemonic);
          $hdFactory = new HierarchicalKeyFactory();
          $master = $hdFactory->fromEntropy($seed);

          // Derive a new address (e.g., BIP-44 path m/44'/0'/0'/0/n)
          $index = Transaction::where('user_id', $user->id)->where('asset_id', $asset->id)->count();
          $path = "m/44'/0'/0'/0/$index";
          $child = $master->derivePath($path);
          $address = new PayToPubKeyHashAddress($child->getPublicKey());
          $bitcoinAddress = $address->getAddress(NetworkFactory::bitcoin());

          // Record the transaction
          Transaction::create([
              'user_id' => $user->id,
              'type' => 'deposit',
              'asset_id' => $asset->id,
              'amount' => null, // Amount updated via webhook
              'status' => 'pending',
              'address' => $bitcoinAddress,
          ]);

          return redirect()->back()->with('address', $bitcoinAddress)->with('success', 'Bitcoin deposit address generated! Share securely via Signal.');
      }

      public function handleWebhook(Request $request)
        {
            $data = $request->all();
            if (isset($data['data']['address']) && isset($data['data']['value'])) {
                $address = $data['data']['address'];
                $amount = $data['data']['value'] / 1e8; // Convert satoshis to BTC
                $transaction = Transaction::where('address', $address)->where('status', 'pending')->first();
                if ($transaction) {
                    $transaction->update(['status' => 'completed', 'amount' => $amount]);
                    Balance::where('user_id', $transaction->user_id)
                        ->where('asset_id', $transaction->asset_id)
                        ->increment('amount', $amount);
                }
            }
            return response()->json(['status' => 'received']);
        }
  }