<form method="POST" action="{{ route('login') }}">
@csrf

<div>
<x-input-label for="email" :value="__('Email')" />
<x-text-input id="email"
class="block mt-1 w-full"
type="email"
name="email"
required />
</div>

<div class="mt-4">
<x-input-label for="password" :value="__('Password')" />
<x-text-input id="password"
class="block mt-1 w-full"
type="password"
name="password"
required />
</div>

<div class="flex items-center justify-between mt-4">

<x-primary-button>
{{ __('Log in') }}
</x-primary-button>

<p class="text-sm text-gray-600">
Don't have an account?
<a href="#"
class="text-blue-600 hover:underline"
@click.prevent="form='register'">
Register
</a>
</p>

</div>

</form>