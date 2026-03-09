<form method="POST" action="{{ route('register') }}">
@csrf

<x-input-label for="name" :value="__('Name')" />
<x-text-input id="name" class="block mt-1 w-full"
type="text" name="name" required />


<x-input-label class="mt-4" for="email" :value="__('Email')" />
<x-text-input id="email" class="block mt-1 w-full"
type="email" name="email" required />
<x-input-label class="mt-4" for="phone" :value="__('Phone')" />
<x-text-input id="phone" class="block mt-1 w-full"
type="text" name="phone" required />

<x-input-label class="mt-4" for="password" :value="__('Password')" />
<x-text-input id="password" class="block mt-1 w-full"
type="password" name="password" required />


<div class="flex items-center justify-between mt-4">

<x-primary-button>
{{ __('Register') }}
</x-primary-button>

<p class="text-sm text-gray-600">
Don't have an account?
<a href="#"
class="text-blue-600 hover:underline"
@click.prevent="form='login'">
Login
</a>
</p>

</div>


</form>