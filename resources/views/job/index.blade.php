<x-layout>
    <x-breadcrumbs class="mb-4 ps-1" :links="['Jobs' => route('jobs.index')]"></x-breadcrumbs>
    @foreach ($jobs as $job)
        <x-job-card class="mb-4" :$job>
            <div>
                <x-link-button :href="route('jobs.show', $job)">Show</x-link-button>    
            </div>
        </x-job-card>
    @endforeach
</x-layout>