<head>
  <link rel="stylesheet" href="{{ URL::asset('css/print.css') }}" type="text/css" media="print" />
</head>

<div class="row">
  <div class="col-md-12"><h4 class="page-head-line">{{$title_page}}</h4></div>
</div><!-- end row -->

<div class="wrap-content">
  <div class="visible-print print-status-position">
    Status:
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

  {!!Form::open(['url'=>'/controller/application/reports/'.$action_url,'class'=>'form-horizontal fsize', 'files'=>true])!!}
  {!! Form::hidden('app_id', $myapplist[0]->id )!!}
  {!! Form::hidden('case_number', $myapplist[0]->case_number )!!}
  {!! Form::hidden('creator_id', $myapplist[0]->id )!!}
  {!! Form::hidden('case_status', $myapplist[0]->status )!!}

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Case Number</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->case_number }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Creator</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->creator_name }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Type of Request</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->type_request }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Type of Form</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $afm->name }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Department</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->department }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Urgency</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      @if($myapplist[0]->urgency == 1)
        Normal
      @else
        Urgent
      @endif
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Approver(s)</div><!-- end col-md-2 -->
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
            <a class="unap @if($approver->approver_status == 1) alert-success @endif @if($approver->approver_status == 2) alert-danger @endif" data-toggle="tooltip" data-placement="top" title="{{ $approver->approver_email }}">
              {{ $approver->approver_name }}
              <input name="approver_id_check[]" type="hidden" value="{{ $approver->approver_user_id }}" />
            </a>
          </span>
        @endforeach

      @else
        <span class="no-approver">N/A</span>
      @endif
      </div><!-- end approver-list -->
      </div><!-- end approver-list-19 -->
    </div><!-- end col-md-10 -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">CC Person(s)</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">

    @if(isset($ccpersonlist) && $ccpersonlist)

      @foreach($ccpersonlist as $ccperson)
        <a data-toggle="tooltip" data-placement="top" title="{{ $ccperson['ccperson_email'] }}" class="unap @if($ccperson['ccperson_status'] == 1) alert-success @endif">{{ $ccperson['ccperson_name'] }} </a>
        <input type="hidden" value="{{ $ccperson['ccperson_user_id'] }}" name="ccperson_each[]">
      @endforeach

    @else
    N/A
    @endif

    </div><!-- end col-md-10 -->
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
    <div class="col-md-2 bg-cc">Title</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $myapplist[0]->title }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Request Details</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
    {!! $myapplist[0]->request_details !!}
    </div><!-- end col-md-10 -->
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
              </div><!-- end google-drive -->

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

        </div><!-- end row -->
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

    </div><!-- end col-md-10-->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc hidden-print">Status</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff hidden-print">
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
      @endif
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  @if($myapplist[0]->status == 1 || $myapplist[0]->status == 5)

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc hidden-print">PP Status</div>
    <div class="col-md-10 bg-ff hidden-print">
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
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  @endif

  <div class="history">
    <div class="headhistory">History</div><!-- end headhistory -->
    <div class="printhistory">
      <a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a>
      <a href="/application/view_reports/{{$myapplist[0]->id}}?download=pdf" class="btn btn-default">print all</a>
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
            @if($myapplist[0]->user_status == 0)
            Submission
            @endif
          </td>
          <td>Pending</td>
          <td>-</td>
        </tr>

        @if($historylist)

          @foreach($historylist as $history)
          <tr>
            <td>{{ date('d/m/Y', strtotime($history['date'])) }} {{ date('h:i A', strtotime($history['date'])) }} </td>
            <td>{{ $history['name'] }}</td>
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
            <td>
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
          <td>
            @if($myapplist[0]->status == 3)
              Cancelled
            @endif
          </td>
          <td>Cancelled</td>
          <td>{!! $myapplist[0]->close_remarks !!}</td>
        </tr>
        @endif
      </table>
    </div><!-- end history -->
  </div><!-- end row -->
