@extends('custom.layouts.privacyPages')
@section('content')

    <main class="signup__content" style="margin: 5%">
        <div class="header__logo">
            <img src="{{asset('assets/img/skilled.png')}}" alt="logo">
        </div>
        <form id="signform" class="login__form"  method="post">

{{--            <fieldset>--}}
                <p class="MsoNormal" align="center" style="margin-bottom:0in;text-align:center;
mso-pagination:none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">Skilledtalk PRIVACY POLICY<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Last updated [month
day, year]<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><!--[if mso & !supportInlineShapes & supportFields]><span
                        style='mso-element:field-begin;mso-field-lock:yes'></span><span
                        style='mso-spacerun:yes'> </span>SHAPE <span
                        style='mso-spacerun:yes'> </span>\* MERGEFORMAT <span style='mso-element:field-separator'></span><![endif]--><!--[if gte vml 1]><v:rect
                        id="Rectangle_x0020_1" o:spid="_x0000_s1026" style='width:468pt;height:1.1pt;
 visibility:visible;mso-wrap-style:square;mso-left-percent:-10001;
 mso-top-percent:-10001;mso-position-horizontal:absolute;
 mso-position-horizontal-relative:char;mso-position-vertical:absolute;
 mso-position-vertical-relative:line;mso-left-percent:-10001;mso-top-percent:-10001;
 v-text-anchor:top' o:gfxdata="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
