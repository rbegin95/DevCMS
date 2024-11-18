@extends('layouts.app')

@section('content')
<main class="position-relative container justify-content-center py-4">
        <div class="row">
        <div class="col-lg-3 col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="silver">Account Settings</h5>

            <ul class="nav nav-pills" id="account-navigation">
                <li class="nav-item">
                    <a href="https://www.habboon.pw/account" class="nav-link ">Preferences</a>
                </li>

                <li class="nav-item">
                    <a href="https://www.habboon.pw/account/email" class="nav-link ">Email</a>
                </li>

                <li class="nav-item">
                    <a href="https://www.habboon.pw/account/password" class="nav-link ">Password</a>
                </li>

                <li class="nav-item">
                    <a href="https://www.habboon.pw/account/discord" class="nav-link  active ">Discord</a>
                </li>
            </ul>
        </div>
    </div>
</div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="silver">Discord Account Association</h5>
                        <a href="https://discordapp.com/api/v6/oauth2/authorize?client_id=346090429629857794&amp;redirect_uri=https://www.habboon.pw/account/discord&amp;response_type=code&amp;scope=identify" class="btn btn-primary btn-block">Login with Discord</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection