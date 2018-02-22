<style type="text/css">

body{
	font-family: arial, sans-serif;
	font-size: 9px;
}

.bg-cc-only{
  clear: both;
}

.menu-section, header .container, #print-page, #print-pdf, footer {
	display:none;
}

.page-head-line, header{
  font-size: 11px!important;
	border: 0;
}

.alert-dismissible{
  display: none!important;
}

.print-table{
  display: none;
}

@page { margin: 10px 30px; size:auto; }


/*page print styles*/
.add-type-field{
  display: none;
}

.page-head-line{
	margin: 0 0 20px 0;
	padding:0;
	background: #eee;
	border-bottom:1px solid #ccc;
	padding: 20px 0 20px 10px;
}

/* .wrap-content{
	font-size: 11px!important;
} */

.filter_field, .pagination-table, .pagination{
  display: none;
}

 a[href]:after {
    content: none !important;
  }

th .glyphicon{
	display: none;
}

#comments {page-break-before: always;}

.visible-print {
    display: block !important;
}

.hidden-print {
    display: none !important;
}

div.history {
  /* page-break-before: always;
   page-break-inside: avoid;*/
   float:none;
   position: relative;
   top:0;
   width:100%;
   /* font-size: 9px!important; */
   margin:10px -15px 0 0;
   padding:10px 0 0;
}

/* .row{
  overflow: hidden;
} */

.col-md-12 {
  width: 100%;
}

.col-md-5 {
  width: 41.66666667%;
  float: left;
}

.col-md-7 {
  width: 58.33333333%;
  float: left;
}

.col-md-10 {
  width: 83.33333333%;
  float: left;
}

.col-md-2 {
  width: 16.66666667%;
  float: left;
}

.bg-cc{
	font-weight: bold;
	/* font-size: 11px; */
	padding:0;
	line-height: 24px;
}
.bg-ff{
	/* font-size:11px; */
	padding:0;
	line-height: 25px;
}

.bg-ff p{
  margin: 0;
}

.print-status-position{
  position: absolute;
  top: 60px;
  right: 150px;
  font-size: 16px;
}

.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
}

.table td, .table tr{
  padding:0;
}

.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ddd;
}

.table > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #ddd;
}

.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
  text-align: left;
  border-top: 0;
}

.table > tbody + tbody {
  border-top: 2px solid #ddd;
}

.table .table {
  background-color: #fff;
}

.table-condensed > thead > tr > th,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > tbody > tr > td,
.table-condensed > tfoot > tr > td {
  padding: 1px;
}

.table-condensed > tbody > tr:nth-of-type(even) {
  background-color: #f9f9f9;
}

/* .table-bordered {
  border: 1px solid #ddd;
} */

/* .table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}

.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
} */
table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}
table td[class*="col-"],
table th[class*="col-"] {
  position: static;
  display: table-cell;
  float: none;
}

.table-responsive {
  min-height: .01%;
  overflow-x: auto;
}

.print-heading{
  margin-bottom: 10px;
}

.remark-td p{
  margin: 0;
}

</style>

<body>

  <div class="row">
    <div class="col-md-12 print-heading">
      <span>AMS: {{ $myapplist[0]->case_number }}</span>
    </div>

    <div class="col-md-12 print-heading">
      <span>Date: {{ $today }}</span>
    </div>
  </div><!-- end row -->

<div class="row">
  <div class="col-md-12">
    <h4 class="page-head-line">Case <small>#{{$myapplist[0]->case_number}}</small> {{-- $title_page --}}</h4>
  </div>
</div><!-- end row -->

