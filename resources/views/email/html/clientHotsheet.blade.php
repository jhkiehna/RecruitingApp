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
                    Top Candidates on the Market
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
                                @if(!empty($candidate->location_preference))
                                    ( {{ $candidate->location_preference }} )
                                @endif
                        </strong></a>
                        {{ $candidate->industry }} – {{ $candidate->summary }}
                    </p>
                @endforeach
                <!--Hotsheet End-->
                <br>
                <!--Signature -->
                <h1 style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 18px; line-height: 110%; text-align: left; font-weight: normal;">
                    <div class="t m0 xd h5 y5f ff2 fs1 fc3 sc0 ls26 ws0" style="font-size: 15px; font-weight: bold; color:rgb(232,117,0);">JUSTIN WILKINS</div>
                    <div class="t m0 xd h6 y60 ff3 fs1 fc4 sc0 ls27 ws0" style="font-size: 15px; font-style: italic; color:rgb(84,84,84);">Vice President</div>
                    <div class="t m0 xd h6 y61 ff3 fs1 fc4 sc0 ls28 ws0" style="font-size: 15px; font-style: italic; color:rgb(84,84,84);">Industrial &amp; Energy Construction</div>
                    <div class="t m0 xd h6 y62 ff3 fs1 fc4 sc0 ls29 ws0" style="font-size: 15px; font-style: italic; color:rgb(84,84,84);">Kimmel &amp; Associates</div>
                    <div class="t m0 xd h7 y63 ff4 fs1 fc4 sc0 ls2a ws0" style="font-size: 15px; font-style: italic; color:rgb(84,84,84);">Direct: <span class="fc5 ls2b">{{$phone}}</span></div>
                </h1>
            </td>
        </tr>
    </tbody>
</table>
<p style="color: #505050; font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 12px; line-height: 110%; text-align: center;">
    <a style="color: #e87600;" href="{{$contactLink}}">
        <img style="width: 100%;" src="{{ asset('Kimmel-Banner.png') }}" alt=""/>
    </a>
</p>

@include('email.partials.hotsheetFooter')
