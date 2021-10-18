<div class="lg:w-2/3 mx-auto">
    <h1 class="text-2xl font-bold pt-10 pb-4">Authors and their books</h1>
    <section class="p-2">
        {{ $Authors->links() }}
    </section>
    <div class="bg-white border border-gray-200">
        <ul class="shadow-box">

            @foreach ($Authors as $key => $Author)
            <li class="relative border-b border-gray-200" x-data="{selected:null}">
                <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                    <div>
                        <div>{{ $Author->full_name }}</div>
                        <i class="text-xs">(<strong class="font-bold">{{ $Author->books->count() }}</strong> books)</i>
                        <span class="ico-plus"></span>
                    </div>
                </button>

                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="p-6">
                        @foreach ($Author->books as $bookey => $Book)
                        <p class="p-2">
                            <strong class="text-lg">{{ $Book->title }}</strong> <i class="text-xs">(released_at {{ $Book->released_at }})</i>
                        </p>
                        @endforeach
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <section class="p-2">
        {{ $Authors->links() }}
    </section>
</div>