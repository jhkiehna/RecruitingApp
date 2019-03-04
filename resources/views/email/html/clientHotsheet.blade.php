@include('email.partials.hotsheetHeader')

<table valign="top" border="0" cellpadding="0" cellspacing="0" style="padding: 60px 20px; min-height: 500px;">
    <tbody>
        <tr>
            <td valign="center" style="color: #505050; font-family: Helvetica, sans-serif; font-size: 16px; line-height: 150%; text-align: left; padding: 12px 20px;">
                {{ $employer->first_name }} {{ $employer->last_name }},
                <br>
                <span style="font-size:12px;">{{ date("F j, Y") }}</span>
            </td>
        </tr>
        <tr>
            <td valign="center" style="color: #505050; font-family: Helvetica, sans-serif; font-size: 16px; line-height: 150%; text-align: left; padding: 12px 20px;">
                <h1 style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 18px; line-height: 110%; text-align: left; font-weight: bold;">
                    Top {{ $industry }} Candidates on the Market
                </h1>
                <p style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 12px; line-height: 110%; text-align: left;">
                    At Kimmel &amp; Associates, we
                    realize that this is a
                    candidate-tight market and great
                    candidates are hard to find.
                    However, we have long-standing
                    relationships with tens of thousands
                    of construction professionals; even
                    in this market, we can identify
                    outstanding candidates with
                    exceptional skills and proven track
                    records who fit your company
                    culture.
                </p>
                <p style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 12px; line-height: 110%; text-align: left;">
                    Below, please find an introduction
                    to a few candidates with whom we are
                    currently working. Please
                    <a style="font-size: 12px; font-family: 'Trebuchet MS', Helvetica, Arial, sans-serif; text-decoration: none; outline: none; color: #e87600;" href="{{ $contactLink }}">
                        contact us
                    </a>
                    for additional information on any of
                    these candidates or if we can serve
                    you in finding the right candidate
                    for your specific needs.
                </p>

                <!--Hotsheet Below-->
                @foreach($candidates as $candidate)
                    <p style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 12px; line-height: 110%; text-align: left;">
                        <a style="color: #e87600;" href="{{$contactLink}}?subject=Candidate-{{$candidate->walter_id}}"><strong>
                            {{ $candidate->walter_id }} – {{ $candidate->job_title }}
                                @if(!empty($candidate->city) && !empty($candidate->state))
                                    ( {{ $candidate->city }}, {{ $candidate->state }} )
                                @elseif(!empty($candidate->state))
                                    ( {{$candidate->state}} )
                                @endif
                        </strong></a>
                        – {{ $candidate->summary }}
                    </p>
                @endforeach
                <!--Hotsheet End-->

                <p style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 12px; line-height: 110%; text-align: center;">
                    <a style="color: #e87600;" href="http://kimmel.com/jobs/?utm_source=ConNews918&amp;utm_medium=email&amp;utm_term=construction&amp;utm_content=hotsheet&amp;utm_campaign=ConNews918">
                        <img style="width: 100%;" src="https://media.kimmel.com/assets/img/uploads/kimmel-jobs/kimmel-jobs.jpg" alt=""/>
                    </a>
                </p>
                <h1 style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 18px; line-height: 110%; text-align: left; font-weight: bold;">
                    <a style="color: #e87600;" href="https://kimmel.com/candidates/offering-and-accepting-counteroffers-its-a-mistake.html?utm_source=ConNews918&amp;utm_medium=email&amp;utm_term=construction&amp;utm_content=hotsheet&amp;utm_campaign=ConNews918">
                        Offering and Accepting
                        Counteroffers: It’s a
                        Mistake!
                    </a>
                </h1>
                <p style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 12px; line-height: 110%; text-align: left;">
                    If you have been in the workforce
                    long enough, chances are good that
                    you have some experience with
                    counteroffers. But despite how
                    common they are, the truth is that
                    counteroffers are a bad idea for
                    both employees and employers.
                    <strong>Need proof?</strong> How
                    about this: back in 2015, DeAndre
                    Jordan accepted a counteroffer.
                    After verbally accepting a
                    four-year, $80 million deal with the
                    Dallas Mavericks, Jordan faced
                    pressure from his coaches and his
                    teammates in Los Angeles, and he
                    decided to stay with the Clippers in
                    exchange for a pay raise. How did
                    that work out for Jordan and the
                    Clippers?
                    <strong>No one benefits in the long run…</strong>
                    <a style="color: #e87600;" href="https://kimmel.com/candidates/offering-and-accepting-counteroffers-its-a-mistake.html?utm_source=ConNews918&amp;utm_medium=email&amp;utm_term=construction&amp;utm_content=hotsheet&amp;utm_campaign=ConNews918">
                        Here’s Why
                    </a>
                </p>
            </td>
        </tr>
    </tbody>
</table>

@include('email.partials.hotsheetFooter')
