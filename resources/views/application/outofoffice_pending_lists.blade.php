@extends('layout.master')
@section('title', $title)
@section('content')

<div class="row pos-rel">
  <div class="col-md-12"><h4 class="page-head-line">Pending Task - Out of Office</h4></div>
  @if(count($pendinglist))
  <div class="print-table">
    <a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a>
  </div><!-- end print-table -->
  @endif
</div><!-- end row -->

<div class="wrap-content">

  @if(count($pendinglist))

  <div class="row">
    <div id="no-more-tables">
     <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
          <th>Date</th>
          <th>S/N</th>
          <th>Type of Request</th>
          <th>Title</th>
          <th>Creator</th>
          <th>Approver</th>
          <th>Urgency</th>
          <th>Department</th>
          <th>Status</th>
        </thead>

        <tbody>
          @foreach($pendinglist as $pending)
          <tr class="clickable-row" data-href="/application/view_details/{{$pending->id}}">
            <td data-title="Date">{{ date('d/m/Y', strtotime($pending->created_at)) }}</td>
            <td data-title="S/N">{{ $pending->case_number }}</td>
            <td data-title="Type of request">{{ $pending->type_request }}</td>
            <td data-title="Title">@if($pending->title){{ $pending->title }} @else {{ $pending->form_name }} @endif</td>
            <td data-title="Creator">{{ $pending->name }}</td>
            <td data-title="Approver">{{ $pending->temp_approver_name }}</td>
            <td data-title="Type">
              @if($pending->urgency == 1)
                Normal
              @else
                Urgent
              @endif
            </td>
            <td data-title="Department">{{ $pending->department }}</td>
            <td data-title="Status">
              @if($pending->status == 0)
                <span class="alert-black">Pending</span>
              @elseif($pending->status == 1)
                <span class="alert-black">Approved</span>
              @elseif($pending->status == 2)
                <span class="alert-black">Rejected</span>
              @elseif($pending->status == 3)
                <span class="alert-black">Cancelled</span>
              @elseif($pending->status == 4)
                <span class="alert-black">Forwarded</span>
              @elseif($pending->status == 6)
                <span class="alert-black">Feedback Required</span>
              @elseif($pending->status == 7)
                <span class="alert-black">Feedback Given</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div><!-- end no-more-tables -->
  </div><!-- end row -->

  @else
    <span class="no-data-display">No data to display.</span>
  @endif

</div><!-- end wrap-content -->

@stop
