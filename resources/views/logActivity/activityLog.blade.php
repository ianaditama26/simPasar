@foreach($activities as $activityLog)
   <ul>
      <li>{{ $activityLog['log_name'] }}</li>
   </ul>
@endforeach