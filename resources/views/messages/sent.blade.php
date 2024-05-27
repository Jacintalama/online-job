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
                <h2 class="text-xl font-bold mb-4">Sent Messages</h2>
                <table class="min-w-full divide-y divide-gray-200 shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <label for="select_all">
                                    Select all
                                    <input type="checkbox" id="select_all">
                                </label>
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipient</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sent At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($sentMessages as $message)
                            <tr class="hover:bg-blue-200 cursor-pointer message-row" data-url="{{ route('messages.show', $message) }}">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="select_message" value="{{ $message->id }}">
                                </td>
                                <td class="px-6 py-4">
                                    {{ $message->recipient->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {!! \Illuminate\Support\Str::limit($message->content, 50) !!}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $message->created_at->timezone('Asia/Manila')->format('F d, Y g:i a') }}
                                </td>
                                <td class="px-6 py-4 delete-btn">
                                    <form action="{{ route('messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="hidden">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4">No sent messages.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>
