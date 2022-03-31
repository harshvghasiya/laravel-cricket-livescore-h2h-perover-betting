
{{ Form::select('state_id',\App\Models\State::getStateDropDown($request->country),null,['placeholder'=>trans('message.select_state_label'),'id'=>'inputcity',"class"=>"form-select select3 "])
                                            }}