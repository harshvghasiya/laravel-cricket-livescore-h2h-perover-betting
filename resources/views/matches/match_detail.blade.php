@extends('layout.app')
@section('title','Match Detail')
@section('content')

  <!-- Banner Section start -->
    <section class="banner-section inner-banner soccer-bets currency-bet bet-details">
        <div class="overlay">
            <div class="shape-area">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/winner-cup.png" class="obj-1" alt="image">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-5.png" class="obj-2" alt="image">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-3.png" class="obj-3" alt="image">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-6.png" class="obj-4" alt="image">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/betting-details-illus.png" class="chart-illu" alt="image">
            </div>
            <div class="banner-content">
                <div class="container">
                    <div class="content-shape">
                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-1.png" class="obj-8" alt="image">
                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/time-circle.png" class="obj-9" alt="image">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-10">
                            <div class="main-content">
                                @if(isset($match_data) && $match_data != null)<h1>{!! teamData($match_data->localteam_id)->name !!} Vs {!! teamData($match_data->visitorteam_id)->name !!}</h1> @endif
                                {{-- <div class="breadcrumb-area">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb d-flex align-items-center">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Currency Bet</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Betting Details</li>
                                        </ol>
                                    </nav>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section end -->

    <!-- Betting details start -->
    <section class="betting-details">
        <div class="overlay pb-120">
            <div class="container">
                <div class="main-content">
                    <div class="row cus-mar">
                        <div class="col-lg-12">
                           {{--  <div class="time-area text-center mt-60 mb-60">
                                <div class="countdown d-flex align-items-center justify-content-center">
                                    <h3>
                                        <span class="days">00</span><span class="ref">d</span><span
                                            class="seperator">:</span>
                                    </h3>
                                    <h3>
                                        <span class="hours">00</span><span class="ref">h</span><span
                                            class="seperator">:</span>
                                    </h3>
                                    <h3>
                                        <span class="minutes">00</span><span class="ref">m</span><span
                                            class="seperator">:</span>
                                    </h3>
                                    <h3>
                                        <span class="seconds">00</span><span class="ref">s</span>
                                    </h3>
                                </div>
                                <div class="bet-id">
                                    <p>Bet Id: #18574b25-dda0-4523-be24-a8df2cf69ca1</p>
                                </div>
                            </div> --}}
                            <div class="mt-60 table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <span class="xlr">Match Name</span>
                                            </th>
                                            <td>
                                                
                                              @if(isset($match_data) && $match_data != null)<span class="xlr">{!! teamData($match_data->localteam_id)->name !!} Vs {!! teamData($match_data->visitorteam_id)->name !!}</span> @else - @endif 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><span class="xlr">Toss Won By</span></th>
                                            <td> @if(isset($match_data) && $match_data != null && teamData($match_data->localteam_id) != null)<span class="xlr">{!! teamData($match_data->localteam_id)->name !!} @else - @endif 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><span class="xlr">@if(isset($match_data) && $match_data != null){!! teamData($match_data->localteam_id)->name !!} Score @else - @endif </span></th>
                                            <td><span class="xlr">@if(isset($match_data) && $match_data != null && $match_data->localteam_id== $match_data->runs[0]->team_id) {!! $match_data->runs[0]->score !!} / {!! $match_data->runs[0]->wickets !!}  Overs: {!! $match_data->runs[0]->overs !!}</span>  @elseif(isset($match_data->runs[1])) {!! $match_data->runs[1]->score !!} / {!! $match_data->runs[1]->wickets !!}  Overs: {!! $match_data->runs[1]->overs !!} @else - @endif</td>
                                        </tr>
                                        <tr>
                                            {{-- {{dd(isset($match_data->runs[0]))}} --}}
                                            <th scope="row"><span class="xlr">@if(isset($match_data) && $match_data != null){!! teamData($match_data->visitorteam_id)->name !!} Score @else - @endif </span></th>
                                            <td><span class="xlr">@if(isset($match_data) && isset($match_data->runs[1]) && $match_data != null && $match_data->visitorteam_id== $match_data->runs[1]->team_id) {!! $match_data->runs[1]->score !!} / {!! $match_data->runs[1]->wickets !!}  Overs: {!! $match_data->runs[1]->overs !!}</span>@elseif(isset($match_data) && isset($match_data->runs[0]) && $match_data != null && $match_data->visitorteam_id== $match_data->runs[0]->team_id) {!! $match_data->runs[0]->score !!} / {!! $match_data->runs[0]->wickets !!}  Overs: {!! $match_data->runs[0]->overs !!} @else - @endif</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <span class="xlr">
                                                    Current Batting
                                                </span>
                                            </th>
                                            <td>
                                                <span class="xlr">
                                                    @if(isset($match_data->batting))
                                                       @foreach($match_data->batting as $key=>$value)
                                                          {{-- {{dd($value)}} --}}
                                                          @if(array_key_last($match_data->batting)==$key)
                                                             @if(playerData($value->player_id) != null)
                                                              {{playerData($value->player_id)->firstname}}  {{playerData($value->player_id)->lastname}}   : {{$value->score}} ({{$value->ball}}) 
                                                             @endif
                                                          @endif
                                                          @if(array_key_last($match_data->batting)-1==$key)
                                                             @if(playerData($value->player_id) != null)
                                                              {{playerData($value->player_id)->firstname}}  {{playerData($value->player_id)->lastname}}   : {{$value->score}} ({{$value->ball}})  <br>
                                                             @endif
                                                          @endif
                                                       @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <span class="xlr">
                                                    Current Bowling
                                                </span>
                                            </th>
                                            <td>
                                                <span class="xlr">
                                                    @if(isset($match_data->bowling))
                                                       @foreach($match_data->bowling as $key=>$value)
                                                          {{-- {{dd($value)}} --}}
                                                          @if(array_key_last($match_data->bowling)==$key)
                                                             @if(playerData($value->player_id) != null)
                                                              {{playerData($value->player_id)->firstname}}  {{playerData($value->player_id)->lastname}}    :<br> Overs: {{$value->overs}} / Wickets: {{$value->wickets}} <br>    Rate:{{$value->rate}} /  Runs:{{$value->runs}}
                                                             @endif
                                                          @endif
                                                          
                                                       @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>




                            @php 
                            $next_over="";
                            $bowler_id="";
                            if (isset($match_data) && $match_data != null) {
                                foreach ($match_data->balls as $key => $value) {
                                    if ($key== array_key_last($match_data->balls)) {
                                        $next_over=ceil($value->ball)+1;
                                    }
                                    
                                    $bowler_id=$value->bowler_id;
                                    $team_id=$value->team_id;
                                }
                            }
                            @endphp
                            @if(isset($contest_over) && $contest_over != null)
                            
                                @if($contest_over->over_run_status==1)
                                <div class="escrow-bet-single">
                                    <div class="left-area">
                                        <h5>In This Over Run : <span> {{$contest_over->over_run}} </span></h5>
                                        <p>Over Number : {{$next_over}}</p>
                                    </div>
                                    <div class="right-area">
                                        <p>If win, will get : {{$contest_over->over_run_odd}} X</p>
                                        <button type="button" class="cmn-btn reg" data-bs-toggle="modal" data-bs-target="#match_de_modal">
                                            Bet Now
                                        </button>
                                    </div>
                                </div>
                                @endif

                              
                            @endif

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Betting details Bets end -->

   <div class="betpopmodal">
        <div class="modal fade bet_modal" id="match_de_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-8 col-xl-9 col-lg-11">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <div class="top-item">
                                        <a href="javascript:void(0)" class="cmn-btn firstTeam">{{$data['team_name']}} will win</a>
                                        <a href="javascript:void(0)" class="cmn-btn active draw">Draw</a>
                                        <a href="javascript:void(0)" class="cmn-btn lastTeam">{{$data['team_name']}} will win</a>
                                    </div> --}}
                                    <form action="{{route('front.match.run_per_over')}}" method="post">
                                      @csrf
                                        <input type="hidden" name="eid" value="{{$match_data->id}}">
                                        <input type="hidden" name="bowler_id" value="{{$bowler_id}}">
                                        <input type="hidden" name="team_id" value="{{$team_id}}">
                                        <input type="hidden" name="over_run_odd" value="{{Crypt::encrypt($contest_over->over_run_odd)}}">
                                        <input type="hidden" name="over_run" value="{{Crypt::encrypt($contest_over->over_run)}}">
                                        <input type="hidden" name="contest_id" value="{{$contest_over->id}}">
                                        <input type="hidden" name="over_number" value="{{$next_over}}">
                                    <div class="mid-area">
                                        <div class="single-area">
                                            <div class="item-title d-flex align-items-center justify-content-between">
                                                <span>Bet Value :</span>
                                               
                                            </div>
                                            <div class="d-flex in-dec-val">

                                                <input type="text" name="bet_value" value="50" class="InDeVal1">
                                                <div class="btn-area">
                                                    <button class="plus">
                                                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/up-arrow.png" alt="icon">
                                                    </button>
                                                    <button class="minus">
                                                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/down-arrow.png" alt="icon">
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="single-area quick-amounts">
                                            <div class="item-title d-flex align-items-center">
                                                <p>Quick Amounts</p>
                                            </div>
                                            <div class="input-item">
                                                <button class="quickIn">100</button>
                                                <button class="quickIn">200</button>
                                                <button class="quickIn">300</button>
                                                <button class="quickIn">400</button>
                                                <button class="quickIn">500</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="bottom-area">
                                        <div class="fee-area">
                                            <p>Winner will get: <span class="amount">{{$contest_over->over_run_odd}}</span> X</p>
                                        </div>
                                        <div class="btn-area">
                                            @if(\Auth::guard('front_user')->user() != null)
                                            <button type="submit" name="yes_bet" value="1">Yes </button>
                                            @else
                                            <button>Login To Bet</button>
                                            @endif
                                        </div>
                                         <div class="btn-area">
                                            @if(\Auth::guard('front_user')->user() != null)
                                            <button type="submit" name="no_bet" value="0">No </button>
                                            
                                            @endif
                                        </div>
                                        <div class="bottom-right">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="betpopmodal">
        <div class="modal fade bet_modal" id="match_six_over_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-8 col-xl-9 col-lg-11">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- <div class="top-item">
                                        <a href="javascript:void(0)" class="cmn-btn firstTeam">{{$data['team_name']}} will win</a>
                                        <a href="javascript:void(0)" class="cmn-btn active draw">Draw</a>
                                        <a href="javascript:void(0)" class="cmn-btn lastTeam">{{$data['team_name']}} will win</a>
                                    </div> --}}
                                    <form action="{{route('front.match.six_over_run')}}" method="post">
                                      @csrf
                                        <input type="hidden" name="eid" value="{{$match_data->id}}">
                                        <input type="hidden" name="bowler_id" value="{{$bowler_id}}">
                                        <input type="hidden" name="six_over_run_odd" value="{{Crypt::encrypt($contest_over->six_over_run_odd)}}">
                                        <input type="hidden" name="six_over_run" value="{{Crypt::encrypt($contest_over->six_over_run)}}">
                                        <input type="hidden" name="contest_id" value="{{$contest_over->id}}">
                                        <input type="hidden" name="over_number" value="1-6">
                                    <div class="mid-area">
                                        <div class="single-area">
                                            <div class="item-title d-flex align-items-center justify-content-between">
                                                <span>Bet Value :</span>
                                               
                                            </div>
                                            <div class="d-flex in-dec-val">

                                                <input type="text" name="bet_value" value="50" class="InDeVal1">
                                                <div class="btn-area">
                                                    <button class="plus">
                                                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/up-arrow.png" alt="icon">
                                                    </button>
                                                    <button class="minus">
                                                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/down-arrow.png" alt="icon">
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="single-area quick-amounts">
                                            <div class="item-title d-flex align-items-center">
                                                <p>Quick Amounts</p>
                                            </div>
                                            <div class="input-item">
                                                <button class="quickIn">100</button>
                                                <button class="quickIn">200</button>
                                                <button class="quickIn">300</button>
                                                <button class="quickIn">400</button>
                                                <button class="quickIn">500</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="bottom-area">
                                        <div class="fee-area">
                                            <p>Winner will get: <span class="amount">{{$contest_over->six_over_run_odd}}</span> X</p>
                                        </div>
                                        <div class="btn-area">
                                            @if(\Auth::guard('front_user')->user() != null)
                                            <button type="submit" name="yes_bet" value="1">Yes </button>
                                            @else
                                            <button>Login To Bet</button>
                                            @endif
                                        </div>
                                         <div class="btn-area">
                                            @if(\Auth::guard('front_user')->user() != null)
                                            <button type="submit" name="no_bet" value="0">No </button>
                                            
                                            @endif
                                        </div>
                                        <div class="bottom-right">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('javascript')
<script type="text/javascript">
    
        $(document).on('click', '.quickIn', function(event) {
            event.preventDefault();
            var quval=$(this).text();
            $('.InDeVal1').val(quval);
        });
</script>
@endsection