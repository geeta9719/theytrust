<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Invoice</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    @page { margin: 28mm 18mm; }
    body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; color: #111; }
    .flex { display: flex; justify-content: space-between; align-items: flex-start; }
    .mt-4 { margin-top: 16px; } .mt-6 { margin-top: 24px; } .mt-8 { margin-top: 32px; }
    .mb-2 { margin-bottom: 8px; } .mb-4 { margin-bottom: 16px; } .text-right { text-align:right; }
    .text-center { text-align:center; } .muted { color: #555; }
    .badge { display:inline-block; padding: 3px 8px; border-radius: 6px; font-size: 11px; }
    .badge.succeeded { background:#e9f9ee; color:#137333; border:1px solid #b8efc7; }
    .badge.canceled { background:#fff2f2; color:#b3261e; border:1px solid #ffd6d6; }
    .badge.payment_failed { background:#fff7e6; color:#8a5300; border:1px solid #ffe0a3; }
    .table { width:100%; border-collapse: collapse; }
    .table th, .table td { border:1px solid #e6e6e6; padding:10px; }
    .table th { background:#fafafa; text-align:left; }
    .totals { width: 300px; margin-left: auto; border-collapse: collapse; }
    .totals td { padding:8px; }
    .totals tr td:first-child { color:#555; }
    hr { border:0; border-top:1px solid #eee; margin:18px 0; }
    .small { font-size: 11px; }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="flex">
    <div>
      <img src="https://theytrust.us/front_components/images/logo.png" alt="TheyTrustUs" style="height:50px;">
      <div class="muted small mt-4">
        TheyTrustUs<br/>
        support@theytrust.us<br/>
        https://theytrust.us
      </div>
    </div>
    <div style="text-align:right;">
      <h2 style="margin:0;">INVOICE</h2>
      <div class="muted small">Invoice #: <strong>{{ $invoice['number'] }}</strong></div>
      <div class="muted small">Date: <strong>{{ $invoice['date'] }}</strong></div>
      @if(!empty($invoice['status']))
        <div class="mt-4">
          <span class="badge {{ $invoice['status'] }}">{{ strtoupper(str_replace('_',' ',$invoice['status'])) }}</span>
        </div>
      @endif
    </div>
  </div>

  <!-- Bill To / Meta -->
  <div class="flex mt-6">
    <div>
      <strong>Bill To</strong>
      <div class="mt-2">
        {{ $user->name ?? 'Customer' }}<br/>
        {{ $user->email }}<br/>
        @if(!empty($user->phone)) {{ $user->phone }}<br/> @endif
      </div>
    </div>
    <div class="text-right">
      <div class="muted small">Payment Method: <strong>{{ $invoice['payment_method'] ?? 'Stripe' }}</strong></div>
      <div class="muted small">Currency: <strong>{{ $invoice['currency'] }}</strong></div>
      @if(!empty($invoice['tx_id']))
        <div class="muted small">Txn ID: <strong>{{ $invoice['tx_id'] }}</strong></div>
      @endif
    </div>
  </div>

  <!-- Line Items -->
  <div class="mt-8">
    <table class="table">
      <thead>
        <tr>
          <th style="width:45%;">Item</th>
          <th style="width:20%;">Plan</th>
          <th style="width:15%;">Qty</th>
          <th style="width:20%;">Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            {{ $invoice['item_title'] }}
            @if(!empty($invoice['item_desc']))
              <div class="muted small">{{ $invoice['item_desc'] }}</div>
            @endif
          </td>
          <td>{{ $invoice['plan_name'] }}</td>
          <td>1</td>
          <td>
            {{ $invoice['currency_symbol'] }}{{ number_format($invoice['amount'], 2) }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Totals -->
  <table class="totals mt-6">
    <tr>
      <td>Subtotal</td>
      <td class="text-right">{{ $invoice['currency_symbol'] }}{{ number_format($invoice['amount'], 2) }}</td>
    </tr>
    @if(!empty($invoice['discount']) && $invoice['discount']>0)
      <tr>
        <td>Discount</td>
        <td class="text-right">- {{ $invoice['currency_symbol'] }}{{ number_format($invoice['discount'], 2) }}</td>
      </tr>
    @endif
    @if(!empty($invoice['tax']) && $invoice['tax']>0)
      <tr>
        <td>Tax</td>
        <td class="text-right">{{ $invoice['currency_symbol'] }}{{ number_format($invoice['tax'], 2) }}</td>
      </tr>
    @endif
    <tr>
      <td><strong>Total</strong></td>
      <td class="text-right"><strong>{{ $invoice['currency_symbol'] }}{{ number_format($invoice['total'], 2) }}</strong></td>
    </tr>
  </table>

  <hr/>

  <div class="small">
    <strong>Notes</strong><br/>
    Thank you for your purchase. This is a computer generated invoice and does not require a signature.
  </div>

  <div class="small text-center mt-6 muted">
    © {{ date('Y') }} TheyTrustUs — https://theytrust.us
  </div>
</body>
</html>
