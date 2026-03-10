 <x-auth-session-status class="mb-4" :status="session('status')" />
<form id="registerForm" method="POST" action="{{ route('register') }}">
@csrf
<input type="hidden" name="from_modal" value="1">
<x-input-label for="name" :value="__('Name')" />
<x-text-input id="name" class="block mt-1 w-full"
type="text" name="name" :value="old('name')" required />
<x-input-error :messages="$errors->get('name')" class="mt-2" />
<x-input-label class="mt-4" for="email" :value="__('Email')" />
<x-text-input id="email" class="block mt-1 w-full"
type="email" name="email" :value="old('email')" required />
<x-input-error :messages="$errors->get('email')" class="mt-2" />
<x-input-label class="mt-4" for="phone" :value="__('Phone')" />

<div class="flex mt-1 gap-2">

<select name="country_code"
class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

<option value="+91">+91</option>
<option value="+61">+61</option>

</select>

<x-text-input id="phone"
class="block w-full"
type="tel"
name="phone"
:value="old('phone')"
placeholder="Enter phone number"
required />

</div>
<x-input-error :messages="$errors->get('phone')" class="mt-2" />
<x-input-label class="mt-4" for="password" name="password" />
<x-text-input id="password" class="block mt-1 w-full"
type="password" name="password" :value="old('password')" required />
<x-input-error :messages="$errors->get('password')" class="mt-2" />

<div class="flex items-center justify-between mt-4">

<x-primary-button>
{{ __('Register') }}
</x-primary-button>

<p class="text-sm text-gray-600">
Already have an account?
<a href="#"
class="text-blue-600 hover:underline"
@click.prevent="form='login'">
Login
</a>
</p>

</div>

</form>