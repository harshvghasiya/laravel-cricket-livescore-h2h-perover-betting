@extends('layout.app')
@section('title','Home')
@section('content')
    <!-- Banner Section start -->
    <section class="banner-section">
        <div class="overlay">
            <div class="shape-area">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-2.png" class="obj-1" alt="image">
                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/winner-cup.png" class="obj-2" alt="image">
            </div>
            <div class="banner-content">
                <div class="container">
                    <div class="content-shape">
                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-1.png" class="obj-1" alt="image">
                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-3.png" class="obj-2" alt="image">
                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-3.png" class="obj-3" alt="image">
                        <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/coin-4.png" class="obj-4" alt="image">
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-10">
                            <div class="main-content">
                                <div class="top-area section-text">
                                    <h4 class="sub-title">Khelo Indian!</h4>
                                    <h1 class="xlr">This website is for only entertainment purpose no batting is played and strictly prohibited </h1>
                                    {{-- <p class="xlr">The fastest, easiest way to bet on cricket</p> --}}
                                </div>
                                <div class="bottom-area">
                                    <span class="btn-border">
                                        @if(Auth::guard('front_user')->user() ==null)
                                        <button type="button" class="cmn-btn reg" data-bs-toggle="modal" data-bs-target="#loginMod">
                                            Login Now
                                        </button>
                                        @else 
                                         <button type="button" class="cmn-btn reg" >
                                            Welcome
                                        </button>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       {{--  <div class="counter-section">
            <div class="container">
                <div class="row cus-mar">
                    <div class="col-xl-4 col-md-6">
                        <div class="single-area d-flex align-items-center">
                            <div class="img-area">
                                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/counter-icon-1.png" alt="image">
                            </div>
                            <div class="text-area">
                                <h3 class="m-none"><span>€</span><span class="counter">1304,941</span></h3>
                                <p>Paid Out Prize in Total</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="single-area d-flex align-items-center">
                            <div class="img-area">
                                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/counter-icon-2.png" alt="image">
                            </div>
                            <div class="text-area">
                                <h3 class="m-none"><span class="counter">76,752</span></h3>
                                <p>Winners</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="single-area d-flex align-items-center">
                            <div class="img-area">
                                <img src="{{UPLOAD_AND_DOWNLOAD_URL()}}/front/assets/images/icon/counter-icon-3.png" alt="image">
                            </div>
                            <div class="text-area">
                                <h3 class="m-none"><span class="counter">4,392</span></h3>
                                <p>Players online</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 --}}    </section>
    <!-- Banner Section end -->
    
    @if(liveMatch() != null && \Auth::guard('front_user')->user() != null)
    <!-- Bet This Game start -->
    <section class="bet-this-game">
        <div class="overlay pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-header text-center">
                            {{-- <h5 class="sub-title">Sports Escrow Bets Peer 2 Peer</h5> --}}
                            <h2 class="title">Current Matches</h2>
                            {{-- <p>Use the power of Bitbetio Bets Fast, Anonymous, Secured, Automatic, Trustworthy</p> --}}
                        </div>
                    </div>
                </div>
                
                <div class="row cus-mar">
                    @if(liveMatch() != null && \Auth::guard('front_user')->user() != null)
                        @foreach(liveMatch() as $key=>$value)
                                <div class="col-lg-6">
                                    <div class="single-area">
                                        <div class="head-area d-flex align-items-center">
                                            <span class="mdr cmn-btn">@if( leagueById($value->league_id) != null) {!! leagueById($value->league_id)->name  !!} @endif</span>
                                            <a href="{{route('front.match.detail',Crypt::encrypt($value->id))}}" class="m-1 mdr cmn-btn"> More Bettings</a>
                                            {{-- <p>{{$value->round}}</p> --}}

                                        </div>
                                        <div class="main-content">
                                            <div class="team-single">
                                                <h4>@if(teamData($value->localteam_id) != null) {!!teamData($value->localteam_id)->name !!} @endif</h4>
                                                {{-- <span class="mdr">Home</span> --}}
                                                <div class="img-area">
                                                    @if(teamData($value->localteam_id) != null) 
                                                    {{-- <img src="{!! teamData($value->localteam_id)->image_path !!}" alt="image"> --}}
                                                    @endif
                                                   {{-- {{dd($value->runs[0]->team_id)}} --}}
                                                    <p>@if(isset($value->runs[0]) && $value->runs[0]->team_id==$value->localteam->id ) {{$value->runs[0]->score}} / {{$value->runs[0]->wickets}} @elseif(isset($value->runs[1]) && $value->runs[1]->team_id==$value->localteam->id) {{$value->runs[1]->score}} / {{$value->runs[1]->wickets}} @else - @endif</p>
                                                    
                                                   {{-- @if(isset($value->Events[0]->Tr1C2) && isset($value->Events[0]->Tr1CW2) )  <p>{{$value->Events[0]->Tr1C2}} / {{$value->Events[0]->Tr1CW2}} @else -</p>
                                                    @endif --}}
                                                </div>
                                            </div>
                                            <div class="mid-area text-center">

                                                {{-- @if(isset($value->Events) && $value->Events != null) --}}

                                                   <h6>{!! $value->status !!} / {!! $value->note !!} </h6>
                                                {{-- @endif --}}
                                            </div>
                                            <div class="team-single">
                                                <h4>@if(teamData($value->visitorteam_id) != null) {!!teamData($value->visitorteam_id)->name !!} @endif</h4>
                                                {{-- <span class="mdr">Away</span> --}}
                                                <div class="img-area">
                                                    @if(teamData($value->visitorteam_id) != null) 
                                                    {{-- <img src="{!! teamData($value->visitorteam_id)->image_path !!}" alt="image"> --}}
                                                    @endif
                                                    {{-- {{dd($value)}} --}}
                                                    <p>@if(isset($value->runs[1]) && $value->runs[1]->team_id==$value->visitorteam_id ) {{$value->runs[1]->score}} / {{$value->runs[1]->wickets}} @elseif(isset($value->runs[0]) &&$value->runs[0]->team_id==$value->visitorteam_id ) {{$value->runs[0]->score}} / {{$value->runs[0]->wickets}} @else - @endif</p>
                                                   

                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom-item">
                                            <button type="button" class="cmn-btn firstTeam betdo"  data-eid="{{$value->id}}" data-team_id="{{$value->localteam_id}}" data-team_name="{!!teamData($value->localteam_id)->name !!}">{!!teamData($value->localteam_id)->name !!} will win</button>
                                            <a class="trigger_link" href="javascript:void()"  data-bs-toggle="modal" data-bs-target="#betpop-up"> </a>
                                            <button type="button" class="cmn-btn draw betdo" data-bs-toggle="modal" data-bs-target="#betpop-up" data-draw="true" data-team_id="Draw"  data-eid="{{$value->id}}"  data-team_name="Draw">Draw</button>
                                            <button type="button" class="cmn-btn lastTeam betdo" data-team_id="{{$value->visitorteam_id}}"  data-eid="{{$value->id}}"  data-team_name="{!!teamData($value->visitorteam_id)->name !!}">{!!teamData($value->visitorteam_id)->name !!} will win</button>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endif
                </div>
                {{-- <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="bottom-area mt-60">
                            <span class="btn-border">
                                <a href="soccer-bets-2.html" class="cmn-btn">Browse More</a>
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Bet This Game end -->
    @endif

     @if($recent_match != null && \Auth::guard('front_user')->user() != null)
    <!-- Bet This Game start -->
    <section class="bet-this-game">
        <div class="overlay pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-header text-center">
                            {{-- <h5 class="sub-title">Sports Escrow Bets Peer 2 Peer</h5> --}}
                            <h2 class="title">Recent Matches</h2>
                            {{-- <p>Use the power of Bitbetio Bets Fast, Anonymous, Secured, Automatic, Trustworthy</p> --}}
                        </div>
                    </div>
                </div>
                
                <div class="row cus-mar">
                    @if($recent_match != null && \Auth::guard('front_user')->user() != null)
                        @foreach($recent_match as $key=>$value)
                              @php
                               $match_detail=matchDetail($value->eid);
                               // dd($match_detail);
                               @endphp
                                <div class="col-lg-6">
                                    <div class="single-area">
                                        <div class="head-area d-flex align-items-center">
                                            {{-- {{dd($match_detail)}} --}}

                                            <span class="mdr cmn-btn">{{$match_detail->round}}</span>
                                           {{--  <a href="{{route('front.match.detail',Crypt::encrypt($match_detail->id))}}" class="m-1 mdr cmn-btn"> More Bettings</a> --}}
                                            {{-- <p>{{$match_detail->round}}</p> --}}

                                        </div>
                                        <div class="main-content">
                                            <div class="team-single">
                                                <h4>@if(teamData($match_detail->localteam_id) != null) {!!teamData($match_detail->localteam_id)->name !!} @endif</h4>
                                                {{-- <span class="mdr">Home</span> --}}
                                                <div class="img-area">
                                                    @if(teamData($match_detail->localteam_id) != null) 
                                                    {{-- <img src="{!! teamData($match_detail->localteam_id)->image_path !!}" alt="image"> --}}
                                                    @endif
                                                   {{-- {{dd($match_detail->runs[0]->team_id)}} --}}
                                                    <p>@if(isset($match_detail->runs[0]) && $match_detail->runs[0]->team_id==$match_detail->localteam->id ) {{$match_detail->runs[0]->score}} / {{$match_detail->runs[0]->wickets}} @elseif(isset($match_detail->runs[1]) && $match_detail->runs[1]->team_id==$match_detail->localteam->id) {{$match_detail->runs[1]->score}} / {{$match_detail->runs[1]->wickets}} @else - @endif</p>
                                                    
                                                   {{-- @if(isset($match_detail->Events[0]->Tr1C2) && isset($match_detail->Events[0]->Tr1CW2) )  <p>{{$match_detail->Events[0]->Tr1C2}} / {{$match_detail->Events[0]->Tr1CW2}} @else -</p>
                                                    @endif --}}
                                                </div>
                                            </div>
                                            <div class="mid-area text-center">

                                                {{-- @if(isset($match_detail->Events) && $match_detail->Events != null) --}}

                                                   <h6>{!! $match_detail->status !!} </h6>
                                                {{-- @endif --}}
                                            </div>
                                            <div class="team-single">
                                                <h4>@if(teamData($match_detail->visitorteam_id) != null) {!!teamData($match_detail->visitorteam_id)->name !!} @endif</h4>
                                                {{-- <span class="mdr">Away</span> --}}
                                                <div class="img-area">
                                                    @if(teamData($match_detail->visitorteam_id) != null) 
                                                    {{-- <img src="{!! teamData($match_detail->visitorteam_id)->image_path !!}" alt="image"> --}}
                                                    @endif

                                                    <p>@if(isset($match_detail->runs[1]) && $match_detail->runs[1]->team_id==$match_detail->visitorteam_id ) {{$match_detail->runs[1]->score}} / {{$match_detail->runs[1]->wickets}} @elseif($match_detail->runs[0]->team_id==$match_detail->visitorteam_id ) {{$match_detail->runs[0]->score}} / {{$match_detail->runs[0]->wickets}} @else - @endif</p>
                                                   

                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom-item">
                                                   <h6> {!! $match_detail->note !!} </h6>
                                           
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endif
                </div>
                {{-- <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="bottom-area mt-60">
                            <span class="btn-border">
                                <a href="soccer-bets-2.html" class="cmn-btn">Browse More</a>
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Bet This Game end -->
    @endif


   <div class="betpopmodal">
        <div class="modal fade bet_modal" id="betpop-up" tabindex="-1" aria-hidden="true">
            
        </div>
    </div>
    

   



@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.betdo', function(event) {
            event.preventDefault();
            var eid=$(this).data('eid');
            var team_id=$(this).data('team_id');
            var team_name=$(this).data('team_name');
            var modal = $('#betpop-up');
            $.ajax({
                url: '{{route('front.match.bet_modal')}}',
                type: 'POST',
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {eid: eid,team_id:team_id,team_name:team_name},
                success:function (response) {
                    console.log(response)
                    $('.bet_modal').html(response);
                   modal.modal('show');
                }
            });
            
            
        });

        $(document).on('click', '.quickIn', function(event) {
            event.preventDefault();
            var quval=$(this).text();
            $('.InDeVal1').val(quval);
        });
    });
</script>
@endsection