<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply ' => '#' ]" />
    <x-job-card :$job />
    <x-card>
       <h2 class="mb-4 text-lg font-medium">Your Job Application</h2>
       <form action="{{ route('job.application.store', $job) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <x-form-label for="expected_salary" :required="true">Expected Salary</x-form-label>
            <x-text-input type="number" name="expected_salary" class="mb-4"/>
        </div>
        <div class="mb-4">
            <x-form-label :required="true">Upload CV</x-form-label>
            <x-text-input type="file" name="cv"></x-text-input>
        </div>
        <x-button class="w-full mt-4">Apply</x-button>
       </form>
    </x-card>
</x-layout>