<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Job Applications' => '#']"/>
    @forelse ($applications as $application)
    <div class="mb-4 rounded-md border border-slate-300 bg-white p-4 shadow-sm">
        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-medium">{{ $application->title }}</h2>
            <div class="text-slate-500">${{ number_format($application->salary) }}</div>
        </div>

        <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
            <div>
                <div>
                    Applied {{ $application->created_at }}
                </div>
                <div>
                    Your asking salary: ${{ $application->expected_salary }}
                </div>
            </div>
            <div class="flex space-x-1 text-xs">
                <x-tag><a href="{{ route('jobs.index', ['experience' => $application->experience])}}">{{ Str::ucfirst($application->experience) }}</a></x-tag>
                <x-tag><a href="{{ route('jobs.index', ['category' => $application->category])}}">{{ Str::ucfirst($application->category) }}</a></x-tag>
            </div>
            <div>
                <form action="{{ route('my-job-applications.destroy', $application->application_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Cancel</x-button>
                  </form>
            </div>
        </div>

    </div>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            No job application yet
        </div>
        <div class="text-center">
            Go find your new job <a class="text-indigo-500 hover:underline" href="{{ route('jobs.index') }}">here!</a>
        </div>
    @endforelse
</x-layout>