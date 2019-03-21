
{{ $employer->first_name }} {{ $employer->last_name }},

Top Candidates on the Market

At Kimmel & Associates, we realize that this is a candidate-tight market and great candidates are hard to find. 
However, we have long-standing relationships with tens of thousands of construction professionals; 
even in this market, we can identify outstanding candidates with exceptional skills and proven track records who fit your company culture.

Below, please find an introduction to a few candidates with whom we are currently working.

@foreach($candidates as $candidate)
@if(!empty($candidate->city) && !empty($candidate->state))
{{ $candidate->walter_id }} – {{ $candidate->job_title }} ( {{$candidate->industry}} {{ $candidate->city }}, {{ $candidate->state }} )
@elseif(!empty($candidate->state))
{{ $candidate->walter_id }} – {{ $candidate->job_title }} ( {{$candidate->industry}} {{$candidate->state}} )
@endif

    – {{ $candidate->summary }}

@endforeach

Please contact us for additional information on any of these candidates or if we can serve you in finding the right candidate for your specific needs at {{$contactLink}}

© 1981 — 2019 Kimmel & Associates, Inc.
All Rights Reserved.

828-251-9900 · 25 Page Ave. Asheville, NC 28801
https://kimmel.com

{{ date("F j, Y") }}
