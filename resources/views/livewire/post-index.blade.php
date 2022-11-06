<div class="max-w-6xl mx-auto">
    <div class="flex justify-end p-2 m-2">
        <x-jet-button wire:click="showPostModal">Create</x-jet-button>
    </div>
    <div class="p-2 m-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Id</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                    Image</th>
                                <th scope="col" class="relative px-6 py-3">Edit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr></tr>
                            @foreach ($posts as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img class="w-8 h-8 rounded-full" src="{{ Storage::url($post->image) }}" />
                                </td>
                                <td class="px-6 py-4 text-sm text-right">
                                    <div class="flex space-x-2">
                                        <x-jet-button wire:click="showEditPostModal({{ $post->id }})">Edit
                                        </x-jet-button>
                                        <x-jet-button class="bg-red-400 hover:bg-red-600"
                                            wire:click="deletePost({{ $post->id }})">Delete
                                        </x-jet-button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 m-2">Pagination</div>
                </div>
            </div>
        </div>

    </div>
    <div>
        <x-jet-dialog-modal wire:model="showingPostModal">
            @if ($isEditMode)
            <x-slot name="title">Update Post</x-slot>
            @else
            <x-slot name="title">Create Post</x-slot>
            @endif
            <x-slot name="content">
                <div class="w-full mt-10 space-y-8 divide-y divide-gray-200">
                    <form enctype="multipart/form-data">
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
                            <div class="mt-1">
                                <input type="text" id="title" wire:model.lazy="title" name="title"
                                    class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5" />
                            </div>
                            @error('title')
                            <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Post Image </label>
                            @if ($oldImage)
                            Old Image:
                            <img src="{{ Storage::url($oldImage) }}">
                            @endif
                            @if ($newImage)
                            Photo Preview:
                            <img src="{{ $newImage->temporaryUrl() }}">
                            @endif
                            <div class="mt-1">
                                <input type="file" id="image" wire:model="newImage" name="newImage"
                                    class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5" />
                            </div>
                            @error('newImage')
                            <span class="text-red-400">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="pt-5 sm:col-span-6">
                            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                            <div class="mt-1">
                                <textarea id="body" rows="3" wire:model.lazy="body"
                                    class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm appearance-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            </div>
                            @error('body')
                            <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>

            </x-slot>
            <x-slot name="footer">
                @if ($isEditMode)
                <x-jet-button wire:click="updatePost">Update</x-jet-button>
                @else
                <x-jet-button wire:click="storePost">Create</x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