" filled="f">
                        <o:lock v:ext="edit" rotation="t" aspectratio="t" verticies="t" text="t"
                                shapetype="t"/>
                        <w:wrap type="none"/>
                        <w:anchorlock/>
                    </v:rect><![endif]--><!--[if !vml]--><img width="626" height="3" src="file:///C:/Users/irfan/AppData/Local/Packages/oice_16_974fa576_32c1d314_2c6e/AC/Temp/msohtmlclip1/01/clip_image001.png" v:shapes="Rectangle_x0020_1"><!--[endif]--><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
                                                                                                                                                                                                                                                                                             coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
                                                                                                                                                                                                                                                                                             filled="f" stroked="f">
                        <v:stroke joinstyle="miter"/>
                        <v:formulas>
                            <v:f eqn="if lineDrawn pixelLineWidth 0"/>
                            <v:f eqn="sum @0 1 0"/>
                            <v:f eqn="sum 0 0 @1"/>
                            <v:f eqn="prod @2 1 2"/>
                            <v:f eqn="prod @3 21600 pixelWidth"/>
                            <v:f eqn="prod @3 21600 pixelHeight"/>
                            <v:f eqn="sum @0 0 1"/>
                            <v:f eqn="prod @6 1 2"/>
                            <v:f eqn="prod @7 21600 pixelWidth"/>
                            <v:f eqn="sum @8 21600 0"/>
                            <v:f eqn="prod @7 21600 pixelHeight"/>
                            <v:f eqn="sum @10 21600 0"/>
                        </v:formulas>
                        <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
                        <o:lock v:ext="edit" aspectratio="t"/>
                    </v:shapetype><![endif]--><!--[if mso & !supportInlineShapes & supportFields]><v:shape
                        id="_x0000_i1025" type="#_x0000_t75" style='width:468pt;height:1.1pt'>
                        <v:imagedata croptop="-65520f" cropbottom="65520f"/>
                    </v:shape><span style='mso-element:field-end'></span><![endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW"><o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">INTRODUCTION<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0in;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">Skilledtalk ("we," "us,"
or "our") is committed to protecting our users' privacy
("user" or "you"). This privacy policy applies to the
information we collect, use, disclose, and retain about you when you visit our
website, </span><a href="http://www.skilledtalk.com/" target="_blank"><span style="font-size:10.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
Arial;color:#0563C1;background:#FAFAFA;mso-fareast-language:ZH-TW">Www.skilledtalk.com</span></a><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">, as well as to any other media format, media
channel, mobile website, or mobile application that is linked to or connected
to the Site (collectively, the "Site"). Please take the time to read
our privacy policy thoroughly. If you do not agree to the terms of this privacy
policy, please do not access the site.</span><span style="font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;"><o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We reserve the right
to amend our Privacy policy at any time and for any reason. Any changes to our
Privacy Policy will be communicated to you by updating the "Last
Updated" date at the top of this page. Any changes or modifications will
take effect immediately upon publishing on the Site, and you therefore waive
your right to particular notice of any such change or modification.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">It is recommended
that you review our Privacy policy on a frequent basis to ensure that you are
aware of any changes. By continuing to use the Site after the updated Privacy
Policy is posted, you are deemed to have been informed of, bound by, and
accepted the new Privacy Policy.&nbsp; <a name="_a1z8gmw82988"></a><o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">COLLECTION OF YOUR INFORMATION<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We may collect
information about you in a variety of ways. We may collect the following
categories of information on the Site:<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Personal Data<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">You voluntarily
provide us with personally identifiable information about yourself, such as
your name, shipping address, email address, and telephone number, as well as
demographic information about yourself, such as your age, gender, hometown, and
interests, when you register with the Site or participate in various Site
activities, such as online chat and message boards. While you are not obligated
to provide us with personal information, your failure to do so may prevent you
from accessing some features of the Site.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Derived Data<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">When you use the
Site, our servers automatically collect information about you, such as your IP
address, browser type, operating system, access times, and the websites you
visited just before and just after accessing the Site.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Financial Data<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">When you make a
purchase, order, return, exchange, or seek information about our services via
the Site, we may collect financial information about you, such as credit card
numbers, brands, and expiry dates. We store just a small portion, if any, of
the financial data we collect. Otherwise, all financial information is stored
by our payment processor, and we advise you to review their Privacy policy and
contact them promptly if you have any concerns.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Data from Social
Networks<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If you connect your
account to social media platforms such as Facebook, Instagram, or Twitter, we
will collect information about you from those platforms, including your name,
social network username, location, gender, birth date, email address, and
profile image, as well as public contact information.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Data from Mobile
Devices<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If you use the Site
via a mobile device, we may collect information about that device, including
its unique identifier, model, and manufacturer, as well as its location.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Third-Party
Information<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Third-party data is
received when you connect your account to a third-party service and provide the
Site access to this data, such as personal information or network friends.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_of2kpc6s3bpz"></a><a name="_cuwaioazo5ri"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">USE OF YOUR INFORMATION <o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">To provide you with a
seamless, efficient, and personalized experience, we rely on correct
information about you. To be more explicit, we may use information about you
that we gather through the Site to:<o:p></o:p></span></p><ul style="margin-top:0in" type="disc">
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Create a safe
     personal account for yourself.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Assist
     investigators with their investigations and reply to subpoenas.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Collect and
     analyze statistics data that has been anonymized for internal use or
     transmission to third parties.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Ads, discounts,
     bulletins, and other information about specials and the Site can be
     customized for you.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Allow
     user-to-user communication.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Complete and
     manage transactions relating to the Site, such as purchases, orders,
     payments, and other operations.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Create a
     customized profile for you so that future visits to the Site may be
     tailored to your preferences.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Enhance the
     Site's efficiency and functionality.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We monitor and
     analyze use and trends to ensure that you get the most out of the Site.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Notify you of
     Site updates.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We will keep you
     informed about new products, services, and/or ideas.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Conduct further
     business transactions as required.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Avoid fraudulent
     transactions, be vigilant for theft, and take precautions to safeguard
     yourself from unlawful conduct.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Processing of
     payments.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We will solicit
     feedback on your usage of the Site and will communicate with you regarding
     it.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Resolve
     conflicts and troubleshoot issues.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Customer service
     and product-related inquiries are handled.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We're going to
     send you a newsletters.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l2 level1 lfo1;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Solicit
     financial support for the Site<b><o:p></o:p></b></span></li>
                </ul><p class="MsoNormal" style="margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;mso-add-space:auto;text-align:justify;mso-pagination:none;