<div class="wrap-content">
  <div class="print-status-position">
    Status :
    @if($myapplist[0]->status == 0)
      <span class="alert-warning">Pending</span>
    @elseif($myapplist[0]->status == 1)
      <span class="alert-success">Approved</span>
    @elseif($myapplist[0]->status == 2)
      <span class="alert-danger">Rejected</span>
    @elseif($myapplist[0]->status == 3)
      <span class="alert-info">Cancelled</span>
    @elseif($myapplist[0]->status == 4)
      <span class="alert-success">Forwarded</span>
    @endif
  </div><!-- end visible-print -->

  @if($myapplist[0]->status == 1 || $myapplist[0]->status == 5)
  <div class="print-status-position">
   PP Status :
    @if($myapplist[0]->pp_status == 0)
      <span class="alert-warning">Pending</span>
    @elseif($myapplist[0]->pp_status == 1)
      <span class="alert-info">Processing</span>
    @elseif($myapplist[0]->pp_status == 2)
      <span class="alert-success">Exported</span>
    @elseif($myapplist[0]->pp_status == 3)
      <span class="alert-info">Ready for Collection</span>
    @elseif($myapplist[0]->pp_status == 4)
      <span class="alert-success">Collected</span>
    @elseif($myapplist[0]->pp_status == 5)
      <span class="alert-danger">Rejected</span>
    @endif
  </div><!-- end visible-print -->
  @endif

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Case Number</div>
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->case_number }}
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Creator</div>
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->creator_name }}
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Type of Request</div>
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->type_request }}
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Type of Form</div>
    <div class="col-md-10 bg-ff">
      {{ $afm->name }}
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Department</div>
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->department }}
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Urgency</div>
    <div class="col-md-10 bg-ff">
      @if($myapplist[0]->urgency == 1)
        Normal
      @else
        Urgent
      @endif
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Approver(s)</div>
    <div class="col-md-10 bg-ff">
      @if($myapplist[0]->type_form == 19)
      <div class="approver-list-19">
      @else
      <div class="approver-list">
      @endif

      @if($approverlist->count() != 0)

      <input type="hidden" value="{{ $approverlist->count()}} " id="approver_count" name="approver_count">
      @foreach($approverlist as $approver)
        <span class="each_approver">
          @if($approver->group_id > 0)
          <a class="unap @if($approver->approver_status == 1) alert-success @endif @if($approver->approver_status == 2) alert-danger @endif" target='_blank' href="{{ url('/flexigroup/viewflexigroup/'.$approver->group_id) }}">
            {{ $approver->group_name }}

          @else
          <a class="unap @if($approver->approver_status == 1) alert-success @endif @if($approver->approver_status == 2) alert-danger @endif" data-toggle="tooltip" data-placement="top" title="{{ $approver->approver_email }}">
            {{ $approver->approver_name }}
          @endif
          <input name="approver_id_check[]" type="hidden" value="{{ $approver->approver_user_id }}" />
          </a>
        </span>
      @endforeach

      @else
        <span class="no-approver">N/A</span>
      @endif
      </div>
      </div>
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">CC Person(s)</div>
    <div class="col-md-10 bg-ff">
      @if(isset($ccpersonlist) && $ccpersonlist)
        @foreach($ccpersonlist as $ccperson)
          <a data-toggle="tooltip" data-placement="top" title="{{ $ccperson['ccperson_email'] }}" class="unap @if($ccperson['ccperson_status'] == 1) alert-success @endif">{{ $ccperson['ccperson_name'] }} </a>
          <input type="hidden" value="{{ $ccperson['ccperson_user_id'] }}" name="ccperson_each[]">
        @endforeach
      @else
      N/A
      @endif
    </div>
  </div><!-- end row -->

  @if($myapplist[0]->type_form == 2)
    @include('viewforms.form_rcp')
  @elseif($myapplist[0]->type_form == 3)
    @include('viewforms.form_rca')
  @elseif($myapplist[0]->type_form == 4)
    @include('viewforms.form_area')
  @elseif($myapplist[0]->type_form == 5)
    @include('viewforms.form_arge')
  @elseif($myapplist[0]->type_form == 6)
    @include('viewforms.form_cdsaa')
  @elseif($myapplist[0]->type_form == 7)
    @include('viewforms.form_rdra')
  @elseif($myapplist[0]->type_form == 8)
    @include('viewforms.form_atac')
  @elseif($myapplist[0]->type_form == 9)
    @include('viewforms.form_hphcrf')
  @elseif($myapplist[0]->type_form == 10)
    @include('viewforms.form_mjr')
  @elseif($myapplist[0]->type_form == 11)
    @include('viewforms.form_pgvbf')
  @elseif($myapplist[0]->type_form == 12)
    @include('viewforms.form_sorapfca')
  @elseif($myapplist[0]->type_form == 13)
    @include('viewforms.form_aca')
  @elseif($myapplist[0]->type_form == 14)
    @include('viewforms.form_pcmcf')
  @elseif($myapplist[0]->type_form == 20)
    @include('viewforms.form_pcmcf2')
  @elseif($myapplist[0]->type_form == 15)
    @include('viewforms.form_mrf')
  @elseif($myapplist[0]->type_form == 16)
    @include('viewforms.form_tsw')
  @elseif($myapplist[0]->type_form == 17)
    @include('viewforms.form_irfi')
  @elseif($myapplist[0]->type_form == 18)
    @include('viewforms.form_coprpo')
  @elseif($myapplist[0]->type_form == 19)
    @include('viewforms.form_eoq')
  @else

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Title</div>
    <div class="col-md-10 bg-ff">
    @if($myapplist[0]->status == 0 && $mark == 'creator')
      {!! Form::input('text','title', $myapplist[0]->title , array( 'id' => 'title', 'class' => 'form-control')) !!}
    @else
      {{ $myapplist[0]->title }}
    @endif
  </div>
  </div><!-- end row -->

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Request Details</div>
  <div class="col-md-10 bg-ff">
    @if($myapplist[0]->status == 0 && $mark == 'creator')
      {!! Form::textarea('request_details', $myapplist[0]->request_details, ['class' => 'ckeditor form-control']) !!}
    @else
      {!! $myapplist[0]->request_details !!}
    @endif
  </div>
  </div><!-- end row -->

  @endif

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Documents</div>
    <div class="col-md-10 bg-ff">

      <div class="col-md-8 bg-ff hidden-print">
        <div class="row doc-thumb">

          @if($filelist->count() == 0 && $doclist->count() == 0)
           N/A
          @else

          @if($doclist)

            @foreach($doclist as $doc)
            <div class="google-drive">
              <a class="thumbnail text-center" href="{{ $doc->document_link }}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $doc->document_name }}"  class="thumbnail text-center" >
                <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($doc->document_name, $limit = 10, $end = '...') }}</div>
              </a>
            </div><!-- end drive -->
          @endforeach

        @endif

        @if($filelist)

          @foreach($filelist as $file)
          <div class="icon-hover">
            @if($file->files_mimes == 'application/pdf')

            <a href="/application/view/file/{{ $file->files_fileurl }}/pdf" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $file->files_filename }}"  class="thumbnail text-center pdf-icon" >
              <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($file->files_filename, $limit = 10, $end = '...') }}</div>
            </a>

            @elseif($file->files_mimes == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')

            <a href="/application/view/file/{{ $file->files_fileurl }}/docx" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $file->files_filename }}"  class="thumbnail text-center doc-icon" >
              <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($file->files_filename, $limit = 10, $end = '...') }}</div>
            </a>

             @elseif($file->files_mimes == 'application/msword')

            <a href="/application/view/file/{{ $file->files_fileurl }}/doc" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $file->files_filename }}"  class="thumbnail text-center doc-icon" >
              <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($file->files_filename, $limit = 10, $end = '...') }}</div>
            </a>

            @elseif(($file->files_mimes == 'application/vnd.ms-excel'))

            <a href="/application/view/file/{{ $file->files_fileurl }}/xls" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $file->files_filename }}"  class="thumbnail text-center xls-icon" >
              <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($file->files_filename, $limit = 10, $end = '...') }}</div>
            </a>

            @elseif($file->files_mimes == 'image/jpeg' || $file->files_mimes == 'image/png')

             <a href="/application/download/file/{{ $file->files_fileurl }}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ $file->files_filename }}" data-imagelightbox="bx" class="thumbnail text-center image-icon" >
                <img class="hidden-thumb-image" alt="{{ $file->files_filename }}" src="/uploads/final/{{ $file->files_fileurl }}" />
                <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($file->files_filename, $limit = 10, $end = '...') }}</div>
             </a>

            @else
            <a href="/application/download/file/{{ $file->files_fileurl }}" data-toggle="tooltip" data-placement="top" title="{{ $file->files_filename }}"  class="thumbnail text-center unknowned-icon" ></a>
              <div class="hidden-md hidden-lg hidden-sm doc-size">{{ str_limit($file->files_filename, $limit = 10, $end = '...') }}</div>
            @endif
          </div>
          @endforeach
        @endif
        @endif

        </div><!-- end doc-thumb -->
      </div><!-- end col-md-8 -->

      <div class="visible-print-block">
        @if($filelist->count() == 0 && $doclist->count() == 0)
         N/A
        @else

          @if($doclist)
            @foreach($doclist as $doc)
              <a href="{{ $doc->document_link }}" target="_blank" class="unap">{{ $doc->document_name }} </a>
            @endforeach
          @endif

          @if($filelist)
            @foreach($filelist as $file)

              <a href="/application/file/{{ $file->files_fileurl }}" target="_blank" class="unap">{{ $file->files_filename }} </a>

            @endforeach
          @endif
        @endif
      </div><!-- end visible-print-block -->

    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Status</div>
    <div class="col-md-10 bg-ff">
      @if($myapplist[0]->status == 0)
        <span class="alert-warning">Pending</span>
      @elseif($myapplist[0]->status == 1)
        <span class="alert-success">Approved</span>
      @elseif($myapplist[0]->status == 2)
        <span class="alert-danger">Rejected</span>
      @elseif($myapplist[0]->status == 3)
        <span class="alert-info">Cancelled</span>
      @elseif($myapplist[0]->status == 4)
        <span class="alert-success">Forwarded</span>
      @elseif($myapplist[0]->status == 5)
      <span class="alert-success">Commented</span>
      @elseif($myapplist[0]->status == 6)
      <span class="alert-warning">Feedback Required</span>
      @elseif($myapplist[0]->status == 7)
      <span class="alert-success">Feedback Given</span>
      @endif
    </div>
  </div><!-- end row -->

  @if($approverlist->count() != 0)

    @if($myapplist[0]->status == 0 && $mark == 'creator')
      <div class="row bg-cc-only hidden-print">
        <div class="col-md-2 bg-cc">Cancel Case (*)</div>
        <div class="col-md-10 bg-ff">
          <label class="label-details-check">{!! Form::checkbox('status', '3'); !!} Cancel this case </label>
        </div>
      </div><!-- end row -->

    <div class="row bg-cc-only hidden-print">
      <div class="col-md-2 bg-cc">Remarks (*)</div>
      <div class="col-md-10 bg-ff">
        {!! Form::textarea('remarks', null, ['class' => 'ckeditor form-control', 'id'=>'remarks']) !!}
      </div>
    </div><!-- end row -->

    <div class="row hidden-print">
      <div class="col-md-2">
      </div>
      <div class="col-md-10 bg-ff">
        <button type="submit" class="btn btn-default ">Submit</button>
      </div>
    </div><!-- end row -->
    @endif

  @endif

  @if($myapplist[0]->status != 2 && $myapplist[0]->status != 3 && $myapplist[0]->status != 4 && $mark == 'approver' && $one_approver->approver_read == 0)

  {!! Form::hidden('approver_id', $one_approver->approver_id )!!}

  <div class="row bg-cc-only hidden-print">
    <div class="col-md-2 bg-cc">Approval (*)</div>
    <div class="col-md-10 bg-ff">
      @if($myapplist[0]->type_form == 1)

        @if($currentapprover == $finalapprover)
          <label class="label-details-check">{!! Form::radio('status', '1','',['class' => 'radio_approve']); !!} Approve</label>
        @else
          <label class="label-details-check">{!! Form::radio('status', '1','',['class' => 'radio_approve']); !!} Insert Comment and Proceed</label>
        @endif

       @else

         @if($currentapprover == $finalapprover)
          <label class="label-details-check">{!! Form::radio('status', '1','',['class' => 'radio_approve']); !!} Approve</label>
         @else
          <label class="label-details-check">{!! Form::radio('status', '1','',['class' => 'radio_approve']); !!} Insert Comment and Proceed</label>
         @endif

      @endif

      <label class="label-details-check">{!! Form::radio('status', '4','',['class' => 'radio_recommend', 'data-toggle'=>'modal', 'data-target'=>'.add_recommend']); !!} Forward</label>
      <label class="label-details-check">{!! Form::radio('status', '2','',['class' => 'radio_reject']); !!} Reject</label>

       <div class="recommend-added-list">
         <strong>Forward Person:</strong>
         <span>

         </span>
       </div><!-- end recommend-added-list -->

       @if($myapplist[0]->type_form ==19)

         @if($currentapprover == $finalapprover)

        @else
          <div class="form-group checkbox">
           <label>&nbsp; &nbsp; {!! Form::checkbox('conditions', '1') !!}      I do not have any conflict of interest in connection to this evaluation.</label>
           <div id="conditions"></div>
         </div><!-- end form-group -->
        @endif
      @endif
    </div>
  </div><!-- end row -->

  <div class="row bg-cc-only hidden-print">
    <div class="col-md-2 bg-cc">Remarks (*)</div>
    <div class="col-md-10 bg-ff">
       {!! Form::textarea('remarks', null, ['class' => 'ckeditor form-control', 'id'=>'remarks']) !!}
    </div>
  </div><!-- end row -->

  <div class="row hidden-print">
    <div class="col-md-2">
    </div>
    <div class="col-md-10 bg-ff">
       <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div><!-- end row -->
  @endif

  @if($myapplist[0]->status != 1 && $myapplist[0]->status != 2 && $myapplist[0]->status != 3 && $mark == 'ccperson')

  {!! Form::hidden('ccperson_id', $one_ccperson[0]->ccperson_id )!!}
  <div class="row bg-cc-only hidden-print">
    <div class="col-md-2 bg-cc">Comments (*)</div>
    <div class="col-md-10 bg-ff">
       {!! Form::textarea('comments', null, ['class' => 'ckeditor form-control', 'id'=>'comments']) !!}
    </div>
  </div><!-- end row -->

  <div class="row hidden-print">
    <div class="col-md-2">
    </div>
    <div class="col-md-10 bg-ff">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div><!-- end row -->
  @endif

  <div class="row bg-cc-only history">
    <div class="headhistory bg-cc">History</div>
    <div class="printhistory">
      <a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a>
      <a href="/application/view_details/{{$myapplist[0]->id}}?download=pdf" id="print-pdf" class="btn btn-default">print all</a>
    </div><!-- end printhistory -->

    <table class="table" id="table-history">
      <tr>
        <td style="width:12%">Date</td>
         <td style="width:12%">User</td>
          <td style="width:12%">Action</td>
          <td style="width:12%">Status</td>
          <td style="width:52%">Remarks</td>
      </tr>
      <tr>
        <td>{{ date('d/m/Y', strtotime($myapplist[0]->created_at)) }} {{ date('h:i A', strtotime($myapplist[0]->created_at)) }}</td>
        <td>{{ $myapplist[0]->creator_name }}</td>
        <td>
          @if($myapplist[0]->user_status == 0) Submission @endif
        </td>
        <td>Pending</td>
        <td>-</td>
      </tr>

      @if($historylist)

        @foreach($historylist as $history)
        <tr>
          <td>{{ date('d/m/Y', strtotime($history['date'])) }} {{ date('h:i A', strtotime($history['date'])) }} </td>
          <td>
            @if($history['group_id'] > 0)

            <a class="unap @if($approver->approver_status == 1) alert-success @endif @if($approver->approver_status == 2) alert-danger @endif" target='_blank' href="{{ url('/flexigroup/viewflexigroup/'.$history['group_id']) }}">
              click to view

            @else
              {{ $history['name'] }}
            @endif
          </td>
          <td>
            @if($history['status'] == 0)
              Pending
            @elseif($history['status'] == 1)
              Approved
            @elseif($history['status'] == 2)
              Rejected
            @elseif($history['status'] == 4)
              Forwarded
            @elseif($history['status'] == 5)
              Commented
            @endif
          </td>
          <td>
            @if($history['case_status'] == 0)
              Pending
            @elseif($history['case_status'] == 1)
              Approved
            @elseif($history['case_status'] == 2)
              Rejected
            @elseif($history['case_status'] == 5)
              Commented
            @endif
          </td>
          <td class="remark-td">
            <div>
              <div>@if(isset($history['recommend_user_id']))<strong> Forwarded to {{$history['recommend_user_id']['name']}} </strong> <br /> <br /> Remarks:</div> @endif
                {!! $history['remarks'] !!}
            </div>
          </td>
        </tr>
      @endforeach
    @endif

    @if($myapplist[0]->status == 3)

    <tr>
      <td>{{ date('d/m/Y', strtotime($myapplist[0]->updated_at)) }} {{ date('h:i A', strtotime($myapplist[0]->updated_at)) }}</td>
      <td>{{ $myapplist[0]->creator_name }}</td>
      <td>@if($myapplist[0]->status == 3) Cancelled @endif</td>
      <td>Cancelled</td>
      <td>{!! $myapplist[0]->close_remarks !!}</td>
    </tr>

    @endif

    </table>
  </div><!-- end history -->

