@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Contact Requests</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage and respond to customer inquiries</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Tabs -->
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <nav class="flex space-x-4" aria-label="Tabs">
            <a href="{{ route('contacts.index', ['status' => 'all']) }}" 
               class="px-4 py-2 text-sm font-medium border-b-2 {{ $status === 'all' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                All
                <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $status === 'all' ? 'bg-primary text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                    {{ \App\Models\Contact::count() }}
                </span>
            </a>
            <a href="{{ route('contacts.index', ['status' => 'pending']) }}" 
               class="px-4 py-2 text-sm font-medium border-b-2 {{ $status === 'pending' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Pending
                <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $status === 'pending' ? 'bg-primary text-white' : 'bg-yellow-200 dark:bg-yellow-700 text-yellow-800 dark:text-yellow-200' }}">
                    {{ \App\Models\Contact::pending()->count() }}
                </span>
            </a>
            <a href="{{ route('contacts.index', ['status' => 'resolved']) }}" 
               class="px-4 py-2 text-sm font-medium border-b-2 {{ $status === 'resolved' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Resolved
                <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $status === 'resolved' ? 'bg-primary text-white' : 'bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-200' }}">
                    {{ \App\Models\Contact::resolved()->count() }}
                </span>
            </a>
        </nav>
    </div>

    <!-- Contact Requests Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        @if($contacts->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Name & Contact
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Property Interest
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Message Preview
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($contacts as $contact)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $contact->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $contact->email }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $contact->phone }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $contact->property_interest ? ucfirst(str_replace('_', ' ', $contact->property_interest)) : 'Not specified' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white line-clamp-2">
                                        {{ Str::limit($contact->message, 100) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($contact->isPending())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            Pending
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Resolved
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $contact->created_at->format('M d, Y') }}
                                    <div class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $contact->created_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('contacts.show', $contact) }}" 
                                       class="text-primary hover:text-primary-dark inline-flex items-center">
                                        View Details
                                        <i class="lni lni-arrow-right ml-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                {{ $contacts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="lni lni-inbox text-6xl text-gray-400 dark:text-gray-600 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No contact requests found</h3>
                <p class="text-gray-500 dark:text-gray-400">
                    @if($status === 'pending')
                        There are no pending contact requests at the moment.
                    @elseif($status === 'resolved')
                        There are no resolved contact requests yet.
                    @else
                        There are no contact requests yet.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection