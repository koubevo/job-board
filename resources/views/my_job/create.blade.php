<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Create' => '#']" class="mb-4"/>

    <x-card class="mb-8">
        <form action="{{ route('my-jobs.store') }}" method="POST">
            @csrf
            <div class="grid mb-4 grid-cols-2 gap-4">
                <div>
                    <x-form-label for="title" :required="true">Job Title</x-form-label>
                    <x-text-input name="title" />
                </div>
                <div>
                    <x-form-label for="location" :required="true">Job Location</x-form-label>
                    <x-text-input name="location" />
                </div>
                <div class="col-span-2">
                    <x-form-label for="salary" :required="true">Job Salary</x-form-label>
                    <x-text-input name="salary" type="number" />
                </div>
                <div class="col-span-2">
                    <x-form-label for="description" :required="true">Job Salary</x-form-label>
                    <x-text-input name="description" type="textarea" />
                </div>

                <div>
                    <x-form-label for="experience" :required="true">Experience</x-form-label>
                    <x-radio-group name="experience" :allOption="false" :value="old('experience')" :options="array_combine(array_map('ucfirst' ,\App\Models\Offer::$experience), \App\Models\Offer::$experience)"></x-radio-group>
                </div>

                <div class="mb-4">
                    <x-form-label for="category" :required="true">Category</x-form-label>
                    <x-radio-group name="category" :all-option="false" :value="old('category')" :options="array_combine(array_map('ucfirst' ,\App\Models\Offer::$category), \App\Models\Offer::$category)"></x-radio-group>
                </div>

                <x-button class="w-full col-span-2">Create Job</x-button>
            </div>
        </form>
    </x-card>
</x-layout>