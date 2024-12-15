@extends('Layout.LoginRegisterLayout')

@section('base')
<div class="col-xxl-6 col-lg-6 col-12">
    <div class="nftmax-wc__form">
        <div class="nftmax-wc__form-inner">
            <div class="nftmax-wc__heading">
                <h3 class="nftmax-wc__form-title nftmax-wc__form-title__one">Sign Up</h3>
            </div>
            @if(session('success'))
                <span style="color: green">{{ session('success') }}</span>
            @endif
            @if($errors->any())
                <div style="color: red">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="nftmax-wc__form-main" action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="nftmax-wc__form-label">Name</label>
                    <div class="form-group__input">
                        <input class="nftmax-wc__form-input" type="text" name="name" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="nftmax-wc__form-label">Email Address</label>
                    <div class="form-group__input">
                        <input class="nftmax-wc__form-input" type="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="nftmax-wc__form-label">Password</label>
                    <div class="form-group__input">
                        <input class="nftmax-wc__form-input" type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="nftmax-wc__form-label">Confirm Password</label>
                    <div class="form-group__input">
                        <input class="nftmax-wc__form-input" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="nftmax-wc__button">
                        <input class="ntfmax-wc__btn" type="submit" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