</div><!-- end wrap-content -->

<script type="text/javascript">

  creator_id = $('input[name="creator_id"]').val();
  prepend_view();
   prepend_view19();
  check_submit = $('.recommend-added-list').find('.recommend_final').attr('class');
  if(check_submit == undefined) {
    $('.radio_recommend').prop('checked', false);
  }

  $(".click_open").on('click',function(){
      var sib = $(this).siblings('.remarks-history').html();
      $('.open_remarks').find('.remarks-body').append(sib);
  });

  $('.open_remarks').on('hidden.bs.modal', function () {
    $(this).find('.remarks-body').empty();
  });

$(function () {

  CKEDITOR.config.removePlugins = 'about,link';

  $('#recommend_name').autocomplete({
      serviceUrl: '/application/getjsonuser',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      type: 'GET',

      onSelect: function (suggestion) {
        getselector = $(this);
        if(suggestion.data.id != '') {
            switch (getselector.attr('id')) {
              case 'recommend_name':
                $('.recommend-selected').html('<div class="recommend-selected-row"><b>Email Address: </b>'+suggestion.data.email+' <input type="hidden" id="email_address" value="'+suggestion.data.email+'" /><input type="hidden" id="recommend_selected_id" value="'+suggestion.data.id+'" /><input type="hidden" id="recommend_selected_name" value="'+suggestion.value+'" /></div>');
                 break;
          }
        } else{
           $('.recommend-selected-row').remove();
        }

      },
      onInvalidateSelection: function() {
          getselector = $(this);
            switch (getselector.attr('id')) {
            case 'recommend_name':
                $('.recommend_name').html('<b>Name not found</b>none');
                break;
        }
      }
  });

  //recommend status
  $('div.add_recommend').on('hidden.bs.modal', function () {
    $('input#recommend_name').val(''); $('.recommend-selected > div').remove(); $('input#recommend_name').focus();
    rec_final = $('.recommend-added-list').find('.recommend_final').attr('class');

    if(rec_final == undefined) {
        $('.radio_recommend').prop('checked', false);
    }

  });

  $(".submit_recommend").on('click', function(e) {
    e.preventDefault();
    selected_email = $('input#email_address').val();
    selected_name = $('input#recommend_selected_name').val();
    selected_id = $('input#recommend_selected_id').val();
    check_approver_list = true;

    $('.recommend_final').remove();

    $( "[name^='approver_id_check']" ).each(function() {
      var aValue = $(this).val();
      if(aValue == selected_id) check_approver_list = false;
    });

  if(creator_id != selected_id){
        if(selected_email != undefined) {
          if(check_approver_list){
            $(".recommend-added-list").css('display','block');
            $('.recommend-added-list').find('span').append('<span class="recommend_final"><i class="glyphicon glyphicon-minus-sign remove_recommend"></i> <span class="unap alert-info">'+selected_name+' <small>('+selected_email+')</small></span>  <input type="hidden" value="'+selected_id+'" name="selected_recommend"></span>');
            $('.add_recommend').modal('hide');
            $('.radio_recommend').prop('checked', true);
          } else {
           $('.recommend-selected > alert').remove();
           $('.recommend-selected').html('<div class="alert alert-danger"> Person exist on the approver chain. </div>');
          }
        } else {
          $('.recommend-selected > alert').remove();
          $('.recommend-selected').html('<div class="alert alert-danger"> Please select user on the search field. </div>');
        }
    } else {
        $('.recommend-selected > alert').remove();
        $('.recommend-selected').html('<div class="alert alert-danger"> You cant choose owner as forward person. </div>');
    }
  });

  $('.recommend-added-list').on('click','span span i', function(){
      $(".recommend-added-list").css('display','none');
      $(this).parent().remove();
      $('.radio_recommend').prop('checked', false);
  });

   $('.radio_approve, .radio_reject').on('click',function(){
      find_final = $('.recommend-added-list').find('.recommend_final').attr('class');

      if(find_final != undefined) {
        $(".recommend-added-list").css('display','none');
        $('.recommend-added-list').find('.recommend_final').remove();
      }

   });

})