border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><b><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Arial;
mso-fareast-language:ZH-TW">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_j66at0vsg9so"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">DISCLOSURE OF YOUR INFORMATION<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We may reveal
information we have gathered about you in certain circumstances. Your
information may be shared via the following techniques:<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Third-Party Service
Providers<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We may share your
information with third-party service providers that assist us with tasks such
as payment processing, data analysis, email delivery, website hosting, customer
support, and marketing assistance.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Marketing
Communications<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">To the extent
permitted by law, we may share your information with third parties for
marketing purposes with your consent or after providing you with an opportunity
to withdraw consent.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Interactions with
Users<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If you interact with
other Site users, they may see your name, profile photo, and descriptions of
your Site activities, which may include inviting other users to the Site,
talking with other users, like articles, and subscribing to blogs.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Affiliates<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If we share your
information with our affiliates, we will require them to conform to our Privacy
Policy. Our parent company and any subsidiaries, joint venture partners, or
other businesses that we jointly control or manage are considered affiliates.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Business Partners<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Your information may
be shared with business partners in order to provide you with information about
certain goods, services, or promotions.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Internet
advertisements<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">When you post
comments, contributions, or other content to the Site, those items become
accessible to all users and may be publicly distributed in perpetuity outside
of the Site.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Third-Party
Advertisers<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">When you visit the
Site, we may display advertisements through the services of third-party
advertising organizations. These firms may use information about your visits to
the Site and other websites that is stored in web cookies to serve you
advertising for goods and services that may be of interest to you.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Third Parties Not
Listed<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Your data may be
shared with marketers and investors for the purpose of doing business analysis.
Additionally, we may share your information with such third parties for
marketing purposes, as permitted by law.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Sale or Insolvency<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If we reorganize or
sell all or a portion of our assets, merge, or are acquired by another
business, we may transfer your information to the successor business. If we are
forced to close our doors or declare bankruptcy, we will transfer or sell your
information to a third party. You acknowledge that such transfers may occur and
that the receiver may choose to violate the Privacy Policy's requirements.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">By Law or to Protect
Rights<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If we believe that
disclosing information about you is necessary to comply with legal process,
investigate or rectify suspected policy violations, or protect the rights,
property, or safety of others, we will do so in compliance with applicable law,
rule, or regulation. This necessitates data sharing with other businesses in
order to combat fraud and mitigate credit risk.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We are not liable for
the acts of third parties to whom you provide personally identifiable or
sensitive data, and we lack the resources necessary to monitor or supervise
third-party solicitations. You must contact the third party directly if you
wish to unsubscribe from letters, emails, or other third-party communications.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">DISCLAIMER AS TO
INFORMATION SHARED BETWEEN USER AND CONSULTANT<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Any data and
documents provided by a user seeking consultation and a consultant seeking to
give consultation must get their own intellectual property agreements if
necessary; in the event of a violation, we will bear no responsibility, since
we are only a facilitation plate form.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Confidential
documents exchanged during the consultation shall be handled solely between you
and the consultant; Skilledtalk will not be held liable for any breach. It is
recommended that licensing documents not be shared until a mutually agreed upon
NDA in accordance with your company policy is signed.<o:p></o:p></span></p><p class="MsoNormal" style="margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;text-align:justify;mso-pagination:none;border:none;mso-padding-alt:
31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;text-align:justify;mso-pagination:none;border:none;mso-padding-alt:
31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-top:0in;margin-right:0in;margin-bottom:0in;
margin-left:.5in;text-align:justify;mso-pagination:none;border:none;mso-padding-alt:
31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_rzz0xwkv1b2d"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">TRACKING TECHNOLOGIES<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><a name="_n5sqrslzsepk"></a><b><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Arial;
mso-fareast-language:ZH-TW;mso-bidi-font-style:italic">Web Beacons and Cookies<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">On the Site, we may use cookies, web beacons, tracking pixels, and
other tracking technologies to improve your experience and customize it. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">Please refer to our Cookie Policy for further information on how we use
cookies, which is integrated into this Privacy Policy. By accessing and using
the Site, you agree to our Cookie Policy.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">You should be aware that when you acquire a new computer, install a new
browser, update an old browser, or remove or otherwise modify your browser's
cookies files, some opt-out cookies, plug-ins, or preferences may be erased as
well.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">Internet advertising<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW;mso-bidi-font-style:
italic">Additionally, we may utilize third-party technologies to manage email
marketing campaigns and other forms of interactive marketing on the Site. This
third-party software may employ cookies and other tracking technologies in
order to assist us in managing and optimizing your online experience with us.
Please see the </span><a href="http://www.networkadvertising.org/choices/"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;color:windowtext;mso-fareast-language:ZH-TW">Network
Advertising Initiative Opt-Out Tool</span></a><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;mso-fareast-language:ZH-TW"> or </span><a href="http://www.aboutads.info/choices/"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:windowtext;mso-fareast-language:ZH-TW">Digital Advertising Alliance
Opt-Out Tool</span></a><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Arial;mso-fareast-language:
ZH-TW;mso-bidi-font-style:italic"> for further information on how to opt out of
interest-based advertising</span><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Arial;
mso-fareast-language:ZH-TW">.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Website Analytics<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Additionally, we may
collaborate with carefully selected third-party vendors to enable tracking
technologies and remarketing services on the Site through the use of
first-party cookies and third-party cookies in order to analyze and track
users' use of the Site, ascertain the popularity of particular content, and
gain a better understanding of online activity. By using the Site, you consent
to these third-party merchants collecting and using your information. It is
suggested that you read their privacy policy and address any complaints
directly to them. We do not provide these third-party firms with any personal
information. If you desire to opt out of having your information collected and
used by tracking technologies, please visit the third-party vendor's or the
tracking technology's website </span><a href="http://www.networkadvertising.org/choices/"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:windowtext;mso-fareast-language:ZH-TW">Network Advertising
Initiative Opt-Out Tool</span></a><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Arial;
mso-fareast-language:ZH-TW"> or </span><a href="http://www.aboutads.info/choices/"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:windowtext;mso-fareast-language:ZH-TW">Digital Advertising Alliance
Opt-Out Tool</span></a><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Arial;mso-fareast-language:
ZH-TW">.</span><a href="http://www.aboutads.info/choices/"></a><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW"><o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><a href="http://www.adobe.com/privacy/opt-out.html"></a><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW"><o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><a href="http://www.adobe.com/privacy/opt-out.html"></a><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW"><o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_3qgufk2zp9mw"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">THIRD-PARTY WEBSITES<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">The Site may contain
links to third-party websites and apps that you may find useful, such as
advertisements and third-party services. After leaving the Site via these
links, any information you provide to these third parties is not protected by
this Privacy Policy, and we cannot guarantee the security or privacy of your
information. Prior to accessing or giving information to any third-party
website, you should become aware with the third party's privacy policies and
practices (where applicable), and take all necessary actions to ensure the
privacy of your information. We are not responsible for third-party content,
privacy, or security practices or policies, which may include any other
websites, services, or apps connected to or accessible through the Site.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">DATA MANAGEMENT.<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We may preserve your
Personal Data for as long as you use the Service or have an account with us, or
as long as necessary to accomplish the purposes set forth in this Privacy
Policy. We may retain your Personal Data after you deactivate your account
and/or cease using the Service if we believe such retention is reasonably
necessary to comply with our legal obligations, resolve disputes, prevent fraud
and abuse, enforce our Terms and other agreements, and/or protect our
legitimate interests. If we no longer require your Personal Data for these
purposes, we will delete it.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">SECURITY OF YOUR DATA<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We safeguard your
personal information administratively, technologically, and physically. While
we have taken reasonable steps to protect the personal information you provide
to us, please keep in mind that no security system is flawless or impenetrable,
and no mode of data transfer can be guaranteed to be free of interception or
other type of misuse. Any information provided online may be intercepted and
exploited by third parties. As a result, we cannot ensure that any personally
identifiable information you provide will remain entirely confidential.<b><o:p></o:p></b></span></p><p class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify;mso-pagination:none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><b><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-fareast-language:ZH-TW">YOUR GDPR RIGHTS</span></b><span style="font-size:
12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;mso-fareast-language:ZH-TW"><o:p></o:p></span></p><p class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
text-align:justify"><span style="font-size:12.0pt;line-height:115%;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:
ZH-TW">According to current legislation, you have the following rights:<o:p></o:p></span></p><ul type="disc">
                    <li class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
     mso-add-space:auto;text-align:justify;mso-pagination:none;mso-list:l0 level1 lfo2;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:ZH-TW">Access
     to personal data: You have the right to request access to your personal
     data at any time. On request, we shall provide you with a copy of your
     personal data in a commonly used electronic format.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
     mso-add-space:auto;text-align:justify;mso-pagination:none;mso-list:l0 level1 lfo2;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:ZH-TW">The
     right to rectification: You have the right to have inaccurate or
     incomplete personal data repaired or completed.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
     mso-add-space:auto;text-align:justify;mso-pagination:none;mso-list:l0 level1 lfo2;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:ZH-TW">The
     right to erasure: In some instances, you may request that we delete your
     User Data (including those involving processing based on your permission).
     Bear in mind, however, that this right is not absolute. As a result, an
     attempt to assert the right may result in our inaction.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
     mso-add-space:auto;text-align:justify;mso-pagination:none;mso-list:l0 level1 lfo2;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:ZH-TW">The
     right to object: to certain processing activities that we do with your
     personal data, including our use of your personal data for our legitimate
     purposes. Additionally, you have the right to object to the direct
     marketing use of your personal data.<o:p></o:p></span></li>
                    <li class="MsoNormal" style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;
     mso-add-space:auto;text-align:justify;mso-pagination:none;mso-list:l0 level1 lfo2;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:ZH-TW">The
     right to data portability entitles you to get your personal information in
     a structured, commonly used, and machine-readable format (or to have your
     personal data directly sent to another data controller).<o:p></o:p></span></li>
                </ul><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_pkxcyt65agaf"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">POLICY FOR CHILDREN<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We do not intentionally
