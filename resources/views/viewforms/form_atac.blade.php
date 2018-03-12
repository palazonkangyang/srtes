  @if($myapplist[0]->status == 0 && $mark == 'creator') 
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Fullname (*)</div>
  <div class="col-md-10 bg-ff">
        {!! Form::text('fullname',$forminfo->fullname,['class'=>'form-control width-50 ', 'id'=>'fullname']) !!}
      </div>
   </div>
     <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">NRIC (*)</div>
  <div class="col-md-10 bg-ff">
        {!! Form::text('nric',$forminfo->nric,['class'=>'form-control width-20', 'id'=>'nric']) !!}
      </div>
   </div>
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Address (*)</div>
  <div class="col-md-10 bg-ff">
     {!! Form::textarea('address',$forminfo->address,['class'=>'form-control width-50', 'id'=>'address', 'rows'=>'5']) !!}
      </div>
   </div>
   <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Telephone #</div>
  <div class="col-md-10 bg-ff">
        {!! Form::text('telephone',$forminfo->telephone,['class'=>'form-control ', 'id'=>'telephone']) !!}
      </div>
   </div>
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Mobile #</div>
  <div class="col-md-10 bg-ff">
        {!! Form::text('mobile',$forminfo->mobile,['class'=>'form-control ', 'id'=>'mobile']) !!}
      </div>
   </div>
  
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Access Areas Applied</div>
  <div class="col-md-10 bg-ff">
    <div class="radio">   
            <label class="display-block">
                  @if($forminfo->srca == 1)
                   {!! Form::checkbox('srca', 1,true) !!} SRCA
                  @else
                {!! Form::checkbox('srca', 1) !!} SRCA
                @endif
            </label>
            <label class="display-block">
                   @if($forminfo->admin_fr_ccm == 1)
                   {!! Form::checkbox('admin_fr_ccm', 1,true) !!} Admin/FR/CCM
                  @else
                {!! Form::checkbox('admin_fr_ccm', 1) !!} Admin/FR/CCM
                @endif
            </label>
            <label class="display-block">
                @if($forminfo->hr_is == 1)
                   {!! Form::checkbox('hr_is', 1,true) !!} HR/IS
                  @else
                {!! Form::checkbox('hr_is', 1) !!} HR/IS
                @endif
            </label>
            <label class="display-block">
                  @if($forminfo->mvd_rcy_cs == 1)
                   {!! Form::checkbox('mvd_rcy_cs', 1,true) !!} MVD/RCY/CS
                  @else
                {!! Form::checkbox('mvd_rcy_cs', 1) !!} MVD/RCY/CS
                @endif
            </label>
            <label class="display-block">
                   @if($forminfo->rear_entrance == 1)
                   {!! Form::checkbox('rear_entrance', 1,true) !!} Rear Entrance
                  @else
                {!! Form::checkbox('rear_entrance', 1) !!} Rear Entrance
                @endif
            </label>
            <label class="display-block">
                   @if($forminfo->meeting_room == 1)
                   {!! Form::checkbox('meeting_room', 1,true) !!} Meeting Room 
                  @else
                {!! Form::checkbox('meeting_room', 1) !!} Meeting Room 
                @endif
            </label>
            <label class="display-block">
                 @if($forminfo->thrift_shop == 1)
                   {!! Form::checkbox('thrift_shop', 1,true) !!} Thrift Shop
                  @else
                {!! Form::checkbox('thrift_shop', 1) !!} Thrift Shop
                @endif
            </label>
       </div>
   </div>
   </div>
  
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Access Period (Date)</div>
  <div class="col-md-10 bg-ff">
        &nbsp;From
      {!! Form::text('access_date_start',$forminfo->access_date_start,['class'=>'form-control width-40 start_date_only']) !!}
         &nbsp;To
      {!! Form::text('access_date_end',$forminfo->access_date_end,['class'=>'form-control width-40 end_date_only']) !!}
      </div>
    </div>
    <div id="access_date_start"></div>
    <div id="access_date_end"></div>
 
  
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons (*)</div>
  <div class="col-md-10 bg-ff">
     {!! Form::textarea('reasons',$forminfo->reasons,['class'=>'form-control ckeditor', 'id'=>'reasons', ]) !!}
      </div>
   </div>
      @else
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Fullname</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->fullname }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">NRIC</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->nric }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Address</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->address }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Telephone #</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->telephone }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Mobile #</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->mobile }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Access Areas Applied</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->srca == 1)
       SRCA
    @endif
    @if($forminfo->admin_fr_ccm == 1)
       , Admin/FR/CCM
    @endif
    @if($forminfo->hr_is == 1)
       , HR/IS
    @endif
    @if($forminfo->mvd_rcy_cs == 1)
       , MVD/RCY/CS
    @endif
    @if($forminfo->rear_entrance == 1)
       , Rear Entrance
    @endif
    @if($forminfo->meeting_room == 1)
       , Meeting Room
    @endif
    @if($forminfo->thrift_shop == 1)
       , Thrift Shop
    @endif
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Access Period (Date and Time)</div>
  <div class="col-md-10 bg-ff">
    <strong>&nbsp;From:&nbsp;</strong>
    {!! date('j F Y', strtotime($forminfo->access_date_start)) !!}
    <strong>&nbsp;To:&nbsp;</strong>
    {!! date('j F Y', strtotime($forminfo->access_date_end)) !!}
    <br /> &nbsp;
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->reasons !!}
  </div>
  </div>

    @endif
  