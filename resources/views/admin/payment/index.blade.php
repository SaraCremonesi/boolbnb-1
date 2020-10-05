@extends('layouts.app')

@section('content')
  {{-- !isset($time_ending) ||  --}}
  @if ($end_date < $now || $end_date == false)

    <!-- Payment simulation -->
    <section>
      <div class="container">

        <h1>Scegli il piano di sponsorizzazione del tuo appartamento</h1>

          {{--       Inizio form         --}}
          <form method="post" id="payment-form" autocomplete="off" action="{{ route('admin.payment.checkout', $apartment) }}">
          @csrf
          @method('POST')

            <!-- select promo -->
            <label>Seleziona la sponsorizzazione</label><br>
            <select id="sponsorship_select" name="sponsorship_select" class="form-control">
              <option>Seleziona la sponsorizzazione</option>
              @foreach ($sponsorships as $sponsorship)
                  <option data-price="{{ $sponsorship->price }}" value="{{ $sponsorship->id }}">{{ $sponsorship->name }}</option>
              @endforeach
            </select>
            <!-- select promo -->

            <!-- select promo -->
            <label for="amount">
                <span>Prezzo</span>
                <div>
                    <input id="amount" name="amount" type="tel" min="1" value="" readonly>
                </div>
            </label>
            <!-- select promo -->

            <div class="container">
                <div id="dropin"></div>
            </div>

            <div>
              <input id="nonce" name="payment_method_nonce" type="hidden" />
              <button class="btn btn-success" type="submit"><span>Paga ora</span></button>
            </div>

          </form>

          @foreach($sponsorships as $sponsorship)
            <h2>{{$sponsorship->name}}</h2>
            <p>Metti in evidenza il tuo appartamento per {{$sponsorship->duration}} ore</p>
          @endforeach

      </div>
    @endif

  <script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";

    braintree.dropin.create({
        authorization: client_token,
        selector: '#dropin',

    }, function (createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
  </script>
@endsection