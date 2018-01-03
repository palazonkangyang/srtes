  @if($myapplist[0]->status == 0 && $mark == 'creator')
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Title</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->type == 1)
      Creation of Account
    @else
      Deletion of Account
    @endif
  </div>
  </div>
  
   @if($forminfo->type == 1)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Employee's Name</div>
  <div class="col-md-10 bg-ff">
      {!! Form::text('employees_name',$forminfo->employees_name,['class'=>'form-control width-50', 'id'=>'employees_name']) !!}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Able to</div>
  <div class="col-md-10 bg-ff">
       <div class="radio">   
            <label >
                  @if($forminfo->create_prpo == 1)
                   {!! Form::checkbox('create_prpo', 1,true) !!} Create PR/PO
                  @else
                {!! Form::checkbox('create_prpo', 1) !!} Create PR/PO
                @endif
            </label>
            <label >
                  @if($forminfo->approve_pr == 1)
                   {!! Form::checkbox('approve_pr', 1,true) !!} Approve PR
                  @else
                {!! Form::checkbox('approve_pr', 1) !!} Approve PR
                @endif
            </label>
             <label >
                  @if($forminfo->others == 1)
                   {!! Form::checkbox('others', 1,true) !!} Others
                  @else
                {!! Form::checkbox('others', 1) !!} Others
                @endif
            </label>
  
    </div>
  </div>
  </div>
 
   <div class="row bg-cc-only others ">
  <div class="col-md-2 bg-cc">Others(*)</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->others == 1)
    {!! Form::text('others_name',$forminfo->others_name,['class'=>'form-control', 'id'=>'others_name']) !!} </div>
   @else 
      {!! Form::text('others_name',$forminfo->others_name,['class'=>'form-control hide', 'id'=>'others_name']) !!} </div>
  
   @endif
   </div>
  @else
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons for deletion</div>
  <div class="col-md-10 bg-ff">
      
   {!! Form::textarea('reasons', $forminfo->reasons, ['class' => 'ckeditor form-control']) !!}
  </div>
  </div>
  @endif
  @else
<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Title</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->type == 1)
      Creation of Account
    @else
      Deletion of Account
    @endif
  </div>
  </div>
  
  @if($forminfo->type == 1)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Employee's Name</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->employees_name !!}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Able to</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->create_prpo == 1)
       Create PR/PO
     @endif
    @if($forminfo->approve_pr == 1)
       , Approve PR
     @endif
    @if($forminfo->others == 1)
       , Others ({{ $forminfo->others_name }})
    @endif
  </div>
  </div>

  @else
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons for deletion</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->reasons !!}
  </div>
  </div>
  @endif
  @endif
  
   <script type="text/javascript">
    $(document).ready(function(){

   $('input[name=others]').on('change', function(){

           if($(this).prop('checked') == true){
          
              $('#others_name').addClass('show').removeClass('hide');
           } else {
              $('#others_name').removeClass('show').addClass('hide');
           }
        });
        
        });
  </script>
  