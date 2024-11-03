@extends('layouts.app')

@section('title')
    {{ config('app.name') }} - The {{config('app.name')}} Way
@endsection

@section('content')
    <main class="position-relative container justify-content-center py-4">
        <div class="row">
            <div class="col-12">
                <div id="staff-banner">
                    <img src="https://imager.habboon.pw/?figure=sh-740-92.he-50071-1408.ch-665-71.lg-720-89.hr-3852-61.ca-50062-80-92.cc-50030-1414.ha-50026-71-80.hd-600-2&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="936805" data-rank="5" data-toggle="tooltip" data-placement="top" title="lily">
                    <img src="https://imager.habboon.pw/?figure=lg-3283-92-92.ch-50009-1326.hr-3936-34-34.hd-600-10.fa-8332-97-1408.sh-3089-71.ea-3727-1408&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="859292" data-rank="5" data-toggle="tooltip" data-placement="top" title="cookie">
                    <img src="https://imager.habboon.pw/?figure=lg-60508-110.hr-3163-45.ch-3167-0.cc-3007-110-110.hd-180-10.sh-3035-64.wa-8555-110&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="833047" data-rank="5" data-toggle="tooltip" data-placement="top" title="HabboonQuests">
                    <img src="https://imager.habboon.pw/?figure=hr-3163-1350.ea-3270-92-110.ch-240-1326.lg-3483-110-110.ha-1006-1408.hd-205-1.sh-305-62.ca-1816-63&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="384581" data-rank="5" data-toggle="tooltip" data-placement="top" title="BoonValues">
                    <img src="https://imager.habboon.pw/?figure=lg-720-82.hr-43251-61-40.ch-3013-110.sh-3035-104.ca-3414-104.hd-629-17.fa-3276-67.ha-1005-104&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="138081" data-rank="5" data-toggle="tooltip" data-placement="top" title="linds">
                    <img src="https://imager.habboon.pw/?figure=fa-3276-97.lg-3061-92.cc-3542-71-71.ha-4198-1337-71.ch-5030-1337-71.hr-4117-42-42.ea-3169-92.sh-725-92.hd-600-2&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="958941" data-rank="4" data-toggle="tooltip" data-placement="top" title="Paige">
                    <img src="https://imager.habboon.pw/?figure=ch-3013-110.hr-43251-31-40.lg-3017-110-92.hd-629-3.he-3229-1409.sh-908-110.ha-5364-1408.ca-5571-64&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="445566" data-rank="4" data-toggle="tooltip" data-placement="top" title="Kaydee">
                    <img src="https://imager.habboon.pw/?figure=hd-200-18.lg-285-1334.ch-3498-110.sh-3035-1408.hr-3260-42.ca-5574-110-1408.fa-5435-1408.he-3218-1408&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="1622385" data-rank="3" data-toggle="tooltip" data-placement="top" title="lance">
                    <img src="https://imager.habboon.pw/?figure=ch-3135-1335.hr-7326-1404-1404.hd-5319-2-18.lg-5243-1335.sh-3035-92.fa-5467-1408.wa-2003-92.ha-5276-1335.he-3974-1408&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="1618410" data-rank="3" data-toggle="tooltip" data-placement="top" title="lil">
                    <img src="https://imager.habboon.pw/?figure=sh-908-92.hr-9534-41.lg-720-64.ch-660-110.hd-629-28.ha-3762-1408.he-3974-1408.fa-3276-1328.ca-5001-1408&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="1511744" data-rank="3" data-toggle="tooltip" data-placement="top" title="luna">
                    <img src="https://imager.habboon.pw/?figure=ch-5217-106-92.hd-615-3.lg-720-77.sh-740-92.fa-5467-1408.hr-5439-1404-49.he-3974-1408.ha-5343-1408&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="1412103" data-rank="3" data-toggle="tooltip" data-placement="top" title="abigail">
                    <img src="https://imager.habboon.pw/?figure=hd-5319-1-1365.hr-5439-1396-57.ha-5471-77-92.he-3740-1408.fa-5391-1408.ch-3213-77-92.lg-3933-1408.sh-4064-92.cc-4041-92.ca-50062-92-1338&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" class="staff" data-id="1016111" data-rank="3" data-toggle="tooltip" data-placement="top" title="kels">
                </div>
            </div>
            <div class="col-12">
                <div class="card rules-card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <div class="row align-items-center">
                                <div class="col-1 alert-icon-col">
                                    <i class="fas fa-info-circle" style="font-size: 36px;"></i>
                                </div>
                                <div class="col">
                                Rules and regulations are subject to change without notice. As a member of the Habboon community, you hereby agree to and understand the following terms and conditions above. Failure to comply with these rules and regulations will result in the necessary sanctions implemented upon your account. If you have any questions or concerns in regards to The Habboon Way, please do not hesitate to ask a member of the Hotel Staff.
                                </div>
                            </div>
                        </div>
                        <h5 class="silver">General Rules</h5>
                        <ul>
                            <li>
                                <strong>1.1.</strong>
                                 Do not abuse the Call for Help (CFH) system; it should be used during emergency purposes only.
                            </li>
                            <li>
                                <strong>1.2.</strong>
                                 Do not advertise other Habbo Retros; hotel links or purposely mentioning the name of another hotel with the intentions of advertising is not permitted.
                            </li>
                            <li>
                                <strong>1.3.</strong>
                                 Do not attempt to or scam credits or furniture from other users through betting, gaming, or trading.
                            </li>
                            <li>
                                <strong>1.4.</strong>
                                 Do not bully, harass, or abuse other users; avoid violent or aggressive behavior.
                            </li>
                            <li>
                                <strong>1.5.</strong>
                                 Do not disclose any personal information of another user (e.g., address, IP Address, phone number, school, private images etc.) without their consent.
                            </li>
                            <li>
                                <strong>1.6.</strong>
                                 Do not excessively repeat identical or similar statements (spamming).
                            </li>
                            <li>
                                <strong>1.7.</strong>
                                 Users are prohibited from engaging in any sexual, inappropriate, or generally objective acts towards other users without their prior consent. Sexual roleplay involving an underage character is strictly prohibited.
                            </li>
                            <li>
                                <strong>1.8.</strong>
                                 Do not make rooms with inappropriate or abusive names.
                            </li>
                            <li>
                                <strong>1.9.</strong>
                                 Do not attempt to or successfully harm a user’s home internet connection.
                            </li>
                            <li>
                                <strong>1.10.</strong>
                                 Do not disrupt events with explicit language or negative behavior.
                            </li>
                        </ul>
                        <h5 class="silver">Account</h5>
                        <ul>
                            <li>
                                <strong>2.1</strong>
                                 Do not attempt to or give away, buy, sell, or trade your 
                                <strong>Habboon Hotel</strong>
                                 account and/or Habboon items for virtual items from another game, accounts from another game, cash, or vice versa without permission from an Administrator. This includes giving away, buying, selling or trading Habboon furniture/currency for Habbo furniture/currency or vice versa.
                            </li>
                            <li>
                                <strong>2.2</strong>
                                 Do not create a username with an offensive name that is insulting, racist, harassing, or generally objectionable.
                            </li>
                            <li>
                                <strong>2.3</strong>
                                 Do not evade an IP Address ban.
                            </li>
                            <li>
                                <strong>2.4</strong>
                                 Do not share your account with other users.
                            </li>
                            <li>
                                <strong>2.5</strong>
                                 Do not threaten to, attempt to, or hack other users' accounts.
                            </li>
                            <li>
                                <strong>2.6</strong>
                                 Do not create multiple accounts for the purpose of taking an advantage over gaining more in-game currency and/or rares of any kind.
                            </li>
                            <li>
                                <strong>2.7</strong>
                                 Do not re-appeal your ban unless stated otherwise. This means if you re-appeal in 2 days after your first appeal was denied and you were told to re-appeal in 2-3 weeks, you will be banned from the forum as well as the hotel.
                            </li>
                        </ul>
                        <h5 class="silver">Habboon Hotel</h5>
                        <ul>
                            <li>
                                <strong>3.1</strong>
                                 Do not attempt to or exploit errors of 
                                <strong>Habboon Hotel</strong>
                                ; report it to the Administration immediately.
                            </li>
                            <li>
                                <strong>3.2</strong>
                                 Do not attempt to or refund your VIP Membership or donation to 
                                <strong>Habboon Hotel</strong>
                                 at any given time; all payments are final.
                            </li>
                            <li>
                                <strong>3.3</strong>
                                 Do not intentionally give wrong or misleading information to staff members in reports about rule violations, complaints, bug reports, or support requests.
                            </li>
                            <li>
                                <strong>3.4</strong>
                                 Do not make false statements against 
                                <strong>Habboon Hotel</strong>
                                 or any other part of its services.
                            </li>
                            <li>
                                <strong>3.5</strong>
                                 Do not pretend to be a representative of 
                                <strong>Habboon Hotel</strong>
                                . This includes mimicing, acting like them, and or claim to have staff powers.
                            </li>
                            <li>
                                <strong>3.6</strong>
                                 Do not threaten to, attempt to, or use any scripts or third party software to enter, disrupt, or modify 
                                <strong>Habboon Hotel</strong>
                                .
                            </li>
                            <li>
                                <strong>3.7</strong>
                                 Non-harmful auto-typing, auto-clicking and other programs can only be used if you are the room owner or with permission from the room owner.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
   @endsection