<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="text-xl font-bold pb-2">Tickets Claimed List</h5>
                    @forelse($ticketGroups as $key => $tickets)
                        <div class="mt-2 underline">{{ Illuminate\Support\Carbon::parse($key)->format('d M Y')}}</div>


                        <table class="w-full text-sm text-left text-gray-500 mt-2">
                            <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th>#</th>
                                <th>Name</th>
                                <th>Ticket Date</th>
                                <th>User Type</th>
                                <th>Claimed At</th>
                            </tr>
                            @forelse($tickets as $key => $ticket)
                                <tr class="bg-white border-b">
                                    <td>{{ $key + 1}}</td>
                                    <td>{{ $ticket->name }}</td>
                                    <td>{{ $ticket->date->format('d M Y') }}</td>
                                    <td>{{ str($ticket->type)->upper() }}</td>
                                    <td>{{ $ticket->claimed_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr class="text-gray-500 my-2">
                                    <td class="text-center" colspan="4">No tickets claimed</td>
                                </tr>
                            @endforelse
                        </table>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
