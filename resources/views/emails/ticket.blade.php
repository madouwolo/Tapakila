<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0">

                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">
                        <table class="inner-body" align="center" width="100%" cellpadding="0" cellspacing="0" style="margin-right: ">

                            <tr>
                                <td class="content-cell">
                                    <div style="background-color: white; margin-top: 30px; padding: 20px 25px 20px 25px;">
                                        <img class="logoactivate" src="{{url('/')}}/public/img/logo.png"
                                             title="Leguichet">
                                        <hr class="border-logo">
                                        <h2>
                                            <b style="color:#333;margin-top: 20px; margin-bottom: 10px;font-size: 30px;word-wrap: break-word;font-weight: 700;">Merci {{$user->name}}
                                                , Voici vos billets!</b></h2>
                                        <p style="font-size: 14px;color:#333;">Lorsque vous participez, utiliser le qr
                                            code (image) ci-dessus</p><br/><br/>
                                        <h4>
                                            <b style=" color:#333;margin-top: 20px; margin-bottom: 10px;font-size: 30px;word-wrap: break-word;font-weight: 700;">Vos
                                                évènements</b></h4>
                                        @foreach($tic as $ticket)
                                            @php
                                                $event = $ticket->events[0];
                                            @endphp
                                            <p style="font-size: 14px;color:#333;">
                                                <strong>{{$event->title}}
                                                    le {{ \Carbon\Carbon::parse($event->date_debut_envent)->format('d M Y')}}</strong>
                                            </p>
                                            <p style="font-size: 14px;color:#333;">
                                                Localisation: {{$event->localisation_nom}}
                                                {{$event->localisation_adresse}}
                                            </p>
                                            <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
                                                @if(count($tap)<=3)
                                                    <tr>
                                                        @foreach($tap as $tapakila)
                                                            <td>
                                                                <p style="text-align: center; margin: 5px 0; ">{{$ticket->type}}</p>
                                                                <p style="text-align: center">
                                                                    <img src="{{url('/public/qr_code/'.$tapakila->qr_code)}}"
                                                                         class="qt">
                                                                </p>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @else
                                                    @php($i=0)
                                                    @foreach($tap as $tapakila)
                                                        @if($i%3 == 0)
                                                            @if($i==0)
                                                                <tr>
                                                                    <td>
                                                                        <p style="text-align: center; margin: 5px 0; ">{{$ticket->type}}</p>
                                                                        <p style="text-align: center">
                                                                            <img src="{{url('/public/qr_code/'.$tapakila->qr_code)}}"
                                                                                 class="qt">
                                                                        </p>
                                                                    </td>
                                                                    @else
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <p style="text-align: center; margin: 5px 0; ">{{$ticket->type}}</p>
                                                                        <p style="text-align: center">
                                                                            <img src="{{url('/public/qr_code/'.$tapakila->qr_code)}}"
                                                                                 class="qt">
                                                                        </p>
                                                                    </td>
                                                                    @endif
                                                                    @else
                                                                        <td>
                                                                            <p style="text-align: center; margin: 5px 0; ">{{$ticket->type}}</p>
                                                                            <p style="text-align: center">
                                                                                <img src="{{url('/public/qr_code/'.$tapakila->qr_code)}}"
                                                                                     class="qt">
                                                                            </p>
                                                                        </td>
                                                                    @endif
                                                                    @if($i==count($tap))
                                                                </tr>
                                                            @endif
                                                            @php($i++)
                                                            @endforeach
                                                        @endif
                                            </table>
                                        @endforeach
                                        <br>
                                        <p style="font-size: 14px;color:#333;text-align: center;background-color: #cccccc; margin-top: 25px; padding: 15px;  margin-bottom: 20px;  border: 1px solid transparent; border-radius: 4px;">
                                            Vous avez des question? consultez notre <a
                                                    style="text-decoration: none;color: #62b2eb;"
                                                    href="{{url('')}}/tapakila/faq">FAQ</a> dès maintenant</p>
                                        <p style="text-align: center">L'équipe Leguichet.mg</p>
                                    </div>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