collect information about children under the age of 13 or advertise to them. If
you become aware that we have obtained personal information from children under
the age of 13 without their consent, please contact us at the address shown
below.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">CONTROLS FOR FEATURES
THAT ARE NOT MONITORED<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">The majority of web
browsers and certain mobile operating systems provide a Do-Not-Track
("DNT") function or option that enables you to communicate your
privacy preferences about the monitoring and collecting of data about your
online browsing activities. There is no industry standard for detecting and
processing DNT signals at the moment. As a result, we do not yet respond to Do
Not Track browser signals or other mechanisms for conveying your desire to be
anonymous online. If a future norm for online monitoring is adopted, we will
tell you via an updated version of this Privacy Policy.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_68x8hhg4z771"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">OPTIONS REGARDING YOUR INFORMATION<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;mso-outline-level:2;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_18e6vd31own3"></a><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Account Information<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">You may examine or
edit the information in your account at any time, or you may terminate your
account, by:<o:p></o:p></span></p><ol style="margin-top:0in" start="1" type="a">
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l1 level1 lfo3;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Accessing and
     changing your account settings<o:p></o:p></span></li>
                    <li class="MsoNormal" style="margin-bottom:0in;margin-bottom:0in;margin-top:
     0in;mso-margin-bottom-alt:10.0pt;mso-margin-top-alt:0in;mso-add-space:
     auto;text-align:justify;mso-pagination:none;mso-list:l1 level1 lfo3;
     border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
     yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
     mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Using the
     contact information provided below, you may contact us.<o:p></o:p></span></li>
                </ol><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We shall deactivate
