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
            <div class="col-md-9">
                <h2 class="text-2xl font-semibold mb-4">Received Messages</h2>

                <table class="min-w-full divide-y divide-gray-200 shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sender</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($messages as $message)
                        <tr class="{{ $message->is_read ? '' : 'font-bold' }} hover:bg-blue-200 cursor-pointer message-row" data-url="{{ route('messages.show', $message) }}">
                            <td class="px-6 py-4 {{ $message->is_read ? '' : 'font-bold' }}">
                                {{ $message->sender->name }}
                            </td>
                            <td class="px-6 py-4 {{ $message->is_read ? '' : 'font-bold' }}">
                                {!! \Illuminate\Support\Str::limit($message->content, 50) !!}
                            </td>
                            <td class="px-6 py-4 {{ $message->is_read ? '' : 'font-bold' }}">
                                {{ $message->created_at->timezone('Asia/Manila')->format('F d, Y g:i a') }}
                            </td>

                            <td class="px-6 py-4">
                                <form action="{{ route('messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="delete-form hidden">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" class="p-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        <i class="fas fa-trash-alt"></i>
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-4" colspan="4">No received messages.</td>
                        </tr>
                        @endforelse
                    </tbody>


                </table>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