function prepend_view(){
var $set = $('.approver-list > span');
var len = $set.length;
  $(".approver-list > span").each(function(i) {



if (i == len - 1) {
           $(this).find("a").prepend('<span class="numbering_method"> <strong>[Approver] </strong> <span>');

          }else{
              if(i == 0)    {
       $(this).find("a").prepend('<span class="numbering_method"> <strong>[1st Verify] </strong> <span>');

    }
    else if (i == 1) {
           $(this).find("a").prepend('<span class="numbering_method"> <strong>[2nd Verify] </strong> <span>');

          }
       else if (i == 2) {
           $(this).find("a").prepend('<span class="numbering_method"> <strong>[3rd Verify] </strong> <span>');

          }

              }
  });
}
function prepend_view19(){
var $set = $('.approver-list-19 > span');
var len = $set.length;

  $(".approver-list-19 > span").each(function(i) {



if (i == len - 1) {
           $(this).find("a").prepend('<span class="numbering_method"> <strong>[Approver] </strong> <span>');

          }else{
              if(i == 0)    {
       $(this).find("a").prepend('<span class="numbering_method"> <strong>[1st Verify] </strong> <span>');

    }
    else if (i == 1) {
           $(this).find("a").prepend('<span class="numbering_method"> <strong>[2nd Verify] </strong> <span>');

          }
       else if (i == 2) {
           $(this).find("a").prepend('<span class="numbering_method"> <strong>[3rd Verify] </strong> <span>');

          }

              }
  });
}
</script>

</body>
