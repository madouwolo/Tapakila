@extends('template')

@section('content')
    <div class="container custom-container">
        <div class=" hier1">
            <div class="row ">
                <div class="col-lg-7 ">
                    <div class="thumbnail det-picture">
                        <img src="{{url('/')}}/public/img/{{$event->image}}" class="image_detail">
                    </div>
                </div>
                <div class="col-lg-5">
                    <h3 class="couleur_mot">{{$event->title}}</h3>
                    <p style="text-align: justify;padding-right: 10px;">{{$event->additional_note}}</p>
                    <div class="div_style">
                        <i class="fa fa-product-hunt fa-2x zav" aria-hidden="true"></i><strong id="programme"
                                                                                               class="couleur_mot">
                            Programme : </strong>{{$event->additional_note_time}}
                    </div>
                    <div class="div_style">
                        <i class="fa fa-map-marker fa-2x loc zav" aria-hidden="true"></i><strong id="localisation"
                                                                                                 class="couleur_mot">
                            Localisation : </strong> {{$event->localisation_nom }} {{$event->localisation_adresse}}
                    </div>
                    <div class="div_style">
                        <i class="fa fa-calendar-o fa-2x  zav" aria-hidden="true"></i><strong id="date"
                                                                                              class="couleur_mot">
                            Date : </strong> {{ \Carbon\Carbon::parse($event->date_debut_envent)->format('d M Y')}}
                    </div>
                    <div class="div_style">
                        <i class="fa fa-clock-o fa-2x zav" aria-hidden="true"></i><strong id="heure"
                                                                                          class="couleur_mot">
                            Heure :</strong> {{ \Carbon\Carbon::parse($event->date_debut_envent)->format('H:i')}}
                    </div>
                    <div class="div_style">
                        <strong class="couleur_mot zav"> Partagez sur :</strong> <img
                                src="{{url('/')}}/public/img/facebook.png"
                                style="width: 22px;">
                    </div>
                </div>
            </div>

            <div class="men1">
                <ul class="nav nav-tabs tabl" role="tablist">

                    <li class=" active">
                        <a href="#date1" role="tab"
                           data-toggle="tab">{{\Carbon\Carbon::parse($event->date_debut_envent)->format('d M')}}</a>
                    </li>

                    {{--<li>
                        <a href="#date2" role="tab" data-toggle="tab">23 dec</a>
                    </li>

                    <li>
                        <a href="#date3" role="tab" data-toggle="tab">24 dec</a>
                    </li>

                    <li>
                        <a href="#date4" role="tab" data-toggle="tab">25 dec</a>
                    </li>--}}
                </ul>

                <section>
                    <div class="tab-content">
                        <div class="tab-pane tabulation  fade active in" id="date1">
                            <div class="table-responsive tableau_detail">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Type de ticket</th>
                                        <th>Disponiblité</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Totale</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <form action="{{ url('shopping/cart') }}" method="POST" class="side-by-side">
                                    @php $count_id_price = 0; @endphp
                                    <!-- prixunit1 -->
                                        @foreach($event->tickets as $ticket)
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="id[]" value="{{ $ticket->id }}">
                                            <input type="hidden" name="type[]" value="{{ $ticket->type }}">
                                            <input type="hidden" name="price[]" value="{{ $ticket->price }}">
                                            <tr>
                                                <td><strong>{{$ticket->type}}</strong>
                                                    <p>Description here</p>
                                                </td>
                                                <td><i class="fa fa-unlock fa-2x clock{{$count_id_price}}"
                                                       aria-hidden="true"></i>
                                                    <p id="tickets{{$count_id_price}}">{{$ticket->number}}</p> tickets
                                                </td>
                                                <td>
                                                    <div class="row postions">
                                                        <div class="col-md-4 col-md-offset-2  ">
                                                            <div class="input-group number-spinner{{$count_id_price}}">
                                                            <span class="input-group-btn">
																		<button class="btn btn-default btn-circle smoins"
                                                                                data-dir="dwn"
                                                                                id="btn-down{{$count_id_price}}"><span
                                                                                    class="fa fa-minus"></span></button>
                                                            </span>
                                                                <input class="form-control text-center ui" value="0"
                                                                       type="text" name="nombre[]">
                                                                <span class="input-group-btn">
																		<button type="button" class="btn btn-default btn-circle splus "
                                                                                data-dir="up"
                                                                                id="btn-up{{$count_id_price}}"><span
                                                                                    class="fa fa-plus"></span></button>
                                                            </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-md-offset-1"></div>
                                                    </div>
                                                </td>
                                                <td><b>{{(int)$ticket->price}}</b> Ar</td>
                                                <td><b id="prixUnit{{$count_id_price}}">0</b> Ar</td>
                                            </tr>
                                            @php $count_id_price++; @endphp
                                        @endforeach

                                        <tr>
                                            <td class="td_detail"></td>
                                            <td class="td_detail"></td>
                                            <td class="td_detail"></td>
                                            <td><strong>Total</strong></td>
                                            <td><b id="total">0</b> Ar</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type="submit" class=" btn btn-danger btn_reset">Reset</button>
                                            </td>
                                            <td>
                                                <button type="submit" class=" btn btn-success btn_acheterr">Acheter
                                                </button>
                                            </td>
                                        </tr>
                                        <input type="hidden" id="nombre_id" value="{{$count_id_price}}"/>
                                    </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="categoriesport">
            <h2 class="couleur_mot">Voir aussi</h2>
            <div class="row">
                @php $count_id = 0 @endphp
                @foreach($interested as $ev)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail"
                             onmouseover="mouseover('month{{$count_id}}','title{{$count_id}}')"
                             onmouseleave="mouseleave('month{{$count_id}}','title{{$count_id}}')">
                            <a href="{{url('events/show',[$ev->id])}}">
                                <div class="mg-image">
                                    <img src="{{ url('/public/img/'.$ev->image.'') }}">
                                </div>
                            </a>
                            <div class="caption taille">
                                <a href="{{url('events/show',[$ev->id])}}">
                                    <div class="limitelengh">
                                        <h3>
                                            <a href="{{url('events/show',[$ev->id])}}"
                                               id="title{{$count_id}}">{{str_limit($ev->title,$limit=60, $end = ' ...')}}</a>
                                        </h3>
                                    </div>
                                    <div class="limite">
                                        <a href="#"><p
                                                    style="text-align: justify">{{ str_limit(ucfirst($ev->additional_note), $limit = 100, $end = ' ...') }}</p>
                                        </a><br/>
                                    </div>
                                    <div class="row cbg">
                                        <div class="col-md-3 col-xs-3">
                                            <div class="calendar">
                                                <h1 class="month"
                                                    id="month{{$count_id}}">{{ \Carbon\Carbon::parse($ev->date_debut_envent)->format('M')}}</h1>
                                                <label class="jour">{{ \Carbon\Carbon::parse($ev->date_debut_envent)->format('D')}}</label>
                                                <p class="day">{{ \Carbon\Carbon::parse($ev->date_debut_envent)->format('d')}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-xs-9 ">
                                            <a>
                                                <div class="prixfx">
                                                    @if($ev->tickets()->count() > 0)
                                                        <i class="fa fa-tag prices"></i>A partir de
                                                        <b class="prx">{{ (int) $ev->tickets()->orderBy('price','asc')->take(1)->get()[0]->price  }}</b>
                                                        AR
                                                    @else
                                                        <i class="fa fa-tag prices"></i>Non
                                                        disponible
                                                    @endif
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="price"><i
                                                            class="glyphicon glyphicon-time time"></i>{{ \Carbon\Carbon::parse($ev->date_debut_envent)->format('H:i')}}
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="date"><i
                                                            class="glyphicon glyphicon-map-marker position"></i>{{ $ev->localisation_adresse }}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php $count_id++ @endphp
                @endforeach
            </div>
        </div>
    </div>
    <h3>{{$event->tickets()->count()}}</h3>
@endsection

@section('specificScript')
    <script type="text/javascript">
        function mouseover(element, title) {
            $('#' + title + '').css('color', '#d70506');
            $('#' + element + '').css('background', '#d70506');
        }
        function mouseleave(element, title) {
            $('#' + title + '').css('color', '#000');
            $('#' + element + '').css('background', '#5cb85c');
        }
    </script>
    <script>
        var newticket = new Array();
    </script>
    @for($i=0;$i<$event->tickets()->count();$i++)
        <script>
            newticket[[{{$i}}]] = {{$event->tickets[$i]->number}};
            $(document).on('click', '.number-spinner{{$i}} button', function () {
                var btn = $(this),
                    oldValue = btn.closest('.number-spinner{{$i}}').find('input').val().trim(),
                    newVal = 0;
                if (btn.attr('data-dir') == 'up') {
                    if (oldValue < {{$event->tickets[$i]->number}}) {
                        newVal = parseInt(oldValue) + 1;
                        var prixUnit1 = {{$event->tickets[$i]->price}} *
                        newVal;
                        newticket[{{$i}}] -= 1;
                        $('#tickets{{$i}}').html(newticket[{{$i}}]);
                        $('#prixUnit{{$i}}').html(0 + prixUnit1);

                        btn.closest('.number-spinner{{$i}}').find('input').val(newVal);
                        var total = 0;
                        for (var j = 0; j < $('#nombre_id').val(); j++) {
                            total += parseInt($('#prixUnit' + j).html());
                        }
                        $('#total').html(total);
                    } else if (oldValue == {{$event->tickets[$i]->number}}) {
                        $('#tickets{{$i}}').html('Epuisé');
                        $('.clock{{$i}}').removeClass('fa-unlock');
                        $('.clock{{$i}}').addClass('fa-lock');
                        $('#btn-up{{$i}}').attr('disabled', 'true');
                        var total = 0;
                        for (var j = 0; j < $('#nombre_id').val(); j++) {
                            total += parseInt($('#prixUnit' + j).html());
                        }
                        $('#total').html(total);
                    }

                } else {
                    if (oldValue > 0) {
                        newVal = parseInt(oldValue) - 1;
                        var prixUnit1 = {{$event->tickets[$i]->price}} *
                        newVal;
                        newticket[{{$i}}] += 1;
                        $('#prixUnit{{$i}}').html(0 + prixUnit1);
                        $('#tickets{{$i}}').html(newticket[{{$i}}]);
                        $('#btn-up{{$i}}').removeAttr('disabled');
                        $('.clock{{$i}}').removeClass('fa-lock');
                        $('.clock{{$i}}').addClass('fa-unlock');
                        btn.closest('.number-spinner{{$i}}').find('input').val(newVal);
                        var total = 0;
                        for (var j = 0; j < $('#nombre_id').val(); j++) {
                            total += parseInt($('#prixUnit' + j).html());
                        }
                        $('#total').html(total);
                    }
                }
            });
        </script>
    @endfor

@endsection