@extends('layouts.app')

@section('title')
    {{ config('app.name') }} - Store
@endsection

@section('content')
    <main class="position-relative container justify-content-center py-4">
        <script>
        window.giftVipStoreUrl = "https://www.habboon.pw/store/gift-vip";
        </script>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <strong>Heads up!</strong>
                     We're currently not accepting PayPal payments, however we're now accepting more cryptocurrencies than before.
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <h5 class="silver">VIP Ranks</h5>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card" style="margin-bottom: 0.75rem;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="https://assets.habboon.pw/c_images/album1584//BVIP.gif" alt="Bronze VIP" loading="lazy">
                                    </div>
                                    <div class="col text-center">
                                        Bronze (
                                        <span class="price">£5</span>
                                        )
                                    </div>
                                    <div class="col-12 mt-3">
                                        <form action="https://www.habboon.pw/store/purchase" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                                            <input type="hidden" name="product" value="bronze_vip">
                                            <button type="submit" class="btn btn-success">Buy</button>
                                        </form>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#giftVIPModal" data-package="bronze_vip">
                                            <i class="fas fa-gift" data-toggle="tooltip" data-placement="top" title="Gift a friend"></i>
                                        </button>
                                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#bronzeVIPModal">
                                            <i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="View Perks"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card" style="margin-bottom: 0.75rem;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="https://assets.habboon.pw/c_images/album1584//SVIP.gif" alt="Bronze VIP" loading="lazy">
                                    </div>
                                    <div class="col text-center">
                                        Silver (
                                        <span class="price">£7</span>
                                        )
                                    </div>
                                    <div class="col-12 mt-3">
                                        <form action="https://www.habboon.pw/store/purchase" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                                            <input type="hidden" name="product" value="silver_vip">
                                            <button type="submit" class="btn btn-success">Buy</button>
                                        </form>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#giftVIPModal" data-package="silver_vip">
                                            <i class="fas fa-gift" data-toggle="tooltip" data-placement="top" title="Gift a friend"></i>
                                        </button>
                                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#silverVIPModal">
                                            <i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="View Perks"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="card" style="margin-bottom: 0.75rem;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="https://assets.habboon.pw/c_images/album1584//GVIP.gif" alt="Gold VIP" loading="lazy">
                                    </div>
                                    <div class="col text-center">
                                        Gold (
                                        <span class="price">£12</span>
                                        )
                                    </div>
                                    <div class="col-12 mt-3">
                                        <form action="https://www.habboon.pw/store/purchase" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                                            <input type="hidden" name="product" value="gold_vip">
                                            <button type="submit" class="btn btn-success">Buy</button>
                                        </form>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#giftVIPModal" data-package="gold_vip">
                                            <i class="fas fa-gift" data-toggle="tooltip" data-placement="top" title="Gift a friend"></i>
                                        </button>
                                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#goldVIPModal">
                                            <i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="View Perks"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12 d-none">
                        <div class="card" style="margin-bottom: 0.75rem;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="https://assets.habboon.pw/c_images/album1584//EVIP.gif" alt="Gold VIP" loading="lazy">
                                    </div>
                                    <div class="col text-center">
                                        Emerald (
                                        <span class="price">£??</span>
                                        )
                                    </div>
                                    <div class="col-12" style="margin-top: 10px;">
                                        <button class="btn btn-primary btn-block">Coming Soon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12 d-none">
                        <div class="card" style="margin-bottom: 0.75rem;">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <img src="https://assets.habboon.pw/c_images/album1584//EVIP.gif" alt="Gold VIP" loading="lazy">
                                    </div>
                                    <div class="col text-center">
                                        Emerald Bonus (
                                        <span class="price">£??</span>
                                        )
                                    </div>
                                    <div class="col-12" style="margin-top: 10px;">
                                        <button class="btn btn-primary btn-block">Coming Soon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="silver">
                    Currency 
                    <span class="float-right">
                        <i class="fas fa-coins"></i>
                    </span>
                </h5>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <img src="https://www.habboon.pw/img/store/diamond-light.gif" alt="220 Diamonds" loading="lazy">
                                    </div>
                                    <div class="col text-right">
                                        220 Diamonds (
                                        <span class="price">£4</span>
                                        )
                                    </div>
                                    <div class="col-12" style="margin-top: 10px;">
                                        <form action="https://www.habboon.pw/store/purchase" method="POST">
                                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                                            <input type="hidden" name="product" value="diamonds_220">
                                            <button type="submit" class="btn btn-success btn-block">Purchase</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <img src="https://www.habboon.pw/img/store/diamond-blue.gif" alt="700 Diamonds" loading="lazy">
                                    </div>
                                    <div class="col text-right">
                                        700 Diamonds (
                                        <span class="price">£11</span>
                                        )
                                    </div>
                                    <div class="col-12" style="margin-top: 10px;">
                                        <form action="https://www.habboon.pw/store/purchase" method="POST">
                                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                                            <input type="hidden" name="product" value="diamonds_700">
                                            <button type="submit" class="btn btn-success btn-block">Purchase</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <img src="https://www.habboon.pw/img/store/diamond-gold.gif" alt="1200 Diamonds" loading="lazy">
                                    </div>
                                    <div class="col text-right">
                                        1200 Diamonds (
                                        <span class="price">£14</span>
                                        )
                                    </div>
                                    <div class="col-12" style="margin-top: 10px;">
                                        <form action="https://www.habboon.pw/store/purchase" method="POST">
                                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                                            <input type="hidden" name="product" value="diamonds_1200">
                                            <button type="submit" class="btn btn-success btn-block">Purchase</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <h5 class="silver">
                    Add Credit 
                    <span class="float-right">
                        <i class="fas fa-piggy-bank"></i>
                    </span>
                </h5>
                <div class="card" style="margin-bottom: 0.75rem;">
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            <div class="row align-items-center">
                                <div class="col-2 d-block d-lg-block d-md-none alert-icon-col">
                                    <i class="fas fa-piggy-bank" style="font-size: 36px;"></i>
                                </div>
                                <div class="col">

                                    You have 
                                    <strong>£0</strong>
                                     account balance.
                                </div>
                            </div>
                        </div>
                        <p>We advise that if you're not familiar with crypto or sending payments that you do not attempt to top-up.</p>
                        <form action="https://www.habboon.pw/store" method="POST">
                            <div class="form-group">
                                <label for="amount" class="font-weight-bold">Amount</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">&pound;</span>
                                    </div>
                                    <input type="number" name="amount" class="form-control" placeholder="Amount (to the nearest pound)" aria-label="Amount (to the nearest pound)">
                                </div>
                                <p class="text-muted" style="margin-top: -10px;">You may now enter your own amount.</p>
                            </div>
                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                            <label for="payment-method-crypto" class="font-weight-bold">Pay via crypto</label>
                            <p>Select a crypto currency below.</p>
                            <div class="row no-gutters" id="payment-method-crypto">
                                <div class="col-4 px-1">
                                    <button type="submit" class="btn btn-primary btn-block w-100" name="payment_method" data-toggle="tooltip" data-placement="top" title="Pay using Ethereum" value="Ethereum">
                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1027.png" style="width: 23px;" alt>
                                    </button>
                                </div>
                                <div class="col-4 px-1">
                                    <button type="submit" class="btn btn-primary btn-block" name="payment_method" data-toggle="tooltip" data-placement="top" title="Pay using Litecoin" value="Litecoin">
                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/2.png" style="width: 23px;" alt>
                                    </button>
                                </div>
                                <div class="col-4 px-1">
                                    <button type="submit" class="btn btn-primary btn-block" name="payment_method" data-toggle="tooltip" data-placement="top" title="Pay using BNB" value="BNB">
                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1839.png" style="width: 23px;" alt>
                                    </button>
                                </div>
                                <div class="col-4 px-1 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block" name="payment_method" data-toggle="tooltip" data-placement="top" title="Pay using Polygon/Matic" value="Polygon">
                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/3890.png" style="width: 23px;" alt>
                                    </button>
                                </div>
                                <div class="col-4 px-1 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block" name="payment_method" data-toggle="tooltip" data-placement="top" title="Pay using Bitcoin Cash" value="Bitcoin Cash">
                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1831.png" style="width: 23px;" alt>
                                    </button>
                                </div>
                                <div class="col-4 px-1 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block" name="payment_method" data-toggle="tooltip" data-placement="top" title="Pay using Bitcoin" value="Bitcoin">
                                        <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/1.png" style="width: 23px;" alt>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p class="mt-3">
                            <strong>Note:</strong>
                             Ethereum & Litecoin are recommended due to speed & lower transaction fees.
                        </p>
                        <hr/>
                        <p class="mb-0 mt-3">
                            Please make sure to read our 
                            <a href="#" data-toggle="modal" data-target="#tosModal" class="font-weight-bold">Terms of Service</a>
                            .
                        </p>
                    </div>
                </div>
                <h5 class="silver">
                    Redeem Code 
                    <span class="float-right">
                        <i class="fas fa-money-bill-wave-alt"></i>
                    </span>
                </h5>
                <div class="card">
                    <div class="card-body">
                        <form action="https://www.habboon.pw/store/voucher" method="POST">
                            <div class="form-group">
                                <input type="text" name="code" placeholder="Voucher Code" class="form-control" required>
                            </div>
                            <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">Redeem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    

    <div class="modal fade" id="giftVIPModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gift VIP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Using your account balance, you're able to gift 
                        <span id="gifting-vip-package-name" class="font-weight-bold"></span>
                         to other players.
                    </p>
                    <div id="gifting-alert-messages"></div>
                    <form method="POST" id="gift-vip-form" class="form" style="display: inline-block;">
                        <div class="form-group">
                            <label for="username" class="font-weight-bold">Username</label>
                            <input type="text" name="username" id="username" class="form-control" data-parsley-required-message="Please enter the recipients username." required>
                        </div>
                        <input type="hidden" name="product" value>
                        <input type="hidden" name="_token" value="iTCLpt4PesbaixTXMEFDnDBH25wO8UIPthg3Fa8G" autocomplete="off">

                        <div id="confirmation-section" style="display: none;">
                            <div class="form-group">
                                <p>Confirm the following details:</p>
                                <p id="confirmation-details"></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="confirm" id="confirm-checkbox">
                                    <label class="form-check-label" for="confirm-checkbox">
                                    I confirm the above details are correct.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Gift</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bronzeVIPModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bronze VIP (£5)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Bronze VIP currently features the following perks listed below:</b>
                    </p>
                    <ul>
                        <li>Bronze VIP badge</li>
                        <li>Bronze VIP catalog.</li>
                        <li>1 Chat text colours. </li>
                        <li>Mimic command (:mimic)</li>
                        <li>Super pull command (:spull)</li>
                        <li>Super push command (:spush)</li>
                        <li>Bubble command (:bubble %id%)</li>
                        <li>Reduced flooding (10 seconds).</li>
                        <li>15 daily respect &amp; scratches (5 extra).</li>
                        <li>Ability to enter rooms when they're full. </li>
                        <li>Exclusive effect (:enable 191) </li>
                        <li>Ability to change your username weekly (:flagme)</li>
                        <li class="font-weight-bolder">600 credits per 15 minute cycle.</li>
                        <li class="font-weight-bolder">400 duckets per 15 minute cycle.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="silverVIPModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Silver VIP (£7)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Silver VIP currently features the following perks listed below:</b>
                    </p>
                    <ul>
                        <li>Silver VIP badge</li>
                        <li>Bronze &amp; Silver VIP catalog.</li>
                        <li>3 Chat text colours. </li>
                        <li>Super pull command (:spull)</li>
                        <li>Super push command (:spush)</li>
                        <li>Bubble command (:bubble %id%)</li>
                        <li>Room alert command (:roomalert %message%)</li>
                        <li>Reduced flooding (7 seconds).</li>
                        <li>20 daily respect &amp; scratches (10 extra).</li>
                        <li>Ability to change your username daily (:flagme)</li>
                        <li class="font-weight-bolder">800 credits per 15 minute cycle.</li>
                        <li class="font-weight-bolder">500 duckets per 15 minute cycle.</li>
                        <li>Ability to enter rooms when they're full. </li>
                        <li>Exclusive effect (:enable 191) </li>
                        <li>Ability to request a member of staff to supervise your events.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="goldVIPModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gold VIP (£12)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Gold VIP currently features the following perks listed below:</b>
                    </p>
                    <ul>
                        <li>Gold VIP badge</li>
                        <li>Bronze, Silver &amp; Gold VIP catalog.</li>
                        <li>5 Chat text colours. </li>
                        <li>Super pull command (:spull)</li>
                        <li>Super push command (:spush)</li>
                        <li>Bubble command (:bubble %id%)</li>
                        <li>Room alert command (:roomalert %message%)</li>
                        <li>Reduced flooding (3 seconds).</li>
                        <li>25 daily respect &amp; scratches (15 extra).</li>
                        <li>Ability to change your username daily (:flagme)</li>
                        <li class="font-weight-bolder">1000 credits per 15 minute cycle.</li>
                        <li class="font-weight-bolder">600 duckets per 15 minute cycle.</li>
                        <li>Ability to enter rooms when they're full. </li>
                        <li>Exclusive effect (:enable 191) </li>
                        <li>Exclusive effect badge (:enable 178).</li>
                        <li>Ability to request a member of staff to supervise your events.</li>
                        <li>Ability to use the :eha command to have your event put into the event alert queue.</li>
                        <li>Ability to set an effect on your room bots. (:botenable %id%) or (:botenable %id% %name%) </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tosModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms of Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Purchasing ranks and items through SwiftPay, Selly, or PayPal is considered a donation, and refunds will not be issued under any circumstances. The rewards provided for your purchase are a token of our gratitude for supporting and sustaining our online community.</p>
                    <p>If your account is found in violation of our community guidelines, it may result in a ban, and you will not be entitled to a refund. Furthermore, users are prohibited from filing disputes or claims, as they have already received the purchased item(s) and agreed to the terms upon signing up for the site. Any threat or actual initiation of a claim or dispute through the chosen payment platform may lead to a permanent ban until the matter is resolved.</p>
                    <p>By purchasing anything from SwiftPay, Selly, or PayPal and checking the accept box, you explicitly agree to abide by these Terms and Conditions. In the event of a dispute, we encourage users to contact us directly for resolution before resorting to filing a claim or dispute with the respective payment platform. Failure to follow this procedure may result in account suspension until the issue is resolved.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection