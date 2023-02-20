<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('ご登録ありがとうございます！ 開始する前に、メールでお送りしたリンクをクリックして、メールアドレスを確認していただけますか？ メールが届かない場合は、メールを再度お送りします.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('登録時に指定したメールアドレスに、再度送信されました。') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('user.verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('メールを再送') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('user.logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
