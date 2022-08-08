<div class="register">
    <div class="content">
        <div class="right">
            <p class="fs-1 header">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <form action="{{ route('student.auth.verification.send') }}" method="POST">
                @csrf
                <div class="footer">
                    <div>
                        <button type="submit" class="btn">{{__('Resend Verification Email')}}</button>
                    </div>
                </div>

            </form>
            <form action="{{ route('student.auth.logout') }}" method="GET">
                @csrf
                <div class="footer">
                    <div>
                        <button type="submit" class="btn">{{__('Log Out')}}</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="left">
            <img src="{{ url('assets/img/background-1.png') }}" class="img-fluid" alt="" srcset="">

        </div>

    </div>
</div>