or remove your account and associated information from our active databases
upon your request to cancel your account. However, we may store certain
information in our files to prevent fraud, troubleshoot problems, help with
investigations, enforce our Terms of Use, and/or comply with legal laws.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;mso-outline-level:2;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_j7abu6mkysdi"></a><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">Emails and
Communications<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">We may send you
periodic newsletters and/or emails advertising the usage of our Service or the
products and services of third parties. If you get newsletters or promotional
messages from us, you may unsubscribe by following the unsubscribe instructions
included in the email or by accessing your Settings page's Notifications
options. Regardless of your preferences, we may send you recurrent
instructional mailings regarding our transactional services.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:2.0pt;text-align:justify;mso-pagination:
none;mso-outline-level:1;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes"><a name="_g22rkoc1aibh"></a><a name="_69tgsuyd2pa0"></a><b><span style="font-size: 12pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-caps: small-caps;">CONTACT US<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">If you have questions
or comments about this Privacy Policy, please contact us at:<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;mso-pagination:none;border:none;
mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:#434343;mso-fareast-language:ZH-TW">[Company Name]<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:#434343;mso-fareast-language:ZH-TW">[Street Address]<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:#434343;mso-fareast-language:ZH-TW">[City, State Zip]<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:#434343;mso-fareast-language:ZH-TW">[Phone Number]<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:#434343;mso-fareast-language:ZH-TW">[Fax Number]<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Arial;color:#434343;mso-fareast-language:ZH-TW">[Email]&nbsp;<o:p></o:p></span></p><p class="MsoNormal" style="line-height:133%;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;
mso-border-shadow:yes">



























































































































































































































































                </p><p class="MsoNormal" style="margin-bottom:0in;text-align:justify;mso-pagination:
none;border:none;mso-padding-alt:31.0pt 31.0pt 31.0pt 31.0pt;mso-border-shadow:
yes"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Arial;mso-fareast-language:ZH-TW">&nbsp;</span></p>
{{--            </fieldset>--}}
        </form>

    </main>
@endsection
