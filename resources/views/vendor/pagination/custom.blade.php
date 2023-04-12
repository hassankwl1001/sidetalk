<style>
    @import url('https://rsms.me/inter/inter.css');

    html {
        font-family: 'Inter', sans-serif;
    }

    @supports (font-variation-settings: normal) {
        html {
            font-family: 'Inter var', sans-serif;
        }
    }

    :root {
        --bg-page: #057642;
        --text-color: #f3f3f3;
        --card-bg: #057642;
        --icon-bg: #45423C;
        --blue: #0870f8;
        --blue-rgb: 8, 112, 248;
        --orange: #FF9232;
        --g-purple: linear-gradient(30deg, #85f, #9966ff);
        --g-yellow: linear-gradient(30deg, #fc0, #fc0);
        --g-red: linear-gradient(30deg, #f36, #f24);
        --g-blue: linear-gradient(30deg, #0cf, #0af);
        --g-purple: linear-gradient(30deg, #85f, #9966ff);
        --range: 0%;
        --shadow:057642;
        --light-shadow: rgba(255, 255, 255, .8);
        --light-shadow-2: rgba(255, 255, 255, .1);
    }


    .hide {
        display: none;
        visibility: hidden;
        height: 0;
    }

    .pagination\:container {
        display: flex;
        align-items: center;
    }

    .arrow\:text {
        display: block;
        vertical-align: middle;
        font-size: 13px;
        vertical-align: middle;
    }

    .pagination\:number {
        color: white;
        --size: 32px;
        --margin: 6px;
        margin: 0 var(--margin);
        border-radius: 6px;
        background: #057642;
        max-width: auto;
        min-width: var(--size);
        height: var(--size);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        padding: 0 6px;

    }



    .active {
        background-color: #7ab48b !important;
    }



    .pagination\:active {
        background-color: #7ab48b !important;

        position: relative;
    }
</style>
@if ($paginator->hasPages())

    <div class="pagination:container">
        @if ($paginator->onFirstPage())
            <div class="pagination:number arrow">
                <svg width="18" height="18">
                    <use xlink:href="#left"/>
                </svg>
            </div>
        @else
            <div class="pagination:number arrow">
                <svg width="18" height="18">
                    <use xlink:href="#left"/>
                </svg>
                <a href="{{ $paginator->previousPageUrl() }}" style="color:white;"> <span class="arrow:text">Previous</span></a>
            </div>
        @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <div class="pagination:number disabled">
                        {{ $element }}
                    </div>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <div class="pagination:number active">
                                {{ $page }}
                            </div>
                        @else
                        <a href="{{ $url }}">    <div class="pagination:number ">
                                {{ $page }}
                            </div>
                        </a>

                        @endif
                    @endforeach
                @endif
            @endforeach








        @if ($paginator->hasMorePages())

            <div class="pagination:number arrow">
                <a href="{{ $paginator->nextPageUrl() }}" style="color:white;"> <span class="arrow:text">next</span></a>

                <svg width="18" height="18">
                    <use xlink:href="#right"/>
                </svg>

            </div>
        @else
            <div class="pagination:number arrow">
                <svg width="18" height="18">
                    <use xlink:href="#right"/>
                </svg>

            </div>
        @endif
    </div>

    <svg class="hide">
        <symbol id="left" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </symbol>
        <symbol id="right" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </symbol>
    </svg>
@endif
