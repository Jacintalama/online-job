<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inbox
        </h2>
    </x-slot>

    <div class="container mx-auto mt-5">
        <div class="row">
            <!-- Sidebar for navigation -->
            <div class="w-1/4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('messages.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('messages.index') ? 'bg-blue-700 text-white' : 'text-blue-500 hover:bg-blue-200' }}">
                        <i class="fas fa-inbox"></i> Received Messages
                        <span class="bg-red-500 text-white ml-2 px-2 py-1 rounded-full">
                            {{ Auth::user()->unreadMessagesCount() }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('messages.sent') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('messages.sent') ? 'bg-blue-700 text-white' : 'text-blue-500 hover:bg-blue-200' }}">
                        <i class="fas fa-paper-plane"></i> Sent Messages
                    </a>
                </li>
            </ul>
        </div>
           <!-- Main content area -->
<div class="col-md-9 bg-white p-6 rounded-lg shadow-md animate-message">
    <h2 class="text-2xl font-semibold mb-4">Received Messages</h2>

    <div class="mb-6 p-6 bg-gray-100 rounded-lg shadow-inner">
        <h3 class="text-xl font-medium mb-2">Message from  {{ $message->sender->first_name }} {{ $message->sender->middle_initial }}. {{ $message->sender->last_name }}</h3>
        <p class="mb-4 text-gray-700">{!! $message->content !!}</p>
        <p class="text-sm text-gray-600">Sent: {{ $message->created_at->timezone('Asia/Manila')->format('F d, Y g:i a') }}</p>
    </div>
</div>

        </div>
    </div>
</x-app-layout>

