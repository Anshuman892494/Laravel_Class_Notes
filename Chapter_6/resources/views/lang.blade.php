<!-- First Method -->
<!-- Using __() helper (Best & Modern) -->
<h1>{{ __('messages.welcome') }}</h1>
<p>{{ __('messages.login') }}</p>
<p>{{ __('messages.logout') }}</p>


<!-- Second Method -->
<!-- Using @lang directive -->
<h1>@lang('messages.login')</h1>

<!-- Third Method -->
<h1>{{ trans('messages.welcome') }}</h1>