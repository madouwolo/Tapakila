@extends('template')
@section('title')
    <title>Le Guichet | Evénement {{$sous_menu_event->name}}</title>
    <meta name="description" content="Leguichet, vente des billets electroniques à Madagascar, des listes d'événements, musicaux, et de divertissement en direct, des guides, des petites annonces, des critiques, et plus encore.">
@endsection
@section('content')
    <section id="sectioncategorie" class="clearfix">
        <div class="container custom-container">
            <ul class="clearfix">
                <li><a href="{{url('/')}}">accueil</a></li>
                @foreach($menus as $menu)
                    <li><a href="{{url('/evenement/'.$menu->name)}}">{{strtoupper($menu->name)}}</a></li>
                @endforeach

            </ul>
            <a href="#" class="menupull" id="pull"><strong>Catégories &nbsp <label class="test">&darr;</label></strong></a>
        </div>
    </section>

    <section id="sectionevenement" role="navigation">
        <div class="container custom-container" >
            <ul>
                @foreach($sousmenus as $sousmenu)
                    <li>
                        <a href="{{url('/tags/'.$sousmenu->name)}}">{{ucfirst(strtolower($sousmenu->name))}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <br/>
    <section class="clearfix">
        <div class="container custom-container">
            <ul class="herb">
                <li class=" bounce animated2 zoomIn"><a href="{{url('/')}}"><b>Acceuil</b></a></li>
                <li class=" bounce animated2 zoomIn"><a href="{{url('/')}}"><b>Evénement</b></a></li>
                <li class=" bounce animated2 zoomIn"><a
                            href="{{url('/evenement/'.$sous_menu_event->menus->name)}}"><b>{{ucfirst(strtolower($sous_menu_event->menus->name))}}</b></a>
                </li>
                <li class=" bounce animated2 zoomIn dernier"><a
                            href="#"><b>{{ucfirst(strtolower($sous_menu_event->name))}}</b></a>
                </li>
            </ul>
        </div>
    </section>

    <section id="categorie-concert">
        <div class="container custom-container">
            @if($sous_menu_event)
                @php $count_id = 0 @endphp
                <div class="categorie-item">
                    <h2 class="couleur_mot">{{ucfirst(strtolower($sous_menu_event->name))}}</h2>
                    <div class="row">
                        @if($events->count() > 0)
                            @if($events->count() <= 9)
                                @foreach($events as $event)
                                @php
                                    $string_url_detail = "/evenement/".$event->sous_menus->name ."/".date('Y-m-d',strtotime($event->date_debut_envent)) . "_".  str_slug($event->title)."_".$event->id;
                                @endphp
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail"
                                             onmouseover="mouseover('month{{$count_id}}','title{{$count_id}}')"
                                             onmouseleave="mouseleave('month{{$count_id}}','title{{$count_id}}')">
                                            <a href="{{url($string_url_detail)}}">
                                                <div class="mg-image">
                                                    <img src="{{ url('/public/img/'.$event->image.'') }}">
                                                </div>
                                            </a>
                                            <div class="caption taille">
                                                <a href="{{url($string_url_detail)}})}}">
                                                    <div class="limitelengh">
                                                        <h3>
                                                            <a href="{{url($string_url_detail)}}"
                                                               id="title{{$count_id}}">{{ucfirst(strtolower(str_limit($event->title,$limit=40, $end = ' ...')))}}</a>
                                                        </h3>
                                                    </div>
                                                    <div class="limite">
                                                        <a href="{{url($string_url_detail)}}">
                                                            <?php  if ($event->additional_note == null) {
                                                                echo "<br/>";
                                                            }?>
                                                            <p style="text-align: justify">{{ str_limit(ucfirst($event->additional_note), $limit = 100, $end = ' ...') }}</p>
                                                        </a><br/>
                                                    </div>
                                                    <div class="row cbg">
                                                        <div class="col-md-3 col-xs-3">
                                                            <a href="{{url($string_url_detail)}}">
                                                                <div class="calendar">
                                                                    <h1 class="month"
                                                                        id="month{{$count_id}}">{{ \Carbon\Carbon::parse($event->date_debut_envent)->format('M')}}</h1>
                                                                    <label class="jour">{{ \Carbon\Carbon::parse($event->date_debut_envent)->format('D')}}</label>
                                                                    <p class="day">{{ \Carbon\Carbon::parse($event->date_debut_envent)->format('d')}}</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-9 col-xs-9 ">
                                                            {{--<a>--}}
                                                            <div class="prixfx">
                                                                @if($event->tickets()->where('date_debut_vente','<=',date('Y-m-d'))->where('date_fin_vente','>=',date('Y-m-d'))->count() > 0)
                                                                    <i class="fa fa-tag prices"></i>A
                                                                    partir de <b
                                                                            class="prx">{{ (int) $event->tickets()->orderBy('price','asc')->take(1)->get()[0]->price  }}</b>
                                                                    AR
                                                                @else
                                                                    <i class="fa fa-tag prices"></i>Non
                                                                    disponible
                                                                @endif
                                                            </div>
                                                            <a href="{{url($string_url_detail)}}">
                                                                <div class="price"><i
                                                                            class="glyphicon glyphicon-time time"></i>{{ \Carbon\Carbon::parse($event->date_debut_envent)->format('H:i')}}
                                                                </div>
                                                            </a>
                                                            <a href="{{url($string_url_detail)}}">
                                                                <div class="date"><i
                                                                            class="glyphicon glyphicon-map-marker position"></i>{{ str_limit($event->localisation_adresse, $limit = 15, $end = ' ...')}}
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div style="text-align:center;">
                                                        <a style="color:white !important;"
                                                           href="{{url($string_url_detail)}}"
                                                           class="btn btn-danger btn_reset">Réserver</a>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @php $count_id++ @endphp
                                @endforeach
                                @if($events->count() < 9)
                                    <div class="col-sm-6 col-md-4">
                                        <a href="{{url('/')}}/organisateur/evenement/ajouter" class="thumbnail">
                                            <img class="hut" src="{{ url('') }}/public/img/create_events.png">
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="bg-custom">
                                <h2 class="text-center"><strong>Pas d'événement ajoutés récements</strong></h2>
                                @if (Auth::guest())
                                    <p class="text-center"><strong>Inscrivez-vous dès maintenant, pour ne pas rater les
                                            prochaines
                                            Evénements</strong></p>
                                    <div class="sinscrire">
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                <div class="infopers">
                                                    <h1 class="inscriptioin"><strong>S'inscrire</strong></h1>
                                                    <label><strong>Une mise à jour mensuel des événements à
                                                            Madagascar</strong></label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8 col-xs-10 col-md-offset-2 col-xs-offset-1">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <a type="button"
                                                                   class="btn btn-sinscrire btn-lg btn-block"
                                                                   href="{{url('')}}/register">
                                                                    S'inscrire
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <hr class="couvert">
                                <div class="replik">
                                    <ul>
                                        <li><a href="#"><img src="{{url('/public/img/items1.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Concert</a></strong></p></li>
                                        <li><a href="#"><img src="{{url('/public/img/items2.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Kabaret</a></strong></p></li>
                                        <li><a href="#"><img src="{{url('/public/img/items3.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Sport</a></strong></p></li>
                                        <li><a href="#"><img src="{{url('/public/img/items4.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Soiré</a></strong></p></li>
                                        <li><a href="#"><img src="{{url('/public/img/items5.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Danse</a></strong></p></li>
                                        <li><a href="#"><img src="{{url('/public/img/items6.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Cinema</a></strong></p></li>
                                        <li><a href="#"><img src="{{url('/public/img/items7.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Festivals</a></strong></p>
                                        </li>
                                        <li><a href="#"><img src="{{url('/public/img/items8.png')}}"></a>
                                            <p class="ctgori"><strong><a href="#">Dj</a></strong></p></li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12 pull-right">
                            @php($page==null? $page=1 : $page=$page)
                            @if($events->count() >= 9)
                                <div class="pull-right">
                                    <form action="{{url('/tags/'.$sous_menu_event->name)}}"
                                          method="get">
                                        <input type="hidden" name="page" value="{{$page+1}}">
                                        <button type="submit" class="linkButton"><i><b class="next-prevs"> Suivant
                                                    >></b></i></button>
                                    </form>
                                </div>
                            @endif
                            @if($page>1)
                                <div class="pull-left">
                                    <form action="{{url('/tags/'.$sous_menu_event->name)}}"
                                          method="get">
                                        <input type="hidden" name="page" value="{{$page-1}}">
                                        <button type="submit" class="linkButton"><i><b class="next-prevs"><<
                                                    Précédent</b></i></button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                    <br/>
                </div>
            @endif
        </div>
    </section>
    <style>
        .linkButton {
            background: none;
            border: none;
            color: #0066ff;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
@endsection