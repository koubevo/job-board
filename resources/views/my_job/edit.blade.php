<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Edit Job' => '#']" class="mb-4"/>

    <x-card class="mb-8">
        <form action="{{ route('my-jobs.update', $job) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid mb-4 grid-cols-2 gap-4">
                <div>
                    <x-form-label for="title" :required="true">Job Title</x-form-label>
                    <x-text-input name="title" :value="$job->title"/>
                </div>
                <div>
                    <x-form-label for="location" :required="true">Job Location</x-form-label>
                    <x-text-input name="location" :value="$job->location"/>
                </div>
                <div class="col-span-2">
                    <x-form-label for="salary" :required="true">Job Salary</x-form-label>
                    <x-text-input name="salary" type="number" :value="$job->salary"/>
                </div>
                <div class="col-span-2">
                    <x-form-label for="description" :required="true">Job Description</x-form-label>
                    <x-text-input name="description" type="textarea" :value="$job->description"></x-text-input>
                </div>

                <div>
                    <x-form-label for="experience" :required="true">Experience</x-form-label>
                    <x-radio-group name="experience" :allOption="false" :value="$job->experience" :options="array_combine(array_map('ucfirst' ,\App\Models\Offer::$experience), \App\Models\Offer::$experience)"></x-radio-group>
                </div>

                <div class="mb-4">
                    <x-form-label for="category" :required="true">Category</x-form-label>
                    <x-radio-group name="category" :all-option="false" :value="$job->category" :options="array_combine(array_map('ucfirst' ,\App\Models\Offer::$category), \App\Models\Offer::$category)"></x-radio-group>
                </div>

                <x-button class="w-full col-span-2">Edit Job</x-button>
            </div>
        </form>
    </x-card>
</x-layout>