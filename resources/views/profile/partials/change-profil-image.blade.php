<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Upload your profile image.") }}
        </p>
    </header>
    <form method="post" action="{{ route('profile.update') }}" class="p-6 flex gap-3" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="file" name="image" id="" class="p-3 border-1 text-black border-gray-500 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-md">
        <x-primary-button>{{ __('Change profil') }}</x-primary-button>
    </form>
</section>
