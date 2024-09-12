<x-layout>
    <x-card>
        <form action="{{ route('employer.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-form-label for="company_name" :required="true">
                    Company name
                </x-form-label>
                <x-text-input name="company_name" />
            </div>
            <x-button class="w-full">Create</x-button>
        </form>
    </x-card>
</x-layout>