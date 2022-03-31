 <!-- Betpop Up Modal start -->
    {{-- <div class="betpopmodal"> --}}
        {{-- <div class="modal fade" id="betpop-up" tabindex="-1" aria-hidden="true"> --}}
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
                                    <div class="select-odds d-flex align-items-center">
                                        @if($res != null)
                                        <h6>{{$res->team_name1}} Winnig Odd</h6>
                                        <div class="d-flex in-dec-val">
                                              <input type="text" @if($res->team_1_odd != null) value="{{$res->team_1_odd}}" @else value="{{$setting->default_odd}}" @endif class="InDeVal2 disabled" disabled="true">     
                                        </div>
                                        <h6 style="margin-left:20px;">Draw</h6>
                                        <div class="d-flex in-dec-val">
                                              <input type="text" @if($res->draw != null) value="{{$res->draw}}" @else value="{{$setting->default_odd}}" @endif class="InDeVal2 disabled" disabled="true">     
                                        </div>
                                        @else
                                        <h6>{{$res->team_name1}} Winnig Odd</h6>
                                        <div class="d-flex in-dec-val">
                                              <input type="text" value="{{$setting->default_odd}}"  class="InDeVal2 disabled" disabled="true">     
                                        </div>
                                        <h6 style="margin-left:20px;">Draw</h6>
                                        <div class="d-flex in-dec-val">
                                              <input type="text"  value="{{$setting->default_odd}}"  class="InDeVal2 disabled" disabled="true">     
                                        </div>

                                        @endif
                                    </div>
                                    <div class="select-odds d-flex align-items-center">
                                        @if($res != null)
                                        <h6>{{$res->team_name2}} Winnig Odd</h6>
                                        <div class="d-flex in-dec-val">
                                              <input type="text"  @if($res->team_2_odd != null) value="{{$res->team_2_odd}}" @else value="{{$setting->default_odd}}" @endif class="InDeVal2 disabled" disabled="true">     
                                        </div>
                                        @else
                                        <h6>{{$res->team_name2}} Winnig Odd</h6>
                                        <div class="d-flex in-dec-val">
                                              <input type="text"  value="{{$setting->default_odd}}" class="InDeVal2 disabled" disabled="true">     
                                        </div>

                                        @endif
                                    </div>
                                    <form action="{{route('front.match.make_bet')}}">
                                        <input type="hidden" name="eid" value="{{$data['eid']}}">
                                        <input type="hidden" name="team_id" value="{{$data['team_id']}}">
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
                                            <p>Winner will get: <span class="amount">0.179</span> ETH</p>
                                            <p class="fee">Escrow Fee: <span>5%</span></p>
                                        </div>
                                        <div class="btn-area">
                                            @if(\Auth::guard('front_user')->user() != null)
                                            <button type="submit">Make Bet On {{$data['team_name']}}</button>
                                            @else
                                            <button>Login To Bet</button>
                                            @endif
                                        </div>
                                        <div class="bottom-right">
                                            <p>Game Closes:</p>
                                            <p class="date-area">Mar <span>21,2021-1:00</span> Am</p>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div> --}}
    <!-- Betpop Up Modal end -->