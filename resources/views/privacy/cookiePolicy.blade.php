@extends('custom.layouts.privacyPages')
@section('content')

    <main class="signup__content" style="margin: 5%">
        <div class="header__logo">
            <img src="{{asset('assets/img/skilled.png')}}" alt="logo">
        </div>
        <form id="signform" class="login__form"  method="post">
            <p class="MsoNormal" align="center" style="margin-bottom:0in;text-align:center;
mso-pagination:none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">Skilledtalk <span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">DISCLAIMER<o:p></o:p></span></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">Last updated [Date</span><span lang="PT" style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">]</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span lang="PT" style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;"><br></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
widow-orphan lines-together;page-break-after:avoid;mso-outline-level:1;
border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">INTRODUCTION<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">Skilledtalk ("we," "us," or "our")
provides information on </span><a href="http://www.skilledtalk.com/" target="_blank"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Arial Unicode MS&quot;mso-themecolor:background1;border:none;
background:#FAFAFA">Www.skilledtalk.com</span></a><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none; background: rgb(250, 250, 250);"> </span><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;(the "Site"). While we make every
effort to ensure the accuracy, adequacy, validity, reliability, availability,
and completeness of the information on the Site, we make no representation or
warranty, express or implied, regarding the accuracy, adequacy, validity,
reliability, availability, or completeness of any information on the Site.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">We will not be liable for any loss or damage of any kind caused as
a consequence of your use of the site or reliance on any information contained
on the site. You use the site at your own risk and rely on any information
included on the site at your own risk.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
widow-orphan lines-together;page-break-after:avoid;mso-outline-level:1;
border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><a name="_x1u8x12nt00e"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">E</span></b><b><span lang="DE" style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">XTERNAL LINKS DISCLAIMER FOR WEBSITE</span></b><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;"><o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">The Site may contain (or you may be directed to) links to other
websites or material owned or provided by third parties, as well as connections
to websites and features contained in banners or other advertising. We do not
research, monitor, or review the correctness, sufficiency, validity,
reliability, availability, or completeness of any external connections.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">We make no representations or warranties about the authenticity or
reliability of information provided by third-party websites connected through
the site or any website or feature referenced in any banner or other
advertising. We shall not be a party to or responsible for monitoring any
transaction between you and third-party product or service providers.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
widow-orphan lines-together;page-break-after:avoid;mso-outline-level:1;
border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><a name="_wfmrqujylbbj"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">P</span></b><b><span lang="DE" style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">ROFESSIONAL DISCLAIMER FOR WEBSITE</span></b><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;"><o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">The Site cannot provide medical/legal/fitness/health/other advice and
does not do so. The legal/medical/fitness/health/other material is offered for
educational and informative reasons only and is not intended to be a substitute
for expert advice.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">The information you get from the Consultant is provided at the
Consultant's exclusive discretion, and you agree that we will not be
accountable for your use of such information. We just serve as a liaison
between you and the consultant.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">As such, we recommend you to speak with relevant specialists before to
taking any activities based on such material. We do not give medical, legal,
fitness, or health advice of any type. You are entirely responsible for your
use of or reliance on any information posted on this site.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
widow-orphan lines-together;page-break-after:avoid;mso-outline-level:1;
border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><a name="_vr3hcv8nhz0r"></a><a name="_nowexyib1mk6"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">T</span></b><b><span lang="DE" style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">ESTIMONIALS DISCLAIMER FOR WEBSITE</span></b><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;"><o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">Testimonials from users of our services may be included on the Site.
These testimonials are based on the users' actual experiences and views.
However, those users' experiences are unique to them and may not be reflective
of other users of our services. We make no guarantee, and you should make no
assumption, that all users will have the same experience. Your results may
vary.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">Testimonials on the Site may be provided in a variety of formats,
including text, audio, and/or video, and are vetted by us prior to publication.
They appear on the Site verbatim as submitted by users, with the exception of
minor grammatical and spelling issues. Certain testimonies may have been
condensed for the purpose of brevity if the original contained irrelevant
information for the general audience.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; border: none;">The testimonials are the individual user's perspective and do not
reflect our ideas or opinions. We are not linked with the testimonials provided
by users, and users are not rewarded in any way for their testimonials.<o:p></o:p></span></p><p class="MsoNormal" align="center" style="margin-bottom:0in;text-align:center;
mso-pagination:none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes">























































            </p><p class="MsoNormal"><o:p>&nbsp;</o:p></p>
        </form>

    </main>
@endsection
