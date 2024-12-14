@extends('housekeeping.app')

@section('content')
<div class="card mb-5 mb-xl-10" style="margin-left: 10%; max-width: 80%;">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Profile Details</h3>
        </div>
    </div>

    <div id="kt_account_settings_profile_details" class="collapse show">
        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ route('housekeeping.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                    <div class="col-lg-8">
                        <img src="https://imager.habboon.pw/?figure={{ $user->look ?? '' }}&direction=2&head_direction=3&gesture=sml&action=wav" alt="{{ $user->username }}" class="img-fluid rounded-circle mb-4">
                    </div>
                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username:</label>
                    <div class="col-lg-8">
                        <input type="text" name="username" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{ $user->username }}" disabled />
                    </div>
                </div>
                <p></p>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Motto:</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="motto" class="form-control form-control-lg form-control-solid" placeholder="Motto" value="{{ $user->motto }}" />
                    </div>
                </div>
                <p></p>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Rank:</label>
                    <div class="col-lg-8 fv-row">
                       <select name="rank" id="rank" class="form-control">
                            <option value="{{ $user->rank }}">{{ $currentRank->rank_name }} (current)</option>
                            @foreach($ranks as $rank)
                            <option value="{{ $rank->id }}">{{ $rank->rank_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <p></p>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Diamonds:</label>
                    <div class="col-lg-8 fv-row">
                        <input type="number" name="diamonds" class="form-control form-control-lg form-control-solid" placeholder="Enter a diamond amount" value="{{ $user->points }}" />
                    </div>
                </div>
                <p></p>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Duckets:</label>
                    <div class="col-lg-8 fv-row">
                        <input type="number" name="duckets" class="form-control form-control-lg form-control-solid" placeholder="Enter a ducket amount" value="{{ $user->pixels }}" />
                    </div>
                </div>
                <p></p>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Coins:</label>
                    <div class="col-lg-8 fv-row">
                        <input type="number" name="credits" class="form-control form-control-lg form-control-solid" placeholder="Enter a credit amount" value="{{ $user->credits }}" />
                    </div>
                </div>
                <p></p>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Gotw Points:</label>
                    <div class="col-lg-8 fv-row">
                        <input type="number" name="gotw_points" class="form-control form-control-lg form-control-solid" placeholder="Enter GOTW points amount" value="{{ $user->gotw_points }}" />
                    </div>
                </div>
            </div>
            <p></p>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection