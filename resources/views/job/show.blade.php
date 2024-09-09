<x-layout>
    <x-breadcrumbs class="mb-4 ps-1" :links="['Jobs' => route('jobs.index'), $job->title => '#']"></x-breadcrumbs>
    <x-job-card :$job />
</x-layout>