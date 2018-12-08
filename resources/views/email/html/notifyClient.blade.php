@include('email.partials.header')
<div style="margin:0px auto;max-width:600px;">
    <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0">
        <tbody>
            <tr>
                <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:12px;padding-top:12px;"></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="margin:0px auto;border-radius:3px 3px 0px 0px;max-width:600px;background:#ffffff;">
    <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;border-radius:3px 3px 0px 0px;background:#ffffff;" align="center" border="0">
        <tbody>
            <tr>
                <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:24px;padding-top:6px;">
                    <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                            <tbody>
                                <tr>
                                    <td style="word-break:break-word;font-size:0;padding:10px 25px;" align="left">
                                        <div class="" style="cursor:auto;color:{{ site_color() }};font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:16px;font-weight:300;line-height:22px;text-align:left;">
                                            Hello {{ $first_name }},
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="word-break:break-word;font-size:0;padding:0;">
                                        <p style="font-size:1px;margin:0 auto;border-top:1px solid #f2f2f2;width:100%;"></p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="word-break:break-word;font-size:0;padding:20px 25px 0;" align="left">
                                        <div class="" style="cursor:auto;color:#2b2b2b;font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:14px;font-weight:300;line-height:22px;text-align:left;">
                                            @if ($first)
                                                Thank you for continuing to use {{ display_url() }}.  As an added benefit of choosing our site, you’ll receive weekly email alerts notifying you of any new candidates relevant to your job posting.   If you’d like to change your settings or add additional resume alerts, <a style="text-decoration: none; color: {{ site_color() }};" href="{{ link_builder(site_url() . '/company/account/alerts', $queryParameters) }}">click here</a>.
                                            @elseif ($location)
                                                We've identified the following @if (count($candidates) > 1) candidates which match @else candidate which matches @endif the keyword alert you set for: <span style="color:{{ site_color() }};">{{ $keywords }}</span> in <span style="color:{{ site_color() }};">{{ $location }}</span>
                                            @else
                                                We've identified the following @if (count($candidates) > 1) candidates which match @else candidate which matches @endif the keyword alert you set for: <span style="color:{{ site_color() }};">{{ $keywords }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@foreach ($candidates as $candidate)
    <div style="margin:0 auto;max-width:600px;background:#ffffff;">
        <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0;width:100%;background:#ffffff;" align="center" border="0">
            <tbody>
                <tr>
                    <td style="text-align:center;vertical-align:top;border-top:1px solid #f2f2f2;direction:ltr;font-size:0;padding:0 0 24px;">
                        <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td style="word-break:break-word;font-size:0;padding:10px 25px;" align="left">
                                            <div class="" style="cursor:auto;color:#2b2b2b;font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:16px;font-weight:300;line-height:22px;text-align:left;">
                                                <a href="{{ link_builder(site_url() . '/company/resumes/view/' . $candidate->candidate_id, $queryParameters) }}" target="_blank" style="color: inherit; text-decoration: none;">
                                                    <p style="margin-bottom: 4px; text-transform: capitalize;">
                                                        {{ $candidate->display_job_title }}
                                                    </p>
                                                    
                                                    <span style="font-size: 11px; font-weight: 500; color: #b2b2b2; text-transform: uppercase;">
                                                        {{ $candidate->display_location_name }}
                                                    </span>
                                                    
                                                    @if(isset($candidate->display_experience))
                                                        <p style="font-size: 13px; font-weight:800; margin-top: 4px; margin-bottom: 0;">
                                                            {{$candidate->display_experience->title or 'None'}}
                                                        </p>
                                                        
                                                        <span style="font-size: 11px; font-weight: 500; text-transform: uppercase;">
                                                            {{$candidate->display_experience->company or 'None'}}
                                                        </span>
                                                    @endif
                                                        
                                                    @if(isset($candidate->display_education))
                                                        <p style="font-size: 13px; font-weight:800; margin-top: 4px; margin-bottom: 0;">
                                                            {{ $candidate->display_education->school_name }}
                                                        </p>
                                                        
                                                        @if($candidate->display_education->major)
                                                            <span style="font-size: 11px; font-weight: 500; text-transform: uppercase;">
                                                                {{ $candidate->display_education->major }}
                                                            </span>
                                                            
                                                        @endif
                                                    @endif
                                                        
                                                    @if(isset($candidate->display_summary))
                                                        <p style="font-size: 13px; margin-top: 4px; margin-bottom: 0;">
                                                            {{ $candidate->display_summary }}
                                                        </p>
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="word-break:break-word;font-size:0px;padding:10px 25px;padding-top:6px;padding-bottom:0px;" align="left">
                                            <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="left" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="border:1px solid {{ site_color() }};border-radius:24px;color:{{ site_color() }};cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#ffffff">
                                                            <a href="{{ link_builder(site_url() . '/company/resumes/view/' . $candidate->candidate_id, $queryParameters) }}" style="text-decoration:none;line-height:100%;background:#ffffff;color:{{ site_color() }};font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:12px;font-weight:300;text-transform:uppercase;margin:0px;" target="_blank">
                                                                View Candidate
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endforeach
    <div style="margin:0px auto;border-radius:0px 0px 3px 3px;max-width:600px;background:#ffffff;">
        <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;border-radius:0px 0px 3px 3px;background:#ffffff;" align="center" border="0">
            <tbody>
                <tr>
                    <td style="text-align:center;vertical-align:top;border-top:1px solid #f2f2f2;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:24px;padding-top:24px;">
                        <div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td style="word-break:break-word;font-size:0px;padding:10px 25px;padding-top:6px;padding-bottom:0px;" align="center">
                                            <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="border:1px solid {{ site_color() }};border-radius:3px;color:#ffffff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="{{ site_color() }}">
                                                            @if ($location)
                                                                @if ($coordinates)
                                                                    <a href="{{ link_builder(site_url() . '/company/resumes?configure[aroundLatLng]=' . $coordinates . '&location=' . $location .'&query=' . $keywords . '&referrer=' . $queryParameters->referrer) }}" style="text-decoration:none;line-height:100%;background:{{ site_color() }};color:#ffffff;font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:12px;font-weight:500;text-transform:uppercase;margin:0px;" target="_blank">
                                                                        View More Candidates
                                                                    </a>
                                                                @elseif ($boundingBox)
                                                                    <a href="{{ link_builder(site_url() . '/company/resumes?configure[insideBoundingBox]=' . $boundingBox . '&location=' . $location . '&query=' . $keywords . '&referrer=' . $queryParameters->referrer) }}" style="text-decoration:none;line-height:100%;background:{{ site_color() }};color:#ffffff;font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:12px;font-weight:500;text-transform:uppercase;margin:0px;" target="_blank">
                                                                        View More Candidates
                                                                    </a>
                                                                @endif
                                                            @else
                                                                <a href="{{ link_builder(site_url() . '/company/resumes?query=' . $keywords . '&referrer=' . $queryParameters->referrer) }}" style="text-decoration:none;line-height:100%;background:{{ site_color() }};color:#ffffff;font-family:Open Sans, Helvetica, Arial, sans-serif;font-size:12px;font-weight:500;text-transform:uppercase;margin:0px;" target="_blank">
                                                                    View More Candidates
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@include('email.partials.footer')
